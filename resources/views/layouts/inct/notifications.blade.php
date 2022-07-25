<div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fa fa-bell" aria-hidden="true"></i>
    </button>
    <ul class="dropdown-menu notifications" aria-labelledby="dropdownMenuButton1">
        @forelse (Auth::user()->notifications as $notification)
            @switch($notification->type)
                @case("App\Notifications\StoreCreated")
                    <li><a class="dropdown-item float-start" href="{{url('/storeDetails/'.$notification->data['store_slug'])}}">{{$notification->data['owner_name']}} has created new store </a>
                        @if (! isActiveStore($notification->data['store_slug'])==1|| !isActiveStore($notification->data['store_slug'])==2)
                            <button class="btn btn-success float-end activeStore" value="{{$notification->data['store_slug']}}">active</button><button class="btn btn-primary float-end deletStore" value="{{$notification->data['store_slug']}}">delet</button></li>
                        @endif
                    @break
                @case(2)
                    @break
                @default
                <li><a class="dropdown-item" href="#">another notifications</a></li>
            @endswitch
        @empty
            <li><a class="dropdown-item" href="#">no notifications</a></li>
        @endforelse
</div>
