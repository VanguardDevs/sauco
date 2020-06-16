@extends('cruds.form')

@if ($typeForm == 'create')
    @section('title', 'Nueva cuenta contable')
    @section('subheader__title', 'Nueva cuenta contable')
@else
    @section('title', 'Actualización de cuenta contable')
    @section('subheader__title', 'Actualización cuenta contable')
@endif

@section('form')
    <div class="row">
        <div class="col-lg-12">
            <div id="registerAccountingAccount"></div>
        </div>
    </div>
@endsection
