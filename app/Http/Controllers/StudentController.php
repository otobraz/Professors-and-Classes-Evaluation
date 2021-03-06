<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Models\Aluno;
use App\Models\Curso;
use App\Models\Resposta;

class StudentController extends Controller
{

   // Gets and returns the LdapUser based on the username (CPF)
   public function getLdapUser($ldapData = null, $username = null){
      $ds = ldap_connect($ldapData['server']); // your ldap server
      try{
         $bind = ldap_bind($ds, $ldapData['cn'] . "," . $ldapData['domain'], base64_decode($ldapData['password']));
         $filter = "(" . $ldapData['id_field'] . "=" . $username . ")"; // this command requires some filter
         $justThese = array(
            $ldapData['given_name_field'],
            $ldapData['last_name_field'],
            $ldapData['email_field']
         ); // the attributes to pull, which is much more efficient than pulling all attributes if you don't do this
         $sr = ldap_search($ds, $ldapData['domain'], $filter, $justThese);
         $entry = ldap_get_entries($ds, $sr);
         if ($entry['count'] > 0) {
            return $entry;
         }
         return null;
      }catch(\Exception $e){
         abort(503);
      }
   }

   /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function index()
   {

      $students = Aluno::all();
      switch (session()->get('role')) {

         case '0':
         return view ('student.admin.index', compact('students'));
         break;

         case '2':
         return view ('student.professor.index', compact('students'));
         break;

         case '3':
         return view ('student.prograd.index', compact('students'));
         break;

         default:
         return redirect('home');
         break;
      }

   }

   /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function show($id){

      $student = Aluno::find(decrypt($id));
      if(isset($student)){
         $currentSections = $student->turmas()->OrderByDisciplina()->get()->groupBy('ano')->transform(function($item, $k) {
            return $item->groupBy('semestre');
         })->first()->first();

         $currentGuidances = $student->orientacoes()->emAndamento()->get();
         $openSurveys = collect();
         $generalSurveys = collect();

         foreach  ($student->turmas as $section){
            foreach ($section->questionarios as $survey) {
               if(is_null($survey->professor_id)){
                  if($survey->pivot->aberto){
                     $response = Resposta::where('questionario_turma_id', $survey->pivot->id)->first();
                     if(!isset($response)){
                        $generalSurveys = $generalSurveys->push(array($survey, $section));
                     }
                  }
               }else{
                  if($survey->pivot->aberto){
                     $response = Resposta::where('questionario_turma_id', $survey->pivot->id)->first();
                     if(!isset($response)){
                        $openSurveys = $openSurveys->push(array($survey, $section));
                     }
                  }
               }
            }

         }

         return view('student.admin.show', compact(
            'currentSections',
            'currentGuidances',
            'openSurveys',
            'generalSurveys',
            'student'
         ));
      }

   }

   /**
   * Show the form for editing the specified resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function edit()
   {
      $student = Aluno::find(session()->get('id'));
      return view('student.edit', compact('student'));
   }

   /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function update(Request $request, $id)
   {

      $student = Aluno::find(decrypt($id));
      $student->email = $request->input('email');
      if($student->save()){
         return redirect()->route('student.edit', ['id' => $id])->with('successMessage', 'Informações alteradas com sucesso.');
      }
      return redirect()->route('student.edit', ['id' => $id])->with('errorMessage', 'Erro ao atualizar informações');
   }

   /**
   * Show the form for importing the students from the .csv file
   */
   public function import(){
      return view('student.admin.import');
   }

   /**
   * Import the students from the .csv file
   */
   public function storeFromCsv(Request $request){

      if($request->file('students-csv')->isValid()){

         $studentsCsv = (array_map('str_getcsv', file($request->file('students-csv'))));
         $filtered = array_filter($studentsCsv, function($v, $k){
            return $v[6] == "MATRICULADO";
         }, ARRAY_FILTER_USE_BOTH);
         $cpfs = array_column($filtered, 4, 0);
         $cursos = array_column($filtered, 7, 0);
         krsort($cpfs);
         $cpfs = array_unique($cpfs);
         $array1 = array_intersect_key($cpfs, $cursos);
         $array2 = array_intersect_key($cursos, $cpfs);
         $studentsData = array_merge_recursive($array1, $array2);


         $header = [
            "MATRICULA",
            "NOME",
            "SEXO",
            "DATA NASCIMENTO",
            "CPF",
            "RG",
            "DESCRICAO SITUACAO ALUNO",
            "COD CURSO"
         ];

         if($header == array_shift($studentsCsv)){
            $students = Aluno::all();
            $sections = Curso::all();
            $ldapData = config('my_config.ldapData');
            foreach ($studentsData as $key => $student){
               $username = preg_replace('/[^0-9]+/', '', $student[0]);
               $major = $sections->where('cod_curso', $student[1])->first();
               if($studentModel = $students->where('usuario', $username)->first()){
                  $studentModel->matricula = $key;
                  $studentModel->curso_id = $major->id;
                  $studentModel->save();
               }else{
                  if($ldapUser = $this->getLdapUser($ldapData, $username)){
                     $newStudent = new Aluno([
                        'usuario' => $username,
                        'matricula' => $key,
                        'nome' => $ldapUser[0][$ldapData['given_name_field']][0],
                        'sobrenome' => $ldapUser[0][$ldapData['last_name_field']][0],
                        'email' => (array_key_exists($ldapData['email_field'], $ldapUser[0]) ? $ldapUser[0][$ldapData['email_field']][0] : NULL),
                        'curso_id' => $major->id
                     ]);
                     $newStudent->save();
                  }
               }
            }
            return redirect()->route('student.index')->with('successMessage', 'Importação realizada com sucesso');
         }else{
            return redirect()->back()->with('errorMessage', 'Arquivo inválido');
         }
      }else{
         return redirect()->back()->with('errorMessage', 'Erro ao importar CSV');
      }
   }
}
