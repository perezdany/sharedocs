<section class="content">
    <div class="row">
        <div class="container-fluid">
            <!-- Main row -->
      
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Base des utilisateurs</h3>

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
                                    <button type="button" class="btn btn-primary" wire:click="AddUserForm">
                                    <i class="fa fa-user-plus"></i>
                                    </button>
                                </div>    

                                <div class="col-md-3 form-group">
                                            
                                </div>

                               
                            </div>

                             <a href="users" style="color:blue"><u>Rétablir<i class="fa fa-refresh" aria-hidden="true"></i></u></a> &emsp;&emsp;&emsp;&emsp; <label>Filtrer par:</label>
                        
                          
                            <div class="row">
                                <div class="col-md-3 form-group">
                                    <select class="form-control" id="groupe_id"  wire:model.debounce.250ms="groupe_id" >
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

                                <div class="col-md-3 form-group">
                                    <select class="form-control"  wire:model.debounce.250ms="active" id="active">
                                    
                                        <option value="">Etat</option>
                                        <option value="1">Actif</option>
                                        <option value="0">Inactif</option>
                                        
                                    </select>
                                                            
                                </div>

                               
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive table-bordered">
                           
                            <table class="table table-hover">
                                <tr>
                                    <th>Nom & Prénom(s)</th>
                                     <th>Fonction</th>
                                      <th>Structure</th>
                                    <th>Email</th>
                                    <th>Téléphone</th>
                                    <th>Groupe</th>
                                    <th>Etat</th>
                                    <th>Désact./Actier</th>
                                    <th>Supprimer</th>
                                    <th>Modifier</th>
                                    
                                </tr>
                               
                                @forelse($users as $user)

                                   <tr>
                                       <!--<img src="dist/img/3979284.png" alt="icone user" class="img img-responsive elevation-2">-->
                                        <td> {{$user->nom_prenoms}}</td>
                                        <td> {{$user->fonction}}</td>
                                         <td> {{$user->entreprise}}</td>
                                        <td> {{$user->email}}</td>
                                        <td> {{$user->telephone}}</td>
                                        <td>
                                            {{$user->titre}}</td>
                                        </td>
                                        <td>
                                            @if($user->active > 0)
                                                <span class="bg-success">Actif</span>
                                            @else
                                                <span class="bg-danger">Inactif</span>   
                                            @endif
                                        </td>
                                        <td>
                                            @if($user->active == true)
                                                <!--<form action="disable_user" method="post">
                                                    @csrf
                                                    <input type="text" value={{$user->id}} style="display:none;" name="id_user">
                                                    <button type="submit" class="btn btn-danger"><i class="fa fa-times"></i></button>
                                                </form>-->
                                                <button type="submit" class="btn btn-danger" 
                                                    wire:click="confirmDisable(' {{ $user->email }} '
                                                    , {{ $user->id }} )"><i class="fa fa-times"></i></button>
                                            @else
                                                <!--<form action="enable_user" method="post">
                                                    @csrf
                                                    <input type="text" value={{$user->id}} style="display:none;" name="id_user">
                                                    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i></button>
                                                </form>-->
                                                <button type="submit" class="btn btn-primary" 
                                                    wire:click="confirmEnable(' {{ $user->email }} '
                                                    , {{ $user->id }} )"><i class="fa fa-check"></i></button>
                                            @endif
                                                
                                                
                                        </td>
                                        
                                        <td>
                                            
                                            <button type="submit" class="btn btn-danger" 
                                            wire:click="confirmDelete(' {{ $user->email }} '
                                            , {{ $user->id }} )"><i class="fa fa-trash"></i></button>
                                           
                                        </td>
                                         <td>
                                            <form action="edit_user_form" method="post">
                                                @csrf
                                                <input type="text" value={{$user->id}} style="display:none;" name="id_user">
                                                <button type="submit" class="btn btn-success"><i class="fa fa-edit"></i></button>
                                            </form>
                                            
                                        </td>
                                    </tr>  
                               @empty
                                    <tr colspan="10">
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
                           
                            {{$users->links()}}
                           
                            
                        </ul>
                    </div>
                    <!-- /.card -->
                </div>
                
           
            <!-- /.row -->

      

        
        </div><!--/. container-fluid -->
    </div>
</section>