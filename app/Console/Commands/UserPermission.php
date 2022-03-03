<?php

namespace App\Console\Commands;

use App\Jobs\MailSend;
use App\Models\User;
use Illuminate\Console\Command;

class UserPermission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'UserPermission';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command use for User Permission';

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
        date_default_timezone_set("Asia/Calcutta");
        $users = User::all()->where('created_at', '<', date("Y-m-d h:i:s",strtotime("-1 days")));
        foreach ($users as $user) {
            User::where('id', $user->id)->update(['remember_token' => null, 'status' => 1]);
        }
    }
}
