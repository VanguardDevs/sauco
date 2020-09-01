@extends('layouts.template')

@section('title', 'Pagos antiguos de '.$taxpayer->rif)

@section('content')

@if(Auth()->user()->can('process.settlements'))
<div id="registerOldPayments"></id>
@endif
@endsection
