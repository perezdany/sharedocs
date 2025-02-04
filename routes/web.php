<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\AuthController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\Calculator;
use App\Http\Controllers\GroupController;

use App\Models\User;
use App\Models\Groupe;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['guest:web'])->group(function(){

    //PAGE DE CONNEXION
    Route::get('/', function () {
        return view('login');
    })->name('login');

    /*Route::get('welcome', function () {
        return view('welcome');
    })->name('home');*/

    Route::get('login', function () {
        return view('login');
    })->name('login');

    Route::get('code_form', function () {
        return view('code_form');
    });

    Route::get('edit_pass_firstlog', function () {
        return view('edit_pass_firstlog');
    });

    Route::post('go_login', [AuthController::class, 'AdminLogin']);

    Route::post('login_code', [AuthController::class, 'LoginCode']);

    Route::post('update_pass_firstlog', [UserController::class, 'EditPasswordFristLog']);
});



//SI IL EST DEJA CONNECTE 
Route::middleware(['auth:web'])->group(function(){

   /* Route::get('welcome', function () {
        return User::with("groupes")->paginate(5);
    })->name('home');*/

    Route::get('welcome', function () {
        return view('welcome');
    })->name('home');

    //AJOUTER UN FICHIER 
    Route::post('AddFile', [FileController::class, 'CreateFile']);

    //TABLEAU DES FICHIERS
    Route::get('fichiers', function () {
        return view('dash/fichiers');
    });

    //AJOUTER OU MODIFIER LE FICHIER

    //LE FORMULAIRE
    Route::post('showupoladform', [FileController::class, 'UploadFile']);
    Route::post('upload', [FileController::class, 'UploadFile']);


    //VOIR LE FICHIER
    Route::post('display', [FileController::class, 'Display']);
   
    //AFFIHCER PAR DOSSIER
    Route::get('dossiers', function () {
        return view('dash/folders');
    });

    Route::get('by_folder', [FileController::class, 'GoDisplayByFolder']);
    Route::get('by_folder_online', [FileController::class, 'GoDisplayByFolderOnline']);

    //PAGE MES FICHIERS
    Route::get('mes_fichiers', function () {
        return view('dash/mfichiers');
    });

    Route::get('fichier_enligne', function () {
        return view('dash/fichier_enligne');
    });

    //LES UTILISATEURS (ADMINISTRATIONS)
    //PROFIL UTILISATEUR
    Route::get('profile', [UserController::class, 'GoProfil']);

    //PROFIL UTILISATEUR
    Route::post('edit_user_form', [UserController::class, 'EditForm']);


    //MODIFIER L'UTILISATEUR
    Route::post('edit_user', [UserController::class, 'EditUser']);

    //MODIFIER MOT DE PASSE
    Route::post('edit_password', [UserController::class, 'EditPassword']);

    //REINITIALISER LE MOT DE PASSE
    Route::post('reset_password', [UserController::class, 'ResetPassword']);

    //MODIFIER LES PERMISSION
    Route::post('update_permissions', [UserController::class, 'UpdatePermissions']);

    //DESACTIVER L'UTILISATEUR
    Route::post('disable_user', [UserController::class, 'DisableUser']);

    //ACTIVER L'UTILISATEUR
    Route::post('enable_user', [UserController::class, 'EnableUser']);


    //DECONNEXION
    Route::post('logout', [AuthController::class, 'logoutUser']);
    Route::get('logout', [AuthController::class, 'logoutUser']);

    //LES UTILISATEURS
    //AFFIHCER PAR DOSSIER
    Route::get('users', function () {
        return view('admin/users');
    });


    //LES GROUPES UTILISATEURS
    Route::get('groups', function () {
        return view('admin/group_users');
    });

    Route::post('edit_groupe', [GroupController::class, 'updateGroup']);

    //SUPPRIMER LE GROUPE
    Route::post('delete_group', [GroupController::class, 'TryDelete']);

});
