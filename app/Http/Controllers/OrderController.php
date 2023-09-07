<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Models\Order;

class OrderController extends ParentController
{
    public function __construct(
        Order $order,
        OrderService $orderService,
    ) {
        $this->model = $order;
        $this->service = $orderService;
    }
    public function getall()
    {
        // $data = DB::table('users')
        //     ->join('orders', 'orders.user_id', '=', 'users.id')
        //     ->join('stocks', 'stocks.order_id', '=', 'orders.id')
        //     ->select('users.*', 'orders.*', 'stocks.*')
        //     ->orderBy('orders.id')
        //     ->get();
        // return $data;
        return parent::getWithRelation(['users', 'stocks']);
    }

    public function create(Request $request): JsonResponse
    {
        if( $request['status'] == null){
            $request['status'] = 'Ordering';
        }
        
        return parent::create($request);
    }
    public function update(Request $request, $id): JsonResponse
    {

        return parent::update($request, $id);
    }
    public function delete($id): JsonResponse
    {
        return parent::delete($id);
    }
    public function getOrder()
    {

        $data = Order::all();
        $id = $data['id'];
        return $id;
    }
    public function ownOrder($id)
    {

        $data = DB::table('users')
            ->join('orders', 'orders.user_id', '=', 'users.id')
            ->select('users.username', 'orders.*')
            ->where('users.id', '=', $id)
            ->orderBy('orders.id', 'desc')
            ->get();
        return $data;
    }

    public function total()
    {
        $total = DB::table('orders')->get();
        return $total;
    }
    public function deleteItem($id)
    {
        $deleted = DB::table('orders')
            ->where('id', $id)
            ->where('arrival_date', null)
            ->where('warehouse', null)
            ->delete();

        if ($deleted) {
            return response()->json(['message' => 'Order deleted successfully', "status" => 200]);
        } else {
            return response()->json(['message' => 'error', "status" => 300]);
        }
    }
    // public function editOrder(Request $request, $id): JsonResponse
    // {
    //     $data = DB::table('orders')
    //         ->where('id', $id)->get();
    //     if ($data['arrival_date'] == null && $data['warehouse'] == null) {
    //         return parent::update($request, $id);
    //     }
    //     else{
    //         return response()->json(['message' => 'Cannot update', "status" => 300]);
    //     }

    // }

}
