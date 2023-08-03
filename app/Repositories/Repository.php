<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\DB;

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

    public function delete($model)
    {
        return $model->delete();
    }


    public function create(array $data)
    {
        $create = $this->model::create($data);

        return $create;
    }

    public function update(array $data, $model){}
   
}