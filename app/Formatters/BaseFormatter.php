<?php namespace App\Formatters;

use App\Formatters\Interfaces\BaseFormatterInterface;
use App\Models\Interfaces\BaseModelInterface;
use Illuminate\Support\Collection;

/**
 * File: BaseFormatter.php
 * Description:
 *
 * Author: Patryk Pasternak
 */
abstract class BaseFormatter implements BaseFormatterInterface
{

    /**
     * @var BaseModelInterface
     */
    protected $entity;

    public function setModel(BaseModelInterface $entity): BaseFormatterInterface
    {
        $this->entity = $entity;
        return $this;
    }


    public function toArray(): array
    {
        return $this->getFields();
    }

    public function toCollection(): Collection
    {
        return collect($this->getFields());
    }
}
