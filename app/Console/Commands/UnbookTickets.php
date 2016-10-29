<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Carbon\Carbon;
use App\Ticket;

class UnbookTickets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tickets:unbook';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Unbook tickets after 10 mins.';

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
    public function handle()
    {
        $unbooked_tickets = Ticket::where('status', 2)
            ->where('updated_at', '<=', Carbon::now()->addMinutes(-90))
            ->update([
                'status'    => 1,
                'booked_by' => null
            ]);

        $this->info(Carbon::now() . ' : ' . $unbooked_tickets . ' tickets have been unbooked successfully!');
    }
}
