@extends('cruds.form')

@section('title', 'Registro de contribuyente')

@section('form')
    <div class="row">
        <div class="col-lg-12">
            <div class="kt-portlet">
                <div class="kt-portlet__head alert alert-danger">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                        @if ($typeForm == 'create')
                            Registro de Contribuyente

                            @section('breadcrumbs')
                                {{ Breadcrumbs::render('taxpayers/create') }}
                            @endsection
                        @else
                            Editar usuario: {{ @$row->login }}

                            @section('breadcrumbs')
                                {{ Breadcrumbs::render('taxpayers/edit', $row) }}
                            @endsection
                        @endif
                        </h3>
                    </div>
                </div>
                <!-- form start -->
                @if ($typeForm == 'create')
                {!! Form::open(['route' => ["add-activities", $taxpayer->id], 'autocomplete' => 'off', 'enctype' => 'multipart/form-data',]) !!}
                @else
                {!! Form::model($row, ['route' => ['taxpayers'.'.update', $row->id], 'method' => 'patch', 'autocomplete' => 'off', 'role' => 'form', 'enctype' => 'multipart/form-data',]) !!}
                @endif
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <div class="form-group col-lg-12">
                            <div class="kt-heading kt-heading--md">
                                Actividades económicas
                            </div>
                            </div>
                            <select name="economic_activities[]" class="form-control select2" multiple="multiple" id="economicActivities">
                            @foreach ($economicActivities as $activity)
                            {{-- @if(old('economic_activity') == $activity->id OR @$taxpayer->economicActivities->economic_activity_id == $activity->id) selected @endif --}}
                                <option value="{{ $activity->id }}" >
                                {{ $activity->code."   |   ".$activity->name }}
                                </option>
                            @endforeach
                            </select>

                            @error('economic_activities')
                            <div class="text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    {{-- <div class="kt-separator kt-separator--border-solid kt-separator--portlet-fit kt-separator--space-lg"></div>
                    <div class="row"> --}}
                    {{-- <div class="form-group col-lg-12">
                        <div class="kt-heading kt-heading--md">
                        Registro comercial
                        </div>
                    </div>

                    <div class="form-group col-md-3">
                        <label class="control-label"> Número <span class="text-danger">*</span></label>
                        {!! Form::text("num", old('num', @$row->num), [
                        "Placeholder" => "Número del registro comercial",
                        "class" => "form-control",
                        "onkeyup" => "upperCase(this);"
                        ]) !!}
                        @error('num')
                        <div class="text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                        <div class="form-group col-md-3">
                            <label class="control-label"> Tomo <span class="text-danger">*</span></label>
                            {!! Form::text("volume", old('volume', @$row->volume), [
                            "Placeholder" => "Tomo del registro comercial",
                            "class" => "form-control"
                            ]) !!}
                            @error('volume')
                            <div class="text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label"> Expediente <span class="text-danger">*</span></label>
                            {!! Form::text(
                            "case_file",
                            old('case_file',
                            @$row->case_file
                            ), [
                            "Placeholder" => "Expediente",
                            "class" => "form-control",
                            "onkeyup" => "upperCase(this);"
                            ]) !!}

                            @error('case_file')
                            <div class="text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">Fecha de inicio de actividades <span class="text-danger">*</span></label>
                            {!! Form::text(
                            "start_date",
                            old('start_date', @$row->start_date),
                            [
                            "class" => "form-control date-input-mask",
                            "placeholder" => "DD/MM/AAAA"
                            ])
                            !!}

                            <span class="form-text text-muted">Formato de fecha:
                            <code>DD/MM/AAAA</code>
                            </span>
                            @error('start_date')
                            <div class="text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div> --}}
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
