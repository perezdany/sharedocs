
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Partage de Fichier</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <style type="text/css">
      .defilement {
      height: 3000px;
    }

    .popup {
      display: none;
    }

    #popup.open {
      display: flex !important;
    }
    .popup-encart {
      position: fixed;
      left: 90%;
      background: rgba( 0, 0, 0, .25 )
    }
    .popup-contenu {
      position: fixed;
      left: 90%;
      padding: 25px;
      background: #fff;
      /*transform: translate(-50%, -50%)*/
      max-width: 250 px
    }

    #popup-fermeture{
      color: #138AED;
      position:absolute;
      right:0;
      bottom:-3px
    }

    thead{
    background-color: rgb(161, 157, 157);
    }

    tfoot{
      background-color: rgb(169, 164, 164);
      }

  </style>


   @livewireStyles

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  @include("layouts/components/alerts")

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <img src="dist/img/281777.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">SahreDocs</span>
    </a>

   @include("layouts/components/menu")
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">
          @if(session('error'))
                <p class="bg-danger">{{session('error')}}</p>
          @endif

          @if(session('success'))
                <p class="bg-success">{{session('success')}}</p>
          @endif

          @if(isset($success))
                  <p class="bg-success">{{$success}}</p>
          @endif

          @if(isset($error))
                  <p class="bg-danger">{{$error}}</p>
          @endif

        </div>
       
     
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    @yield('content')
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-sm-none d-md-block">
      By Danype
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2025 </strong> Tous droits réservés.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
@livewireScripts

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="dist/js/demo.js"></script>

<!-- PAGE PLUGINS -->
<!-- SparkLine -->
<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jVectorMap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- Select2 -->
<!--<script src="plugins/select2/select2.full.min.js"></script>-->
<!-- ChartJS 1.0.2 -->
<script src="plugins/chartjs-old/Chart.min.js"></script>
<!-- DataTables -->
<!--<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables/dataTables.bootstrap4.js"></script>-->

<script type="text/javascript">

  function togglePopup()
  {
     let popup = document.ByClassName("popup");
    
     popup.classList.toggle("open");
  }

  /*
  let test = document.getElementById("test");

  // Ce gestionnaire ne sera exécuté qu'une fois
  // lorsque le curseur se déplace sur la liste
  test.addEventListener(
    "mouseenter",
    function (event) {
      // on met l'accent sur la cible de mouseenter
      event.target.style.color = "purple";

      // on réinitialise la couleur après quelques instants
      setTimeout(function () {
        event.target.style.color = "";
      }, 500);
    },
    false,
  );

  // Ce gestionnaire sera exécuté à chaque fois que le curseur
  // se déplacera sur un autre élément de la liste
  test.addEventListener(
    "mouseover",
    function (event) {
      // on met l'accent sur la cible de mouseover
      event.target.style.color = "orange";

      // on réinitialise la couleur après quelques instants
      setTimeout(function () {
        event.target.style.color = "";
      }, 500);
    },
    false,
  );*/
</script>

<!--  Sweet Alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  /*$(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

   
  })*/

</script>

<!-- PAGE SCRIPTS -->
<!--<script src="dist/js/pages/dashboard2.js"></script>-->
</body>
</html>
