<?php namespace App\Domains\Currency\Formatters;

use App\Domains\Currency\Formatters\Interfaces\CurrencyFormatterInterface;
use App\Domains\Currency\Models\Interfaces\RateInterface;
use App\Formatters\BaseFormatter;

/**
 * File: CurrencyFormatter.php
 * Description:
 *
 * Author: Patryk Pasternak
 */
class CurrencyFormatter extends BaseFormatter implements CurrencyFormatterInterface
{

    /**
     * @var RateInterface;
     */
    protected $entity;

    /**
     * @return array
     */
    public function getFields(): array
    {
        return [
            RateInterface::CURRENCY => $this->entity->getCurrency(),
            RateInterface::CODE_CURRENCY => $this->entity->getCodeCurrency(),
            RateInterface::MID_VALUE => number_format($this->entity->getMidValue(), 4, '.', ','),
            RateInterface::EFFECTIVE_DATE => $this->entity->getEffectiveDate()->format('Y-m-d'),
        ];
    }

}
