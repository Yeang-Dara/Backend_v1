<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
 use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserController extends ParentController
{
        public function __construct(
            User $user,
            UserService $userService,
        ){
            $this->model= $user;
            $this->service =$userService;
        }
        public function getUserID($id):JsonResponse
        {
            return parent::getById($id);

        }
        public function getallUser(){

            // return parent::all();
            $data = DB:: select('SELECT * FROM users ORDER BY id');
            return $data;
        }
        public function addUser(Request $request):JsonResponse
        {
            $validator=Validator::make($request->all(),[
                'first_name' =>'required',
                'last_name' =>'required',
                'username' =>'required',
                'email' =>'required|email',
                'rules' =>'required',
                'password' =>'required|min:6',
                'c_password'=>'required|same:password',
            ]);
            if($validator->fails()) {
                $response =[
                    'success' =>false,
                    'status' => 404,
                    'message' =>" Information invalid",
                ];
                return response()->json($response, 404);
            }
            $users = DB::table('users')->get();
                foreach($users as $user){
                    if($user->email ==$request->email){
                        $response =[
                            'success' =>false,
                            'status' =>400,
                            'message' =>" This account has been already exited",
                        ];
                        return response()->json($response, 400);
                    }
                }
            $request['password'] =bcrypt($request['password']);
            return parent::create($request);  
        }
        public function updateUser( Request $request, $id):JsonResponse
        {   
            return parent::update($request,$id);
            
        }
        public function deleteUser($id):JsonResponse
        {
            return parent::delete($id);
        }
}