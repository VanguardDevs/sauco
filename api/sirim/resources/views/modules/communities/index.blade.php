@extends('layouts.template')

@section('title', 'Área geográfica')

@section('subheader__title', 'Área geográfica')

@section('content')

<div class="row" style="margin-top: 20px;">
    <div class="col-lg-12">
      <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="fas fa-globe-americas"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Control de comunidades
                </h3>
            </div>
           @if (Auth()->user()->can('create.communities'))
           <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-actions">
                    <a href="{{ Route('communities.create') }}" class="btn btn-clean btn-sm btn-icon btn-icon-md" title="Nueva comunidad">
                        <i class="fas fa-plus"></i>
                    </a>
                </div>
            </div>
            @endif
        </div>

        <div class="kt-portlet__body">
          <table id="tCommunities" class="table table-bordered table-striped datatables" style="text-align: center">
            <thead>
              <tr>
                <th width="30%">Parroquia(s)</th>
                <th width="40%">Comunidad</th>
                <th width="10%">Contribuyentes</th>
                <th width="20%">Acciones</th>
              </tr>
            </thead>
          </table>
        </div>

      </div>
    </div>
  </div>

@endsection
