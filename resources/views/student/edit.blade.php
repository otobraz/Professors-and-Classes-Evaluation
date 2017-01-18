@extends('layout.student.base')

@section('title')
   {{session()->get('first_name')}} | Perfil
@endsection

@section('content')

   <div class="col-md-offset-2 col-md-8">
      <div class="box box-primary-ufop">
         <div class="box-header with-border">
            <h3 class="box-title">PERFIL</h3>
         </div>

         <div class="box-body">

            @include('alert-message.success')
            @include('alert-message.error')

            <form class="form-signin" method="POST" action="{{action('StudentController@update', encrypt($student->id))}}">

               {{ csrf_field() }}

               {{ method_field('PUT') }}

               <table class="table h4 table-condensed table-responsive">
                  <tbody>
                     <tr>
                        <th>Nome:</th>
                        <td>{{$student->nome_completo}}</td>
                     </tr>
                     <tr>
                        <th>Curso:</th>
                        <td>{{$student->curso->curso}}</td>
                     </tr>
                     <tr>
                        <th>Matrícula:</th>
                        <td>{{$student->matricula}}</td>
                     </tr>
                     <tr>
                        <th>Login (CPF):</th>
                        <td>{{$student->usuario}}</td>
                     </tr>
                     <tr>
                        <th>E-mail:</th>
                        <td>
                           <input class="form-control" type="email" name="email" placeholder="E-mail" value="{{$student->email}}" autofocus required>
                        </td>
                     </tr>

                  </tbody>

               </table>

               <hr>

               <div class="pull-left">
                  <a class="btn btn-primary-ufop" role="button" href="https://zeppelin10.ufop.br/minhaUfop/desktop/login.xhtml" target="_blank"><i class="fa fa-external-link"></i> <span>minhaUFOP</span></a>
               </div>

               <div class="pull-right">
                  <button class="btn btn-default" type="button" onclick="history.go(-1)"> Cancelar</button>
                  <button class="btn btn-primary-ufop" type="submit"><i class="fa fa-pencil-square-o"></i> Atualizar Perfil</button>
               </div>

            </form>

         </div>

      </div>

   </div>

@endsection
