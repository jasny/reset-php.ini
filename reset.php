<?php

// Call construct is JS-like nonsense to leave no trace. No global variables or defined functions.

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
            trigger_error("PHP setting '$key' should be $expectDesc but is $valueDesc. "
              . "Please modify php.ini and change this setting.", E_USER_WARNING);
        }
    }

    foreach (array_diff(stream_get_wrappers(), ['file']) as $wrapper) {
        stream_wrapper_unregister($wrapper);
    }

    if (ob_get_level()) {
        ob_end_flush();
    }
});

