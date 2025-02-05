<?php

namespace App\Http\Livewire;

use Livewire\Component;

use DB;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\FileController;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use Livewire\WithPagination;
use Livewire\WithFileUploads;//POUR IMPORTER LES FICHIERS

use App\Models\Fichier_dossier;

use App\Models\Fichier;
use App\Models\Folder;
use App\Models\User;

use App\Mail\NotifNewFile;
use App\Mail\NotificationNouveauCompte;

use Illuminate\Support\Facades\Mail;


class Mfichiers extends Component
{
    use WithPagination; //POUR LA PAGINATION
    protected $paginationTheme = "bootstrap";

    use WithFileUploads;

    public $editFichier = []; //LA VARIABLE QUI RECUPERE LES DONNEES ENTREES DU FORMULAIRE

    public $editHasChanged;
    public $editOldValues = [];

    public $table_search = "";
    public $folder = "";
    public $online = "";

    public $groupe;

    public $nom, $date_creation, $path;
    public  $folder_id = "1";

    public $AddFichier = [];

    public $ShareFichier = [];

    public $UploadFichier = [];

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

    public function AddFileForm(Fichier $fichier)
    {
        //dd('ici');
        $this->AddFichier = $fichier->toArray();
      
        $this->dispatchBrowserEvent('showAddModal');
    }

    public function ShareFileForm(Fichier $fichier)
    {
        //dd('ici');
        $this->ShareFichier = $fichier->toArray();
      
        $this->dispatchBrowserEvent('showShareModal');
    }

    public function UploadForm(Fichier $fichier)
    {
        //dd('ici');
        $this->UploadFichier = $fichier->toArray();
      
        $this->dispatchBrowserEvent('showUploadModal');
    }

    public function ShareFile()
    {
        //dd($this->groupe);
        //modifier le champ online
        $affected = DB::table('fichiers')
        ->where('id',  $this->ShareFichier['id'])
        ->update([
            'online'=>  1, 
            'mis_en_ligne' => date('Y-m-d'),
            'groupe_user' => $this->groupe,
            ]);

        if($this->groupe == null)
        {
           
            //ON VA ENVOYER LE MAIL A TOUS LE MONDE
            $users = User::all();
            $url = "127.0.0.1:8000";
            $data = ['url' => $url];
            foreach($users as $user)
            {
                Mail::to($user->email)->send(new NotifNewFile($data));
            }

        }
        else
        {
           // dd('idi');
           //SI IL VEUT PARTAGER ET AUX MEMBRES ET AUX MEMBRES D'HONNEUR
           if($this->groupe == "100")
           {
                $users_get = DB::table('users')->where('groupes_id', 2)->get();
                $url = "127.0.0.1:8000";
                $data = ['url' => $url];
                //dd($this->groupe);
                foreach($users_get as $user_get)
                {
                    Mail::to($user_get->email)->send(new NotifNewFile($data));
                }

                $users_get = DB::table('users')->where('groupes_id', 4)->get();
                foreach($users_get as $user_get)
                {
                    Mail::to($user_get->email)->send(new NotifNewFile($data));
                }
            }
            $users_get = User::where('groupes_id', $this->groupe)->get();
            
            $url = "127.0.0.1:8000";
            $data = ['url' => $url];
            //dd($this->groupe);
            foreach($users_get as $user_get)
            {
                
                Mail::to($user_get->email)->send(new NotifNewFile($data));
            }
        }

        
        $this->dispatchBrowserEvent('showSuccessMessage', ["message" => "Fichier mis en ligne avec succès!"]);

        $this->dispatchBrowserEvent("closeShareModal");

    }

    public function UploadFile()
    {
        $fichier = $this->path;
        
       //ENREGISTRER LE FICHIER DU CONTRAT

        //IL FAUT SUPPRIMER L'ANCIEN FICHIER DANS LE DISQUE DUR
   
        if($fichier != null)
        {
          
            //VERIFIER SI L'ENREGISTREMENT A UN CHEMIN D'ACCES ENREGISTRE
            $get_path = Fichier::where('id', $this->UploadFichier['id'])->get();
            foreach($get_path as $get_path)
            {
                if($get_path->path == null)
                {
                    //enregistrement de fichier dans la base
                    $file_name = $fichier->getClientOriginalName();
                    
                    //Prendre le nom du dossier dans la base
                    $folder_nom = Folder::where('id', $this->folder_id)->get();
                    
                    foreach($folder_nom as $folder_nom)
                    {
                        $nom_dossier = $folder_nom->nom_folder;
                    }
                    //dd($nom_dossier);
                    $path =$this->path->storeAs($nom_dossier, $file_name);
                    //dd($path);
                    $affected = DB::table('fichiers')
                    ->where('id', $this->UploadFichier['id'])
                    ->update([
                        'path'=> $path,
                        
                    ]);

                    
                }
                else
                {
                    $get_path = Fichier::where('id', $this->UploadFichier['id'])->get();
                    //SUPPRESSION DE L'ANCIEN FICHIER
                    //dd($get_path->path);
                    foreach($get_path as $get_path)
                    {
                        Storage::delete($get_path->path);
                    }
                    
                    $file_name = $fichier->getClientOriginalName();
                    
                    //Prendre le nom du dossier dans la base
                    $folder = Folder::where('id', $this->folder_id)->get();
                    foreach($folder as $folder)
                    {
                        $nom_dossier = $folder->nom;
                    }
                  
                    $path =$this->path->storeAs($nom_dossier, $file_name);

                    $affected = DB::table('fichiers')
                    ->where('id', $this->UploadFichier['id'])
                    ->update([
                        'path'=> $path,
                        
                    ]);

                    
                }
            }
            
        }
        else
        {
        
        }

        $this->dispatchBrowserEvent('showSuccessMessage', ["message" => "Fichier ajouté avec succès "]);

        $this->dispatchBrowserEvent("closeUploadModal");
    }
    
    public function AddFichier()
    {
        $fichier = $this->path;
       
        if($fichier == null)
        {
            //dd($fichier);
            $this->dispatchBrowserEvent('showErrorMessage', ["message" => "Le fichier doit être au format PDF SVP!"]);
          
        }
        else
        {
           
            //$this->dispatchBrowserEvent('showSuccessMessage', ["message" => "Le fichier doit être au format PDF SVP!"]);
        }
   
        //dd($this->all());
        $Insert = Fichier::create([
            'nom' => $this->nom,
            'date_creation' => $this->date_creation,
            'folder_id' => $this->folder_id,
            'online' => 0,
            'user_id' => auth()->user()->id,
       ]);
       //dd($Insert);

       //ENREGISTRER LE FICHIER DU CONTRAT

        //IL FAUT SUPPRIMER L'ANCIEN FICHIER DANS LE DISQUE DUR
   
        if($fichier != null)
        {
          
            //VERIFIER SI L'ENREGISTREMENT A UN CHEMIN D'ACCES ENREGISTRE
            $get_path = Fichier::where('id', $Insert->id)->get();
            foreach($get_path as $get_path)
            {
                if($get_path->path == null)
                {
                    //enregistrement de fichier dans la base
                    $file_name = $fichier->getClientOriginalName();
                    
                    //Prendre le nom du dossier dans la base
                    $folder_nom = Folder::where('id', $this->folder_id)->get();
                    
                    foreach($folder_nom as $folder_nom)
                    {
                        $nom_dossier = $folder_nom->nom_folder;
                    }
                    //dd($nom_dossier);
                    $path =$this->path->storeAs($nom_dossier, $file_name);

                    $affected = DB::table('fichiers')
                    ->where('id', $Insert->id)
                    ->update([
                        'path'=> $path,
                        
                    ]);

                    
                }
                else
                {
                    $get_path = Fichier::where('id', $Insert->id)->get();
                    //SUPPRESSION DE L'ANCIEN FICHIER
                    //dd($get_path->path);
                    foreach($get_path as $get_path)
                    {
                        Storage::delete($get_path->path);
                    }
                    
                    $file_name = $fichier->getClientOriginalName();
                    
                    //Prendre le nom du dossier dans la base
                    $folder = Folder::where('id', $this->folder_id)->get();
                    foreach($folder as $folder)
                    {
                        $nom_dossier = $folder->nom;
                    }
                   
                    $path =$this->path->storeAs($nom_dossier, $file_name);

                    $affected = DB::table('fichiers')
                    ->where('id', $Insert->id)
                    ->update([
                        'path'=> $path,
                        
                    ]);

                    
                }
            }
            
        }
        else
        {
        
        }

        $this->dispatchBrowserEvent('showSuccessMessage', ["message" => "Fichier ajouté avec succès "]);

        $this->dispatchBrowserEvent("closeAddModal");

    }

    public function confirmDelete($nom_entreprise, $id)
    {
        $this->dispatchBrowserEvent('showConfirmMessage', 
        
        ["message" => [
            "text" => "Vous êtes sur le point de supprimer le fichier intitulé $nom_entreprise de la base de données.",
            "title" => "Êtes vous sûre de continuer?",
            "type" => "warning",
            "data" => ["id_file" => $id]
            ]
        
        ]);
    }

    public function deleteFile($id)
    {
        //PASSER A LA SUPPRESSION

        //dd($try_delete);
        Fichier::destroy($id);
        $get_path = Fichier::where('id', $id)->get();
        //SUPPRESSION DE L'ANCIEN FICHIER
        //dd($get_path->path);
        foreach($get_path as $get_path)
        {
            Storage::delete($get_path->path);
        }
        $this->dispatchBrowserEvent('showSuccessMessage', ["message" => "Elément supprimé avec succès !"]);
       
    }

    public function showUpdateButton()
    {
        //dd('ici');
        $this->editHasChanged = false;
        
        if(
            $this->editFichier['nom'] != $this->editOldValues['nom'] OR
            $this->editFichier['date_creation'] != $this->editOldValues['date_creation'] OR
             $this->editFichier['online'] != $this->editOldValues['online'] OR
            $this->editFichier['folder_id'] != $this->editOldValues['folder_id'] 
         
        )
        {
            $this->editHasChanged = true;
        }

        return $this->editHasChanged;
   
    }

    public function Editfichier(Fichier $fichier)
    {
        $this->editFichier = $fichier->toArray();
      
        $this->editOldValues = $this->editFichier; //Mettre les valeurs ancienne dedans

        $this->dispatchBrowserEvent('showEditModal');
      

    }

    public function UpdateFichier()
    {
        $affected = DB::table('fichiers')
        ->where('id',  $this->editFichier['id'])
        ->update([
            'nom'=>  $this->editFichier['nom'],
            'date_creation' =>  $this->editFichier['date_creation'], 
            'folder_id' =>  $this->editFichier['folder_id'], 
            'online' => $this->editFichier['online'], 
           
        ]);
        if($this->editFichier['online'] == "0")
        {
            //effacer la date de mise en ligne
            $affected = DB::table('fichiers')
            ->where('id',  $this->editFichier['id'])
            ->update([
                'mis_en_ligne'=>  NULL,
                 
            ]);

        }

        $this->dispatchBrowserEvent('showSuccessMessage', ["message" => "Informaations modifiées avec succès!"]);

        $this->dispatchBrowserEvent("closeEditModal");
    }
    
    public function render()
    {
        if($this->editFichier != []) 
        {
            //Ca veut dire que des valeurs sont en train d'être modifié dans le formulaire de modification
            $this->showUpdateButton();
        }
        $fichierQuery = Fichier_dossier::query()->where('user_id', auth()->user()->id);

        if($this->table_search != "")
        {
            //dd($this->table_search);
            $fichierQuery->where("nom", "LIKE", "%".$this->table_search."%")
            ->orwhere("nom_folder", "LIKE", "%".$this->table_search."%");
        }

        if($this->online != "")
        {
         
            //dd($this->online);
            $fichierQuery->where("online",  $this->online);
            
        }

        if($this->folder != "")
        {
            $fichierQuery->where("folder_id",  $this->folder);
           
        }

        return view('livewire.mfichiers.index', ['fichiers' => $fichierQuery->orderBy($this->orderField, $this->orderDirection)->paginate(3) ]);
    }
}
