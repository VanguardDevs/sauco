@extends('layouts.template')

@section('title', 'Retenciones de '.$taxpayer->rif)

@section('content')

@if(Auth()->user()->can('process.settlements'))
<div id='withholdings'></div>
<div id="data" data-taxpayer-id="{{ $taxpayer->id }}" data-user-id="{{ auth()->user()->id }}"></id>
@endif
@endsection
