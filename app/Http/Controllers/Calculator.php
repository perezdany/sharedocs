<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Fichier;
use DB;

class Calculator extends Controller
{
    //Handle Calculation


    public function CountMember()
    {
        $count = User::where('groupes_id', '>', "1")->count();

         return  $count;
    }

    public function CountOnlineFile()
    {
        $count = Fichier::where('online', 1)
        ->count();
         return  $count;
    }
  

}
