# 🇰🇿 KZ Currency Rates

![PHP](https://img.shields.io/badge/php-%3E=8.1-blue)
![License](https://img.shields.io/badge/license-MIT-green.svg)
![Packagist](https://img.shields.io/packagist/v/rustem-kaimolla/kz-currency-rates)
![Downloads](https://img.shields.io/packagist/dt/rustem-kaimolla/kz-currency-rates)

**Легковесная PHP-библиотека** для получения курсов валют с официального API Национального Банка Казахстана.

📡 Источник: [https://nationalbank.kz/rss/get_rates.cfm?fdate=dd.mm.YYYY](https://nationalbank.kz/rss/get_rates.cfm?fdate=dd.mm.YYYY)

---

## 🚀 Установка

```bash
composer require rusdev/kz-currency-rates
```

---

## 🧱 Стек

- PHP 8.1+
- Guzzle HTTP client
- PSR-4 автозагрузка

---

## 📦 Быстрый старт

```php
use Currency\Requests\RateRequestBuilder;
use Currency\Parsers\XmlRateParser;
use Currency\Services\RateFetcher;
use GuzzleHttp\Client;

$builder = (new RateRequestBuilder())->forDate('12.05.2025');
$parser = new XmlRateParser();

$fetcher = new RateFetcher(
    $builder->build(),
    $parser
);

$rates = $fetcher->getAllRates();

foreach ($rates as $rate) {
    echo $rate->code . ': ' . $rate->rate . PHP_EOL;
}
```

---

## 📌 Получение конкретной валюты

```php
$usd = $fetcher->getRate('USD');

echo "Курс доллара: {$usd->rate} ₸";
```

---

## 🧠 Фильтрация основных валют (Specification)

```php
use Currency\Filters\MajorCurrencySpecification;

$spec = new MajorCurrencySpecification();

$majorRates = array_filter($rates, fn($rate) => $spec->isSatisfiedBy($rate));

foreach ($majorRates as $rate) {
    echo $rate->currency() . ': ' . $rate->value() . PHP_EOL;
}
```

---

## 🧪 Тесты

```bash
composer test
```

Покрытие тестами:
- XmlRateParser
- RateRequestBuilder
- CurrencyRateDTO
- MajorCurrencySpecification
- RateFetcher (с Guzzle mock)

---

## 📄 Лицензия

MIT — используй свободно.
