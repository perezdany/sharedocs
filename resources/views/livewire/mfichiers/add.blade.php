<div class="modal fade" id="addModal" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>-->
            <h4 class="modal-title">Ajouter un utilisateur</h4>
        </div>
            <!--<form wire:submit.prevent="AddFichier" >
                <div class="modal-body">
                     @csrf
                    <p class="bg-warning">NB: si le fichier est au format incorect, il ne sera pas téléchargé</p>
                   <div class="form-group">
                        <label for="nom" class="col-sm-4 control-label">Dossier</label>
                            
                        <div class="col-sm-10">
                            <select class="form-control"  wire:model="folder_id" >
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
                            placeholder="Fichier" wire:model="nom" maxlength="30" onkeyup='this.value=this.value.toUpperCase()'>
                        </div>
                    </div>
                   <div class="form-group">
                        <label for="date_creation" class="col-sm-4 control-label">Date de création</label>

                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="date_creation" wire:model="date_creation">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="path" class="col-sm-4 control-label">Télécharger le fichier</label>

                        <div class="col-sm-8">
                            <input type="file" class="form-control" id="path" wire:model="path">
                        </div>
                    </div>

                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Fermer</button>
                       
                      <button type="submit" class="btn btn-success pull-right">Valider</button>
                                    
                           
                    </div>
                </div>
            </form>-->

             <form enctype="multipart/form-data" method="post" action="AddFile" >
                <div class="modal-body">
                     @csrf
                    <p class="bg-warning">NB: si le fichier est au format incorect, il ne sera pas téléchargé</p>
                   <div class="form-group">
                        <label for="nom" class="col-sm-4 control-label">Dossier</label>
                            
                        <div class="col-sm-10">
                            <select class="form-control"  name="folder_id" >
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

                        <div class="col-sm-8">
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
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>    
<!-- /.modal -->