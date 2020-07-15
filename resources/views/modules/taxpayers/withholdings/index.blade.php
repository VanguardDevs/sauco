@extends('layouts.template')

@section('title', 'Retenciones de '.$taxpayer->rif)

@section('content')

@if(Auth()->user()->can('process.settlements'))
<div id='withholdings'></div>
<div id="taxpayerID" data_id="{{ $taxpayer->id }}"></id>
@endif
@endsection
