<?php

namespace App\Services;

use App\Models\Stock;
use App\Services\BaseService;

class StockService extends BaseService
{
    public function __construct(Stock $stock)
    {
        $this->model = $stock;
    }
}