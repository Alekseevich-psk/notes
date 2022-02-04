<?php

// regPhone
$p1 = array(" ", "-", "(", ")");
$p2 = array("", "", "", "");
return str_replace($p1, $p2, $input);

// {set $phone = $_modx->config.phone}
// <a class="phone" href="tel:{$_modx->runSnippet('regPhone', ['input' => $phone])}">{$phone}</a>
