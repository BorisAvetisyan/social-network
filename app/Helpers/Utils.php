<?php

namespace App\Helpers;

class Utils {

    public static function returnUnauthorizedResponse() {
        return response()->view('layouts.unauthorized', [], 403);
    }
}
