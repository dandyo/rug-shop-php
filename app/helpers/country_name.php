<?php
function getCountryName($code)
{
    $json = file_get_contents(URLROOT . "js/countries.json");
    $countries = json_decode($json, TRUE);
    $key = array_search($code, array_column($countries, 'code'), false);
    return ($key) ? $countries[$key]['name'] : false;
    // return array_key_exists($code, $countries) ? $countries[$code] : false;
}
