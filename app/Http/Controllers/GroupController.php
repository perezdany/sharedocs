<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Groupe;

use DB;

class GroupController extends Controller
{
    //
    public function GetAll()
    {
        return Groupe::all();
    }

    public function updateGroup(Request $request)
    {
        //dd($request->all());
        $affected = DB::table('groupes')->where('id', $request->id)
        ->update(['titre' => $request->titre]);

        return back()->with('success', 'Modification effectuée avec succès');
    }

    public function TryDelete(Request $request)
    {
        // dd($request->all());
        $users = DB::table('users')->where('groupes_id', $request->id)->count();
        if($users != 0)
        {
            return back()->with('error', 'Vous ne pouvez pas supprimer ce groupe car des utilisateurs y sont associés');
        }
        else
        {
            $deleted = DB::table('groupes')->where('id', '=', $request->id)->delete();
            return back()->with('success', 'Le groupe a été supprimé avec succès');
        }
       
    }
}
