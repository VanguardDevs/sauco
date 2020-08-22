@extends('layouts.template')

@section('title', "Licencia Nº ".$row->id)

@section('content')
<div class="kt-subheader kt-grid__item" id="kt_subheader">
    <div class="kt-subheader__main">
    <h3 class="kt-subheader__title">Licencia por concepto de {{ $row->ordinance->description }}</h3>
    </div>
</div>
    <div class="row">
        <div class="col-lg-12">
            <div class="kt-portlet">

            </div>
        </div>
    </div>
@endsection
