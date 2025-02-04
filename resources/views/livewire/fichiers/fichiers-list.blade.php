<section class="content">
    <div class="row">
        <div class="container-fluid">
            <!-- Main row -->
      
               
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Fichiers</h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 350px;">
                                    <input type="text" wire:model.debounce.250ms="table_search" id="table_search" class="form-control float-right" placeholder="Rechercher">

                                    <div class="input-group-append">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div><br>
                             <a href="fichiers" style="color:blue"><u>Rétablir<i class="fa fa-refresh" aria-hidden="true"></i></u></a> &emsp;&emsp;&emsp;&emsp; <label>Filtrer par:</label>
        
                            <div class="row">
                                <div class="col-md-3 form-group">
                                    <select class="form-control" id="folder_id"  wire:model.debounce.250ms="folder_id" >
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
                                    <!--<th>Supprimer</th>
                                    <th>Modifier</th>-->
                                    
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
                                            
                                                <button type="submit" class="btn btn-warning"><i class="fa fa-e"></i>Afficher/Télécharger</button>
                                            </form>
                                        </td>
                                        <!-- <td>
                                       
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i></button>
                                         
                                        </td>
                                        <td>
                                            
                                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                           
                                        </td>-->
                                    </tr>  
                               @empty
                                    <tr colspan="7">
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