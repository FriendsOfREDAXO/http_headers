<?php

$addon = rex_addon::get('http_headers');

if (!$addon->hasConfig()) {
    $addon->setConfig('x-frame-options_fb', 1);
    $addon->setConfig('x-frame-options', 'deny');
    $addon->setConfig('x-powered-by_fb', 1);
    $addon->setConfig('x-powered-by-always-unset', 1);
    $addon->setConfig('referrerpolicy_fb', 1);
    $addon->setConfig('referrerpolicy', 'no-referrer-when-downgrade');
}

$somethingIsWrong = false;
if ($somethingIsWrong) {
    throw new rex_functional_exception('Something is wrong');
}

// Alternativ kann ähnlich wie in R4 mit den Properties "install" und "installmsg" die Installation als nicht erfolgreich markiert werden.
// Im Gegensatz zu R4 muss für eine erfolgreiche Installation keine Property mehr gesetzt werden.
if ($somethingIsWrong) {
    $this->setProperty('installmsg', 'Something is wrong');
    $this->setProperty('install', false);
}
