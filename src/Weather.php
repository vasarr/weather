<?php
/**
 * Created by PhpStorm.
 * User: vasar
 * Date: 2019-01-22
 * Time: 00:07
 */

namespace Vasar\Weather;


use GuzzleHttp\Client;

class Weather
{
    protected $key;

    protected $guzzleOptions = [];


    public function __construct(string $key)
    {
        $this->key = $key;
    }

    public function getGuzzleClient()
    {
        return new Client($this->guzzleOptions);
    }

    public function setGuzzleOptions(array $options)
    {
        $this->guzzleOptions = $options;
    }

    public function getWeather($city, $type='base', $format = 'json')
    {
        $url = 'https://restapi.amap.com/v3/weather/weatherInfo';

        $query = array_filter([
            'key' => $this->key,
            'city' => $city,
            'extensions' => $type,
            'output' => $format,
        ]);

        $response = $this->getGuzzleClient()->get($url, [
           'query' => $query,
        ])->getBody()->getContents();

        return 'json' == $format ? json_decode($response, true) : $response;
    }
}