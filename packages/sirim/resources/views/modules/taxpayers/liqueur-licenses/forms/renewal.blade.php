<div class="col-lg-12">
    <label class="col-lg-12">Parámetro de Expendio<span class="text-danger">*</span></label>

    {!!
        Form::select('license_id', $existingLicenses, null, [
            'class' => 'col-md-12 select2',
            'placeholder' => 'SELECCIONE',
            'id' => 'license_id'
        ])
    !!}

    @error('license_id')
    <div class="text text-danger">{{ $message }}</div>
    @enderror
</div>

<!--</div>-->
