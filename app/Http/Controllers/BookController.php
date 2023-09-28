<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;


class BookController extends Controller
{

  
   public function delete($id,$authorId)
   {
   
       $user= Auth::user();
       Http::withToken($user->token_key)->delete('https://candidate-testing.api.royal-apps.io/api/v2/books/'.$id);
       
    $response = Http::withToken($user->token_key)->get('https://candidate-testing.api.royal-apps.io/api/v2/authors/'.$authorId);
   
    if ($response->successful()) {
        $author = $response->json();
        $books = $author['books'];
        return view('author', compact('author', 'books','user'))->with('success', 'Book deleted successfully');
    }
   
   }

   public function showAddForm()
   {
       
        $user= Auth::user();
        
        $currentPage = 1;
        $perPage = 100;

        $response = Http::withToken($user->token_key)->get('https://candidate-testing.api.royal-apps.io/api/v2/authors',[
        'page' => $currentPage, 
        'limit' => $perPage, 
    ]);

    if ($response->successful()) {
        $data = $response->json();
        $authors = $data['items'];
        return view('addBook', compact('authors','user'));
    }
   
   }
   
   
   public function addBook(Request $request)
   {

    $validator = Validator::make($request->all(), [
        'title' => 'required|string',
        'release_date' => 'required|date',
        'author_id' => 'required',
        'description' => 'required|string',
        'isbn' => 'required|string',
        'format' => 'required|string',
        'number_of_pages' => 'required|integer|min:0',
    ]);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    $user = Auth::user();
    $bookData = [
        'author' => ['id' => $request->input('author_id')],
        'title' => $request->input('title'),
        'release_date' => $request->input('release_date'),
        'description' => $request->input('description'),
        'isbn' => $request->input('isbn'), 
        'format' => $request->input('format'), 
        'number_of_pages' => intval($request->input('number_of_pages')),
    ];
   

    // Send a POST request to the API to create the new book
    $response = Http::withToken($user->token_key)
    ->post('https://candidate-testing.api.royal-apps.io/api/v2/books', $bookData);

    if ($response->successful()) {
        return back()->with('success', 'Book added successfully');
    } else {
        return back()->with('error', 'Failed to add the book. Please try again.');
    }
   }

}
