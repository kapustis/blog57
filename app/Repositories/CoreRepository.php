<?php

namespace App\Repositories;
/**
 * Class CoreRepository
 * @package App\Repositories
 *
 * репозиторий работы с сущностью
 * может выдавать наборы данных.
 * не может создавать\изменять сущности
 * */

use Illuminate\Database\Eloquent\Model;

abstract class CoreRepository
{
    /**
     * @var Model
     * */
    protected $model;

    /**
     * CoreRepository constructor
     * */
    public function __construct()
    {
        $this->model = app($this->getModelClass());
    }

    /**
     * @return mixed
     **/
    abstract protected function getModelClass();

    /**
     * @return Model| mixed
     **/
    protected function startConditions()
    {
        return clone $this->model;
    }
}
