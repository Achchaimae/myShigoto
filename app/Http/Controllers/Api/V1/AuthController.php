<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request){
        //validator
        $validator = Validator::make($request->all(), [
            'FirstName' => 'required|string',
            'LastName' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string',
            'confirm_password' => 'required|same:password',
            'address' => 'required|string',
            'city' => 'required|string',
            'role' => 'required|string',
            // 'image' => 'required|st|mimes:jpeg,png,jpg,gif,svg|max:2048',
            
            'phone' => 'required|string',
        ]);
        // check file is valid or not
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
        }

        if($validator->fails()){
            $response =[
                'success' => false,
                'message' => 'Validation Error.',
                'data' => $validator->errors()
            ];
            return response()->json($response, 422);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        $succes['token'] = $user->createToken('MyApp')->plainTextToken;
        $succes['FirstName'] = $user->FirstName;

        $response =[
            'success' => true,
            'message' => 'User register successfully.',
            'data' => $succes
        ];
        return response()->json($response, 200);
       
    }

    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            
            'email' => 'required',
            'password' => 'required',
            
        ]);
        
        if($validator->fails()){
            $response =[
                'success' => false,
                'message' => 'Validation Error.',
                'data' => $validator->errors()
            ];
            return response()->json($response, 422);
        }
        if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password])){
            
            $user = $request->user();
            $succes['token'] = $user->createToken('MyApp')->plainTextToken;
            $succes['FirstName'] = $user->FirstName;

            $response =[
                'success' => true,
                'message' => 'User login successfully.',
                'data' => $succes
            ];
            return response()->json($response, 200);
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        $response =[
            'success' => true,
            'message' => 'User logout successfully.',
            'data' => []
        ];
        return response()->json($response, 200);
    }
}
