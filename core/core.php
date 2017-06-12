<?php
/**
 * FrAnanas is golden
 */

/**
 * FrAnanas is golden
 */
require('autoload/autoload.php');

$autoloader = new Autoload('../');
spl_autoload_register([$autoloader, 'load']);

if(defined('PROFILER') && PROFILER) {
    $profiler = new Profiler();
}

$view = new View('../views/');
$controller = new Controller('../controllers/');
$router = new Router();

$session = new Session();
$cookie = new Cookie();

// TODO(doc): find a place for that
/**
 * Check if serialized
 * Fairly certain but not 100%
 *
 * @param $data
 * @param $strict
 * @return bool
 */
function is_serialized( $data, $strict = true ):bool {
    // if it isn't a string, it isn't serialized.
    if ( ! is_string( $data ) ) {
        return false;
    }
    $data = trim( $data );
    if ( 'N;' == $data ) {
        return true;
    }
    if ( strlen( $data ) < 4 ) {
        return false;
    }
    if ( ':' !== $data[1] ) {
        return false;
    }
    if ( $strict ) {
        $lastc = substr( $data, -1 );
        if ( ';' !== $lastc && '}' !== $lastc ) {
            return false;
        }
    } else {
        $semicolon = strpos( $data, ';' );
        $brace     = strpos( $data, '}' );
        // Either ; or } must exist.
        if ( false === $semicolon && false === $brace )
            return false;
        // But neither must be in the first X characters.
        if ( false !== $semicolon && $semicolon < 3 )
            return false;
        if ( false !== $brace && $brace < 4 )
            return false;
    }
    $token = $data[0];
    switch ( $token ) {
        case 's' :
            if ( $strict ) {
                if ( '"' !== substr( $data, -2, 1 ) ) {
                    return false;
                }
            } elseif ( false === strpos( $data, '"' ) ) {
                return false;
            }
            // or else fall through
        case 'a' :
        case 'O' :
            return (bool) preg_match( "/^{$token}:[0-9]+:/s", $data );
        case 'b' :
        case 'i' :
        case 'd' :
            $end = $strict ? '$' : '';
            return (bool) preg_match( "/^{$token}:[0-9.E-]+;$end/", $data );
    }
    return false;
}

/**
 * Try to unserialize
 *
 * @param $original
 * @return mixed
 */
function maybe_unserialize( $original ) {
    if ( is_serialized( $original ) ) // don't attempt to unserialize data that wasn't serialized going in
        return @unserialize( $original );
    return $original;
}
