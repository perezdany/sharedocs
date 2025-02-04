@extends('layouts/base')
@section('content')

    @livewire('fichiers', ['folder_id' => $id])

@endsection