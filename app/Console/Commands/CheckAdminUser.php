<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class CheckAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-admin-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check if admin user exists';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $adminUser = User::where('email', 'admin@example.com')->first();
        
        if ($adminUser) {
            $this->info("Admin user found:");
            $this->info("- ID: {$adminUser->id}");
            $this->info("- Name: {$adminUser->name}");
            $this->info("- Email: {$adminUser->email}");
            $this->info("- Is Admin: " . ($adminUser->is_admin ? "Yes" : "No"));
        } else {
            $this->error("Admin user not found");
        }
    }
}