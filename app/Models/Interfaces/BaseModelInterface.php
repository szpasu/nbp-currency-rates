<?php namespace App\Models\Interfaces;

use ArrayAccess;
use Illuminate\Contracts\Queue\QueueableEntity;
use Illuminate\Contracts\Routing\UrlRoutable;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Carbon;
use JsonSerializable;

/**
 * File: BaseModelInterface.php
 * Description:
 *
 * Author: Patryk Pasternak
 */
interface BaseModelInterface extends ArrayAccess, Arrayable, Jsonable, JsonSerializable, QueueableEntity, UrlRoutable
{


    const ID = 'id';
    CONST CREATED = 'created_at';
    CONST UPDATED = 'updated_at';

    /**
     * Get ID of the entity.
     *
     * @return integer|null
     */
    public function getID(): ?int;

    /**
     * Set ID of the entity.
     *
     * @param integer $id
     * @return BaseModelInterface
     */
    public function setID(int $id): self;

    /**
     * Get model created at date.
     *
     * @return Carbon|null
     */
    public function getCreatedAtDate(): ?Carbon;

    /**
     * Set model created at date.
     *
     * @param string $date
     * @return BaseModelInterface
     */
    public function setCreatedAtDate(string $date): self;

    /**
     * Get model updated at date.
     *
     * @return Carbon|null
     */
    public function getUpdatedAtDate(): ?Carbon;

    /**
     * Set model updated at date.
     *
     * @param string $date
     * @return BaseModelInterface
     */
    public function setUpdatedAtDate(string $date): self;

}
