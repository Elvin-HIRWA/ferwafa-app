<?php

namespace App\Console\Commands;

use App\Models\Key;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateCompetitionUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'competition:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $key = Key::where("permissionID", 3)->first();

        if (is_null($key)) {
            $this->error("Admin Permission not found, create it first");
            return 1;
        }

        $name = $this->ask("Enter Names");

        $email = $this->ask("Enter Email");

        $password = $this->ask("Enter Password");

        User::create([
            'name' => (string) $name,
            'email' => $email,
            'password' => Hash::make($password),
            'keyID' => $key->id
        ]);

        $this->info('User created successfull ');

        return 0;
    }
}
