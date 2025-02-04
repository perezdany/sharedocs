@extends('layouts/dash')

@php
    use App\Http\Controllers\FolderController;
    use App\Http\Controllers\FileController;
    use App\Http\Controllers\Calculator;
    use App\Http\Controllers\GroupController;
    $foldercontroller = new FolderController();
    $filecontroller = new FileController();
    $calculator = new Calculator();
    $groupecontroller = new GroupController();
    use App\Models\Group;

    $get = $groupecontroller->GetAll();
@endphp
@section('content')
    <section class="content">
        <div class="container-fluid">
            @include("layouts/components/badges")
            <!-- Main row -->
            <div class="row">
               
                <div class="col-md-12">
                    
                    <!-- /.card -->
                    <div class="card table-responsive">
                        <div class="card-header">
                        <h3 class="card-title">Les groupes d'utilisateurs</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nom</th>
                                <th>Ajouté le:</th>
                                <!--<th>Modifié le:</th>-->
                                <th>Mod.</th>
                                <th>Supp.</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($get as $groupe)
                                    <tr>
                                        <td>{{$groupe->id}}</td>
                                        <td>{{$groupe->titre}}</td>
                                        <td>
                                            @php 
                                                echo "<b>".date('d/m/Y',strtotime($groupe->created_at))."</b> à <b>".date('H:i:s',strtotime($groupe->created_at))."</b>" ;
                                            @endphp
                                        
                                        </td>
                                        <!--<td>
                                            
                                            @if($groupe->updated_at == NULL)
                                                
                                            @else
                                                @php 
                                                
                                                    echo "<b>".date('d/m/Y',strtotime($groupe->updated_at))."</b> à <b>".date('H:i:s',strtotime($groupe->updated_at))."</b>" ;
                                                @endphp
                                            @endif
                                        
                                        </td>-->
                                        <td>
                                            <a class="nav-link" data-toggle="dropdown" href="#">
                                                <button type="submit" class="btn btn-primary  dropdown"><i class="fa fa-edit"></i></button>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-lg" >
                                                
                                                <div class="media" style="width:300px;">
                                                
                                                    <div class="media-body">
                                                        <h3 class="dropdown-item-title">
                                                            Modification
                                                            <span class="float-right text-sm text-danger"><i class="fa fa-edit"></i></span>
                                                        </h3>
                                                        
                                                        <form action="edit_groupe"  enctype="multipart/form-data" method="post">
                                                            <div class="modal-body">
                                                                @csrf
                                                            
                                                                <input type="text" class="form-control" name="id" value="{{$groupe->id}}" style="display:none;" >
                                                                <div class="form-group">
                                                                    <label for="titre" class=" control-label">Nom</label>

                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control" value="{{$groupe->titre}}" id="titre" name="titre">
                                                                    </div>
                                                                </div>

                                                                
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Fermer</button>
                                                                
                                                                <button type="submit" class="btn btn-success pull-right">Valider</button>
                                                                                
                                                                    
                                                                </div>
                                                            </div>
                                                        </form>
                                                    
                                                    </div>
                                                </div>
                                            
                                            
                                            </div>
                                            
                                        </td>
                                        <td>
                                            <form method="post" action="delete_group">
                                               
                                                @csrf
                                                <input type="text" class="form-control" name="id" value="{{$groupe->id}}" style="display:none;" >
                                                <button type="sumit" class="btn btn-danger"><i class="fa fa-trash"></i></button>        
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>   
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Nom</th>
                                <th>Ajouté le:</th>
                                <!--<th>Modifié le:</th>-->
                                <th>Mod.</th>
                                <th>Supp.</th>
                            </tr>
                            </tfoot>
                        </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                 
                    <!-- /.card -->
                </div>
                
            </div><!-- /.row -->
            <!-- /.row -->
        </div><!--/. container-fluid -->
    </section>
@endsection

