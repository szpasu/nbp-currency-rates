<?php namespace App\Domains\Currency\Services\Interfaces;

use App\Services\Interfaces\BaseServiceInterface;

/**
 * File: CurrencyServiceInterface.php
 * Description:
 *
 * Author: Patryk Pasternak
 */
interface CurrencyServiceInterface extends BaseServiceInterface
{

    /**
     * @return array
     */
    public function getActualRates(): array;

    /**
     * @param string $currency
     * @param string|null $fromDate
     * @param string|null $toDate
     * @param string|null $sort
     * @return array
     */
    public function getSpecifyRates(
        string $currency,
        ?string $fromDate = null,
        ?string $toDate = null,
        ?string $sort = null
    ): array;

}
