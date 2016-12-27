<?php

/* 
* Given an address, return the longitude and latitude using The Google Geocoding API V3
*
*/

function Get_LatLng_From_Google_Maps($address) {
    $address = urlencode($address);

    $url = "http://maps.googleapis.com/maps/api/geocode/json?address=$address&sensor=false";

    // Make the HTTP request
    $data = @file_get_contents($url);
    // Parse the json response
    $jsondata = json_decode($data,true);

    // If the json data is invalid, return empty array
    if (!check_status($jsondata))   return array();

    $LatLng = array(
        'lat' => $jsondata["results"][0]["geometry"]["location"]["lat"],
        'lng' => $jsondata["results"][0]["geometry"]["location"]["lng"],
    );

    return $LatLng;
}

/* 
* Check if the json data from Google Geo is valid 
*/

function check_status($jsondata) {
    if ($jsondata["status"] == "OK") return true;
    return false;
}

$address = "Av. do Uruguai, 6. 1000-167 Lisboa";
$latlong = Get_LatLng_From_Google_Maps($address);

echo "Address: ". $address;
echo "<br />Lat: ". $latlong['lat'];
echo "<br />Long: ". $latlong['lng'];