<?php


namespace App\Repositories;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CoreRepository
 * @package App\Repositories
 *
 * Получение подготовленного набора данных из модели
 */
abstract class CoreRepository
{
    /**
     * @var Model of repository
     */
    private $model;

    /**
     * CoreRepository constructor.
     */
    public function __construct()
    {
        $this->model = app( $this->getModel() );
    }

    /**
     * @return mixed
     */
    abstract protected function getModel();

    /**
     * @return Application|Model|mixed
     */
    protected function model()
    {
        return clone $this->model;
    }

}