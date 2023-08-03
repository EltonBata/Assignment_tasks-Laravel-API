<?php

namespace App\Services\Models;

use App\Repositories\RoleRepository;
use App\Contracts\Services\RoleContract;

class RoleService extends Service implements RoleContract
{
    protected $repository = RoleRepository::class;
}