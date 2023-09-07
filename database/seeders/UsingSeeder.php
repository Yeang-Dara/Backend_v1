<?php 
namespace Database\Seeders;

use App\Models\Using;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsingSeeder extends Seeder
{
  public function run(): void{
      Using::truncate();
      $datas = fopen(base_path('database/datas/v5.csv'), 'r');
      $transRow = true;

      while(($data = fgetcsv($datas,'1000', ',')) !== false){
        if(!$transRow){
          Using::create([
           
            'atm_id' => $data[0],
            'alias_id' => $data[1],
            'site_id' => $data[2],
            'site_name' => $data[3],
            'address'=>$data[4],
            'city' => $data[5],
            'state_name' => $data[6],
            'region_name' => $data[7],
            'location' => $data[8],
            'accessibility'=>$data[9],
            'install_date'=>$data[10],
            'delivery_date' => $data[11],
            'take_over_date' => $data[12],
            'category_name' => $data[13],
            'model_name' => $data[14],
            'serial_number'=>$data[15],
            'type_name' => $data[16],
            'warranty_days' => $data[17],
            'bank_name' => $data[18],
            'user_id' => $data[19],
            'status'=>$data[20],
            
          ]);
        }
        $transRow = false;
      }
      fclose($datas);
  }
    // public function run(){
    //     DB::table('usings')->delete();
    //     $using = [
    //       [   
    //             "created_at"=>"11/13/2021",
    //             "updated_at"=> "11/26/2021",
    //             "user_id"=>1,
    //             "atm_id"=>"AMKATM01",
    //             "alias_id"=>"ASNVSR-A001",
    //             "install_date"=>"2021-06-21",
    //             "delivery_date"=> "2021-07-18",
    //             "take_over_date"=> "2026-08-30",
    //             "category_name"=> "Gold",
    //             "serial_number"=>"J810004200",
    //             "model_name"=>"DN100D",
    //             "warranty_days"=>365,
    //             "comment"=>null,
    //             "type_name"=>"ATM",
    //             "status"=>"active",
    //             "bank_name"=>"AMK MFI",
    //             "site_id"=>"120910",
    //             "region_name"=>"Phnom Penh",
    //             "site_name"=>"Branch Site",
    //             "location"=>"Doun Penh Section",
    //             "city"=>"Doun Penh Section",
    //             "state_name"=>"Phnom Penh",
    //             "accessibility"=>"Accessibility from 06:00 to 18:00",
    //             "address"=>"Building 6, Veng Sreng Street, Trapeang Thleung Village, Sangkat Choam Chao, Khan Por Senchey, Phnom Penh."
    //       ], 
    //       [
    //           // "id"=> 2,
    //           "user_id"=>1,
    //           "atm_id"=>"AMKATM02",
    //           "alias_id"=>"PNPCAP-C002",
    //           "install_date"=> "2021-02-01",
    //           "delivery_date"=> "2021-07-18",
    //           "take_over_date"=> "2026-08-30",
    //           "category_name"=> "Gold",
    //           "serial_number"=> "5310264009",
    //           "model_name"=>"DN200V",
    //           "warranty_days"=>365,
    //           "comment"=> null,
    //           "type_name"=>"CRM",
    //           "status"=>"active",
    //           "bank_name"=>"AMK MFI",
    //           "site_id"=>"121202",
    //           "region_name"=>"Phnom Penh",
    //           "site_name"=>"OnSite",
    //           "created_at"=> "11/13/2021",
    //           "updated_at"=> "11/26/2021",
    //           "location"=>"Doun Penh Section",
    //           "city"=>"Doun Penh Section",
    //           "state_name"=>"Phnom Penh",
    //           "accessibility"=>"Accessibility from 06:00 to 18:00",
    //           "address"=>"Building No. 588, National Road No. 1, Group 3, Doeum Sleng Village, Sangkat Chba Ampov 2, Khan Chbar Ampov, Phnom Penh"
    //       ],
    //       [
    //         // "id"=> 3,
    //         "user_id"=> 1,
    //         "atm_id"=> "AMKATM03",
    //         "alias_id"=> "PNPAEON1-C001",
    //         "install_date"=> "2021-08-29",
    //         "delivery_date"=> "2021-07-18",
    //         "take_over_date"=> "2026-08-30",
    //         "category_name"=> "Gold",
    //         "serial_number"=> "5310259889",
    //         "model_name"=>"DN200V",
    //         "warranty_days"=>365,
    //         "comment"=> null,
    //         "type_name"=>"CRM",
    //         "status"=>"active",
    //         "bank_name"=>"AMK MFI",
    //         "site_id"=>"120101-03",
    //         "region_name"=>"Phnom Penh",
    //         "site_name"=>"Offsite",
    //         "created_at"=> "11/13/2021",
    //         "updated_at"=> "11/26/2021",
    //         "location"=>"Doun Penh Section",
    //         "city"=>"Doun Penh Section",
    //         "state_name"=>"Phnom Penh",
    //         "accessibility"=>"Accessibility from 06:00 to 18:00",
    //         "address"=>"132, Sothearos Street, Sangkat Tonle Bassac, Khan Chamkarmon, Phnom Penh."
    //       ],
    //       [
           
    //         "user_id"=> 1,
    //         "atm_id"=> "AMKATM04",
    //         "alias_id"=> "PNPSTM-C001",
    //         "install_date"=> "2021-06-29",
    //         "delivery_date"=> "2021-07-18",
    //         "take_over_date"=> "2026-08-30",
    //         "category_name"=> "Gold",
    //         "serial_number"=> "5310259740",
    //         "model_name"=>"DN200V",
    //         "warranty_days"=>365,
    //         "comment"=> null,
    //         "type_name"=>"CRM",
    //         "created_at"=> "11/13/2021",
    //         "updated_at"=> "11/26/2021",
    //         "status"=>"active",
    //         "bank_name"=>"AMK MFI",
    //         "site_id"=>"120112",
    //         "region_name"=>"Phnom Penh",
    //         "site_name"=>"Offsite",
    //         "location"=>"Doun Penh Section",
    //         "city"=>"Doun Penh Section",
    //         "state_name"=>"Phnom Penh",
    //         "accessibility"=>"Accessibility from 06:00 to 18:00",
    //         "address"=>"Kampuchea Krom Street, Sangkat Teuk Laak 1, Khan Toul Kork, Phnom Penh, Cambodia."
    //       ],
    //       [
    //         // "id"=> 5,
    //         "user_id"=> 1,
    //         "atm_id"=> "AMKATM05",
    //         "created_at"=> "11/13/2021",
    //         "updated_at"=> "11/26/2021",
    //         "alias_id"=> "BMCPOP-A001",
    //         "install_date"=> "2021-02-01",
    //         "delivery_date"=> "2021-07-18",
    //         "take_over_date"=> "2026-08-30",
    //         "category_name"=> "Gold",
    //         "serial_number"=> "J810004231",
    //         "model_name"=>"DN100D",
    //         "warranty_days"=>365,
    //         "comment"=> null,
    //         "type_name"=>"CRM",
    //         "status"=>"active",
    //         "bank_name"=>"AMK MFI",
    //         "site_id"=>"10901",
    //         "region_name"=>"Phnom Penh",
    //         "site_name"=>"OnSite",
    //         "location"=>"Poipet Municipality",
    //         "city"=>"Poipet Municipality",
    //         "state_name"=>"Phnom Penh",
    //         "accessibility"=>"Accessibility from 06:00 to 18:00",
    //         "address"=>"National Road No 5, Paliley Village, Sangkat Poipet, Poipet City, Banteay Meanchey Province."
    //       ],
    //       [
    //         // "id"=> 6,
    //         "user_id"=> 1,
    //         "atm_id"=> "AMKATM06",
    //         "alias_id"=> "BTBPSN-A001",
    //         "install_date"=> "2021-07-14",
    //         "delivery_date"=> "2021-07-18",
    //         "take_over_date"=> "2026-08-30",
    //         "category_name"=> "Gold",
    //         "serial_number"=> "5310264011",
    //         "model_name"=>"DN200V",
    //         "warranty_days"=>365,
    //         "comment"=> null,
    //         "type_name"=>"CRM",
    //         "status"=>"active",
    //         "bank_name"=>"AMK MFI",
    //         "created_at"=> "11/13/2021",
    //         "updated_at"=> "11/26/2021",
    //         "site_id"=>"121202",
    //         "region_name"=>"Phnom Penh",
    //         "site_name"=>"OnSite",
    //         "location"=>"Battambang Municipality",
    //         "city"=>"Battambang Municipality",
    //         "state_name"=>"Battambang",
    //         "accessibility"=>"Accessibility from 06:00 to 18:00",
    //         "address"=>"Prek Mohatep Village, Sangkat Svay Por, Battambang Province."
    //       ],
    //       [
    //         // "id"=> 7,
    //         "user_id"=> 1,
    //         "atm_id"=> "AMKATM07",
    //         "alias_id"=> "PNPPNP-A002",
    //         "install_date"=> "2022-01-17",
    //         "delivery_date"=> "2021-07-18",
    //         "created_at"=> "11/13/2021",
    //         "updated_at"=> "11/26/2021",
    //         "take_over_date"=> "2026-08-30",
    //         "category_name"=>"Gold",
    //         "serial_number"=> "J810004225",
    //         "model_name"=>"DN100D",
    //         "warranty_days"=>365,
    //         "comment"=> null,
    //         "type_name"=>"CRM",
    //         "status"=>"active",
    //         "bank_name"=>"AMK MFI",
    //         "site_id"=>"120104-02",
    //         "region_name"=>"Phnom Penh",
    //         "site_name"=>"OnSite",
    //         "location"=>"Doun Penh Section",
    //         "city"=>"Doun Penh Section",
    //         "state_name"=>"Phnom Penh",
    //         "accessibility"=>"Accessibility from 06:00 to 18:00",
    //         "address"=>" 285, Street 271, Village 1, Sangkat Boeung Keng Kang, Khan Chamkarmon, Phnom Penh."
    //       ],
    //       [
    //         // "id"=> 8,
    //         "user_id"=> 1,
    //         "atm_id"=> "AMKATM08",
    //         "alias_id"=> "PNPFFM-A001",
    //         "install_date"=> "2021-02-01",
    //         "delivery_date"=> "2021-07-18",
    //         "take_over_date"=> "2026-08-30",
    //         "category_name"=> "Gold",
    //         "serial_number"=> "J810004229",
    //         "model_name"=>"DN100D",
    //         "warranty_days"=>365,
    //         "comment"=> null,
    //         "type_name"=>"ATM",
    //         "status"=>"active",
    //         "bank_name"=>"AMK MFI",
    //         "site_id"=>"120104-06",
    //         "region_name"=>"Phnom Penh",
    //         "site_name"=>"OnSite",
    //         "created_at"=> "11/13/2021",
    //         "updated_at"=> "11/26/2021",
    //         "location"=>"Doun Penh Section",
    //         "city"=>"Doun Penh Section",
    //         "state_name"=>"Phnom Penh",
    //         "accessibility"=>"Accessibility from 06:00 to 18:00",
    //         "address"=>" 56, Street 360, Village 9, Sangkat Boeung Keng Kang III, Khan Boeung Keng Kang, Phnom Penh"  
    //       ],
    //       [
    //         // "id"=> 9,
    //         "user_id"=> 1,
    //         "atm_id"=> "AMKATM09",
    //         "alias_id"=> "PNPCCV-A001",
    //         "install_date"=> "2021-02-01",
    //         "delivery_date"=> "2021-07-18",
    //         "take_over_date"=> "2026-08-30",
    //         "category_name"=> "Gold",
    //         "serial_number"=>"J810004203",
    //         "model_name"=>"DN100D",
    //         "warranty_date"=>365,
    //         "comment"=> null,
    //         "type_name"=>"ATM",
    //         "status"=>"active",
    //         "bank_name"=>"AMK MFI",
    //         "site_id"=>"121202",
    //         "region_name"=>"Phnom Penh",
    //         "site_name"=>"OnSite",
    //         "created_at"=> "11/13/2021",
    //         "updated_at"=> "11/26/2021",
    //         "location"=>"Doun Penh Section",
    //         "city"=>"Doun Penh Section",
    //         "state_name"=>"Phnom Penh",
    //         "accessibility"=>"Accessibility from 06:00 to 18:00",
    //         "address"=>"Building No. 588, National Road No. 1, Group 3, Doeum Sleng Village, Sangkat Chba Ampov 2, Khan Chbar Ampov, Phnom Penh"
    //       ],
    //       [
    //         // "id"=> 10,
    //         "user_id"=> 2,
    //         "atm_id"=> "AMKATM10",
    //         "alias_id"=> "PNPCAP-C001",
    //         "install_date"=> "2021-02-01",
    //         "delivery_date"=> "2021-07-18",
    //         "take_over_date"=> "2026-08-30",
    //         "category_name"=> "Gold",
    //         "serial_number"=> "5310264010",
    //         "model_name"=>"DN200V",
    //         "warranty_date"=>365,
    //         "comment"=> null,
    //         "type_name"=>"CRM",
    //         "status"=>"active",
    //         "bank_name"=>"AMK MFI",
    //         "site_id"=>"120104-04",
    //         "region_name"=>"Phnom Penh",
    //         "site_name"=>"OnSite",
    //         "created_at"=> "11/13/2021",
    //         "updated_at"=> "11/26/2021",
    //         "location"=>"Doun Penh Section",
    //         "city"=>"Doun Penh Section",
    //         "state_name"=>"Phnom Penh",
    //         "accessibility"=>"Accessibility from 06:00 to 18:00",
    //         "address"=>"National Road No. 6A, Group 8, Village 3, Sangkat Chroy Changva, Khan Chroy Changva, Phnom Penh"
    //       ]

    //     ];
    //     Using::insert($using);
    //   }
}