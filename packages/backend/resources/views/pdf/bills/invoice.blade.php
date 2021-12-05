@extends('pdf.bills.layouts.template')

@section('content')
<div class="tables">
    <table class="table" style="text-align: center;margin-bottom:0;">
        <thead>
            <tr>
                <th width="85%">RAZÓN SOCIAL</th>
                <th width="15%">RIF</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $denomination }}</td>
                <td>{{ $payment->taxpayer->rif }}</td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: left; padding-left: 3px;">
                    <strong>DIRECCIÓN:</strong> {{ $payment->taxpayer->fiscal_address }}
                </td>
            </tr>
        </tbody>
    </table>
    <table class="table" style="text-align: center">
        <caption>OBJETO DE PAGO</caption>
        <thead>
            <tr>
                <th width="20%">FECHA</th>
                <th width="65%">FORMA DE PAGO</th>
                <th width="15%">REFERENCIA</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $payment->processed_at }}</td>
                <td>{{ $payment->paymentMethod->name }}</td>
                <td>{{ $payment->reference->reference ?? 'S/N' }}</td>
            </tr>
        </tbody>
    </table>
    <table class="details">
    <caption>DETALLES DEL PAGO</caption>
        <thead>
            <tr>
                <th width="12%">Nº LIQUIDACIÓN</th>
                <th width="68%">DETALLES</th>
                <th width="20%">MONTO TOTAL</th>
            </tr>
        </thead>
        <tbody>
        @foreach($payment->liquidations as $liquidation)
            <tr>
                <td>{{ $liquidation->num }}</td>
                <td class="object-payment">{{ $liquidation->object_payment  }}</td>
                <td style="word-spacing:1px;font-size:16px;">{{ $liquidation->pretty_amount }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<br>
<div class="bill-info">
    <div class="col-bill-info">
        N° DE FACTURA: {{ $payment->num }}
    </div>
    <div class="col-bill-info">
        <div class="total-amount">
            PAGO TOTAL: {{ $payment->pretty_amount }} Bs
        </div>
    </div>
</div>
<br>
<div class="miscellaneus">
    <div class="liquidator-info">
        Recaudador: {{ $payment->user->first_name.' '.$payment->user->surname }}
    </div>
    <div class="collector-firm">
        <span style="width:50%;"></span>
    </div>
    <br>
    <div class="observations">
        OBSERVACIONES: {{ $payment->observations }}
    </div>
</div>
@endsection
