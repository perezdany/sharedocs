@extends('layouts/base')

@php
    use App\Http\Controllers\FolderController;
    use App\Http\Controllers\FileController;
    use App\Http\Controllers\Calculator;
    $foldercontroller = new FolderController();
    $filecontroller = new FileController();
    $calculator = new Calculator();
    use App\Models\Group;
@endphp
@section('content')
    <section class="content">
        <div class="container-fluid">
            @include("layouts/components/badges")
            <!-- Main row -->
            <div class="row">
               
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Récements mis en ligne</h3>

                            <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                 <p><a href="fichier_enligne"><span class="fa fa-eye">Voir tout</span></a></p>

                               
                            </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            @php
                                $recents =  $filecontroller->GetThreeLatest();
                                //dd($recents);
                            @endphp
                            <table class="table table-hover">
                                <tr>
                                    <th>Nom</th>
                                    <th>Thème</th>
                                    <th>Mis en ligne le:</th>
                                    <th>Date de création</th>
                                    <th>Aperçu</th><!--ICI SI LE GARS N'EST PAS ACTIF, ON NE LUI DONNE PAS LA POSSIBILIT2 DE VOIR LE FICHIER!-->
                                    
                                </tr>
                                @foreach($recents as $recents)
                                    @if($recents->groupe_user == auth()->user()->groupes_id)
                                        <tr>
                                            <td>{{$recents->nom}}</td>
                                            <td>{{$recents->nom_folder}}</td>
                                            <td>
                                                @if($recents->mis_en_ligne != NULL)
                                                    @php echo date('d/m/Y',strtotime($recents->mis_en_ligne)) @endphp
                                                @else

                                                @endif
                                            
                                            </td>
                                            <td>@php echo date('d/m/Y',strtotime($recents->date_creation)) @endphp</td>
                                            <td>
                                                <form action="display" method="post" enctype="multipart/form-data" target="blank">
                                                    @csrf
                                                
                                                    <input type="text" value={{$recents->id}} style="display:none;" name="id">
                                                    <input type="text" class="form-control" name="path" value="{{$recents->path}}" style="display:none;">
                                                
                                                    <button type="submit" class="btn btn-warning"><i class="fa fa-e"></i>Afficher/Télécharger</button>
                                                </form>
                                            </td>
                                        </tr>  
                                    @else
                                        @if($recents->groupe_user == NULL)
                                        
                                            <tr>
                                                <td>{{$recents->nom}}</td>
                                                <td>{{$recents->nom_folder}}</td>
                                                <td>
                                                    @if($recents->mis_en_ligne != NULL)
                                                        @php echo date('d/m/Y',strtotime($recents->mis_en_ligne)) @endphp
                                                    @else

                                                    @endif
                                                
                                                </td>
                                                <td>@php echo date('d/m/Y',strtotime($recents->date_creation)) @endphp</td>
                                                <td>
                                                    <form action="display" method="post" enctype="multipart/form-data" target="blank">
                                                        @csrf
                                                    
                                                        <input type="text" value={{$recents->id}} style="display:none;" name="id">
                                                        <input type="text" class="form-control" name="path" value="{{$recents->path}}" style="display:none;">
                                                    
                                                        <button type="submit" class="btn btn-warning"><i class="fa fa-e"></i>Afficher/Télécharger</button>
                                                    </form>
                                                </td>
                                            </tr>  

                                        @endif
                                    @endif
                                @endforeach
                               
                            
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="clearfix pull-right">
                           
                        </div>
                    </div>
                     
                    <!-- /.card -->
                </div>
                
            </div><!-- /.row -->
            <!-- /.row -->

            <div class="row">
                @can("direction")
                    <div class="col-md-6">
                        <!-- Horizontal Form -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Ajouter un ficher</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form class="form-horizontal" enctype="multipart/form-data" method="post" action="AddFile">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="nom" class="col-sm-4 control-label">Dossier</label>
                                            
                                        <div class="col-sm-10">
                                        <select class="form-control"  name="folder_id" required>
                                                @php
                                                    $get =  $foldercontroller->GetAll();
                                                    //dd($get);
                                                @endphp
                                                @foreach($get as $get)
                                                    <option value={{$get->id}}>{{$get->nom_folder}}</option>

                                                @endforeach
                                            
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="nom" class="col-sm-4 control-label">Nom du fichier</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="nom" 
                                            placeholder="Fichier" name="nom" maxlength="250" onkeyup='this.value=this.value.toUpperCase()'>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="date_creation" class="col-sm-4 control-label">Date de création</label>

                                        <div class="col-sm-10">
                                            <input type="date" class="form-control" id="date_creation" name="date_creation">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="path" class="col-sm-4 control-label">Télécharger le fichier</label>

                                        <div class="col-sm-10">
                                            <input type="file" class="form-control" id="path" name="path">
                                        </div>
                                    </div>
                                    
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-info">Ajouter</button>
                                
                                </div>
                                <!-- /.card-footer -->
                            </form>
                        </div> <!-- /.card -->
                    </div>
                @endcan
                 @can("admin")
                    <div class="col-md-6">
                        <!-- Horizontal Form -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Ajouter un ficher</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form class="form-horizontal" enctype="multipart/form-data" method="post" action="AddFile">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="nom" class="col-sm-4 control-label">Dossier</label>
                                            
                                        <div class="col-sm-10">
                                        <select class="form-control"  name="folder_id" required>
                                                @php
                                                    $get =  $foldercontroller->GetAll();
                                                    //dd($get);
                                                @endphp
                                                @foreach($get as $get)
                                                    <option value={{$get->id}}>{{$get->nom_folder}}</option>

                                                @endforeach
                                            
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="nom" class="col-sm-4 control-label">Nom du fichier</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="nom" 
                                            placeholder="Fichier" name="nom" maxlength="30" onkeyup='this.value=this.value.toUpperCase()'>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="date_creation" class="col-sm-4 control-label">Date de création</label>

                                        <div class="col-sm-10">
                                            <input type="date" class="form-control" id="date_creation" name="date_creation">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="path" class="col-sm-4 control-label">Télécharger le fichier</label>

                                        <div class="col-sm-10">
                                            <input type="file" class="form-control" id="path" name="path">
                                        </div>
                                    </div>
                                    
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-info">Ajouter</button>
                                
                                </div>
                                <!-- /.card-footer -->
                            </form>
                        </div> <!-- /.card -->
                    </div>
                @endcan
            </div>

        
        </div><!--/. container-fluid -->
    </section>
@endsection