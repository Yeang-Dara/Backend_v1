<?php

namespace App\Http\Controllers;

use App\Models\maintenace;
use App\Services\MaintenaceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class MaintenaceController extends ParentController
{
    //
    public function __construct(
        maintenace $maintenace, 
        MaintenaceService $maintenaceService
    ) 
    {
        $this->model = $maintenace;
        $this->service = $maintenaceService;
    }
    public function gettest()
    {
        return ("Maintenace");
    }
    public function create(Request $request):JsonResponse
    {
        return parent::create($request);
    }
    public function update(Request $request, $id):JsonResponse
    {
        return parent::update($request, $id);
    }
    public function delete($id): JsonResponse
    {
      return parent::delete($id);
    }
    public function getData($id)
    {
        $data = DB::table('maintenaces')
                    ->where('atm_id', '=', $id)
                    ->orderBy('id')
                    ->get();
        return $data;
    }
    public function getAll()
    {
        $data = DB::table('maintenaces')
                ->orderBy('id')
                ->get();

        return $data;
    }
}
 
