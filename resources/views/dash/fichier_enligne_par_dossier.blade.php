@extends('layouts/base')
@section('content')
  
    @livewire('ofichiers', ['folder_id' => $id, 'online' => "1"])

@endsection