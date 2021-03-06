@extends('layout.admin.base')

@section('title')
   Importar | Alunos
@endsection

@section('content')

   <div class="col-md-offset-3 col-md-6">
      <div class="box box-primary-ufop">
         <div class="box-header with-border">
            <h3 class="box-title">IMPORTAR ALUNOS</h3>
            <div class="box-tools pull-right">
            </div>
         </div>
         <div class="box-body">
            @include('alert-message.error')
            <form class="form-signin" method="POST" autocomplete="off" enctype="multipart/form-data" action="{{action('StudentController@storeFromCsv')}}">
               {{ csrf_field() }}
               <fieldset>

                  <div class="form-group">
                     <label for="professors-csv">Selecione o arquivo: <span class="span-error">*</span></label>
                     <input type="file" accept=".csv" id="students-csv" name="students-csv"
                        oninvalid="setCustomValidity('Selecione o arquivo.')"
                        oninput="setCustomValidity('')"required
                     >
                     <p class="help-block">Apenas arquivos do tipo .csv</p>
                  </div>

                  <button class="btn btn-default"  type="reset"><i class="glyphicon glyphicon-erase"></i> Limpar</button>
                  <button class="btn btn-primary-ufop" type="submit"><i class="fa fa-check-square-o"></i> Importar</button>
               </fieldset>
            </form>
         </form>
      </div><!-- /.box-body -->
   </div>

@endsection
