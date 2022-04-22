@extends('pdf.reports.layouts.template')

@section('content')
<table style="text-align: center">
    <caption>{{ strtoupper($title) }}</caption>
    <thead>
        <tr>
            <th width="5%">#</th>
            <th width="30%">NOMBRE</th>
            <th width="30%">CÉDULA</th>
            <th width="15%">LOGIN</th>
            <th width="15%">ESTADO</th>
        </tr>
    </thead>
    <tbody>
    @foreach($models as $index => $model)
        <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $model->full_name }}</td>
        <td>{{ $model->identity_card }}</td>
        <td>{{ $model->login }}</td>
        <td>{{ $model->active ? 'ACTIVO' : 'INACTIVO' }}</td>
    </tr>
    @endforeach
</title>
@endsection
