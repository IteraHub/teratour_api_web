<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
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

    public function update(Request $request){
        $data = $request->all([
            'firstname', 'email','lastname',
            'image_url','dob','about','coverphoto_url',
            'location'
        ]);

        $validator = $this->upValidator($data);
        

        if(!$validator->fails()){
            $user = User::find(\Auth::user()->id);

            if(!$user) return response()->json(['status'=>false,'message'=>'unknown user'],403);

            foreach ($data as $key=>$value){
                if($value){
                    $user[$key] = $value;
                }
            }

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

    public function updatePassword(Request $request)
    {
        $data = $request->all(['password','password_confirmation']);
        $validator = Validator::make($data,
                        [
                            'current_password'=>'required|string|min:6',
                            'password'=>'required|string|min:6|confirmed'
                        ]);

        if($validator->fails()){
            return response()->json([
                'status'=>false,
                'message'=>'Could not create account due to errors.',
                'errors'=>$validator->messages()->toArray()
            ],400);
        }

        //check password with existing
        $user = User::find(\Auth::user()->id);

        if(!Hash::check($data['current_password'],$user->password))
        {
            return response()->json([
                'status'=>false,
                'message'=>"Incorrect Current Password"
            ],400);
        }

        $user->password = Hash::make($data['password']);

        if($user->save()){
            return response()->json([
               'status'=>true,
               "message"=>"password changed successfully."
            ]);
        }

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
            'dob'=>'nullable',
            'about'=>'nullable|string',
            'coverphoto_url'=>'nullable|url',
            'location'=>'nullable|string',
            'password'=>'required|string|min:6|confirmed' 
        ]);
    }

    private function upValidator($data){
        return Validator::make($data,[
            'firstname'=>'nullable|string|min:2', 
            'email'=>'nullable|emails',
            'lastname'=>'nullable|string|min:2',
            'username'=>'nullable|string|unique:users,username',
            'image_url'=>'nullable|string|url',
            'dob'=>'nullable',
            'about'=>'nullable|string',
            'coverphoto_url'=>'nullable|url',
            'location'=>'nullable|string',
        ]);
    }
}