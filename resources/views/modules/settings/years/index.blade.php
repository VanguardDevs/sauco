@extends('layouts.template')

@section('title', 'Control de años fiscales')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="fas fa-lightbulb"></></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        Control de años fiscales
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-actions">
                        <a href="{{ Route('years.create') }}" class="btn btn-clean btn-sm btn-icon btn-icon-md" title="Nuevo año">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
              <table class="table table-bordered table-striped datatables" style="text-align: center">
                <thead>
                  <tr>
                    <th>Año</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($years as $year)
                    <tr>
                        <td>{{ $year->year  }}</td>
                    </tr>
                @endforeach
                </tbody>
              </table>
            </div>
        </div>
    </div>
</div>

@endsection
