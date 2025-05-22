# 🇰🇿 KZ Currency Rates

![PHP](https://img.shields.io/badge/php-%3E=8.1-blue)
![License](https://img.shields.io/badge/license-MIT-green.svg)
![Packagist](https://img.shields.io/packagist/v/rustem-kaimolla/kz-currency-rates)
![Downloads](https://img.shields.io/packagist/dt/rustem-kaimolla/kz-currency-rates)

**Lightweight PHP library** for getting exchange rates from the official API of the National Bank of Kazakhstan.

📡 Source: [https://nationalbank.kz/rss/get_rates.cfm?fdate=dd.mm.YYYY](https://nationalbank.kz/rss/get_rates.cfm?fdate=dd.mm.YYYY)

---

## 🚀 Installation

```bash
composer require rusdev/kz-currency-rates
```

---

## 🧱 Stack

- PHP 8.1+
- Guzzle HTTP client
- PSR-4 autoload

---

## 📦 Quick start

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

## 📌 Receiving a specific currency

```php
$usd = $fetcher->getRate('USD');

echo "USD/KZT: {$usd->rate} ₸";
```

---

## 🧠 Filtering major currencies (Specification)

```php
use Currency\Filters\MajorCurrencySpecification;

$spec = new MajorCurrencySpecification();

$majorRates = array_filter($rates, fn($rate) => $spec->isSatisfiedBy($rate));

foreach ($majorRates as $rate) {
    echo $rate->currency() . ': ' . $rate->value() . PHP_EOL;
}
```

---

## 🧪 Tests

```bash
composer test
```

Test Coverage:
- XmlRateParser
- RateRequestBuilder
- CurrencyRateDTO
- MajorCurrencySpecification
- RateFetcher (с Guzzle mock)

---

## 📄 License

MIT.
