<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">

   <!-- sidebar: style can be found in sidebar.less -->
   <section class="sidebar">

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
         <li class="header">MENU</li>
         <!-- Optionally, you can add icons to the links -->

         <li class="treeview">
            <a href="#"><i class="fa fa-university"></i><span>ICEA</span>
               <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
               </span>
            </a>
            <ul class="treeview-menu">
               <li>
                  <a href="{{route('major.index')}}"><i class="fa fa-circle-o"></i>Cursos</a>
               </li>
               <li>
                  <a href="{{route('department.index')}}"><i class="fa fa-circle-o"></i>Departamentos</a>
               </li>
               <li>
                  <a href="{{route('course.index')}}"><i class="fa fa-circle-o"></i>Disciplinas</a>
               </li>
               <li>
                  <a href="{{route('section.index')}}"><i class="fa fa-circle-o"></i>Turmas</a>
               </li>
               <li>
                  <a href="{{route('guidance.index')}}"><i class="fa fa-circle-o"></i>Orientações</a>
               </li>
               <li>
                  <a href="{{route('guidanceType.index')}}"><i class="fa fa-circle-o"></i>Tipos de Orientação</a>
               </li>
            </ul>
         </li>

         <li class="treeview">
            <a href="#"><i class="fa fa-users"></i><span>Usuários</span>
               <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
               </span>
            </a>
            <ul class="treeview-menu">
               <li>
                  <a href="{{route('admin.index')}}"><i class="fa fa-circle-o"></i>Administradores</a>
               </li>
               <li>
                  <a href="{{route('adminType.index')}}"><i class="fa fa-circle-o"></i>Tipos de Administrador</a>
               </li>
               <li>
                  <a href="{{route('student.index')}}"><i class="fa fa-circle-o"></i>Alunos</a>
               </li>
               <li>
                  <a href="{{route('professor.index')}}"><i class="fa fa-circle-o"></i>Professores</a>
               </li>
            </ul>
         </li>

         <li class="treeview">
            <a href="#"><i class="fa fa-comments-o"></i><span>Questionários</span>
               <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
               </span>
            </a>
            <ul class="treeview-menu">
               <li>
                  <a href="{{route('survey.generalSurveysIndex')}}"><i class="fa fa-circle-o"></i>Questionários Gerais</a>
               </li>
               <li>
                  <a href="{{route('survey.index')}}"><i class="fa fa-circle-o"></i>Questionários dos Professores</a>
               </li>
               <li>
                  <a href="{{route('question.index')}}"><i class="fa fa-circle-o"></i>Perguntas</a>
               </li>
               <li>
                  <a href="{{route('questionType.index')}}"><i class="fa fa-circle-o"></i>Tipos de Pergunta</a>
               </li>
            </ul>
         </li>

         <li>
            <a href="{{action('AdminController@edit', encrypt(session()->get('id')))}}"><i class="fa fa-id-badge"></i> Perfil</a>
         </li>
         <li>
            <a href="https://zeppelin10.ufop.br/minhaUfop/desktop/login.xhtml" target="_blank"><i class="fa fa-pencil-square-o"></i> <span>Editar Cadastro - minhaUFOP</span></a>
         </li>

         <li>
            <a href="{{action('AuthController@logout')}}"><i class="fa fa-sign-out"></i><span>Sair</span></a>
         </li>
      </ul><!-- /.sidebar-menu -->
   </section>
   <!-- /.sidebar -->
</aside>
