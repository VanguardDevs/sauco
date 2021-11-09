@extends('pdf.reports.layouts.template')

@section('content')
<table style="text-align: center">
    <caption>{{ strtoupper($title) }}</caption>
    <thead>
        <tr>
        <th width="3%">#</th>
        <th width="67%">RUBRO</th>
        <th width="10%">TIPO</th>
        <th width="10%">MOVIMIENTOS</th>
        <th width="10%">MONTO</th>
        </tr>
    </thead>
    <tbody>
    @foreach($models as $index => $model)
        <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $model->name }}</td>
        <td>{{ $model->concurrent ? 'SIMÚLTANEO' : 'MOROSO' }}</td>
        <td>{{ $model->movements_count }}</td>
        <td>{{ $model->amount }}</td>
    </tr>
    @endforeach
</table>
<br>
<div class="bill-info">
    <div class="col-bill-info">
        <div class="total-amount">
        </div>
    </div>
</div>
@endsection
