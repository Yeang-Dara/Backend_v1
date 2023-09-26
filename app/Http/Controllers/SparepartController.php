<?php

namespace App\Http\Controllers;

use App\Services\SparepartService;
use Illuminate\Http\Request;
use App\Models\Sparepart;
use Illuminate\Http\JsonResponse;

class SparepartController extends ParentController
{
    //
    public function __construct(
        Sparepart $sparepart,
        SparepartService $sparepartService,
    )
    {
        $this->model= $sparepart;
        $this->service = $sparepartService;
    }
   public function test1()
   {
    return ("Testing");
   }

   public function create(Request  $request):JsonResponse 
   {
    return parent::create($request);
   }
   public function update(Request $request, $id):JsonResponse 
   {
    return parent::update($request, $id);
   }
   public function delete($id):JsonResponse 
   {
    return parent::delete($id);
   }
}
