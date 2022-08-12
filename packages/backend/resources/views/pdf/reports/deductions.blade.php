@extends('pdf.reports.layouts.template')

@section('content')
<table style="text-align: center">
    <caption>{{ strtoupper($title) }}</caption>
    <thead>
        <tr>
        <th width="3%">#</th>
        <th width="7%">NO. FACTURA</th>
        <th width="15%">RIF</th>
        <th width="60%">RAZÓN SOCIAL</th>
        <th width="15%">MONTO</th>
        </tr>
    </thead>
    <tbody>
    @foreach($deductions as $index => $deduction)
        <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $deduction->payment->num }}</td>
        <td>{{ $deduction->payment->taxpayer->rif }}</td>
        <td>{{ $deduction->payment->taxpayer->name }}</td>
        <td>{{ $deduction->prettyAmount }}</td>
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
