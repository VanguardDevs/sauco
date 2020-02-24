@extends('cruds.form')

@section('title', 'Registro de Permisos')

@section('form')
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header alert alert-danger">
            @if ($typeForm == 'create')
                <h5 class="card-title">Registro de Permisos</h5>
           @else
                <h5>Editar registro: {{ @$row->name }}</h5>
           @endif
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        @if ($typeForm == 'create')
            {!! Form::open(['route' => "permissions".'.store', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data']) !!}
        @else
            {!! Form::model($row, ['route' => ["permissions".'.update', $row->id], 'method' => 'patch', 'autocomplete' => 'off', 'role' => 'form', 'enctype' => 'multipart/form-data',]) !!}
        @endif
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-12">
                    <label class="control-label"> Nombre <span class="text-danger">*</span></label>
                    {!! Form::text("name", old('name', @$row->name), ["Placeholder" => "Nombre", "class" => "form-control", "onkeyup" => "upperCase(this);", "required"]) !!}

                    @error('name')
                    <div class="text text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-12">
                    <label class="control-label"> Url <span class="text-danger">*</span></label>
                    {!! Form::text("slug", old('slug', @$row->slug), ["Placeholder" => "administratition.users.index", "class" => "form-control", "required"]) !!}

                    @error('name')
                    <div class="text text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-12">
                    <label class="control-label"> Descripción <span class="text-danger">*</span></label>
                    {!! Form::text("description", old('description', @$row->description), ["Placeholder" => "Descripción", "class" => "form-control", "onkeyup" => "upperCase(this);"]) !!}

                    @error('description')
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
                    <i class="mdi mdi-rotate-3d"></i>
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
    </div>
    <!-- /.card -->
@endsection
