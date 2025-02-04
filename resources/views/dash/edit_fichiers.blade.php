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
                
            </div><!-- /.row -->
            <!-- /.row -->

       
        </div><!--/. container-fluid -->
    </section>
@endsection