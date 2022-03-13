<?php

namespace App\Console\Commands;

use App\Foundation\ElasticsearchClient;
use Illuminate\Console\Command;

class ElasticsearchPing extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'elasticsearch:ping';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ping Elasticsearch';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle(ElasticsearchClient $client)
    {
        if ($client->client()->ping()) {
            $this->info('success');
            return;
        }

        $this->error('Could not connect to Elasticsearch.');
    }
}
