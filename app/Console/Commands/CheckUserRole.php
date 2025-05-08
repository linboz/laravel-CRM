<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class CheckUserRole extends Command
{
    protected $signature = 'user:check-role {email}';
    protected $description = 'Check if a user has the admin role';

    public function handle()
    {
        $email = $this->argument('email');
        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("User with email {$email} not found.");
            return;
        }

        $this->info("User: {$user->name} ({$user->email})");
        $this->info("Roles: " . implode(', ', $user->getRoleNames()->toArray()));
    }
} 