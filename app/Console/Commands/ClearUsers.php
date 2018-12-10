<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ClearUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear Users Table last updated within one month';

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
    public function handle(): void
    {
        $date = Carbon::now()->subMonth();

//        var_dump($date); die();

        // galima daryti su dienom, valandom, minutem, metais. Jei daugiskaita subMonths(2).
        DB::table('users')
            ->where('updated_at', '<', $date)
            ->delete();

        $this->info(' Old Users were deleted successfully!');
    }
}
