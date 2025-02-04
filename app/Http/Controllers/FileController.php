<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Fichier;
use App\Models\Folder;
use DB;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class FileController extends Controller
{
    //
    public function GetThreeLatest()
    {
        $get = DB::table('fichiers')
            ->join('folders', 'fichiers.folder_id', '=', 'folders.id')
            ->where('online', "1")
            ->orderBy('mis_en_ligne', 'DESC')
            ->limit(3)
            ->get(['fichiers.*', 'folders.nom_folder']);
        return $get;
      
    }

    public function CreateFile( Request $request)
    {
        $fichier = $request->path;
        if($fichier != null)
        {
            //VERFIFIER LE FORMAT 
            $extension = pathinfo($fichier->getClientOriginalName(), PATHINFO_EXTENSION);

            if($extension != "pdf")
            {
                return back()->with('error', 'LE FORMAT DE FICHIER DOIT ETRE UN FORMAT PDF!!');
            }
        }
   
        //dd($request->all());
        $Insert = Fichier::create([
            'nom' => $request->nom,
            'date_creation' => $request->date_creation,
            'folder_id' => $request->folder_id,
            'online' => 0,
            'user_id' => auth()->user()->id,
       ]);

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
                    $folder = Folder::where('id', $request->folder_id)->get();
                    foreach($folder as $folder)
                    {
                        $nom_dossier = $folder->nom_folder;
                    }
                    $path = $request->file('path')->storeAs(
                        $nom_dossier, $file_name
                    );

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
                    $folder = Folder::where('id', $request->folder_id)->get();
                    foreach($folder as $folder)
                    {
                        $nom_dossier = $folder->nom_folder;
                    }
                    $path = $request->file('path')->storeAs(
                        $nom_dossier, $file_name
                    );

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


        return back()->with('success', 'Le fichier a été enregistré avec succès!    ');
    }

    public function ShowUploadForm(Request $request)
    {
        return view('dash/edit_fichiers', [
            'id_fichier' => $request->id,
            ]);
    }

    public function UploadFile(Request $request)
    {
       //dd($request->all());
        $fichier = $request->path;
        if($fichier != null)
        {
            //VERFIFIER LE FORMAT 
            $extension = pathinfo($fichier->getClientOriginalName(), PATHINFO_EXTENSION);

            if($extension != "pdf")
            {
                return back()->with('error', 'LE FORMAT DE FICHIER DOIT ETRE UN FORMAT PDF!!');
            }
        }
   
        //dd($request->all());
       
        //IL FAUT SUPPRIMER L'ANCIEN FICHIER DANS LE DISQUE DUR
   
        if($fichier != null)
        {
          
            //VERIFIER SI L'ENREGISTREMENT A UN CHEMIN D'ACCES ENREGISTRE
            $get_path = Fichier::where('id', $request->id)->get();
           
            foreach($get_path as $get_path)
            {
                
                if($get_path->path == null)
                {
                    
                    //enregistrement de fichier dans la base
                    $file_name = $fichier->getClientOriginalName();
                    
                    //Prendre le nom du dossier dans la base
                    $folder = Folder::where('id', $get_path->folder_id)->get();
                    foreach($folder as $folder)
                    {
                        $nom_dossier = $folder->nom_folder;
                    }
                    $path = $request->file('path')->storeAs(
                        $nom_dossier, $file_name
                    );

                    $affected = DB::table('fichiers')
                    ->where('id', $request->id)
                    ->update([
                        'path'=> $path,
                        
                    ]);

                    
                }
                else
                {
                    $get_path = Fichier::where('id', $request->id)->get();
                    //SUPPRESSION DE L'ANCIEN FICHIER
                    //dd($get_path->path);
                    foreach($get_path as $get_path)
                    {
                        Storage::delete($get_path->path);
                    }
                    
                    $file_name = $fichier->getClientOriginalName();
                    
                    //Prendre le nom du dossier dans la base
                    $get_path = Fichier::where('id', $request->id)->get();
                    foreach($get_path as $get_path)
                    {
                        $folder = Folder::where('id', $get_path->folder_id)->get();
                        foreach($folder as $folder)
                        {
                            $nom_dossier = $folder->nom_folder;
                        }
                    }
                    
                    $path = $request->file('path')->storeAs(
                        $nom_dossier, $file_name
                    );
                   
                  
                    $affected = DB::table('fichiers')
                    ->where('id', $request->id)
                    ->update([
                        'path'=> $path,
                        
                    ]);

                    
                }
            }
            
        }
        else
        {
        
        }


        return back()->with('success', 'Le fichier a été enregistré avec succès!    ');
    }

    public function Display(Request $request)
    {
        if(Storage::disk('local')->exists($request->path))
        {
            //return Storage::download($request->file);

            return response()->file(Storage::path($request->path));
        }
        else
        {
            return back()->with('error', 'Le fichier n\'existe pas');
        }
    }

    public function GoDisplayByFolder(Request $request)
    {
        return view('dash/fichiers_par_dossier', [
            'id' => $request->id,
        ]);
    }

    public function GoDisplayByFolderOnline(Request $request)
    {
        
        return view('dash/fichier_enligne_par_dossier', [
            'id' => $request->id,
          
        ]);
    }
}
