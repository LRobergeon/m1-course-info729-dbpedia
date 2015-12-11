<?php

function e( $string )
{
    return escape( $string );
} 

function escape( $string )
{
    return htmlspecialchars( $string, ENT_QUOTES, 'UTF-8' );
}

function startsWith( $haystack, $needle )
{
    return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
}

function endsWith( $haystack, $needle )
{
    return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== FALSE);
}

function is_assoc( array $array ) {
  return (bool) count( 
        array_filter(
            array_keys( $array ),
            'is_string'
        )
    );
}

function dump( $var )
{
    print_r( '<pre>' . var_export( $var, true ) . '</pre>' );
}

function site_base_uri()
{
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $domainName = rtrim($_SERVER['HTTP_HOST'], '/') . '/';
    return $protocol.$domainName;
}
