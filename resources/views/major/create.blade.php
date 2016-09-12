@extends('dashboard.dashboard_base')

@section('title')
   Criar Curso
@endsection

@section('sidebar')
   @include('admin.sidebar')
@endsection

@section('content')
   <div class="container">
      <div class="col-md-offset-4 col-md-4">
         <form class="form-signin" method="POST" action="{{action('MajorController@store')}}">
            {{ csrf_field() }}
            <fildset>
               <legend>Criar novo Curso</legend>

               <div class="form-group">
                  <label for="major">Nome do curso:</label>
                  <input class="form-control input-xlarge" type="text" name="major" id="major"
                  placeholder="Nome do curso" autofocus required
                  oninvalid="setCustomValidity('Informe o nome do curso.')"
                  oninput="setCustomValidity('')"
                  >
               </div>
               <div class="form-group">
                  <label for="initials">Sigla:</label>
                  <input class="form-control input-xlarge " type="text" name="initials" id="initials"
                  placeholder="Sigla" required
                  oninvalid="setCustomValidity('Informe a sigla do curso.')"
                  oninput="setCustomValidity('')"
                  >
               </div>

               <button class="btn btn-default"  type="reset"><i class="glyphicon glyphicon-erase"></i> Limpar</button>
               <button class="btn btn-primary" type="submit"><i class="fa fa-check-square-o"></i> Criar</button>
            </fildset>
         </form>
      </div>
   </div>
@endsection
