<?php namespace App\Domains\Currency\Services;

use App\Domains\Currency\Api\NBP\Interfaces\NBPCurrencyRatesInterface;
use App\Domains\Currency\Formatters\Interfaces\CurrencyFormatterInterface;
use App\Domains\Currency\Models\Interfaces\RateInterface;
use App\Domains\Currency\Services\Interfaces\CurrencyServiceInterface;
use App\Domains\Currency\Repositories\Interfaces\RateRepositoryInterface;
use App\Services\BaseService;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * File: CurrencyService.php
 * Description:
 *
 * Author: Patryk Pasternak
 */
class CurrencyService extends BaseService implements CurrencyServiceInterface
{

    /**
     * @var NBPCurrencyRatesInterface
     */
    private $currencyRatesAPI;

    /**
     * CurrencyService constructor
     *
     * @param CurrencyFormatterInterface $formatter
     * @param RateRepositoryInterface $rateRepository
     * @param NBPCurrencyRatesInterface $currencyRatesAPI
     */
    public function __construct(
        CurrencyFormatterInterface $formatter,
        RateRepositoryInterface $rateRepository,
        NBPCurrencyRatesInterface $currencyRatesAPI
    ) {
        $this->currencyRatesAPI = $currencyRatesAPI;
        $this->setRepository($rateRepository)->setFormatter($formatter);
    }

    /**
     * @return array
     */
    public function getActualRates(): array
    {
        $cachedRates = $this->getCachedRates(Carbon::now()->format('Y-m-d'));
        if ($cachedRates !== []) {
            return $cachedRates;
        }

        $data = $this->currencyRatesAPI->getActualRates();
        $lastData = Arr::first($data);

        $cachedRates = $this->getCachedRates(Arr::get($lastData, NBPCurrencyRatesInterface::EFFECTIVE_DATE));
        if ($cachedRates !== []) {
            return $cachedRates;
        }

        return $this->cacheDataAndFormat($data);
    }

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
    ): array
    {
        $cachedRates = $this->getCachedRates($fromDate, $toDate, $currency, $sort);
        if ($cachedRates !== []) {
            return $cachedRates;
        }

        $data = $this->currencyRatesAPI->getSpecifyRates($currency, $fromDate, $toDate);

        if ($sort !== null) {
            return $this->sortData(collect($this->cacheDataAndFormat($data)), $sort)->toArray();
        }
        return $this->cacheDataAndFormat($data);
    }

    /**
     * @param array $rates
     * @return array
     */
    private function cacheDataAndFormat(array $rates): array
    {
        $formattedData = [];
        foreach ($rates as $rate) {
            /* @var RateInterface $record */
            $record = $this->repository->firstOrNew(
                [
                    RateInterface::CODE_CURRENCY => Arr::get($rate, NBPCurrencyRatesInterface::CODE),
                    RateInterface::EFFECTIVE_DATE => Arr::get($rate, NBPCurrencyRatesInterface::EFFECTIVE_DATE),
                ]
            );
            if ($record->getID() !== null) {
                continue;
            }

            $rateModel = $this->createEntity(
                [
                    RateInterface::CURRENCY => Arr::get($rate, NBPCurrencyRatesInterface::CURRENCY),
                    RateInterface::CODE_CURRENCY => Arr::get($rate, NBPCurrencyRatesInterface::CODE),
                    RateInterface::MID_VALUE => Arr::get($rate, NBPCurrencyRatesInterface::MID),
                    RateInterface::EFFECTIVE_DATE => Arr::get($rate, NBPCurrencyRatesInterface::EFFECTIVE_DATE),
                ]
            );

            $formattedData[] = $this->setModel($rateModel)->formatData()->toArray();
        }

        return $formattedData;
    }

    /**
     * @param string $fromDate
     * @param string|null $toDate
     * @param string|null $currency
     * @param string|null $sort
     * @return array
     */
    private function getCachedRates(
        ?string $fromDate = null,
        ?string $toDate = null,
        ?string $currency = null,
        ?string $sort = null
    ): array {
        if ($fromDate === null) {
            $fromDate = Carbon::now();
        }

        $where = [RateInterface::EFFECTIVE_DATE => Carbon::parse($fromDate)->format('Y-m-d 00:00:00')];
        if ($toDate !== null) {
            $where = [
                [RateInterface::EFFECTIVE_DATE, '>=', Carbon::parse($fromDate)->format('Y-m-d 00:00:00')],
                [RateInterface::EFFECTIVE_DATE, '<=', Carbon::parse($toDate)->format('Y-m-d 00:00:00')],
            ];
        }

        if ($currency !== null) {
            $where[] = [RateInterface::CODE_CURRENCY, '=', $currency];
        }

        $cachedRates = $this->getRepository()->findWhere($where);
        $formattedRates = [];
        if ($cachedRates->isEmpty()) {
            return [];
        }

        if ($sort !== null) {
            $cachedRates = $this->sortData($cachedRates, $sort);
        }

        foreach ($cachedRates as $rate) {
            $formattedRates[] = $this->setModel($rate)->formatData()->toArray();
        }

        return $formattedRates;
    }

    /**
     * @param Collection $data
     * @param string $sortOrder
     * @return Collection
     */
    private function sortData(Collection $data, string $sortOrder): Collection
    {
        if ($sortOrder === 'asc') {
            return $data->sortBy(RateInterface::EFFECTIVE_DATE);
        }

        return $data->sortByDesc(RateInterface::EFFECTIVE_DATE);
    }

}
