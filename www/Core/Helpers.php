<?php

/**
 * Dump and die with var_dump
 *
 * @param mixed ...$vars Variables to dump
 *
 * @return never
 */
function dd(...$vars)
{
    echo "<pre>";
    foreach ($vars as $var) {
        var_dump($var);
    }
    echo "</pre>";
    die();
}

/**
 * Dump and die with var_export
 *
 * @param mixed ...$vars Variables to dump
 *
 * @return never
 */
function dde(...$vars)
{
    echo "<pre>";
    foreach ($vars as $var) {
        highlight_string("<?php\n\$var =\n" . var_export($var, true) . ";\n?>");
    }
    echo "</pre>";
    die();
}
