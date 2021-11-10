@extends('pdf.reports.layouts.template')

@section('content')
<table style="text-align: center">
    <caption>{{ strtoupper($title) }}</caption>
    <thead>
        <tr>
        <th width="3%">#</th>
        <th width="7%">NO.</th>
        <th width="10%">RIF</th>
        <th width="30%">RAZÓN SOCIAL</th>
        <th width="10%">MONTO</th>
        <th width="10%">MONTO</th>
        </tr>
    </thead>
    <tbody>
    @foreach($models as $index => $model)
        <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $model->num }}</td>
        <td>{{ $model->taxpayer->rif }}</td>
        <td>{{ $model->taxpayer->name }}</td>
        <td>{{ $model->month->name }}</td>
        <td>{{ $model->month->year->year }}</td>
        <td>{{ $model->prettyAmount }}</td>
        <td>{{ $model->prettyTotalBruteAmount }}</td>
    </tr>
    @endforeach
</table>
<br>
<div class="bill-info">
    <div class="col-bill-info">
        FECHA: {{ $dates }}
    </div>
    <div class="col-bill-info">
        <div class="total-amount">
            MONTO TOTAL PROCESADO: {{ $total }}
        </div>
    </div>
</div>
@endsection
