<?php

call_user_func(function () {
    $settings = parse_ini_file(__DIR__ . "/reset.ini", true);

    foreach ($settings['runtime'] as $key => $value) {
        ini_set($key, $value);
    }

    foreach ($settings['non-runtime'] as $key => $expect) {
        $value = ini_get($key);

        if (((string)$expect ?: '0') !== ((string)$value ?: '0')) {
            $expectDesc = var_export($expect, true);
            $valueDesc = var_export($value, true);
            trigger_error("$key should be $expectDesc is $valueDesc", E_USER_WARNING);
        }
    }

    if (ob_get_level()) {
        ob_end_flush();
    }
});

