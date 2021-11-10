@extends('pdf.reports.layouts.template')

@section('content')
<table style="text-align: center">
    <caption>{{ strtoupper($title) }}</caption>
    <thead>
        <tr>
        <th width="3%">#</th>
        <th width="10%">NO.</th>
        <th width="12%">RIF</th>
        <th width="60%">RAZÓN SOCIAL</th>
        <th width="15%">F. DE EMISIÓN</th>
        </tr>
    </thead>
    <tbody>
    @foreach($models as $index => $model)
        <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $model->num }}</td>
        <td>{{ $model->taxpayer->rif }}</td>
        <td>{{ $model->taxpayer->name }}</td>
        <td>{{ $model->emission_date }}</td>
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
