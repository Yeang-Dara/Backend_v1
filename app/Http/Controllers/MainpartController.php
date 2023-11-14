<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MainPartService;
use Illuminate\Http\JsonResponse;
use App\Models\Mainpart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Sparepart;


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
        $data = DB::table('mainparts')
                    ->join('spareparts', 'spareparts.id', '=','mainparts.sparepart_id')
                    ->select('spareparts.spareparts_name', 'mainparts.*')
                    ->where('machine_id','=', $id)
                    ->orderBy('id')
                    ->get();
        return $data;
    }
    public function Store(Request $request){

        $valitateData = $request->validate([
            'sparepart_id' =>'required',
            'machine_id' => 'required',
            'replacer_name' => 'required',
            'replace_date' => 'required',
            'quantity' => 'required',
          
        ]);
        $data1 = Sparepart::find($request['sparepart_id']);

        if($request['quantity'] > $data1['quantity_remain'])
        {
            $response=[
                'success' => false,
                'status' =>300,
                'message' =>"Spare part not enough"
        ];
            return response()->json($response, 300);
        }
        $create = Mainpart::create($valitateData);
        $request['quantity_remain'] = $data1['quantity_remain']-$request['quantity'];
        $request['quantity_used'] = $data1['quantity_used'] + $request['quantity'];

        $id = $data1['id'];
        Sparepart::where('id',$id)->update(['quantity_remain' => $request['quantity_remain'],'quantity_used' => $request['quantity_used']]);
        $response =[
        'success' => true,
        'data' => $create,
        'message' =>"Create Successfully"];
        return response()->json($response, 202);
    }
    public function updatData(Request $request, $id)
    {
        $valitateData = $request->validate([
            'sparepart_id' =>'required',
        ]);
        $data = Mainpart::find($id);
       
        if($data['sparepart_id'] != $request['sparepart_id'])
        {
            $data1 = Sparepart::find($data['sparepart_id']);
            $remain = $data1['quantity_remain']+ $data['quantity'];
            Sparepart::where('id', $data1['id'])->update(['quantity_remain' =>$remain,'quantity_used' =>$data1['quantity']-$remain]);

            $data1 = Sparepart::find($request['sparepart_id']);
            $update= parent::update($request, $id);
            $used = Mainpart::where('sparepart_id', $request['sparepart_id'])->sum('quantity');
            $request['quantity_remain'] = $data1['quantity']- $used;
            $request['quantity_used'] = $used;
            Sparepart::where('id', $data1['id'])->update(['quantity_remain' => $request['quantity_remain'],'quantity_used' => $used]);

            $response =[
                'success' => true,
                'data1' => $used,
                'message' =>"Updated Successfully"];
                return response()->json($response, 202);
        }
        $data1 = Sparepart::find($request['sparepart_id']);
        $update= parent::update($request, $id);
            $used = Mainpart::where('sparepart_id', $request['sparepart_id'])->sum('quantity');
            $request['quantity_remain'] = $data1['quantity']- $used;
            $request['quantity_used'] = $used;
            Sparepart::where('id', $data1['id'])->update(['quantity_remain' => $request['quantity_remain'],'quantity_used' => $used]);
            $response =[
                'success' => true,
                'data' => $update,
                'used'=>$used,
                'message' =>"Updated Successfully"];
                return response()->json($response, 202);
    }
    public function deleteMainpart($id)
    {
        $data = Mainpart::find($id);
        $data1 = Sparepart::find($data['sparepart_id']);
        $remain = $data1['quantity_remain']+ $data['quantity'];
        Sparepart::where('id', $data1['id'])->update(['quantity_remain' =>$remain,'quantity_used' =>$data1['quantity']-$remain]);
        $data2 = Sparepart::find($data['sparepart_id']);
        Mainpart::where('id', $id)->delete();
        return ([
            "data" => $data,
            "Data1" => $data2,
        ]);
    }
}
