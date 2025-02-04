@php
  //header("Refresh:0");
    use App\Http\Controllers\FolderController;
    use App\Http\Controllers\FileController;
    use App\Http\Controllers\UserController;
    use App\Http\Controllers\GroupController;
    use App\Http\Controllers\PermissionController;
   
    $foldercontroller = new FolderController();
    $filecontroller = new FileController();
    $groupecontroller = new GroupController();
    $permissioncontroller = new PermissionController();


@endphp


    <div >
        @include('livewire.users.edit')
         @include('livewire.users.add')
        @include('livewire.users.user-list')


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

            
            //FERMER LE POPUP DE MODIF
            window.addEventListener("closeEditModal",  event=>{
                $("#editModal").modal("hide")
            })

             window.addEventListener("closeAddModal",  event=>{
                $("#addModal").modal("hide")
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
                @this.deleteUser(event.detail.message.data.id_user)
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

