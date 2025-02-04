<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Folder;

class FolderController extends Controller
{
    //

    public function GetAll()
    {
        return Folder::all();
    }

    
}
