<?php

namespace app\Services;
use App\License;

class LicenseService {
    public function all() {
        return License::find(1);
    }
}
