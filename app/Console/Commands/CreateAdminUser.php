<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create-user {--name=Admin User} {--email=admin@example.com} {--password=admin123}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an admin user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get admin user details from options
        $name = $this->option('name');
        $email = $this->option('email');
        $password = $this->option('password');

        // Validate password
        if (strlen($password) < 8) {
            $this->error('Password must be at least 8 characters long!');
            return 1;
        }

        // Check if user already exists
        if (User::where('email', $email)->exists()) {
            $this->error('A user with this email already exists!');
            return 1;
        }

        // Create admin user
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => 'admin',
        ]);

        $this->info('Admin user created successfully!');
        $this->info("Email: {$user->email}");
        $this->info("Name: {$user->name}");
        $this->info("Role: {$user->role}");

        return 0;
    }
}
