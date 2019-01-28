<?php
/**
 * Created by PhpStorm.
 * User: vasar
 * Date: 2019-01-22
 * Time: 00:07.
 */

namespace Vasar\Weather;

use GuzzleHttp\Client;
use Vasar\Weather\Exceptions\HttpException;
use Vasar\Weather\Exceptions\InvalidAgrumentException;

class Weather
{
    protected $key;

    protected $guzzleOptions = [];

    public function __construct($key)
    {
        $this->key = $key;
    }

    public function getGuzzleClient()
    {
        return new Client($this->guzzleOptions);
    }

    public function setGuzzleOptions($options)
    {
        $this->guzzleOptions = $options;
    }

    public function getLiveWeather($city, $format = 'json')
    {
        return $this->getWeather($city, 'base', $format);
    }

    public function getForecastWeather($city, $format = 'json')
    {
        return $this->getWeather($city, 'all', $format);
    }

    public function getWeather($city, $type = 'base', $format = 'json')
    {
        $url = 'https://restapi.amap.com/v3/weather/weatherInfo';

        if (!in_array(strtolower($type), ['base', 'all'])) {
            throw new InvalidAgrumentException('Invalid type value(base/all): '.$type);
        }

        if (!in_array(strtolower($format), ['json', 'xml'])) {
            throw new InvalidAgrumentException('Invalid response format: '.$format);
        }

        $query = array_filter([
            'key' => $this->key,
            'city' => $city,
            'extensions' => $type,
            'output' => $format,
        ]);

        try {
            $response = $this->getGuzzleClient()->get($url, [
                'query' => $query,
            ])->getBody()->getContents();

            return 'json' == $format ? json_decode($response, true) : $response;
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
