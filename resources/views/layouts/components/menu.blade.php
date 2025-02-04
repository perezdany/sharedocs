 <!-- Sidebar -->
    <div class="sidebar">
      
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
           
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/" class="nav-link">
                  <i class="fa fa-dashboard nav-icon"></i>
                  <p>Tableau de bord</p>
                </a>
              </li>
            
              
            </ul>
          </li>
          @can("direction")
            <li class="nav-item">
              <a href="mes_fichiers" class="nav-link">
                <i class="fa fa-file nav-icon"></i>
                <p>Mes Fichiers</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="dossiers" class="nav-link">
              <i class="fa fa-book  nav-icon"></i></i>
                <p>Dossiers</p>
              </a>
            </li>
          @endcan
          @can("admin")
            <li class="nav-item">
              <a href="mes_fichiers" class="nav-link">
                <i class="fa fa-file nav-icon"></i>
                <p>Mes Fichiers</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="dossiers" class="nav-link">
              <i class="fa fa-book  nav-icon"></i></i>
                <p>Dossiers</p>
              </a>
            </li>
          @endcan
         
          <li class="nav-item">
            <a href="fichier_enligne" class="nav-link">
              <i class="fa fa-file nav-icon"></i>
              <p>Fichiers en ligne</p>
            </a>
          </li>
          @can("admin")
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fa fa-edit"></i>
                <p>
                  Administrations
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="users" class="nav-link">
                    <i class="fa fa-user nav-icon"></i>
                    <p>Utilisateurs</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="groups" class="nav-link">
                    <i class="fa fa-users nav-icon"></i>
                    <p>Groupe utilisateurs</p>
                  </a>
                </li>
            
              </ul>
            </li>
          @endcan
          @can("direction")
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fa fa-edit"></i>
                <p>
                  Administrations
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="users" class="nav-link">
                    <i class="fa fa-user nav-icon"></i>
                    <p>Utilisateurs</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="groups" class="nav-link">
                    <i class="fa fa-users nav-icon"></i>
                    <p>Groupe utilisateurs</p>
                  </a>
                </li>
            
              </ul>
            </li>
          @endcan
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-user"></i>
              <p>
                Mon compte
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="profile" class="nav-link">
                  <i class="fa fa-edit nav-icon"></i>
                  <p>Mot de passe</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="logout" class="nav-link">
                  <i class="fa fa-power-off nav-icon"></i>
                  <p>Déconnexion</p>
                </a>
              </li>
           
            </ul>
          </li>
      
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->