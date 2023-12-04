@extends('layout')
@section('content')

<a href="/index" class="inline-block text-black ml-4 mb-4"
><i class="fa-solid fa-arrow-left"></i> Back
</a>
<div class="mx-4">
<div class="bg-gray-50 border border-gray-200 p-10 rounded">
    <div
        class="flex flex-col items-center justify-center text-center"
    >
        <img 
             src="https://image.tmdb.org/t/p/w500/{{ $film['poster_path'] }}" 
             class="w-48 mr-6 mb-6" 
             alt="{{ $film['title'] }}">

             <p class="text-3xl text-black-200 font-bold my-4">
                {{ $film['title'] }}
             </p>

        <ul class="flex">
            
            <li
                class="bg-primary text-white rounded-xl px-3 py-1 mr-2"
            >
            Language: {{ $film['original_language'] }}
            </li>
            <li
                class="bg-primary text-white rounded-xl px-3 py-1 mr-2"
            >
                   Genres:
                   @foreach ($film['genres'] as $genre)
                      *{{$genre['name']}}                  
                   @endforeach
            </li>
            <li
                class="bg-primary text-white rounded-xl px-3 py-1 mr-2"
            >
                Release date: {{ $film['release_date'] }}
            </li>
        </ul>
        
        <div class="border border-gray-200 w-full mb-6"></div>
        <div>
            <h3 class="text-2xl font-bold mb-4">
                Sinopsis
            </h3>
            <div class="text-lg space-y-6">
                <p>
                    {{ $film['overview'] }}
                </p>
               

                <a
                    href="{{$film['homepage']}}"
                    target="_blank"
                    class="block bg-primary text-white py-2 rounded-xl hover:opacity-80"
                    ><i class="fa-solid fa-globe"></i> Visit
                    Website</a
                >
            </div>
        </div>
    </div>
</div>
</div>

@endsection