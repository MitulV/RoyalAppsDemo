<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index(Request $request){
        $user= Auth::user();
        
        $currentPage = $request->query('page', 1);
        $perPage = 5;

        $response = Http::withToken($user->token_key)->get('https://candidate-testing.api.royal-apps.io/api/v2/authors',[
        'page' => $currentPage, 
        'limit' => $perPage, 
    ]);

    if ($response->successful()) {
        $data = $response->json();
        
        $authors = $data['items'];
        
        $totalPages = $data['total_pages'];
        
        return view('dashboard',[
        'user' => $user,
        'authors' => $authors,
        'currentPage' => $currentPage,
        'totalPages' => $totalPages,
    ]);
    }
        

    }
}
