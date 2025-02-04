<div class="modal fade" id="uploadModal" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>-->
            <h4 class="modal-title">Ajout/Modification du fichier</h4>
        </div>
            <!--<form wire:submit.prevent="UploadFile">
                <div class="modal-body">
                     @csrf
                    <p class="bg-warning">NB: Le format du fichier est PDF</p>
                     <input type="text" class="form-control" wire:model="UplodFichier.id" style="display:none;">
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
            <form action="upload"  enctype="multipart/form-data" method="post">
                <div class="modal-body">
                     @csrf
                    <p class="bg-warning">NB: Le format du fichier est PDF</p>
                     <input type="text" class="form-control" name="id" style="display:none;" >
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