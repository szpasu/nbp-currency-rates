<?php namespace App\Domains\Currency\Models;

use App\Domains\Currency\Models\Interfaces\RateInterface;
use App\Models\BaseModel;
use Illuminate\Support\Carbon;

/**
 * File: Rate.php
 * Description:
 *
 * Author: Patryk Pasternak
 */
class Rate extends BaseModel implements RateInterface
{

    /**
     * @var string
     */
    protected $table = RateInterface::TABLE_NAME;

    /**
     * @var array
     */
    protected $fillable = [
        RateInterface::CURRENCY,
        RateInterface::CODE_CURRENCY,
        RateInterface::MID_VALUE,
        RateInterface::EFFECTIVE_DATE,
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        RateInterface::CURRENCY => 'string',
        RateInterface::CODE_CURRENCY => 'string',
        RateInterface::MID_VALUE => 'float',
        RateInterface::EFFECTIVE_DATE => 'timestamp',
    ];

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->getAttribute(RateInterface::CURRENCY);
    }

    /**
     * @param string $currency
     * @return RateInterface
     */
    public function setCurrency(string $currency): RateInterface
    {
        return $this->setAttribute(RateInterface::CURRENCY, $currency);
    }

    /**
     * @return string
     */
    public function getCodeCurrency(): string
    {
        return $this->getAttribute(RateInterface::CODE_CURRENCY);
    }

    /**
     * @param string $codeCurrency
     * @return RateInterface
     */
    public function setCodeCurrency(string $codeCurrency): RateInterface
    {
        return $this->setAttribute(RateInterface::CODE_CURRENCY, $codeCurrency);
    }

    /**
     * @return float
     */
    public function getMidValue(): float
    {
        return $this->getAttribute(RateInterface::MID_VALUE);
    }

    /**
     * @param float $midValue
     * @return RateInterface
     */
    public function setMidValue(float $midValue): RateInterface
    {
        return $this->setAttribute(RateInterface::MID_VALUE, $midValue);
    }

    /**
     * @return Carbon
     */
    public function getEffectiveDate(): Carbon
    {
        return Carbon::parse($this->getAttribute(RateInterface::EFFECTIVE_DATE));
    }

    /**
     * @param string $effectiveDate
     * @return RateInterface
     */
    public function setEffectiveDate(string $effectiveDate): RateInterface
    {
        return $this->setAttribute(RateInterface::EFFECTIVE_DATE, $effectiveDate);
    }

}
