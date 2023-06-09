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
            'image' => 'required|string',
            'phone' => 'required|string',
            'status' => 'required|string',
            'validation' => 'sometime|string',
            'token' => 'sometimes|string',
        ]);
        

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
                'user' => $user,
                'token' => $user->createToken('MyApp')->plainTextToken,
                'role' => $user->role ,
                 'id' => $user->id
            ];
            return response()->json($response, 200);
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }
    //show user who have status company
    public function showCompany(){
        $user = User::where('status', 'company')->get();
        $response =[
            'success' => true,
            'message' => 'User login successfully.',
            'data' => $user
        ];
        return response()->json($response, 200);
    }
    //change the role of user to company
    public function accepted(Request $request){
        
        $user = User::find($request->id);
        $user->validation = 'accepted';
        $user->role = 'company';
        $user->save();
        $response =[
            'success' => true,
            'message' => 'User login successfully.',
            'data' => $user
        ];
        return response()->json($response, 200);
    }
    //change the role of 
    public function rejected(Request $request){
        
        $user = User::find($request->id);
        $user->validation = 'rejected';
        $user->save();
        $response =[
            'success' => true,
            'message' => 'User login successfully.',
            'data' => $user
        ];
        return response()->json($response, 200);
    }

    //logout
    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        $response =[
            'success' => true,
            'message' => 'User logout successfully.',
            'data' => []
        ];
        return response()->json($response, 200);
    }

    //show the data of a user using id
    public function show($id){
        $user = User::find($id);
        $response =[
            'data' => $user
        ];
        return response()->json($response, 200);
    }
    //update the data of a user using id
    public function update(Request $request){
        $user = User::find($request->id);
        if (!$user) {
            $response = [
                'success' => false,
                'message' => 'User not found.'
            ];
            return response()->json($response, 404);
        }
    
        // Validate input data
        $validatedData = $request->validate([
            'FirstName' => 'required',
            'LastName' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'city' => 'required',
            'role' => 'required',
            'image' => 'required',
            'phone' => 'required',
            'status' => 'required',
            'validation' => 'required',
        ]);
    
        $user->FirstName = $validatedData['FirstName'];
        $user->LastName = $validatedData['LastName'];
        $user->email = $validatedData['email'];
        $user->address = $validatedData['address'];
        $user->city = $validatedData['city'];
        $user->role = $validatedData['role'];
        $user->image = $validatedData['image'];
        $user->phone = $validatedData['phone'];
        $user->status = $validatedData['status'];
        $user->validation = $validatedData['validation'];
        $user->save();
        $response =[
            'success' => true,
            'message' => 'User updated successfully.',
            'data' => $user
        ];
        return response()->json($response, 200);
    }
    
    //delete the data of a user using id
    public function destroy($id){
        $user = User::find($id);
        $user->delete();
        $response =[
            'success' => true,
            'message' => 'User deleted successfully.',
            'data' => []
        ];
        return response()->json($response, 200);
    }
}
