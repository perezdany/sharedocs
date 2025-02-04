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


class Ofichiers extends Component
{
    
    use WithPagination; //POUR LA PAGINATION
    protected $paginationTheme = "bootstrap";

    use WithFileUploads;

    public $editFichier = []; //LA VARIABLE QUI RECUPERE LES DONNEES ENTREES DU FORMULAIRE

    public $editHasChanged;
    public $editOldValues = [];

    public $table_search = "";
    public $folder_id = "";
    public $online = "";

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
    
    public function render()
    {
        $fichierQuery = Fichier_dossier::query()->where('online', 1);
        
        if($this->table_search != "")
        {
            //dd($this->table_search);
            $fichierQuery->where("nom", "LIKE", "%".$this->table_search."%")
            ->orwhere("nom_folder", "LIKE", "%".$this->table_search."%");
        }

        if($this->online != "")
        {
            
            $fichierQuery->where("online",  $this->online);
            
        }

        if($this->folder_id != "")
        {
            $fichierQuery->where("folder_id",  $this->folder_id);
           
        }

        return view('livewire.ofichiers.index', ['fichiers' => $fichierQuery->orderBy($this->orderField, $this->orderDirection)->paginate(3) ])
      ;
    }
}
