<div class="modal fade" id="editModal" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Modifier un utilisateur</h4>
        </div>
            <form wire:submit.prevent="updateUser" >
                <div class="modal-body">
                     @csrf
                    
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