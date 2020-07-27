<?php

use App\Domains\Currency\Models\Interfaces\RateInterface;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeTableCurrencyRates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            RateInterface::TABLE_NAME,
            function (Blueprint $table) {
                $table->id();
                $table->string(RateInterface::CURRENCY);
                $table->string(RateInterface::CODE_CURRENCY);
                $table->float(RateInterface::MID_VALUE);
                $table->timestamp(RateInterface::EFFECTIVE_DATE);
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(RateInterface::TABLE_NAME);
    }

}
