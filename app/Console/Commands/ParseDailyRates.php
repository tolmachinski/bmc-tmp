<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ParserService;

class ParseDailyRates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily-rates:parse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse the market rates';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(ParserService $parser)
    {
        try {
            if ($parser->parseTheFinancialsCom($this)) {
                $this->info('The indexes were updated!');
            }
        } catch (\ErrorException $exception){
            $this->error('Failed to update daily rates indexes.');
            $this->error('Error:');
            $this->error($exception->getMessage());
        }
    }
}
