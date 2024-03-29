@extends('cruds.form')

@section('title', 'Actualizar actividades económicas')

@section('form')
    <div class="row">
        <div class="col-lg-12">
            <div class="kt-portlet">
                <!-- form start -->
                @if ($typeForm == 'create')
                {!! Form::open(['route' => ["taxpayer-activities.store", $taxpayer->id], 'autocomplete' => 'off', 'enctype' => 'multipart/form-data',]) !!}
                @else
                {!! Form::model($row, ['route' => ['taxpayer-activities'.'.update', $row->id], 'method' => 'patch', 'autocomplete' => 'off', 'role' => 'form', 'enctype' => 'multipart/form-data',]) !!}
                @endif
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <div class="form-group col-lg-12">
                                <div class="kt-heading kt-heading--md">
                                    Actualizar actividades económicas
                                </div>
                            </div>
                            {!!
                                Form::select('economic_activities[]', $activities,
                                (isset($row->economicActivities) ? ($row->economicActivities) : null), [
                                'class'=>'form-control multiselect',
                                'multiple', 'required'
                                ])
                            !!}

                            @error('economic_activities')
                            <div class="text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary" id="cancel"><i class="fas fa-reply"></i> Regresar</a>

                    @if($typeForm == 'update')
                    <button type="submit" class="btn btn-primary">
                        <i class="flaticon2-reload"></i>
                        Actualizar
                    </button>
                    @else
                    <button  type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i>
                        Registrar
                    </button>
                    @endif
                </div>
                {!! Form::close() !!}
                <!-- end:: Content -->
                </div>
        </div>
    </div>
@endsection
