<?php namespace App\Services\Interfaces;

use App\Formatters\Interfaces\BaseFormatterInterface;
use App\Models\Interfaces\BaseModelInterface;
use Illuminate\Database\Eloquent\Builder;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * File: BaseServiceInterface.php
 * Description:
 *
 * Author: Patryk Pasternak
 */
interface BaseServiceInterface
{

    /**
     * @param BaseModelInterface $model
     * @return BaseServiceInterface
     */
    public function setModel(BaseModelInterface $model): BaseServiceInterface;

    /**
     * @return BaseModelInterface|Builder
     */
    public function getModel();

    /**
     * @param RepositoryInterface $repository
     * @return BaseServiceInterface
     */
    public function setRepository(RepositoryInterface $repository): BaseServiceInterface;

    /**
     * @return RepositoryInterface
     */
    public function getRepository(): RepositoryInterface;

    /**
     * @param BaseFormatterInterface $formatter
     * @return BaseServiceInterface
     */
    public function setFormatter(BaseFormatterInterface $formatter): BaseServiceInterface;

    /**
     * @return BaseFormatterInterface
     */
    public function getFormatter(): BaseFormatterInterface;

    /**
     * @return BaseFormatterInterface
     */
    public function formatData(): BaseFormatterInterface;

    /**
     * @param array $params
     * @return BaseModelInterface
     */
    public function createEntity(array $params = []): BaseModelInterface;

}
