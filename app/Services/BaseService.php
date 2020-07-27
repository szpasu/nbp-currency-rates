<?php namespace App\Services;

use App\Formatters\Interfaces\BaseFormatterInterface;
use App\Models\BaseModel;
use App\Models\Interfaces\BaseModelInterface;
use App\Services\Interfaces\BaseServiceInterface;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Builder;
use Modules\Core\Entities\CoreEntity;
use Modules\Core\Entities\Interfaces\CoreEntityInterface;
use Modules\Core\Exceptions\Repositories\RepositoryEntityException;
use Modules\Core\Repositories\Interfaces\CoreRepositoryInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * File: BaseService.php
 * Description:
 *
 * Author: Patryk Pasternak
 */
class BaseService implements BaseServiceInterface
{

    /**
     * @var BaseModelInterface
     */
    protected $model;

    /**
     * @var RepositoryInterface
     */
    protected $repository;

    /**
     * @var BaseFormatterInterface
     */
    protected $formatter;

    /**
     * @param BaseModelInterface $model
     * @return $this|BaseServiceInterface
     */
    public function setModel(BaseModelInterface $model): BaseServiceInterface
    {
        $this->model = $model;
        return $this;
    }

    /**
     * @return BaseModelInterface|Builder
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param RepositoryInterface $repository
     * @return BaseServiceInterface
     */
    public function setRepository(RepositoryInterface $repository): BaseServiceInterface
    {
        $this->repository = $repository;
        return $this;
    }

    /**
     * @return RepositoryInterface
     */
    public function getRepository(): RepositoryInterface
    {
        return $this->repository;
    }

    /**
     * @param BaseFormatterInterface $formatter
     * @return $this|BaseServiceInterface
     */
    public function setFormatter(BaseFormatterInterface $formatter): BaseServiceInterface
    {
        $this->formatter = $formatter;
        return $this;
    }

    /**
     * @return BaseFormatterInterface
     */
    public function getFormatter(): BaseFormatterInterface
    {
        return $this->formatter;
    }

    /**
     * @return BaseFormatterInterface
     */
    public function formatData(): BaseFormatterInterface
    {
        return $this->getFormatter()->setModel($this->getModel());
    }

    /**
     * @param array $params
     * @return BaseModelInterface
     */
    public function createEntity(array $params = []): BaseModelInterface
    {
        $newModel = $this->getRepository()->create($params);
        return $this->setModel($newModel)->getModel();
    }

}
