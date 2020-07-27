<?php namespace App\Domains\Currency\Repositories;

use App\Domains\Currency\Models\Interfaces\RateInterface;
use App\Domains\Currency\Models\Rate;
use App\Domains\Currency\Repositories\Interfaces\RateRepositoryInterface;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * File: RateRepository.php
 * Description:
 *
 * Author: Patryk Pasternak
 */
class RateRepository extends BaseRepository implements RateRepositoryInterface
{

    /**
     * @return string
     */
    public function model()
    {
        return Rate::class;
    }

}
