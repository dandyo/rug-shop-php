<?php
function getCountryName($code)
{
    $json = file_get_contents(URLROOT . "js/countries.json");
    $countries = json_decode($json, TRUE);
    return array_key_exists($code, $countries) ? $countries[$code] : false;
}
