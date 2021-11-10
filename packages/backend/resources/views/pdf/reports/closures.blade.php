@extends('pdf.reports.layouts.template')

@section('content')
<table style="text-align: center">
    <caption>{{ strtoupper($title) }}</caption>
    <thead>
        <tr>
        <th width="3%">#</th>
        <th width="57%">RUBRO</th>
        <th width="10%">TIPO</th>
        <th width="15%">MOVIMIENTOS</th>
        <th width="15%">MONTO</th>
        </tr>
    </thead>
    <tbody>
    @foreach($models as $index => $model)
        <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $model->name }}</td>
        <td>{{ $model->concurrent ? 'SIMÚLTANEO' : 'MOROSO' }}</td>
        <td>{{ number_format($model->movements_count, 0, '.', '.') }}</td>
        <td>{{ number_format($model->amount, 2, ',', '.') }}</td>
    </tr>
    @endforeach
</table>
<br>
<div class="bill-info">
    <div class="col-bill-info">
        FECHA: {{ $startDate }} - {{ $endDate }}
    </div>
    <div class="col-bill-info">
        <div class="total-amount">
            MONTO TOTAL PROCESADO: {{ $total }}
        </div>
    </div>
</div>
@endsection
