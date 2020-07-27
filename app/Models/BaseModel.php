<?php namespace App\Models;

use App\Models\Interfaces\BaseModelInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * File: BaseModel.php
 * Description:
 *
 * Author: Patryk Pasternak
 */
class BaseModel extends Model implements BaseModelInterface
{

    /**
     * The attributes that should be cast to native types.
     * This is the sample of this array. This should be copied
     * to new model class, and extended with model attributes.
     *
     * @var array
     */
    protected $casts = [
        BaseModelInterface::ID => 'integer',
        self::CREATED_AT => 'timestamp',
        self::UPDATED_AT => 'timestamp',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * Get ID of the entity.
     *
     * @return integer|null
     */
    public function getID(): ?int
    {
        return $this->getAttribute(BaseModelInterface::ID);
    }

    /**
     * Set ID of the entity.
     *
     * @param integer $id
     * @return BaseModelInterface
     */
    public function setID(int $id): BaseModelInterface
    {
        return $this->setAttribute(BaseModelInterface::ID, $id);
    }

    /**
     * Get model created at date.
     *
     * @return Carbon|null
     */
    public function getCreatedAtDate(): ?Carbon
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->getAttribute(self::CREATED_AT));
    }

    /**
     * Set model created at date.
     *
     * @param string $date
     * @return BaseModelInterface
     */
    public function setCreatedAtDate(string $date): BaseModelInterface
    {
        return $this->setAttribute(self::CREATED_AT, $date);
    }

    /**
     * Get model updated at date.
     *
     * @return Carbon|null
     */
    public function getUpdatedAtDate(): ?Carbon
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->getAttribute(self::UPDATED_AT));
    }

    /**
     * Set model updated at date.
     *
     * @param string $date
     * @return BaseModelInterface
     */
    public function setUpdatedAtDate(string $date): BaseModelInterface
    {
        return $this->setAttribute(self::UPDATED_AT, $date);
    }

}
