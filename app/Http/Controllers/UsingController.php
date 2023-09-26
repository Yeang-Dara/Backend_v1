<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UsingService;
use Illuminate\Http\JsonResponse;
use App\Models\Using;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MachinesExport;

class UsingController extends ParentController
{
  public function __construct(
    Using $using,
    UsingService $usingService,
  ) {
    $this->model = $using;
    $this->service = $usingService;
  }
  public function getAll()
  {
    $data = DB::table('usings')
      ->orderBy('id')->get();
    return $data;
  }
  public function getID($id): JsonResponse
  {
    return parent::getById($id);
  }
  public function create(Request $request): JsonResponse
  {
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
  public function getTotal()
  {
    $order = DB::table('orders')->where('status', '=', 'Ordering')
      ->sum('amount');
    $total = DB::table('usings')->count();
    $active = DB::table('usings')->where('status', '=', 'active')->count();
    $status = DB::table('usings')->where('status', '=', 'non-active')->count();
    $atm = DB::table('usings')->where('type_name', '=', 'ATM')->count();
    $crm = DB::table('usings')->where('type_name', '=', 'CRM')->count();
    $dc365 = DB::table('usings')->where('type_name', '=', 'DC365')->count();
    $bti = DB::table('usings')->where('bank_name', '=', 'BTI')->count();
    $aba = DB::table('usings')->where('bank_name', '=', 'ABA Bank')->count();
    $amk = DB::table('usings')->where('bank_name', '=', 'AMK MFI')->count();
    $wing = DB::table('usings')->where('bank_name', '=', 'Wing')->count();
    return ([
      "order" => $order,
      "totals" => $total,
      "active" => $active,
      "nonactive" => $status,
      "atm" => $atm,
      "crm" => $crm,
      "dc365" => $dc365,
      "bti" => $bti,
      "aba" => $aba,
      "amk" => $amk,
      "wing" => $wing,
    ]);
  }
  public function getmuliusing(Request $request)
  {
    if ($request->model_name && $request->type_name && $request->bank_name) {
      $data = DB::table('usings')->where('model_name', '=', $request->model_name)
        ->where('bank_name', 'LIKE', '%' . $request->bank_name . '%')
        ->where('type_name', '=', $request->type_name)
        ->orderBy('id')->get();
    } else if ($request->model_name && $request->bank_name) {
      $data = DB::table('usings')->where('model_name', '=', $request->model_name)
        ->where('bank_name', 'LIKE', '%' . $request->bank_name . '%')
        ->orderBy('id')->get();
    } else if ($request->type_name && $request->bank_name) {
      $data = DB::table('usings')->where('type_name', '=', $request->type_name)
        ->where('bank_name', 'LIKE', '%' . $request->bank_name . '%')
        ->orderBy('id')->get();
    } else if ($request->type_name && $request->model_name) {
      $data = DB::table('usings')->where('type_name', '=', $request->type_name)
        ->where('model_name', '=', $request->model_name)->orderBy('id')->get();
    } else if ($request->type_name) {
      $data = DB::table('usings')->where('type_name', '=', $request->type_name)->orderBy('id')->get();
    } else if ($request->bank_name) {
      $data = DB::table('usings')->where('bank_name', 'LIKE', '%' . $request->bank_name . '%')->orderBy('id')->get();
    } else if ($request->model_name) {
      $data = DB::table('usings')->where('model_name', '=', $request->model_name)->orderBy('id')->get();
    } else {
      $data = DB::table('usings')->orderBy('id')->get();
    }
    return $data;
  }
  public function dataTable(Request $request, $query = null): JsonResponse
  {
    $query = DB::table('usings')
      ->orderBy('id');
    return parent::dataTable($request, $query);
  }
  public function Type()
  {
    $crm = DB::table('usings')->where('type_name', '=', 'CRM')->count();
    $cdm = DB::table('usings')->where('type_name', '=', 'CDM')->count();
    $atm = DB::table('usings')->where('type_name', '=', 'ATM')->count();
    $dc = DB::table('usings')->where('type_name', '=', 'DC365')->count();
    $labels = ['CRM', 'CDM', 'ATM', 'DC365'];
    $data = [$crm, $cdm, $atm, $dc];
    return response()->json([
      'labels' => $labels,
      'data' => $data
    ]);
  }
  public function countdata()
  {
    $crm = DB::table('usings')->where('bank_name', 'LIKE', '%' . 'ABA' . '%')
      ->where('type_name', '=', 'CDM')
      ->where('type_name', '=', 'ATM')
      ->count();
  }
  public function getWarranty($id)
  {
    $warranty = Using::find($id)->warranty_days;
    $date = Using::find($id)->delivery_date;
    $currentDay = Carbon::now()->format('Y-m-d');
    $startDate = Carbon::parse($date);
    $endDate = Carbon::parse($currentDay);
    $daysCount = $endDate->diffInDays($startDate);
    if ($daysCount >= $warranty) {
      $mass = "This machine is out of warranty";
    } else {
      $mass = "This machine is on of warranty";
    }
    return ([
      'delivery date' => $date,
      'warranty days' => $warranty,
      'current day' => $currentDay,
      'total days' => $daysCount,
      "status" => $mass
    ]);
  }

  public function getReport()
  {
    $status = DB::table('usings')->where('status', '=', 'non-active')->get();
    return $status;
  }
  public function export()
  {
    $columns = ['atm_id',
    'alias_id',
    'install_date',
    'apk_version',
    'image_version',
    'mainboard_version',
    'android_version',
    'delivery_date',
    'take_over_date',
    'category_name',
    'serial_number',
    'model_name',
    'warranty_days',
    'comment',
    'type_name',
    'status',
    'bank_name',
    'site_id',
    'region_name',
    'site_name',
    'location',
    'city',
    'state_name',
    'accessibility',
    'address'];
    $results = DB::table('usings')->select($columns)->get();
  return $results;

  }
  function importData(Request $request)
  {
    $this->validate($request, [
      'select_file'  => 'required|mimes:xls,xlsx'
    ]);

    $path = $request->file('select_file')->getRealPath();

    $data = Excel::load($path)->get();

    if ($data->count() > 0) {
      foreach ($data->toArray() as $key => $value) {
        foreach ($value as $row) {

          $insert_data[] = array(
            'user_id'  => $row['user_id']=1,
            'atm_id' => $row['atm_id'],
            'alias_id' => $row['alias_id'],
            'site_id' => $row['site_id'],
            'site_name' => $row['site_name'],
            'address'=>$row['address'],
            'city' => $row['city'],
            'state_name' =>$row['state_name'],
            'region_name' => $row['region_name'],
            'location' => $row['location'],
            'accessibility'=>$row['accessibility'],
            'install_date'=>$row['install_date'],
            'delivery_date' => $row['delivery_date'],
            'take_over_date' => $row['take_over_date'],
            'category_name' => $row['category_name'],
            'model_name' => $row['model_name'],
            'serial_number'=>$row['serial_number'],
            'type_name' => $row['type_name'],
            'warranty_days' => $row['warranty_days'],
            'bank_name' => $row['bank_name'],
            'status'=>$row['status'],
          );
        }
      }

      if (!empty($insert_data)) {
        DB::table('usings')->insert($insert_data);
      }
    }
    return back()->with('success', 'Excel Data Imported successfully.');
  }
}
