@extends('pdf.reports.layouts.template')

@section('content')
<div>
    <br />
    <span><strong>CÓDIGO</strong>: {{ $economicActivity->code }}</span>
    <br />
    <span><strong>ACTIVIDAD</strong>: {{ $economicActivity->name }}</span>
    <br />
    <span><strong>ALÍCUOTA</strong>: {{ $economicActivity->aliquote }}</span>
    <br />
    <span><strong>MÍNIMO</strong>: {{ $economicActivity->min_tax }}</span>
</div>
<table style="text-align: center">
    <thead>
        <tr>
            <th width="5%">#</th>
            <th width="10%">RIF</th>
            <th width="40%">NOMBRE</th>
            <th width="45%">DIRECCIÓN</th>
        </tr>
    </thead>
    <tbody>
    @foreach($models as $index => $model)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $model->rif }}</td>
            <td>{{ $model->name }}</td>
            <td>{{ $model->fiscal_address }}</td>
        </tr>
    @endforeach
</title>
@endsection
