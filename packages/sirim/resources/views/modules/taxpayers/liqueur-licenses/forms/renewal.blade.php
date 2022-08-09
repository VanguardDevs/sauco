<div class="col-lg-12">
    <label class="col-lg-12">Seleccione un expendio a renovar<span class="text-danger">*</span></label>

    {!!
        Form::select('license_id', $existingLicenses, null, [
            'class' => 'col-md-10 select2',
            'placeholder' => 'SELECCIONE',
            'id' => 'license_id'
        ])
    !!}

    @error('license_id')
    <div class="text text-danger">{{ $message }}</div>
    @enderror
</div>

<!--</div>-->
