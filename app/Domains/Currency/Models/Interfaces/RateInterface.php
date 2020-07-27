<?php namespace App\Domains\Currency\Models\Interfaces;

use App\Models\Interfaces\BaseModelInterface;
use Illuminate\Support\Carbon;

/**
 * File: RateInterface.php
 * Description:
 *
 * Author: Patryk Pasternak
 */
interface RateInterface extends BaseModelInterface
{

    CONST TABLE_NAME = 'currency_rates';

    const CURRENCY = 'currency';
    const CODE_CURRENCY = 'code_currency';
    const MID_VALUE = 'mid_value';
    const EFFECTIVE_DATE = 'effective_date';

    /**
     * @return string
     */
    public function getCurrency(): string;

    /**
     * @param string $currency
     * @return RateInterface
     */
    public function setCurrency(string $currency): RateInterface;

    /**
     * @return string
     */
    public function getCodeCurrency(): string;

    /**
     * @param string $codeCurrency
     * @return RateInterface
     */
    public function setCodeCurrency(string $codeCurrency): RateInterface;

    /**
     * @return float
     */
    public function getMidValue(): float;

    /**
     * @param float $midValue
     * @return RateInterface
     */
    public function setMidValue(float $midValue): RateInterface;

    /**
     * @return Carbon
     */
    public function getEffectiveDate(): Carbon;

    /**
     * @param string $effectiveDate
     * @return RateInterface
     */
    public function setEffectiveDate(string $effectiveDate): RateInterface;

}
