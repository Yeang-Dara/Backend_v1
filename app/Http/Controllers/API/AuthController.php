<?php
 namespace App\Http\Controllers\API;

 use App\Http\Controllers\Controller;
 use Illuminate\Http\Request;
 use Illuminate\Support\Facades\Auth;
 use Illuminate\Support\Facades\Hash;
 use Illuminate\Support\Facades\Validator;
 use App\Models\User;

 class AuthController extends Controller
 {
    public function register(Request $request){

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
                'message' =>$validator->errors(),
            ];
            return response()->json($response, 404);
        }
        elseif(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user= $request->user();
            $success['token'] = $user->createToken('myApp')->plainTextToken;
            $success['username'] = $user->username;
            $response =[
                'success' => true,
                'data' => $success,
                'message' =>"This account has been already registered"
            ];
            return response()->json($response, 300);
        }
        $input =$request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        $success['token'] = $user->createToken('myApp')->plainTextToken;
        $success['username'] = $user->username;

        $response =[
            'success' => true,
            'data' => $success,
            'message' =>"Register Successfully"
        ];
        return response()->json($response, 200);
        
    }
    public function login(Request $request){
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user= $request->user();
            $success['token'] = $user->createToken('myApp')->plainTextToken;
            $success['rules'] = $user->rules;
            $success['username'] = $user->username;
            $response =[
                'success' => true,
                'data' => $success,
                'message' =>"Login Successfully"
            ];
            return response()->json($response, 200);
        }
        else{
            return response()->json(['message'=>'Account Not Found'], 400);
        }
    }
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json('logout', 201);
    }
  
 }