@extends('layouts.template')

@section('title', 'Licencia '.$row->num)

@section('content')

	<div id="liqueur-license-show" data-id="{{ $row->id }}">
		<div class="row">
			<div class="col-xs-undefined col-sm-undefined col-md-undefined col-lg-undefined col-xl-12">
				<div class="kt-portlet">
					<div class="kt-portlet__head">
						<div class="kt-portlet__head-label">
							<h3 class="kt-portlet__head-title">Licencia {{ $row->num }}</h3>
							
						</div>
					</div>
					<div class="kt-portlet__body">
						<h5>LICENCIA DE {{ $row->ordinance->description }}</h5>

						<h5>Fecha de emisión: {{$row->emission_date}}</h5>
						<br>
						<h5>Representante: {{$row->representation->person->name}} </h5>
						<br>
						
						<div>
							<h5>Razón Social: {{$row->taxpayer->name}}</h5>
						</div>
						<div>
							<h5>Clasificación del expendio: {{$liqueur->liqueur_parameter->liqueur_classification->name}}</h5>
						</div>
						<br>
						<h5>Usuario: {{$row->user->login}}</h5>
					</div>
					<div class="kt-portlet__foot">

						<a href="{{ route('liqueur-license.download', $row) }}" class="btn btn-info" title="Imprimir licencia" target="_blank">
							<i class="flaticon2-download"></i>
						Imprimir licencia</a>   
						 
						<a href="{{ route('taxpayers.show', $row->taxpayer->id) }}" class="btn btn-success" title="Ver perfil"><i class="fas fa-eye "></i>
						Ver perfil</a>
					</div>
				</div>
			</div>
		</div>
	</div>



@endsection
