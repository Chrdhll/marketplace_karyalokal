<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PruneDeletedUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:prune-deleted-users';
    protected $description = 'Menghapus permanen akun yang sudah di-soft-delete lebih dari 30 hari';


    /**
     * Execute the console command.
     */
    public function handle()
    {
         // Hapus user yang `deleted_at`-nya lebih lama dari 30 hari yang lalu
    $cutoffDate = now()->subDays(30);
    $users = \App\Models\User::onlyTrashed()->where('deleted_at', '<=', $cutoffDate)->get();
    
    foreach ($users as $user) {
        $user->forceDelete(); // Menghapus permanen
    }

    $this->info(count($users) . ' user(s) have been permanently deleted.');
    }
}
