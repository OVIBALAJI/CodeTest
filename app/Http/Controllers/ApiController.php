<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\countries;
use App\Models\states;
use App\Models\cities;

class ApiController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required",
            "email" => "required|email",
            "mobile_number" => "required|numeric",
            "dob" => "required",
            "gender" => "required",
            "password" => "required",
        ]);
        if ($validator->fails()) {
            return response()->json(["message" => "validator error"], 400);
        }
        $data = $request->all();
        $data["password"] = Hash::make($data["password"]);
        $user = User::create($data);
        $response["token"] = $user->createToken("Api");
        $response["name"] = $user->name;
        return response()->json($response, 200);
    }
    public function login(Request $request)
    {
        if (
            Auth::attempt([
                "email" => $request->input("email"),
                "mobile_number" => $request->input("mobile_number"),
            ])
        ) {
            $user = Auth::user();
            $response["token"] = $user->createToken("Api");
            $response["name"] = $user->name;
            return response()->json($response, 200);
        } else {
            return response()->json(["message" => "invalid credentials"], 400);
        }
    }
    public function countries(){
       $countries= countries::get();
       return response()->json($countries, 200);
    }
    public function states(){
        $states= states::get();
        return response()->json($states, 200);
     }
     public function cities(){
        $cities= cities::get();
        return response()->json($cities, 200);
     }
}
