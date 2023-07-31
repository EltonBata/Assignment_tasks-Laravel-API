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
}