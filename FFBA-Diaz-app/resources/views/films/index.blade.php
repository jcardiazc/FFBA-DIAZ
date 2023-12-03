@extends('layout')
@section('content') 
@include('partials._hero')

<div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
   
   
   
   @foreach ($films as $film)
      <div class="bg-gray-50 border border-gray-200 rounded p-6">
         <div class="flex">
            <img
               class="hidden w-48 mr-6 md:block"
               src="https://image.tmdb.org/t/p/w500/{{ $film['poster_path'] }}" class="card-img-top" 
               alt="{{ $film['title'] }}"                     
            />
            <div>
               <h3 class="text-4xl mb-3">
                  <a href="/film/{{$film["id"]}}">{{ $film['title'] }}</a>
               </h3>
               <div >
                  <h4 class="text-2xl">Synopsis</h4>
                  <div class="py-2 mt-2" >
                     <p>{{ $film['overview'] }}</p>
                  </div >
               </div>
            </div>
         </div>
       </div>
    @endforeach

  
          
    </div>
@endsection

