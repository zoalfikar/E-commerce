<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\wishlist;
use App\Notifications\HaveItemInWishlist;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification as FacadesNotification;

class ItemInWishlist implements ShouldQueue
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
        // $items = 'COUNT(prod_id)';
        // $users = ::selectRaw("user_id as id, {$items} as items")->groupBy('user_id')->get() ;

        $usersItemsInWishlists=wishlist::select('user_id')->where('created_at','<',now()->subDays(30))->get()->toArray();
        $users=User::whereIn ('id' , $usersItemsInWishlists)->get();
        foreach ($users as $user ) {
            $user->notify(new HaveItemInWishlist(count($user->wishlist)));
            // FacadesNotification::send($user->id, new HaveItemInWishlist($user->items));
        }

    }
}
