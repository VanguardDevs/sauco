@extends('layouts.template')

@section('title', 'Retenciones de '.$taxpayer->rif)

@section('content')

@if(Auth()->user()->can('process.settlements'))
<div id='withholdings'></div>
@endif
@endsection
