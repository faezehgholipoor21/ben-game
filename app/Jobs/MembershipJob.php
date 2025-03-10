<?php

namespace App\Jobs;

use App\Helper\CalculateMembership;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class MembershipJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // tamame user ha ro begir ye method bezar bar asase levelhaye dakhele membership 30 rooz kharideshoon ro mohasebe kon

        $users = User::query()
            ->get();

        foreach ($users as $user) {
            CalculateMembership::calculate_membership($user);
        }
    }
}
