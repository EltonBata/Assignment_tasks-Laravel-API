<?php

namespace App\Repositories;

abstract class Repository
{

    protected $model;

    public function __construct()
    {
        $this->model = app($this->model);
    }

    public function all(int $page_size)
    {
        return $this->model::paginate($page_size);
    }

  

}