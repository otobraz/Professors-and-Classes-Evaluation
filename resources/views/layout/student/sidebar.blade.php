<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">

   <!-- sidebar: style can be found in sidebar.less -->
   <section class="sidebar">

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
         <li class="header">MENU</li>
         <!-- Optionally, you can add icons to the links -->
         <li>
            <a href="{{action('SurveyController@index')}}"><i class="fa fa-comments-o"></i> <span>Questionários</span></a>
         </li>
         <li>
            <a href="{{action('SectionController@index')}}"><i class="fa fa-book"></i> <span>Minhas Turmas</span></a>
         </li>
         <li>
            <a href="{{action('GuidanceController@index')}}"><i class="fa fa-cubes"></i> <span>Minhas Orientações</span></a>
         </li>
         <li>
            <a href="{{action('ProfessorController@index')}}"><i class="fa fa-graduation-cap"></i> <span>Professores</span></a>
         </li>
         <li>
            <a href="{{action('StudentController@edit')}}"><i class="fa fa-id-badge"></i> <span>Perfil</span></a>
         </li>
         <li>
            <a href="https://zeppelin10.ufop.br/minhaUfop/desktop/login.xhtml" target="_blank"><i class="fa fa-pencil-square-o"></i> <span>Editar Cadastro - minhaUFOP</span></a>
         </li>
         <li>
            <a href="{{action('AuthController@logout')}}" ><i class="fa fa-sign-out"></i> <span>Sair</span></a>
         </li>
      </ul><!-- /.sidebar-menu -->
   </section>
   <!-- /.sidebar -->
</aside>
