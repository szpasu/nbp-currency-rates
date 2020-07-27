<?php namespace App\Domains\Currency\Api\NBP\Interfaces;

use App\Domains\Currency\Api\Interfaces\BaseApiInterface;

/**
 * File: NBPCurrencyRatesInterface.php
 * Description:
 *
 * Author: Patryk Pasternak
 */
interface NBPCurrencyRatesInterface extends BaseApiInterface
{

    const EFFECTIVE_DATE = 'effectiveDate';
    const CURRENCY = 'currency';
    const CODE = 'code';
    const MID = 'mid';
    const RATES = 'rates';

    /**
     * @return array
     */
    public function getActualRates(): array;

    /**
     * @param string $currency
     * @param string|null $fromDate
     * @param string|null $toDate
     * @return array
     */
    public function getSpecifyRates(string $currency, ?string $fromDate, ?string $toDate): array;

}
