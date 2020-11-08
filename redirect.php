<?php
    /*
    |--------------------------------------------------------------------------
    | List Country ID = https://countrycode.org/
    |--------------------------------------------------------------------------
    | example atau contoh below:
    | $uri_affilate = 'http://www.google.com';
    */
function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER["HTTP_CF_CONNECTING_IP"])) 
        $ipaddress = $_SERVER["HTTP_CF_CONNECTING_IP"];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else
        $ipaddress = 'UNKNOWN';
    $geord = @json_decode(@file_get_contents('http://www.geoplugin.net/json.gp?ip='.$ipaddress));
    return $geord;
}
$countryCode = get_client_ip()->geoplugin_countryCode;

if ( $countryCode == "US" ) {
    $uri_affilate = 'http://yandex.com';
} elseif ( $countryCode == "AU" || $countryCode == "NL" || $countryCode == "FR" || $countryCode == "MR" ) {
    $uri_affilate = 'http://bing.com';
} elseif ( $countryCode == "DE" || $countryCode == "ES" ) {
    $uri_affilate = 'http://fb.com';
} elseif ( $countryCode == "CA" ) {
    $uri_affilate = 'http://twitter.com';
} elseif ( $countryCode == "ID" ) {
    $uri_affilate = 'http://yahoo.com';
} else {
    $uri_affilate = 'http://google.com';
}
header("Location: $uri_affilate");
?>