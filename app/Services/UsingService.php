<?php
namespace App\Services;
use App\Models\Using;
use App\Services\BaseService;

class UsingService extends BaseService
{
    public function __construct(Using $using)
    {
        $this->model = $using;
    }
}