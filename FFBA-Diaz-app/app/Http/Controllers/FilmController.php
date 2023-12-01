<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
//use Illuminate\Http\Request;


class FilmController extends Controller
{
    /*public function index()
    {
        $response = Http::get("https://api.themoviedb.org/3/movie/popular?api_key=da30e671936115ccc8bb59d618f91d8d");

        $films = $response->json()['results'];

        return view('films.index', compact('films'));
    }*/


    
    public function index()
    {
        $response = Http::get("https://api.themoviedb.org/3/movie/popular", [

        'api_key' => config('services.tmdb.api_key')]);

        $films = $response->json()['results'];

        return view('films.index', compact('films'));
    }


    public function film($id)
    {
        $response = Http::get("https://api.themoviedb.org/3/movie/{$id}", [

        'api_key' => config('services.tmdb.api_key')]);

        $film = $response->json();

        return view('films.film', compact('film'));
    }

}
