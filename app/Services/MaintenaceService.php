<?php
 namespace App\Services;

 use App\Models\maintenace;
 use App\Services\BaseService;

 class MaintenaceService extends BaseService
 {
    public function __construct(maintenace $maintenace)
    {
        $this->model = $maintenace;
    }
 }