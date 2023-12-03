<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use App\Models\Genre;
use App\Models\Film;
//use Illuminate\Http\Request;


class FilmController extends Controller
{
    
    public function index()
    {
       //On recupere les donnés depuis l'API externe
       $response = Http::get("https://api.themoviedb.org/3/movie/popular", [
       'api_key' => config('services.tmdb.api_key')]);
         
       $films = $response->json()['results'];

        
       $response = Http::get("https://api.themoviedb.org/3/genre/movie/list", [
       'api_key' => config('services.tmdb.api_key')]);
            
       $genres = $response->json()['genres'];
                      
      
       //S'ils n'existent pas dans la BDD on les sauvegarde

       foreach($genres as $genre){    
        $existingData = Genre::where('id', $genre['id'])
                              ->where('name', $genre['name'])
                              ->first();
    
        if (!$existingData) {
            Genre::create([
                'id' => $genre['id'],
                'name' => $genre['name']     
             ]
             );
        } 
       }

       foreach($films as $film){    
         $existingData = Film::where('id', $film['id'])
                               ->where('title', $film['title'])
                               ->first();
         if (!$existingData) {
            
              Film::create([
                'title' => $film['title'],
                'overview'=> $film['overview'],
                'original_language'=> $film['original_language'],
                'release_date'=> $film['release_date']
             ]
             );

              $retrievedFilm = Film::where('title', $film['title'])->first();
              $filmGenres = $film['genre_ids'];
              $tableSize =  count($filmGenres);
              
              for($i = 0; $i<$tableSize; $i++){
                 $genre = $retrievedFilm->genres()->attach([$filmGenres[$i]]);
              }

        
         } 
        }







        //On recupere les données depuis la BDD

        //On envois les données à la view

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
