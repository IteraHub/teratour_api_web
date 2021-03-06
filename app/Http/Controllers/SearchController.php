<?php
/**
 * Created by PhpStorm.
 * User: prosperoking
 * Date: 8/12/18
 * Time: 12:29 PM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;

class SearchController extends Controller
{
    /**
     * SearchController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $query = $request->query('q');

        if(empty($query))
        {
            return response()->json([
                'status'=>false,
                'message'=>'Please provide a search query.'
            ],400);
        }

        $posts = Post::with(['user','media'])->where("title",'like',"%{$query}%")->get();
        $users = User::where("username",'like',"%{$query}%")
                ->select(['id','username','firstname','lastname','about'])
                ->get();

        return response()->json([
           'status'=>true,
           'data'=>[
               'posts'=>$posts,
               'users'=>$users
           ]
        ]);
    }
}