@extends('layouts/base')
@php

    
    use App\Http\Controllers\UserController;

     use App\Http\Controllers\RoleController;

    $usercontroller = new UserController();
  
@endphp

@section('content')
    <div class="row">
     @if(session('success'))
            <div class="col-md-12 card-header" style="font-size:13px;">
              <p class="bg-success" >{{session('success')}}</p>
            </div>
          @endif
    <!-- left column -->
        <div class="col-md-3">
        </div>
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-info">
                    <div class="card-header with-border">
                        <b><h3 class="card-title">MODIFIER MON MOT DE PASSE</h3>
                       </b>
                    </div>
                    @php
                        //dd($id_user);
                        $retrive = $usercontroller->GetById(auth()->user()->id);
                        //dd($retrive);
                    @endphp
                    @foreach($retrive as $user)
                        <!-- form start -->
                    
                        <form role="form" action="edit_password" method="post">
                            @csrf
                            <input type="text" value="{{$user->id}}" name="id_user" style="display:none;">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Mot de passe</label>
                                    <input type="password" maxlength="12" class="form-control  input-lg" required name="password" id="pwd1">
                                </div>
                                
                                <div class="form-group">
                                    <label>Confirmer le mot de passe</label>
                                    <input type="password" maxlength="12" class="form-control  input-lg" required  id="pwd2" equired onkeyup="verifyPassword()">
                                </div>
                                <div class="col-md-12 form-group" id="match">            
                                </div>
                            
                                            
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" id="bt" >MODIFIER</button>
                            </div>
                            <script type="text/javascript">
                                            
                                    /*UN SCRIPT QUI VA VERFIER SI LES DEUX PASSWORDS MATCHENT*/
                                    function verifyPassword()
                                    {
                                        var msg; 
                                        var str = document.getElementById("pwd1").value; 
                                        var button = document.getElementById("bt")

                                        var text1 = document.getElementById('pwd1').value;
                                        var text2 = document.getElementById('pwd2').value;
                                        
                                        
                                        if((text1 == text2))
                                        {  
                                        
                                            
                                            var theText = "<p style='color:green'>Correspond.</p>"; 
                                            button.removeAttribute("disabled");
                                            document.getElementById("match").innerHTML= theText; 
                                            
                                        }
                                        else
                                        {
                                        
                                            var theText = "<p style='color:red'>Ne correspond pas.</p>";
                                            document.getElementById("match").innerHTML= theText;
                                            button.setAttribute("disabled", "true");
                                        }
                                    }
                                            
                                </script>     
                        </form>
                    @endforeach
                </div>
               
            </div>		
        </div>
        <!--/.col (right) -->
         <div class="col-md-3">
        </div>
    </div>
    <!-- Main row -->  

@endsection
     
    
   