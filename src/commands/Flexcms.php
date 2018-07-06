<?php

namespace Jozwikp\Flexcms\commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use App\User;
use Jozwikp\Flexcms\models\Admin;

class Flexcms extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'flexcms:makeadmin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adds user account and makes it an admin';

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
        $email    = $this->ask('Podaj e-mail');
        $name     = $this->ask('Podaj imię');
        $password = $this->secret('Podaj hasło');


        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        Admin::create(['user_id'=>$user->id]);

        $this->info('Dodano admina '.$email. ' Możesz się zalogować');
    }
}
