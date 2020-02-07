@extends('layouts.template')

@section('title', "Liquidaciones")

@section('content')
<div class="kt-subheader kt-grid__item" id="kt_subheader">
    <div class="kt-subheader__main">
        <h3 class="kt-subheader__title">Crear liquidaciones</h3>
    </div>
</div>
    <div class="row">
        <div class="col-lg-12">
            <div class="kt-portlet">
                {!! Form::open(['url' => 'make-settlements', 'class' => 'kt-form kt-form--label-right', 'method' => 'put', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data']) !!}
                    <div class="kt-portlet__body">
                        {{ $taxpayer->economicActivities }}
                        @foreach ($taxpayer->economicActivities as $activity)

                        @endforeach
                    </div>
                    <div class="kt-portlet__foot">
                      <div class="kt-form__actions">
                        <div class="row">
                          <div class="col-lg-6">
                              <button type="submit" class="btn btn-primary">
                                    <i class="flaticon-refresh"></i>
                                    Actualizar
                              </button>
                          </div>
                        </div>
                      </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
