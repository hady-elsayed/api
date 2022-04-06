<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{
    use ApiResponseTrait;

    function index (){
        $posts = Post::paginate(10);
        return $this->apiResponse($posts);
    }

    function show ($id){
        $post = new PostResource(Post::find($id)) ;
        if ($post){
            return $this->apiResponse($post);
        }
            return $this->apiResponse(null,"we don't find this post",404);

    }

    public function store (Request $request){

        $validate = Validator::make($request->all(),[
            'title' => 'required',
            'body' => 'required'
        ]);

        if ($validate -> fails()){
            return $this->apiResponse(null  , $validate->errors() , 422);
        }

        $post = Post::create($request->all());

        if ($post){
            return $this->apiResponse($post , null , 201);
        }
        return $this->apiResponse(null,"unknown error",520);

    }
}

