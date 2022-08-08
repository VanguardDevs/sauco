<div class="row">
    <label class="col-lg-12">Seleccione Horario de Trabajo<span class="text-danger"> *</span></label>
    <div class="col-lg-4">
        <label class="col-lg-12">Hora desde <span class="text-danger"></span></label>
        {!!
            Form::select('start-hour', $hours, null, [
                'class' => 'col-md-12 select2', 'placeholder' => 'SELECCIONE', 'id' => 'start-hour'
            ])
        !!}

        @error('hour')
        <div class="text text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-lg-4">
        <label class="col-lg-12">Hora hasta<span class="text-danger"></span></label>
        {!!
            Form::select('finish-hour', $hours, null, [
                'class' => 'col-md-12 select2', 'placeholder' => 'SELECCIONE', 'id' => 'finish-hour'
            ])
        !!}
        @error('hour')
        <div class="text text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-lg-4">
        <label class="col-lg-12">Fecha de registro<span class="text-danger"></span></label>

        {!!
            Form::text("registry_date", '', [
                'class' => 'form-control',
                'id' => 'datepicker',
                'placeholder' => 'Seleccione una fecha',
                'readonly',
                'required'
            ])
        !!}

        @error('registry_date')
        <div class="text text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-lg-6">
        <label class="col-lg-12"><span class="text-danger"></span></label>
        <label class="col-lg-12">Día desde<span class="text-danger"></span></label>
        {!!
            Form::select('start-day', $days, null, [
                'class' => 'col-md-12 select2', 'placeholder' => 'SELECCIONE', 'id' => 'start-day'
            ])
        !!}
        @error('start-day')
        <div class="text text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-lg-6">
        <label class="col-lg-12"><span class="text-danger"></span></label>
        <label class="col-lg-12">Día hasta<span class="text-danger"></span></label>
        {!!
            Form::select('finish-day', $days, null, [
                'class' => 'col-md-12 select2', 'placeholder' => 'SELECCIONE', 'id' => 'finish-day'
            ])
        !!}
        @error('finish-day')
        <div class="text text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="row">
    <label class="col-lg-12"><span class="text-danger"></span></label>

    <div class="col-lg-6">
        <label class="col-lg-12">Franquicia Móvil<span class="text-danger"> *</span></label>
        {!!
            Form::select('is_mobile', $boolean, null, [
                'class' => 'col-md-12 select2', 'placeholder' => 'SELECCIONE', 'id' => 'is_mobile'
            ])
        !!}
        @error('boolean')
        <div class="text text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-lg-6">
        <label class="col-lg-12">Anexo<span class="text-danger">*</span></label>
        {!!
            Form::select('annexes[]', $liqueurAnnexes, null, [
                'class' => 'form-control multiselect',
                'id' => 'liqueur_annex',
                'multiple', 'required'
            ])
        !!}

        @error('annexes')
        <div class="text text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <label class="col-lg-12">Clasificación de Expendio<span class="text-danger">*</span></label>

        {!!
            Form::select('liqueur_classification_id', $liqueurClassifications, null, [
                'class' => 'col-md-12 select2',
                'placeholder' => 'SELECCIONE',
                'id' => 'liqueur_classification'
            ])
        !!}

        @error('liqueur_classification_id')
        <div class="text text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-lg-6">
        <label class="col-lg-12">Parámetro de Expendio<span class="text-danger">*</span></label>

        {!!
            Form::select('liqueur_parameter_id', $liqueurParameters, null, [
                'class' => 'col-md-12 select2',
                'placeholder' => 'SELECCIONE',
                'id' => 'liqueur_parameter'
            ])
        !!}

        @error('liqueur_parameter_id')
        <div class="text text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>
