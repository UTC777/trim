<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GenerateUserUUID extends Command
{
    protected $signature = 'user:generate-uuid';
    protected $description = 'Generate or update UUID for all users.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $users = DB::table('users')->get();

        if ($users->isEmpty()) {
            $this->info('No users found.');
            return;
        }

        foreach ($users as $user) {
            $newUuid = Str::uuid()->toString();
            DB::table('users')
                ->where('id', $user->id)
                ->update(['uuid' => $newUuid]);

            // Check if the user already had a UUID and output accordingly
            if (!empty($user->uuid)) {
                $this->info("User {$user->id} with existing UUID: {$user->uuid} updated to new UUID: {$newUuid}");
            } else {
                $this->info("Updated user {$user->id} with new UUID: {$newUuid}");
            }
        }

        $this->info('All users have been processed for UUID assignment or update.');
    }
}
