<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Goutte\Client;
use App\Models\Publisher;

class LoadFeedDaily extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'load:feed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Load all the feeds from the enabled publishers.';

    protected $scrapper;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Client $scrapper)
    {
        parent::__construct();
        $this->scrapper = $scrapper;
    }


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $publishers = Publisher::where('enabled', '=', 1)->get();
        if ($publishers->count() > 0)
            foreach($publishers as $publisher)
                $publisher->loadFeed($this->scrapper);
        return 0;
    }
}
