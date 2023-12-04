<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;

class AdminFilmController extends Controller
{
    
    public function index()
    {  
        //On récupère les données depuis la BDD

        $dbFilms =  Film::all();


        //On envoie les données à la view

        return view('admin.films.index', compact('dbFilms'));
    }

 

    public function destroy(Film $film)
    {
        //On efface le film passé en paramètres
        $film->delete();
        return redirect()->back()->with('success', 'The film was deleted');
    }

}
