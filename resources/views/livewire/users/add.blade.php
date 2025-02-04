<div class="modal fade" id="addModal" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>-->
            <h4 class="modal-title">Ajouter un utilisateur</h4>
        </div>
         <form wire:submit.prevent="AddUser" >
                <div class="modal-body">
                     @csrf

                    <div class="form-group">
                        <label for="nom" class="col-sm-4 control-label">Groupe</label>
                            
                        <div class="col-sm-10">
                            <select class="form-control" id="groupe_id"  wire:model="AddUser.groupes_id"  required>
                                @php
                                    $get =  $groupecontroller->GetAll();
                                    //dd($get);
                                @endphp
                                <option value="">Groupe</option>
                                @foreach($get as $get)
                                    <option value={{$get->id}}>{{$get->titre}}</option>

                                @endforeach
                            
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nom" class="col-sm-4 control-label">Nom & prénom(s)</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nom_prenoms" onkeyup='this.value=this.value.toUpperCase()'
                            placeholder="NOM ET PRENOMS" wire:model="AddUser.nom_prenoms" maxlength="60">
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="nom" class="col-sm-4 control-label">STRUCTURE</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="entreprise" onkeyup='this.value=this.value.toUpperCase()'
                            placeholder="L'ENTREPRISE" wire:model="AddUser.entreprise" maxlength="60">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nom" class="col-sm-4 control-label">Fonction</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="fonction" onkeyup='this.value=this.value.toUpperCase()'
                            placeholder="FONCTION" wire:model="AddUser.fonction" maxlength="150">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nom" class="col-sm-4 control-label">Email</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="email" 
                            placeholder="Email" wire:model="AddUser.email" maxlength="60">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="telephone" class="col-sm-4 control-label">Téléphone</label>
                      
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="telephone" 
                            placeholder="+225 44 54 21 23 56" wire:model="telephone" maxlength="30">
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