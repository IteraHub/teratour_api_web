<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use App\Post;
use App\Like;
use App\Media;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        $this->middleware('auth');
    }

    //
    public function index()
    {
        $result = Post::with(['user','media'])->get();
        return [
            'status' => true,
            'data' => $result
        ];
    }

    public function view($post_id)
    {
        $result = Post::with(['user','media'])->find($post_id);
        return [
            'status' => true,
            'data' => $result
        ];
    }

    public function store(Request $request)
    {
        $data = $request->all(['text', 'user_id', 'title']);

        $validator = Validator::make($data, [
            'text' => 'required|min:6|string',
            'title' => 'required|min:2|string',
            'media_url'=>'url'
        ]);
        if (!$validator->fails()) {
            $post = new Post();
            $post->text = $data['text'];
            $post->title = $data['title'];
            $post->user_id = Auth::user()->id;
            $post->post_id = $data['post_id'];

            if ($post->save()) {
                if(isset($data['media_url'])){
                    $media = new Media();
                    $media->media_url = $data['media_url'];
                    $post->media->save($media);
                }
                return [
                    'status' => true,
                    'message' => 'Post saved',
                    'data' => $post
                ];

            }

            return [
                'status' => false,
                'message' => 'unable to save post. Please try again'
            ];
        } else {
            //invalid data

            return [
                'status' => false,
                'message' => 'Incorrect or incomplete data',
                'errors' => $validator->messages()->toArray()
            ];
        }
    }

    public function like(int $post_id = null)
    {
        if ($post_id == null) {
            return response()->json([
                'status' => false,
                'msg' => 'You need to select a post'
            ], 400);
        }
        $user_id = \Auth::user()->id;
        $hasLiked = Like::where([
            ['post_id',$post_id],
            ['user_id',$user_id],
        ])->first();

        if ($hasLiked) {
            return response()->json([
                'status' => false,
                'msg' => 'Post already liked'
            ]);
        }

        $like = new Like([
            'post_id' => $post_id,
            'user_id' => $user_id
        ]);
        if (!$like->save()) {
            return response()->json([
                'status' => false,
                'msg' => 'Could not like due to an error'
            ], 400);
        }
        return response()->json(
            [
                'status' => true,
                "msg" => "liked"
            ]
        );
    }

    public function unlike(int $post_id = null)
    {
        if ($post_id == null) {
            return response()->json([
                'status' => false,
                'msg' => 'You need to select a post'
            ]);
        }
        $user_id = \Auth::user()->id;
        $hasLiked = Like::where([
            ['post_id', $post_id],
            ['user_id', $user_id]
        ])->first();

        if (!$hasLiked) {
            return response()->json([
                'status' => false,
                'msg' => 'has not liked'
            ]);
        }

        if(!$hasLiked->delete()){
            return response()->json([
                'status'=>false,
                "msg"=>"Unable to unlike"
            ]);
        }

        return response()->json([
            'status'=>true,
            "msg"=>"Unliked"
        ]);
        
    }
}
