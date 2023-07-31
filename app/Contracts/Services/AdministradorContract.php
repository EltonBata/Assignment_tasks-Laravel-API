<?php

namespace App\Contracts\Services;

interface AdministradorContract
{

    public function create(array $data);

    public function all(int $page_size);

}