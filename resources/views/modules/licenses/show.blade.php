@extends('layouts.template')

@section('title', 'Licencia '.$row->num)

@section('content')
<div id="license-show" data-id="{{ $row->id }}"></div> 
@endsection
