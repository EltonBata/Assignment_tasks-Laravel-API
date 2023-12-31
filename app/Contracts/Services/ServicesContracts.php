<?php

namespace App\Contracts\Services;

interface ServicesContracts
{
    public function create(array $data);

    public function all(int $page_size);

    public function delete($model);

    public function update(array $data, $model);
}