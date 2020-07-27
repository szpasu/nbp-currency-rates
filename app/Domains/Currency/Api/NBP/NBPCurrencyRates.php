<?php namespace App\Domains\Currency\Api\NBP;

use App\Domains\Currency\Api\BaseApi;
use App\Domains\Currency\Api\NBP\Interfaces\NBPCurrencyRatesInterface;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;

/**
 * File: NBPCurrencyRates.php
 * Description:
 *
 * Author: Patryk Pasternak
 */
class NBPCurrencyRates extends BaseApi implements NBPCurrencyRatesInterface
{

    /**
     * @var string
     */
    protected $endpointUrl = 'http://api.nbp.pl/api/exchangerates/';

    /**
     * @param string $query
     * @return array
     * @throws GuzzleException
     */
    public function parseData(string $query): array
    {
        $stringData = $this->getData($query);
        $data = json_decode($stringData, true);

        if (is_array(Arr::first($data))) {
            $data = Arr::first($data);
        }

        $effectiveDate = Arr::get($data, NBPCurrencyRatesInterface::EFFECTIVE_DATE);
        $codeCurrency = Arr::get($data, NBPCurrencyRatesInterface::CODE);
        $currency = Arr::get($data, NBPCurrencyRatesInterface::CURRENCY);
        $parsedData = [];
        foreach (Arr::get($data, NBPCurrencyRatesInterface::RATES, []) as $rateData) {
            $parsedData[] = [
                NBPCurrencyRatesInterface::CURRENCY =>
                    $currency ?? Arr::get($rateData, NBPCurrencyRatesInterface::CURRENCY),
                NBPCurrencyRatesInterface::CODE =>
                    $codeCurrency ?? Arr::get($rateData, NBPCurrencyRatesInterface::CODE),
                NBPCurrencyRatesInterface::MID => Arr::get($rateData, NBPCurrencyRatesInterface::MID),
                NBPCurrencyRatesInterface::EFFECTIVE_DATE =>
                    $effectiveDate ?? Arr::get($rateData, NBPCurrencyRatesInterface::EFFECTIVE_DATE),
            ];
        }

        return $parsedData;
    }

    /**
     * @return array
     * @throws GuzzleException
     */
    public function getActualRates(): array
    {
        return $this->parseData('tables/A/?format=json');
    }

    /**
     * @param string $currency
     * @param string|null $fromDate
     * @param string|null $toDate
     * @return array
     * @throws GuzzleException
     */
    public function getSpecifyRates(string $currency, ?string $fromDate, ?string $toDate): array
    {
        $query = 'rates/A/' . $currency;
        if ($fromDate !== null) {
            $query .= '/' . Carbon::parse($fromDate)->format('Y-m-d');
        }

        if ($toDate !== null) {
            $query .= '/' . Carbon::parse($toDate)->format('Y-m-d');
        }

        return $this->parseData($query . '?format=json');
    }

}
