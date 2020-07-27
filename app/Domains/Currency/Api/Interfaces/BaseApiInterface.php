<?php namespace App\Domains\Currency\Api\Interfaces;

/**
 * File: BaseApiInterface.php
 * Description:
 *
 * Author: Patryk Pasternak
 */
interface BaseApiInterface
{

    /**
     * @param string $query
     * @return array
     */
    public function parseData(string $query): array;

}
