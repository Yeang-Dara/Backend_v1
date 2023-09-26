<?php
namespace App\Services;
use App\Models\Sparepart;
use App\Services\BaseService;
class SparepartService extends BaseService
{
    public function __construct(Sparepart $sparepart)
    {
        $this->model = $sparepart;
    }
}