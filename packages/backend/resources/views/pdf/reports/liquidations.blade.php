@extends('pdf.reports.layouts.template')

@section('content')
    <caption>REPORTE DE LIQUIDACIONES</caption>
    <thead>
        <tr>
        <th width="3%">#</th>
        <th width="7%">NO. LIQUIDACIÓN</th>
        <th width="15%">RIF</th>
        <th width="60%">RAZÓN SOCIAL</th>
        <th width="15%">MONTO</th>
        </tr>
    </thead>
    <tbody>
    @foreach($liquidations as $index => $liquidation)
        <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $liquidation->num }}</td>
        <td>{{ $liquidation->taxpayer->rif }}</td>
        <td>{{ $liquidation->taxpayer->name }}</td>
        <td>{{ $liquidation->prettyAmount }}</td>
    </tr>
    @endforeach
@endsection
