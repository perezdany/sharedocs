    <!-- Info boxes -->
    <div class="row">
   
        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>
        @can("direction")
            <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fa fa-file"></i></span>

                <div class="info-box-content">
                <span class="info-box-text">Fichier mis en ligne</span>
                @php
                    $o = $calculator->CountOnlineFile();
                @endphp
                <span class="info-box-number">{{$o}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-users"></i></span>

                <div class="info-box-content">
                <span class="info-box-text">Membres</span>
                @php
                    $members = $calculator->CountMember();
                @endphp
                <span class="info-box-number">{{$members}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            </div>
            <!-- /.col -->
        @endcan
         @can("admin")
            <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fa fa-file"></i></span>

                <div class="info-box-content">
                <span class="info-box-text">Fichier mis en ligne</span>
                @php
                    $o = $calculator->CountOnlineFile();
                @endphp
                <span class="info-box-number">{{$o}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-users"></i></span>

                <div class="info-box-content">
                <span class="info-box-text">Membres</span>
                @php
                    $members = $calculator->CountMember();
                @endphp
                <span class="info-box-number">{{$members}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            </div>
            <!-- /.col -->
        @endcan

    </div>
    <!-- /.row -->
  <!--RESTRICTIONS POUR LES INFOS BOX -->