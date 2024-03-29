@extends('pdf.reports.layouts.template')

@section('content')
<table style="text-align: center">
    <caption>{{ strtoupper($title) }}</caption>
    <thead>
        <tr>
        <th width="3%">#</th>
        <th width="7%">NO. </th>
        <th width="15%">RIF</th>
        <th width="60%">RAZÓN SOCIAL</th>
        <th width="15%">MONTO</th>
        </tr>
    </thead>
    <tbody>
    @foreach($models as $index => $model)
        <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $model->cancellable->num }}</td>
        <td>{{ $model->cancellable->taxpayer->rif }}</td>
        <td>{{ $model->cancellable->taxpayer->name }}</td>
        <td>{{ $model->cancellable->prettyAmount }}</td>
    </tr>
    @endforeach
</table>
<br>
<div class="bill-info">
    <div class="col-bill-info">
        FECHA: {{ $dates }}
    </div>
</div>
@endsection
