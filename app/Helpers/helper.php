<?php

if (!function_exists('user')) {
    function user() {
        return \Illuminate\Support\Facades\Auth::user();
    }
}
