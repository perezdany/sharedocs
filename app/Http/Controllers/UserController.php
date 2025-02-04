<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\EntrepriseController;

Use DB;

class UserController extends Controller
{
    //Handle Users

    public function GetById($id)
    { 
        //dd($id);  
        $get = DB::table('users')
        ->join('groupes', 'users.groupes_id', '=', 'groupes.id')
        ->where('users.id', '=', $id)
        ->get(['users.*', 'groupes.titre', ]);
        //dd($get);
       return $get;
    }
    
    public function GoProfil(Request $request)
    {
        //dd($request->id_user);
        
        return view('admin/profile',
            [
                'id_user' => $request->id_user,
            ]
        );
    }

    public function EditForm(Request $request)
    {
        //dd($request->id_user);
        
        return view('admin/edit_user_form',
            [
                'id_user' => $request->id_user,
            ]
        );
    }

    public function EditUser(Request $request)
    {
       
        $affected = DB::table('users')
        ->where('users.id', '=', $request->id_user)
       
        ->update(['email' => $request->email, 'nom_prenoms'=> $request->nom_prenoms, 
        'groupes_id'=> $request->groupe, 'fonction' => $request->fonction,
            'entreprise' => $request->entreprise, 'telephone' => $request->telephone, ]);
        

        return redirect('users')->with('success', 'Modification Effectuée avec succès');
    }

    public function UpdatePermissions(Request $request)
    {
        //dd($request->all());
        $get_of_user = User::find($request->id_user);
        if(isset($request->Ecriture))
        {
           
            $get_permissions_in_table = DB::table('permission_user')->where('permission_id', $request->Ecriture)->where('user_id', $request->id_user)->count();
            if($get_permissions_in_table != 0)
            {
                //nothing 
               
            }
            else
            {
                //c'est une nouvelle permission donc on ajoute
                $get_of_user->permissions()->attach($request->Ecriture);
            }
        }
        else
        {
            $get_permissions_in_table = DB::table('permission_user')->where('permission_id', 1)->where('user_id', $request->id_user)->count();
            if($get_permissions_in_table != 0)
            {
                //SUPPRIMER L'ENREGISTREMENT
                $delete = DB::table('permission_user')->where('user_id', $request->id_user)->where('permission_id', 1)->delete();
            }
            else
            {
                //nothing
             
            }
        }

        if(isset($request->Suppression))
        {
            $get_permissions_in_table = DB::table('permission_user')->where('permission_id', $request->Suppression)->where('user_id', $request->id_user)->count();
            if($get_permissions_in_table != 0)
            {
                //nothing
            }
            else
            {
                //c'est une nouvelle permission donc on ajoute
                $get_of_user->permissions()->attach($request->Suppression);
            }
        }
        else
        {
            $get_permissions_in_table = DB::table('permission_user')->where('permission_id', 2)->where('user_id', $request->id_user)->count();
            if($get_permissions_in_table != 0)
            {
                $delete = DB::table('permission_user')->where('user_id', $request->id_user)->where('permission_id', 2)->delete();
            }
            else
            {
                //nothing
            }
        }

        return redirect('users')->with('success', 'Mise à jour des permissions effectuées');
       
    }

    public function EditPassword(Request $request)
    {
       
        $user_password = Hash::make($request->password);

        $affected = DB::table('users')
        ->where('id', $request->id_user)
        ->update(['password' =>  $user_password, ]);

        return redirect('welcome')->with('success', 'Modification Effectuée avec succès');
    }

    public function EditPasswordFristLog(Request $request)
    {
        $user_password = Hash::make($request->password);

        //ON VA AUSSI CHANGER LE COUNT LOGIN DE LA PREMIERE
        $affected = DB::table('users')
        ->where('id', $request->id)
        ->update(['password' =>  $user_password, 'count_login' => 1]);

        //dd($request->id);

        return redirect('login')->with('success', 'Modification Effectuée avec succès. Vueillez vous connecter à nouveau.');
    }

    public function DisableUser(Request $request)
    {
        $affected = DB::table('users')
        ->where('id', $request->id_user)
        ->update(['active' =>  0, ]);

        return redirect('users')->with('success', 'Utilisateur désactivé');
    }

    public function EnableUser(Request $request)
    {
        $affected = DB::table('users')
        ->where('id', $request->id_user)
        ->update(['active' =>  1, ]);

        return redirect('users')->with('success', 'Utilisateur activé');
    }
    
    public function GetAll()
    {
        $get = DB::table('users')
        ->join('groupes', 'users.groupes_id', '=', 'groupes.id')
        ->get(['users.*', 'groupes.titre']);

        return $get;

    }

    public function TryDelete($id)
    {
        $verif = DB::table('fichiers')->where('user_id', '=', $id)->get();
        $count_verif = $verif->count();
        if($count_verif != 0)
        {
            $message_error = "Vous ne pouvez pas supprimer une entreprise qui a des verif.";
            return false;
        }
        else
        {
            return true;
        }
       
    }

    public function AddUser(Request $request)
    {
        
        $user_password = Hash::make("123456");
        if(User::where('login', $request->login)->count() == 0)
        {
            $Insert = User::create([
                'login' => $request->login, 
                'password' => $user_password,
                 'nom_prenoms' => $request->nom_prenoms, 
                 'groupes_id' => $request->dgroupe, 
                 'poste' => $request->poste, 
                 'roles_id' => $request->role,
                 'active' => 1,
                  'created_by' => auth()->user()->id,
                  'count_login' => 0,
           ]);
            //dd($request->all());
            if(isset($request->Suppression))//SI IL A COCHE LA CASE DE LA PERMISSION SUPPRIMER
            {
                $Insert->permissions()->attach($request->Suppression);
            }
            
            if(isset($request->Ecriture))//SI IL A COCHE LA CASE DE LA PERMISSION SUPPRIMER
            {
                $Insert->permissions()->attach($request->Ecriture);
            }
    
            
    
           return redirect('users')->with('success', 'Enregistrement effectué');
        }

        return redirect('users')->with('error', 'Adresse mail est déja utilisée');
       
    }

    public function ResetPassword(Request $request)
    {
       
        $user_password = Hash::make(123456);
        //dd($user_password);
        //dd( DB::table('users')->where('id', $request->id_user));

        $affected = DB::table('users')->where('id', $request->id_user)
        ->update(['password' =>  $user_password, 'count_login' => 0]);

        return redirect('users')->with('success', 'Réinitialisation Effectuée avec succès');
    }
}
