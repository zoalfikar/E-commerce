<?php

namespace App\Listeners;

use App\Events\UserComplain;
use App\Mail\complain;
use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SendMessegeToAdmins
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UserComplain $event)
    {

        DB::table('complains')->insert([

            'user_id'=>Auth::id(),
            'prod_id'=>$event->prod_id,
            'complain'=>$event->complain
        ]);
        $admins=DB::table('users')->select('email')->where('role_as','1')->get();
        $user=User::find(Auth::id());
        $product=Product::find($event->prod_id);
        foreach ($admins as $admin)
        {
            Mail::to($admin->email)->send(new complain($user->name,$product->name,$event->complain));
        }

    }
}
