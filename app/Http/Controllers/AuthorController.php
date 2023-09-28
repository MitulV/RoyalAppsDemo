<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AuthorController extends Controller
{


public function delete($id)
{
    $user= Auth::user();
    $books=$this->getAuthorBooks($id,$user->token_key);
   
    if(count($books)==0){
        Http::withToken($user->token_key)->delete('https://candidate-testing.api.royal-apps.io/api/v2/authors/'.$id);
        return redirect()->route('dashboard')->with('success', 'Author deleted successfully');
    }else{
        return redirect()->route('dashboard')->with('error', 'Author cannot be deleted as there are related books');
    }
    

}

public function show($id)
{
    $user = Auth::user();
    $response = Http::withToken($user->token_key)->get('https://candidate-testing.api.royal-apps.io/api/v2/authors/'.$id);
    $author = $response->json();
    $books = $author['books'];
    return view('author', compact('author', 'books','user'));


}

public function getAuthorBooks($authorId,$tokenKey){
    $response = Http::withToken($tokenKey)->get('https://candidate-testing.api.royal-apps.io/api/v2/authors/'.$authorId);
    $author = $response->json();
    $books = $author['books'];
    return $books;
}


}