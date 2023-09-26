<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MainPartService;
use Illuminate\Http\JsonResponse;
use App\Models\Mainpart;
use Illuminate\Support\Facades\DB;

class MainpartController extends ParentController
{
    public function __construct(
        Mainpart $mainpart, 
        MainPartService $mainpartService)
    {
        $this->model = $mainpart;
        $this->service = $mainpartService;
    }
    public function getTest(){
        return("Replace main part");
    }
    public function create(Request $request):JsonResponse
    {
        return parent::create($request);
    }
    public function getAll():JsonResponse
    {
        return parent::all();
    }
    public function update(Request $request, $id):JsonResponse
    {
        return parent::update($request, $id);
    }
    public function delete($id): JsonResponse
    {
      return parent::delete($id);
    }
    public function get($id)
    {
        // return parent::getById($id);
        $data = DB::table('mainparts')
                    ->where('machine_id','=', $id)
                    ->orderBy('id')
                    ->get();
        return $data;
    }
}
