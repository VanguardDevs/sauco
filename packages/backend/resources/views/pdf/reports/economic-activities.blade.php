@extends('pdf.reports.layouts.template')

@section('content')
<table style="text-align: center">
    <caption>{{ strtoupper($title) }}</caption>
    <thead>
        <tr>
        <th width="3%">#</th>
        <th width="7%">CÓDIGO</th>
        <th width="80%">NOMBRE</th>
        <th width="5%">%</th>
        <th width="5%">MÍN</th>
        </tr>
    </thead>
    <tbody>
    @foreach($models as $index => $model)
        <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $model->code }}</td>
        <td>{{ $model->name }}</td>
        <td>{{ $model->aliquote }}</td>
        <td>{{ $model->min_tax }}</td>
    </tr>
    @endforeach
</title>
@endsection
