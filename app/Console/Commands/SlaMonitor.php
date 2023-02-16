<?php

namespace App\Console\Commands;

use App\Mail\SlaMonitorNotification;
use App\Models\RoleUser;
use App\Models\Deposit;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SlaMonitor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sla:monitor';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check SLA status';

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


           $tickets =Deposit::whereNotNull('slaId')->get();
          $role = RoleUser::where(['roleId'=>1])->pluck('userId');
          $admins = User::whereIn('id',$role)->pluck('email');
          foreach($tickets as $ticket )
          {
              $sla = Carbon::parse($ticket->updated_at)->addDays($ticket->sla->hours);
              $ticketStatus = $ticket->statusId;

              if($sla <= Carbon::now() & $ticketStatus == 1)
              {
                 $ticket->update(['statusId'=>4]);
                 Mail::to($admins)->queue(new SlaMonitorNotification($ticket));

                // Log::info('Status changed to: '.$ticket->statusId);

              }
              else
              {
                  //Log::info('Time has not elapsed');
              }
          }



    }
}
