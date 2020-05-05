<?php

namespace App\Http\Controllers;

use App\Author;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function create(Request $req){
        $validator = Validator::make($req->all(),[
            'title'=>'required|unique:posts',
            'body'=>'required',
        ]);
        if($validator->fails()){
            return $validator->errors();
        }
        $author = Author::find($req->author);
        $post = new Post();
        $post->title = $req->title;
        $post->body = $req->body;
        $post->author()->associate($author);
        $post->save();
        return [
            'state'=>true,
            'data'=>$post
        ];

    }
}
