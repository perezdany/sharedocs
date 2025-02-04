<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Permission;
use DB;

class PermissionController extends Controller
{
    //

    public function GetAll()
    {
        return Permission::all();
    }
}
