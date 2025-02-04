<div class="modal fade" id="editModal" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>-->
            <h4 class="modal-title">Edition</h4>
        </div>
         <form wire:submit.prevent="UpdateFichier" >
                <div class="modal-body">
                     @csrf
                 
                   <div class="form-group">
                        <label for="nom" class="col-sm-4 control-label">Dossier</label>
                            
                        <div class="col-sm-10">
                            <select class="form-control"  wire:model="editFichier.folder_id" >
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
                            placeholder="Fichier" wire:model="editFichier.nom" maxlength="250" onkeyup='this.value=this.value.toUpperCase()'>
                        </div>
                    </div>
                   <div class="form-group">
                        <label for="date_creation" class="col-sm-4 control-label">Date de création</label>

                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="date_creation" wire:model="editFichier.date_creation">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="date_creation" class="col-sm-4 control-label">Date de création</label>

                        <div class="col-sm-10">
                            <select class="form-control"  wire:model="editFichier.online" id="online">
                                    
                               
                                <option value="1">En ligne</option>
                                <option value="0">Pas en Ligne</option>
                                
                            </select>
                                                      
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Fermer</button>
                       
                        @if($editHasChanged)
                            <button type="submit" class="btn btn-success">Valider la modification</button>
                                    
                        @endif
                           
                    </div>
                </div>
            </form>
            
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>    
<!-- /.modal -->