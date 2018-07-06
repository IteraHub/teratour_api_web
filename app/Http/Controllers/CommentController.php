<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Validator;
use App\Post;
use App\Comment;

class CommentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    //
    public function index($post){
        $result =  Comment::wherePostId($post)->with('user')->get();
        return [
            'status'=>true,
            'data'=>$result
        ];
    }

    public function store(Request $request,$post){
        $data = $request->all(['text','user_id']);
        $data['post_id'] = $post;
        $validator = new Validator($data,[
            'text'=>'required|min:6|string',
            'user_id'=>'exist:user,id|numeric',
            'post_id'=>'exist:post,id|numeric'
        ]);

        if($validator->validate()){
            $comment = new Comment();
            $comment->text = $data['text'];
            $comment->user_id = $data['user_id'];
            $comment->post_id = $data['post_id'];
            
            if($comment->save()){
                return [
                    'status'=>true,
                    'message'=>'Comment saved',
                    'data'=>$comment
                ];

            }

            return [
                'status'=>false,
                'message'=>'unable to save comment. Please try again'
            ];
        }else{
            //invalid data

            return [
                'status'=>false,
                'message'=>'Incorrect or incomplete data',
                'errors'=>$validator->errors()->all()
            ];
        }
    }
}
