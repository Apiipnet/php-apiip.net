# IP to Location (PHP)

<p>
<a href="https://apiip.net"><img alt="apiip.net website status" src="https://img.shields.io/website?down_color=red&down_message=offline&label=apiip.net%20website&up_color=success&up_message=online&url=https%3A%2F%2Fapiip.net%2F"> </a>
<a href="https://status.apiip.net/"><img alt="Uptime Robot status" src="https://img.shields.io/uptimerobot/status/m789879229-16fa66289487470e7544d58a?label=API%20status"></a>
<a href="https://status.apiip.net/"><img alt="Uptime Robot ratio (30 days)" src="https://img.shields.io/uptimerobot/ratio/m789879229-16fa66289487470e7544d58a?label=API%20uptime%20%2830%20days%29"></a>
<img alt="GitHub issues" src="https://img.shields.io/github/issues-raw/Apiipnet/php-apiip.net">
<img alt="GitHub code size in bytes" src="https://img.shields.io/github/languages/code-size/Apiipnet/php-apiip.net">
<img alt="GitHub top language" src="https://img.shields.io/github/languages/top/apiipnet/php-apiip.net">
</p>

This is the official PHP client library for the [Apiip.net](https://apiip.net) IP address API, allowing you to lookup your own IP address, or get any of the details for an IP.

Find geolocation data from IP addresses (e.g. city, country, lat/long) using the apiip.net API.

Apiip.net provides 5.000 free requests per month. For higher plans, check out the [website](https://apiip.net)

## Installation

You need to get your API key from here: https://apiip.net/get-started and you'll get 5.000 free requests/month

Install the package with:

```sh
composer require apiip/apiip.net
```

## Usage

The package needs to be configured with your account's API key, which is available in the [Apiip.net Dashboard](https://apiip.net/user/dashboard)

```php
use ApiipClient\Apiip;

$access_key = 'YOUR_ACCESS_KEY';
$client = new Apiip($access_key);
$details = $client->getLocation();

$details['city'];
Belgrade
```

## HTTPS Encryption

By default, the SSL/TLS is turned off, if you want to enable it just pass the options parameter

#### Example

```php
use ApiipClient\Apiip;

$access_key = 'YOUR_ACCESS_KEY';
$client = new Apiip($access_key, ['ssl' => true]);
```

## Configuration

Call getLocation method with config object

```php
use ApiipClient\Apiip;

$access_key = 'YOUR_ACCESS_KEY';
$client = new Apiip($access_key, ['ssl' => true]);
$details = $client->getLocation([
  'ip' => $ip_address, // 67.250.186.196, 188.79.34.191, 60.138.7.24 - for bulk request
  'output' => 'xml',
  'fields' => 'city,country',
  'languages' => 'es'
]);
```

| Option      | Type     | Description                                                    | Default      |
| ----------- | -------- | -------------------------------------------------------------- | ------------ |
| `ip`        | `string` | _Optional_. Get location about the specify IP or multiple IPs. | Requester IP |
| `output`    | `string` | _Optional_. Specify response format, XML or JSON.              | JSON         |
| `fields`    | `string` | _Optional_. Specify response fields.                           | All fields   |
| `languages` | `string` | _Optional_. Specify response language.                         | EN           |

## Example complete response

```javascript
{
  "ip": "67.250.186.196",
  "continentCode": "NA",
  "continentName": "North America",
  "countryCode": "US",
  "countryName": "United States",
  "countryNameNative": "United States",
  "city": "New York",
  "postalCode": "10001",
  "latitude": 40.8271,
  "longitude": -73.9359,
  "capital": "Washington D.C.",
  "phoneCode": "1",
  "countryFlagEmoj": "🇺🇸",
  "countryFlagEmojUnicode": "U+1F1FA U+1F1F8",
  "isEu": false,
  "borders": [
    "CAN",
    "MEX"
  ],
  "topLevelDomains": [
    ".us"
  ],
  "languages": {
    "en": {
      "code": "en",
      "name": "English",
      "native": "English"
    }
  },
  "currency": {
    "code": "USD",
    "name": "US Dollar",
    "symbol": "$",
    "number": "840",
    "rates": {
      "EURUSD": 1.11
    }
  },
  "timeZone": {
    "id": "America/New_York",
    "currentTime": "10/26/2021, 2:54:10 PM",
    "code": "EDT",
    "timeZoneName": "EDT",
    "utcOffset": -14400
  },
  "userAgent": {
    "isMobile": false,
    "isiPod": false,
    "isTablet": false,
    "isDesktop": true,
    "isSmartTV": false,
    "isRaspberry": false,
    "isBot": false,
    "browser": "Chrome",
    "browserVersion": "100.0.4896.127",
    "operatingSystem": "Windows 10.0",
    "platform": "Microsoft Windows",
    "source": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.127 Safari/537.36"
  },
  "connection": {
    "asn": 12271,
    "isp": "Charter Communications Inc"
  },
  "security": {
    "isPublicProxy": false,
    "isResidentialProxy": false,
    "isTorExitNode": false,
    "network": "67.250.176.0/20"
  }
}

```

## More Information

- [API Documentation](https://apiip.net/documentation)
