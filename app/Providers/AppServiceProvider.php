<?php

namespace App\Providers;

use App\Domains\Currency\Api\BaseApi;
use App\Domains\Currency\Api\Interfaces\BaseApiInterface;
use App\Domains\Currency\Api\NBP\Interfaces\NBPCurrencyRatesInterface;
use App\Domains\Currency\Api\NBP\NBPCurrencyRates;
use App\Domains\Currency\Formatters\CurrencyFormatter;
use App\Domains\Currency\Formatters\Interfaces\CurrencyFormatterInterface;
use App\Domains\Currency\Models\Interfaces\RateInterface;
use App\Domains\Currency\Models\Rate;
use App\Domains\Currency\Repositories\RateRepository;
use App\Domains\Currency\Services\CurrencyService;
use App\Domains\Currency\Services\Interfaces\CurrencyServiceInterface;
use App\Domains\Currency\Repositories\Interfaces\RateRepositoryInterface;
use App\Formatters\BaseFormatter;
use App\Formatters\Interfaces\BaseFormatterInterface;
use App\Models\BaseModel;
use App\Models\Interfaces\BaseModelInterface;
use App\Services\BaseService;
use App\Services\Interfaces\BaseServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BaseModelInterface::class, BaseModel::class);
        $this->app->bind(BaseServiceInterface::class, BaseService::class);
        $this->app->bind(BaseFormatterInterface::class, BaseFormatter::class);

        $this->app->bind(RateInterface::class, Rate::class);
        $this->app->bind(CurrencyServiceInterface::class, CurrencyService::class);
        $this->app->bind(CurrencyFormatterInterface::class, CurrencyFormatter::class);
        $this->app->bind(RateRepositoryInterface::class, RateRepository::class);
        $this->app->bind(BaseApiInterface::class, BaseApi::class);
        $this->app->bind(NBPCurrencyRatesInterface::class, NBPCurrencyRates::class);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
