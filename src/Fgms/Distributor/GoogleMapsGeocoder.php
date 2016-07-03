<?php
namespace Fgms\Distributor;

/**
 *	A geocoder implemented using the Google Maps API.
 */
class GoogleMapsGeocoder implements Geocoder
{
    private $api_key;
    private $decode_depth=10;
    private $client;
    /**
     *	Creates a new GoogleMapsGeocoder object which performs
     *	geocoding requests against the Google Maps API using
     *	a certain API key.
     *
     *	\param [in] $api_key
     *		The API key which shall be used to perform requests
     *		against the Google Maps API.
     *  \param [in] $client
     *      The GuzzleHttp\\Client object to be used to dispatch
     *      HTTP requests.  Defaults to \em null in which case
     *      a GuzzleHttp\\Client shall be default constructod.
     */
    public function __construct ($api_key, \GuzzleHttp\Client $client=null)
    {
        $this->api_key=$api_key;
        $this->client=$client;
        if (is_null($this->client)) $this->client=new \GuzzleHttp\Client();
    }
    private function getUrl($address)
    {
        return sprintf(
            'https://maps.googleapis.com/maps/api/geocode/json?address=%s&key=%s',
            rawurlencode($address),
            rawurlencode($this->api_key)
        );
    }
    private function raise($msg, $code=0)
    {
        throw new GoogleMapsGeocoderException($msg,$code);
    }
    private function raiseJson($json)
    {
        $this->raise(
            sprintf('%s: %s',json_last_error_msg(),$json),
            json_last_error()
        );
    }
    public function forward($address)
    {
        $response=$this->client->request('GET',$this->getUrl($address));
        $code=$response->getStatusCode();
        if ($code!==200) $this->raise(sprintf('%s %s',$code,$response->getReasonPhrase()));
        $body=$response->getBody();
        $json=json_decode($body,false,$this->decode_depth);
        if (json_last_error()!==JSON_ERROR_NONE) $this->raiseJson($body);
        if (!is_object($json)) $this->raise(sprintf('Root of JSON is not an object: %s',$body));
        if (!isset($json->results)) $this->raise(sprintf('No "results": %s',$body));
        $rs=$json->results;
        if (!is_array($rs)) $this->raise(sprintf('"results" not array: %s',$body));
        if (count($rs)===0) $this->raise(sprintf('No results: %s',$body));
        if (count($rs)!==1) $this->raise(sprintf('Ambiguous: %s',$body));
        $r=$rs[0];
        if (!isset($r->geometry)) $this->raise(sprintf('No "results"."geometry":%s',$body));
        $g=$r->geometry;
        if (!is_object($g)) $this->raise(sprintf('"results"."geometry" not an object: %s',$body));
        if (!isset($g->location)) $this->raise(sprintf('No "results"."geometry"."location": %s',$body));
        $l=$g->location;
        if (!is_object($l)) $this->raise(sprintf('"results"."geometry"."location" not an object: %s',$body));
        if (!isset($l->lat)) $this->raise(sprintf('No "results"."geometry"."location"."lat": %s',$body));
        $lat=$l->lat;
        if (!(is_int($lat) || is_float($lat))) $this->raise(sprintf('"results"."geometry"."location"."lat" not a number: %s',$body));
        if (!isset($l->lng)) $this->raise(sprintf('No "results"."geometry"."location"."lng": %s',$body));
        $lng=$l->lng;
        if (!(is_int($lng) || is_float($lng))) $this->raise(sprintf('"results"."geometry"."location"."lng" not a number: %s',$body));
        return [$lat,$lng];
    }
}