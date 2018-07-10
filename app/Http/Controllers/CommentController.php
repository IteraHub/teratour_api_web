<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
        $data = $request->all(['text']);
        $data['post_id'] = $post;
        $validator = Validator::make($data,[
            'text'=>'required|min:6|string',
            'post_id'=>'exists:posts,id|numeric'
        ],[
            'text' =>"You need the text field to comment",
            'post_id'=>'Invalid Post value'
        ]);

        if(!$validator->fails()){
            $comment = new Comment();
            $comment->text = $data['text'];
            $comment->user_id = \Auth::user()->id;
            $comment->post_id = $data['post_id'];
            
            if($comment->save()){
                return [
                    'status'=>true,
                    'message'=>'Comment saved',
                    'data'=>$comment
                ];

            }

            return response()->json( [
                'status'=>false,
                'message'=>'unable to save comment. Please try again'
            ],400);
        }else{
            //invalid data
           return response()->json([
                'status'=>false,
                'message'=>'Incorrect or incomplete data',
                'errors'=>$validator->messages()->toArray()
            ],400);
        }
    }
}
