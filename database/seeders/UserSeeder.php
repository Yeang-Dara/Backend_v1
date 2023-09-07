<?php 
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserSeeder extends Seeder

{
    public function run(){
      DB::table('users')->delete();
      $user = [
        [
            // "id"=>1,
            "last_name"=>"Yeang",
            "first_name"=>"Dara",
            "username"=>"yeang_dara",
            "rules"=> "employee",
            "email"=> "dara@gmail.com",
            "password"=>"$2y$10$5RrEAGC/ruImmjRw7dNGSOdiYAyLniS8AtfYgVKGtFZ8Ylf5y9vDO",
            "c_password"=>"123456",
            "created_at"=>"03/13/2023",
            "updated_at"=> "03/26/2023",
        ],  
        [
            // "id"=> 2,
            "last_name"=> "Administrator",
            "first_name"=> "administrator",
            "rules"=> "admin",
            "username"=>"Admin",
            "email"=>"admin@gmail.com",
            "password"=> "$2y$10$2ecYvk/ECfVqtP8wOWc2suU5K6zuVgbmgRdP0FJSDqJE8TB5uy5FK",
            "c_password"=>"123456",
            "created_at"=>"03/13/2023",
            "updated_at"=> "03/26/2023"
        ],
        // [
        //   "last_name"=>"Nou",
        //   "first_name"=>"Savoeun",
        //   "username"=>"Nou Savoeun",
        //   "roles"=>"admin",
        //   "email"=>"savoeunn@btipayments.com.sg",
        //   "password"=>bcrypt('123456'),
        //   "c_password"=>"123456",
        //   "created_at"=>"",
        //   "updated_at"=>"",
        // ],
        // [
        //   "last_name"=>"",
        //   "first_name"=>"",
        //   "username"=>"",
        //   "roles"=>"",
        //   "email"=>"",
        //   "password"=>bcrypt('123456'),,
        //   "c_password"=>"123456",
        //   "created_at"=>"",
        //   "updated_at"=>"",
        // ],
        // [
        //   "last_name"=>"",
        //   "first_name"=>"",
        //   "username"=>"",
        //   "roles"=>"",
        //   "email"=>"",
        //   "password"=>bcrypt('123456'),,
        //   "c_password"=>"123456",
        //   "created_at"=>"",
        //   "updated_at"=>"",
        // ],
        // [
        //   "last_name"=>"",
        //   "first_name"=>"",
        //   "username"=>"",
        //   "roles"=>"",
        //   "email"=>"",
        //   "password"=>bcrypt('123456'),
        //   "c_password"=>"123456",
        //   "created_at"=>"",
        //   "updated_at"=>"",
        // ],
      ];
      User::insert($user);
    }
 
  
}