<?php

header("strict-transport-security: max-age=600");

if (function_exists('header_remove')) {
    header_remove('X-Powered-By'); // PHP 5.3+
} else {
    @ini_set('expose_php', 'off');
}

(require '../../php/config/bootstrap.php')->run();