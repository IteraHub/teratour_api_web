<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller{

    public function __construct()
    {
        $this->middleware('auth',[
            'except'=>['register']
        ]);
    }

    public function register(Request $request){
        $data = $request->all([
            'firstname', 'email','lastname','username',
            'image_url','dob','about','coverphoto_url',
            'location','password','password_confirmation' 
        ]);

        $validator = $this->validater($data);
        

        if(!$validator->fails()){
            $user = new User($data);
            $user->password = Hash::make($data['password']);

            if($user->save()){
                return response()->json([
                    'status'=>true,
                    'data'=>$user
                ]);
            }

            return response()->json(
                [
                    'status'=>false,
                    'message'=>'Unable to save user due to some errors',
                ]
                ,400
                );

        }

        return response()->json([
            'status'=>false,
            'message'=>'Could not create account due to errors.',
            'errors'=>$validator->messages()->toArray()
        ],400);
       
    }

    public function index(){
        return \Auth::user();
    }

    /**
     * @return \Illuminate\Validation\Validator
     */
    private function validater($data){
        return Validator::make($data,[
            'firstname'=>'required|string|min:2', 
            'email'=>'required|email|unique:users,email',
            'lastname'=>'required|string|min:2',
            'username'=>'required|string|unique:users,username',
            'image_url'=>'nullable|string|url',
            'dob'=>'nullable|date',
            'about'=>'nullable|string',
            'coverphoto_url'=>'nullable|url',
            'location'=>'nullable|string',
            'password'=>'required|string|min:6|confirmed' 
        ]);
    }
}