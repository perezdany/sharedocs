<?php

namespace App\Http\Livewire;

use Livewire\Component;

use DB;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Mail\NotificationNouveauCompte;

use Illuminate\Support\Facades\Mail;


use Livewire\WithPagination;
use Livewire\WithFileUploads;//POUR IMPORTER LES FICHIERS

use App\Models\User_group;
use App\Models\User;

class Users extends Component
{
    use WithPagination; //POUR LA PAGINATION
    protected $paginationTheme = "bootstrap";

    use WithFileUploads;

    public $editFichier = []; //LA VARIABLE QUI RECUPERE LES DONNEES ENTREES DU FORMULAIRE

    public $editHasChanged;
    public $editOldValues = [];

    public $AddUser= [];

    public $table_search = "";
    public $groupe_id = "";
    public $active = "";

    public $telephone="";

    public $orderField = 'created_at';
    public $orderDirection = 'DESC';

     //FONCTION POUR FAIRE ORDRE DECROISSANT
    public function setOrderField($champ)
    {
        
        if($champ == $this->orderField)
        {
            if($this->orderDirection = 'ASC')
            {
                $this->orderDirection = 'DESC';
            }
            $this->orderDirection =  $this->orderDirection = 'DESC' ? 'ASC' : 'DESC';
            
        }
        else
        {

            $this->orderField = $champ;
            $this->orderDirection =  $this->orderDirection = 'DESC' ? 'ASC' : 'DESC';
            
            $this->reset('orderDirection');

        }
        //return $la;
    }

    public function AddUserForm(User $user)
    {
        //dd('ici');
        $this->AddUser = $user->toArray();
      
        $this->dispatchBrowserEvent('showAddModal');
    }

   

    public function AddUser()
    {
        
        $user_password = Hash::make(123456);
       
        $Insert = User::create([
            'nom_prenoms' => $this->AddUser['nom_prenoms'], 
            'entreprise' => $this->AddUser['entreprise'],
            'fonction' => $this->AddUser['fonction'], 
            'email' => $this->AddUser['email'], 
            'password' => $user_password,
            'telephone' => $this->telephone, 
            'groupes_id' => $this->AddUser['groupes_id'],
           
            'active' => 1,
            'created_by' => auth()->user()->id,
            'count_login' => 0,
       ]);

            $url = "https://share-docs.grsci.co/";
            $email = $this->AddUser['email'];
            $data = ['url' => $url, 'email' => $email ];
            //dd($data['url']);
           
            Mail::to($email)->send(new  NotificationNouveauCompte($data));
        


        $this->dispatchBrowserEvent('showSuccessMessage', ["message" => "Utiliateur créé avec succès"]);

        $this->dispatchBrowserEvent("closeAddModal");
        
    }

    public function confirmDelete($nom_entreprise, $id)
    {
        $this->dispatchBrowserEvent('showConfirmMessage', 
        
        ["message" => [
            "text" => "Vous êtes sur le point de supprimer l'email $nom_entreprise de la base de données.",
            "title" => "Êtes vous sûre de continuer?",
            "type" => "warning",
            "data" => ["id_user" => $id]
            ]
        
        ]);
    }

    public function confirmDisable($nom_entreprise, $id)
    {
        $this->dispatchBrowserEvent('showConfirmDisable', 
        
        ["message" => [
            "text" => "Vous êtes sur le point de désactiver l'email $nom_entreprise de la base de données.",
            "title" => "Êtes vous sûre de continuer?",
            "type" => "warning",
            "data" => ["id_user" => $id]
            ]
        
        ]);
    }
    public function confirmEnable($nom_entreprise, $id)
    {
        $this->dispatchBrowserEvent('showConfirmEnable', 
        
        ["message" => [
            "text" => "Vous êtes sur le point d'activer l'email $nom_entreprise de la base de données.",
            "title" => "Êtes vous sûre de continuer?",
            "type" => "warning",
            "data" => ["id_user" => $id]
            ]
        
        ]);
    }

    public function deleteUser($id)
    {
        //PASSER A LA SUPPRESSION

        $try_delete = (new UserController())->TryDelete($id);
        //dd($try_delete);
        if($try_delete)
        {
           
            User::destroy($id);
            $this->dispatchBrowserEvent('showSuccessMessage', ["message" => "Utilisateur supprimé avec succès !"]);
        }
        else
        {
            //dd('icio');
            $this->dispatchBrowserEvent('showErrorMessage', ["message" => "Vous ne pouvez pas suppriemer cette entreprise car elle a des contrats!"]);
           
        }
       
    }

    public function disableUser($id)
    {
        //PASSER A LA SUPPRESSION

        $affected = DB::table('users')
        ->where('id', $id)
        ->update(['active' =>  0, ]);

        $this->dispatchBrowserEvent('showSuccessMessage', ["message" => "Utilisateur désactivé avec succès !"]);
      
       
    }

    public function enableUser($id)
    {
        //ACTIVER LE USER

        $affected = DB::table('users')
        ->where('id', $id)
        ->update(['active' =>  1, ]);

        $this->dispatchBrowserEvent('showSuccessMessage', ["message" => "Utilisateur activé avec succès !"]);
             
       
    }
    
    public function render()
    {
        $userQuery = User_group::query();

        if($this->groupe_id != "")
        {
            $userQuery->where("groupes_id",  $this->groupe_id);
           
        }

        if($this->active != "")
        {
            $userQuery->where("active",  $this->active);
           
        }

        if($this->table_search != "")
        {
            //dd($this->table_search);
            $userQuery->where("email", "LIKE", "%".$this->table_search."%")
            ->orwhere("nom_prenoms", "LIKE", "%".$this->table_search."%")
            ->orwhere("fonction", "LIKE", "%".$this->table_search."%")
            ->orwhere("entreprise", "LIKE", "%".$this->table_search."%")
            ->orwhere("titre", "LIKE", "%".$this->table_search."%");
        }

        return view('livewire.users.index', ['users' => $userQuery->orderBy($this->orderField, $this->orderDirection)->paginate(20) ]);
    }
}
