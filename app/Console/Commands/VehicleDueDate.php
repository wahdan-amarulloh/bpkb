<?php

namespace App\Console\Commands;

use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Services\TwelioService;

class VehicleDueDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vehicle:send {date?} {--all}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notification ';

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
     * @return int
     */
    public function handle()
    {
        $date = !is_null($this->argument('date')) ? Carbon::parse($this->argument('date')) : null;

        $app = new TwelioService();

        $this->info('Execute command with date ' . $date);

        $vehicles = Vehicle::query()
            ->when(!is_null($date), function ($query) use ($date) {
                return $query->whereDate('effective_date', $date);
            })->get();

        foreach ($vehicles as $vehicle) {
            $app->sendMessage('+6289637058723', $vehicle->name);
        }

        $this->info('done send ' . $vehicles->count() . ' data');

        return 0;
    }
}
