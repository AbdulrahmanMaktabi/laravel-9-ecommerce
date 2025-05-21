<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CurrencyConverterApiService
{

    protected $baseUrl, $apiKey;

    public function __construct()
    {
        $this->baseUrl = config('services.exchangerate.base_url');
        $this->apiKey = config('services.exchangerate.key');
    }

    public function convert($fromCurrency = 'USD', $toCurrency = 'SYP', $amount = 1)
    {
        $response = Http::get($this->baseUrl . '/' . $this->apiKey . '/latest/' . $fromCurrency);

        if ($response->successful()) {
            $rate = $response->json()['conversion_rates'][$toCurrency] ?? null;
        }

        return $rate ? $rate * $amount : null;
    }
}
