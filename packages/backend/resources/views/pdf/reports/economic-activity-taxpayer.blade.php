@extends('pdf.reports.layouts.template')

@section('content')
<table style="text-align: center">
    <caption>{{ strtoupper($title) }}</caption>
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
