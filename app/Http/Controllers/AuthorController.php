<?php

namespace App\Http\Controllers;

use App\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    public function create(Request $req){
        $validator = Validator::make($req->all(),[
            'name'=>'required',
            'username'=>'required|unique:authors',
            'age'=>'required'
        ]);
        if($validator->fails()){
            return $validator->errors();
        }
        $author = new Author();
        $author->name = $req->name;
        $author->username = $req->username;
        $author->age = $req->age;
        $author->save();
        return [
            'data'=>$author,
            'state'=>true
        ] ;
    }
}
