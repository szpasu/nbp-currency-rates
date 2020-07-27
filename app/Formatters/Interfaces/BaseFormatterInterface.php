<?php namespace App\Formatters\Interfaces;

use App\Models\Interfaces\BaseModelInterface;
use Illuminate\Support\Collection;

/**
 * File: BaseFormatterInterface.php
 * Description:
 *
 * Author: Patryk Pasternak
 * Date: 27/07/2020
 */
interface BaseFormatterInterface
{

    /**
     * Set model to format.
     *
     * @param BaseModelInterface $entity
     * @return BaseFormatterInterface
     */
    public function setModel(BaseModelInterface $entity): self;

    /**
     * Get fields of model.
     *
     * @return array
     */
    public function getFields(): array;

    /**
     * Return formatted entity as array.
     *
     * @return array
     */
    public function toArray(): array;

    /**
     * Return entity fields as collection.
     *
     * @return Collection
     */
    public function toCollection(): Collection;

}
