<div class="modal fade" id="shareModal" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>-->
            <h4 class="modal-title">Partager le fichier</h4>
        </div>
         <form wire:submit.prevent="ShareFile" >
                <div class="modal-body">
                     @csrf
                    
                   <div class="form-group">
                        <label for="nom" class="col-sm-4 control-label">Partager à:</label>
                            
                        <div class="col-sm-10">
                            <select class="form-control"  wire:model="groupe" >
                                @php
                                    $get =  $groupecontroller->GetAll();
                                    //dd($get);
                                @endphp
                                <option value="null">Tout le monde</option>
                              
                                @foreach($get as $get)
                                    <option value={{$get->id}}>{{$get->titre}}</option>

                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nom" 
                            placeholder="Fichier" wire:model="id" style="display:none;">
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