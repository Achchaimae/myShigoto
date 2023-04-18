<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function showCompany(){
        $user = User::where('validation', 'accepted ' and 'status' )->get();
        $response =[
            'success' => true,
            'message' => 'User login successfully.',
            'data' => $user
        ];
        return response()->json($response, 200);
    }
}
