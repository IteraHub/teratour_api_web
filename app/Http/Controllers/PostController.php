<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Validator;
use App\Post;


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
        $result = Post::with('user')->get();
        return [
            'status' => true,
            'data' => $result
        ];
    }

    public function store(Request $request)
    {
        $data = $request->all(['text', 'user_id', 'title']);

        $validator = new Validator($data, [
            'text' => 'required|min:6|string',
            'title' => 'required|min:2|string',
        ]);
        if (!$validator->fails()) {
            $post = new Post();
            $post->text = $data['text'];
            $post->title = $data['title'];
            $post->user_id = Auth::user()->id;
            $post->post_id = $data['post_id'];

            if ($post->save()) {
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
                'errors' => $validator->errors()->all()
            ];
        }
    }
}
