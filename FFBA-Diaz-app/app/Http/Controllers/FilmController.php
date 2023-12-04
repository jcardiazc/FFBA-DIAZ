<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use App\Models\Genre;
use App\Models\Film;
//use Illuminate\Http\Request;


class FilmController extends Controller
{


    public function fetchStoreFilms()
    {
        
        //On récupère les données depuis l'API externe

        $response = Http::get("https://api.themoviedb.org/3/movie/popular", [
        'api_key' => config('services.tmdb.api_key')]);
          
        $films = $response->json()['results'];
 
         
        $response = Http::get("https://api.themoviedb.org/3/genre/movie/list", [
        'api_key' => config('services.tmdb.api_key')]);
             
        $genres = $response->json()['genres'];
                       
       
        //S'ils n'existent pas dans la BDD on les sauvegarde
 
        foreach($genres as $genre){    
           $existingGenreData = Genre::where('id', $genre['id'])
                               ->where('name', $genre['name'])
                               ->first();
     
           if (!$existingGenreData) {
              Genre::create([
                  'id' => $genre['id'],
                  'name' => $genre['name']     
              ]
              );
           } 
        }
        
        foreach($films as $film){    
           $existingFilmData = Film::where('title', $film['title'])
                                ->first();

           if (!$existingFilmData) {  
                
                /*On récupère les détails de chaque film en faisant un appel à l'API externe, 
                bien qu'il y ait des informations pour chaque film dans la liste 'films', 
                certaines informations importantes manquent, telles que la 'homepage'par exemple.*/

               $response = Http::get("https://api.themoviedb.org/3/movie/{$film['id']}", [
               'api_key' => config('services.tmdb.api_key')]);
               $filmX = $response->json();
        
               Film::create([
                 'title' => $filmX['title'],
                 'overview'=> $filmX['overview'],
                 'original_language'=> $filmX['original_language'],
                 'release_date'=> $filmX['release_date'],
                 'poster_path'=> $filmX['poster_path'],
                 'homepage'=> $filmX['homepage'] 
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
        
        return response()->json(['message' => 'films and genres fetched and stored successfully']);
    }



    public function index()
    {  
        //On récupère les données depuis la BDD

        $dbFilms =  Film::all();


        //On envoie les données à la view

        return view('films.index', compact('dbFilms'));
    }


    public function film($id)
    {
    
        //On récupère un film depuis la BDD en fonction de son id

        $film =  Film::find($id);

        return view('films.film', compact('film'));

    }

}
