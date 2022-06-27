<div class="col-lg-10">
<label class="col-lg-5">Licensias de expendios existentes <span class="text-danger">*</span></label>

{!!
    Form::select('existingLicense', $existingLicenses, null, [
        'class' => 'col-lg-12 select2', 'placeholder' => 'SELECCIONE', 'id' => 'old_licenses'
    ])
!!}
</div>