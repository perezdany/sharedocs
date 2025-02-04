<section class="content">
    <div class="row">
        <div class="container-fluid">
            <!-- Main row -->
      
               
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Mes fichiers</h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 350px;">
                                    <input type="text" wire:model.debounce.250ms="table_search" id="table_search" class="form-control float-right" placeholder="Rechercher">

                                    <div class="input-group-append">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-md-3 form-group">
                                    <button type="button" class="btn btn-primary" wire:click="AddFileForm">
                                    <b>+</b><i class="fa fa-file"></i>
                                    </button>
                                </div>    

                                <div class="col-md-3 form-group">
                                            
                                </div>

                               
                            </div>

                            <a href="mes_fichiers" style="color:blue"><u>Rétablir<i class="fa fa-refresh" aria-hidden="true"></i></u></a> &emsp;&emsp;&emsp;&emsp; <label>Filtrer par:</label>

                            <div class="row">
                                <div class="col-md-3 form-group">
                                    <select class="form-control" id="folder"  wire:model.debounce.250ms="folder" >
                                        @php
                                            $get =  $foldercontroller->GetAll();
                                            //dd($get);
                                        @endphp
                                        <option value="">Thème</option>
                                        @foreach($get as $get)
                                            <option value={{$get->id}}>{{$get->nom_folder}}</option>

                                        @endforeach
                                    
                                    </select>
                                </div>    

                                <div class="col-md-3 form-group">
                                    <select class="form-control"  wire:model.debounce.250ms="online" id="online">
                                    
                                        <option value="">Choisir</option>
                                        <option value="1">En ligne</option>
                                        <option value="0">Pas en Ligne</option>
                                        
                                    </select>
                                                            
                                </div>

                               
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive table-bordered">
                           
                            <table class="table table-hover">
                                <tr>
                                    <th>Nom</th>
                                    <th>Thème</th>
                                    <th>Mis en ligne le:</th>
                                    <th>Date de création</th>
                                    <th>Aperçu</th><!--ICI SI LE GARS N'EST PAS ACTIF, ON NE LUI DONNE PAS LA POSSIBILIT2 DE VOIR LE FICHIER!-->
                                    <th>Ajout./Mod. le fichier</th>
                                    <th>Partager</th>
                                    <th>Modifier</th>
                                    <th>Supprimer</th>
                                </tr>
                               
                                @forelse($fichiers as $fichier)

                                   <tr>
                                       <!--<img src="dist/img/3979284.png" alt="icone fichier" class="img img-responsive elevation-2">-->
                                        <td><span class="fa fa-file"></span>  {{$fichier->nom}}</td>
                                        <td><span class="fa fa-book"></span> {{$fichier->nom_folder}}</td>
                                        <td>
                                            @php 
                                                if($fichier->mis_en_ligne == NULL)
                                                {

                                                }
                                                else
                                                {
                                                    echo date('d/m/Y',strtotime($fichier->mis_en_ligne));
                                                }
                                                
                                            @endphp
                                        </td>
                                        <td>@php echo date('d/m/Y',strtotime($fichier->date_creation)) @endphp</td>
                                        
                                        <td>
                                            <form action="display" method="post" enctype="multipart/form-data" target="blank">
                                                @csrf
                                             
                                                <input type="text" value={{$fichier->id}} style="display:none;" name="id_file">
                                                <input type="text" class="form-control" name="path" value="{{$fichier->path}}" style="display:none;">
                                            
                                                <button type="submit" class="btn btn-warning">Afficher/Télécharger</button>
                                            </form>
                                        </td>
                                         <td>
                                      
                                            <a class="nav-link" data-toggle="dropdown" href="#">
                                                <button type="submit" class="btn btn-warning  dropdown"><i class="fa fa-upload"></i></button>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-lg" >
                                                
                                                <div class="media" style="width:300px;">
                                                
                                                    <div class="media-body">
                                                        <h3 class="dropdown-item-title">
                                                            Ajout/Modification du fichier
                                                            <span class="float-right text-sm text-danger"><i class="fa fa-edit"></i></span>
                                                        </h3>
                                                        <p>{{$fichier->nom}}</p>
                                                        <form action="upload"  enctype="multipart/form-data" method="post">
                                                            <div class="modal-body">
                                                                @csrf
                                                                <p class="bg-warning">NB: Le format du fichier est PDF</p>
                                                                <input type="text" class="form-control" name="id" value="{{$fichier->id}}" style="display:none;" >
                                                                <div class="form-group">
                                                                    <label for="path" class=" control-label">Télécharger le fichier</label>

                                                                    <div class="col-sm-12">
                                                                        <input type="file" class="form-control" id="path" name="path">
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
                                          
                                            <!--<div class="popup">  </div>-->
                                           
                                           
                                         <td>
                                       
                                            <button type="submit" class="btn btn-success" wire:click="ShareFileForm('{{$fichier->id}}')"><i class="fa fa-share"></i></button>
                                         
                                        </td>
                                         <td>
                                       
                                            <button type="submit" class="btn btn-primary" wire:click="Editfichier('{{$fichier->id}}')"><i class="fa fa-edit"></i></button>
                                         
                                        </td>
                                        
                                        <td>
                                            
                                            <button type="submit" class="btn btn-danger"
                                             wire:click="confirmDelete(' {{ $fichier->nom }} '
                                             , {{ $fichier->id }} )"><i class="fa fa-trash"></i></button>
                                           
                                        </td>
                                        
                                    </tr>  
                               @empty
                                    <tr colspan="9">
                                        <div class="alert alert-info alert-dismissible">
                                            
                                            <h4><i class="icon fa fa-ban"></i> Oups!</h4>
                                            Aucune donnée trouvée
                                        </div>
                                    </tr>
                                @endforelse
                               
                            
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div class="card-footer clearfix">
                       <ul class="pagination pagination-sm no-margin pull-right">
                           
                            {{$fichiers->links()}}
                           
                            
                        </ul>
                    </div>
                    <!-- /.card -->
                </div>
                
           
            <!-- /.row -->

      

        
        </div><!--/. container-fluid -->
    </div>
</section>