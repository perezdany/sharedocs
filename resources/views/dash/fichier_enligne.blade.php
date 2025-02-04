
@extends('layouts/base')

@php
    use App\Http\Controllers\FolderController;
    use App\Http\Controllers\FileController;
    $foldercontroller = new FolderController();
    $filecontroller = new FileController();
@endphp
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @php
                    $all = $foldercontroller->GetAll();
                @endphp
                @foreach($all as $dossier)
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{$dossier->nom_folder}}</h3>
                            </div>
                            <p></p>
                            <p></p>
                            <p></p>
                            <div class="icon">
                                <i class="fa fa-book"></i>
                            </div>
                            <form method="get" action="by_folder_online">
                                @csrf
                                <!--<input type="text" value="" name="entreprise" style="display:none;">
                                <input type="text" value="" name="reconduction" style="display:none;">
                                <input type="text" value="0" name="etat_contrat" style="display:none;">-->
                                <input type="text" value="{{$dossier->id}}" name="id" style="display:none;">
                                <input type="text" value="1" name="online" style="display:none;">
                                <button class="btn btn-info"><p class="small-box-footer">Voir les fichiers <i class="fa fa-arrow-circle-right"></i> </p></button>  
                            </form>
                        </div>
                    </div>
                    <!-- ./col -->  
                @endforeach
                
            
            </div>
            <!-- /.row -->

        
        </div><!--/. container-fluid -->
    </section>
@endsection
 