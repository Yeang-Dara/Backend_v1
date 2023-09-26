<?php

namespace App\Services;

use App\Models\Mainpart;
use App\Services\BaseService;

class MainPartService extends BaseService
{
    public function __construct( Mainpart $mainpart)
    {
        $this->model= $mainpart;
    }
}