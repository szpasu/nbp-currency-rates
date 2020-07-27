<?php namespace App\Domains\Currency\Controllers;

use App\Domains\Currency\Services\Interfaces\CurrencyServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * File: IndexController.php
 * Description:
 *
 * Author: Patryk Pasternak
 */
class IndexController extends Controller
{

    /**
     * @var CurrencyServiceInterface
     */
    private $currencyRates;

    /**
     * IndexController constructor
     * @param CurrencyServiceInterface $currencyRates
     */
    public function __construct(CurrencyServiceInterface $currencyRates)
    {
        $this->currencyRates = $currencyRates;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getActualRates(Request $request)
    {
        return $this->currencyRates->getActualRates();
    }

    /**
     * @param string $currency
     * @param string|null $fromDate
     * @param string|null $toDate
     * @param string|null $sort
     * @return array
     */
    public function getSpecifyRates(string $currency, ?string $fromDate = null, ?string $toDate = null, ?string $sort = null)
    {
        return $this->currencyRates->getSpecifyRates($currency, $fromDate, $toDate, $sort);
    }

}
