<h1 align="center"> Weather </h1>

基于 [高德开放平台](https://lbs.amap.com/api/webservice/guide/api/weatherinfo/) 的 PHP 天气信息组件。

## Installing

```shell
$ composer require vasar/weather -vvv
```


## 配置
在使用本扩展之前，你需要去 [高德开放平台](https://lbs.amap.com/dev/key/app) 注册账号，然后创建应用，获取应用的 API Key。


## 使用

```$xslt
use Vasar\Weather\Weather;

$key = 'xxxxxxxxxxxxxxxxxxxxxxxx';

$w = new Weather($key);

```

## 获取实时天气
```$xslt
$response = $w->getLiveWeather('深圳');
```

## 获取近期的天气预报
```$xslt
$response = $w->getForecastWeather('深圳');
```

## 获取 XML 格式返回值
```$xslt
$w->getWeather('深圳', 'base', 'XML');
```

## 参数说明
`array | string getWeather($city, $type='base', $format = 'json')`

- $city - 城市名，比如：“深圳”；
- $type - 返回内容类型：base: 返回实况天气 / all:返回预报天气；
- $format - 输出的数据格式，默认为 json 格式，当 output 设置为 “xml” 时，输出的为 XML 格式的数据。

`array | string getLiveWeather($city, $format = 'json')`

`array | string getForecastWeather($city, $format = 'json'))`

- $city - 城市名，比如：“深圳”；
- $format - 输出的数据格式，默认为 json 格式，当 output 设置为 “xml” 时，输出的为 XML 格式的数据。


## 在 Laravel 中使用
在 Laravel 中使用也是同样的安装方式，配置写在 `config/services.php` 中：

```$xslt
.
'weather' => [
'key' => env('WEATHER_API_KEY'),
],
```
然后在 `.env` 中配置 `WEATHER_API_KEY` ：

```
WEATHER_API_KEY=xxxxxxxxxxxxxxxxxxxxx
```

可以用两种方式来获取 Vasar\Weather\Weather 实例：

#### 方法参数注入
```$xslt
public function show(Request $request, Weather $weather, $city)
{
    return $weather->getWeather($city);
}
```

#### 服务名访问
```$xslt
public function show(Request $request, $city)
{
    return app('weather')->getWeather($city);
}
```

## 参考

- [高德开放平台天气接口](https://lbs.amap.com/api/webservice/guide/api/weatherinfo/)

## License

MIT