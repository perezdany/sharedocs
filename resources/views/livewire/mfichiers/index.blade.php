@php
  //header("Refresh:0");
    use App\Http\Controllers\FolderController;
    use App\Http\Controllers\FileController;
    $foldercontroller = new FolderController();
    $filecontroller = new FileController();
    use App\Http\Controllers\GroupController;
    
    $groupecontroller = new GroupController();
    /*IMPORTANT ! ECRIRE UN CODE ICI POUR SI A CETTE DATE LE CONTRAT DOIT ETRE RECONDUIT ON ACTUALISE LA DATE DE FIN */
@endphp


    <div >
        @include('livewire.mfichiers.edit')
        @include('livewire.mfichiers.uploadform')
        @include('livewire.mfichiers.share')
        @include('livewire.mfichiers.add')
        @include('livewire.mfichiers.mfichiers-list')


        <script>
            window.addEventListener("showEditModal",  event=>{
                $("#editModal").modal(
                    {
                        "show" : true, 
                        "backup": "static"
                    }
                )
            })
            window.addEventListener("showAddModal",  event=>{
                $("#addModal").modal(
                    {
                        "show" : true, 
                        "backup": "static"
                    }
                )
            })

             window.addEventListener("showShareModal",  event=>{
                $("#shareModal").modal(
                    {
                        "show" : true, 
                        "backup": "static"
                    }
                )
            })

            window.addEventListener("showUploadModal",  event=>{
                $("#uploadModal").modal(
                    {
                        "show" : true, 
                        "backup": "static"
                    }
                )
            })

            
            //FERMER LE POPUP DE MODIF
            window.addEventListener("closeEditModal",  event=>{
                $("#editModal").modal("hide")
            })

            //FERMER LE POPUP D'AJOUT
              window.addEventListener("closeAddModal",  event=>{
                $("#addModal").modal("hide")
               
            })

               window.addEventListener("closeShareModal",  event=>{
                $("#shareModal").modal("hide")
               
            })

            window.addEventListener("closeUploadModal",  event=>{
                $("#uploadModal").modal("hide")
               
            })

            //POPUP DELETE
            window.addEventListener("showConfirmMessage",  event=>{
            Swal.fire({
                title: event.detail.message.title,
                text: event.detail.message.text,
                icon: event.detail.message.type,
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Continuer!",
                cancelButtonText: "Annuler!",
                }).then((result) => {
                if (result.isConfirmed) {
                @this.deleteFile(event.detail.message.data.id_file)
                }
                });


                //Message de succès
                window.addEventListener("showSuccessMessage",  event=>{
                Swal.fire({
                    position: 'top-end',
                    icon: "success",
                    toast: true,
                    title: event.detail.message || "Opération effectuée avec succès!",
                    showCancelButton: false,
                    timer: 3000,
                    })
                })

                //Message d'erreur
                window.addEventListener("showErrorMessage",  event=>{
            Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    background: "#ff3362" ,
                    color: "#fff",
                    position: "top",
                    text: event.detail.message,
                
                    });
                })
            })


            window.addEventListener("showDetail",  event=>{
                $("#details").modal(
                    {
                        "show" : true, 
                        "backup": "static"
                    }
                )
            })


            window.addEventListener("showSuccessMessage",  event=>{
                Swal.fire({
                    position: 'top-end',
                    icon: "success",
                    toast: true,
                    title: event.detail.message || "Opération effectuée avec succès!",
                    showCancelButton: false,
                    timer: 3000,
                    })
                })

            window.addEventListener("showErrorMessage",  event=>{
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    background: "#ff3362" ,
                    color: "#fff",
                    position: "top",
                    text: event.detail.message,
                
                    });
                })
                

            
        </script>   

    </div>

