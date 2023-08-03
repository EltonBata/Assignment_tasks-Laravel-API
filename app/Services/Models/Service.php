<?php

namespace App\Services\Models;


abstract class Service
{
    protected $repository;

    public function __construct()
    {
        $this->repository = app($this->repository);
    }

    public function all(int $page_size)
    {
        return $this->repository->all($page_size);
    }

    public function create(array $data)
    {
        $create = $this->repository->create($data);

        if (!$create) {
            throw new \ErrorException("Erro ao cadastrar");
        }

        return $create;
    }

    public function delete($model)
    {

        $delete = $this->repository->delete($model);

        if (!$delete) {
            throw new \ErrorException("Erro ao apagar");
        }

        return $delete;
    }

    public function update(array $data, $model)
    {

        $update = $this->repository->update($data, $model);

        if (!$update) {
            throw new \ErrorException("Erro ao actualizar");
        }

        return $update;
    }
}