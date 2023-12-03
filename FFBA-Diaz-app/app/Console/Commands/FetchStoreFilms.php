<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\FilmController;

class FetchStoreFilms extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-store-films';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch and store film data from external API'
    ;

    /**
     * Execute the console command.
     */
    public function handle()
    {
        app(FilmController::class)->fetchStoreFilms();
        $this->info('films stored successfully');
    }
}
