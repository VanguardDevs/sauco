<!--<div class="col-lg-10">
<label class="col-lg-5">Licencias de expendios existentes <span class="text-danger">*</span></label>-->

<!--{! !
    Form ::select('existingLicense', $existingLicenses, null, [
        'class' => 'col-lg-12 select2', 'placeholder' => 'SELECCIONE', 'id' => 'old_licenses'
    ])
! !}-->

<div class="col-lg-4">
    <label class="control-label">Número de Licencia de Expendio</label>
    {!!
        Form::number("licenseNum", null, [
            "class" => "form-control",
            "placeholder" => "Número"
        ])
    !!}

    @error('licenseNum')
        <div class="text text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="col-md-6 form-group">
    <label class="control-label"> Fecha de pago <span class="text-danger">*</span></label>

        {!!
            Form::text("installed_at", '', [
                'class' => 'form-control',
                'id' => 'datepicker',
                'placeholder' => 'Seleccione una fecha',
                'readonly',
                'required'
            ])
        !!}
</div>


<label class="col-lg-12">Seleccione Horario de Trabajo<span class="text-danger"> *</span></label>

<div class="col-lg-4">
    <label class="col-lg-2">Desde <span class="text-danger"></span></label>
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
    <label class="col-lg-2">Hasta <span class="text-danger"></span></label>
    {!!
        Form::select('finish-hour', $hours, null, [
            'class' => 'col-md-12 select2', 'placeholder' => 'SELECCIONE', 'id' => 'finish-hour'
        ])
    !!}
    @error('hour')
    <div class="text text-danger">{{ $message }}</div>
    @enderror
</div>

<label class="col-lg-12"><span class="text-danger"></span></label>
<div class="col-lg-5">
    <label class="col-lg-2">Desde<span class="text-danger"></span></label>
    {!!
        Form::select('start-day', $days, null, [
            'class' => 'col-md-12 select2', 'placeholder' => 'SELECCIONE', 'id' => 'start-day'
        ])
    !!}
    @error('start-day')
    <div class="text text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="col-lg-5">
    <label class="col-lg-2">Hasta<span class="text-danger"></span></label>
    {!!
        Form::select('finish-day', $days, null, [
            'class' => 'col-md-12 select2', 'placeholder' => 'SELECCIONE', 'id' => 'finish-day'
        ])
    !!}
    @error('finish-day')
    <div class="text text-danger">{{ $message }}</div>
    @enderror
</div>

<label class="col-lg-12"><span class="text-danger"></span></label>

<div class="col-lg-5">
    <label class="col-lg-5">Franquicia Móvil<span class="text-danger"> *</span></label>
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
    <label class="col-lg-3">Anexo<span class="text-danger">*</span></label>
    {!!
        Form::select('liqueurAnnex', $liqueurAnnexes, null, [
            'class' => 'col-md-12 select2',
            'placeholder' => 'SELECCIONE',
            'id' => 'liqueur_annex'
        ])
    !!}

    @error('liqueurAnnex')
    <div class="text text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="col-lg-6">
    <label class="col-lg-6">Parámetro de Expendio<span class="text-danger">*</span></label>

    {!!
        Form::select('liqueurParameter', $liqueurParameters, null, [
            'class' => 'col-md-12 select2',
            'placeholder' => 'SELECCIONE',
            'id' => 'liqueur_parameter'
        ])
    !!}

    @error('liqueurParameter')
    <div class="text text-danger">{{ $message }}</div>
    @enderror
</div>

<!--</div>-->
