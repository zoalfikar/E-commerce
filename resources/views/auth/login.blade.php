@extends('layouts.app')

@section('content')

@php
$hasTooManyAttemps = false;
foreach ($errors->all() as  $error)
{
   if (str_contains($error, 'Too many login attempts')) { $hasTooManyAttemps=true;  $timer= (int)substr($error,24,3); break;};
}
@endphp

@if ($hasTooManyAttemps)
 <center> <div id="count-down">{{$timer}}</div> </center>
@endif

<div class="container">
    <div class="row justify-content-center">
   <center> <div id="active-users">active users on website : {{$activeUsers}}</div> </center>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @if (!$hasTooManyAttemps)
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>


$(function(){
            let ip_adress = '127.0.0.1';
            let socket_port = '3000';
            let socket = io(ip_adress+ ':'+ socket_port);

            socket.on('sendToClinet1',(message)=>
            {
                $("#active-users").html("active users on website :"+message.data.active_user);

            });
        });


</script>

{{-- timmer count down --}}
<script>



    let time = parseInt(document.getElementById('count-down').innerHTML);
    const decay =  setInterval( countDown , 1000);

    const countDownVal = document.getElementById('count-down');

    function countDown() {
        if (time == 0) {
            clearInterval(decay);
            countDownVal.innerHTML = "" ;
        }
      let  minutes =Math.floor(time / 60 ) ;
      let seconds = time % 60 ;
      countDownVal.innerHTML = " retry after " + minutes + ":" + seconds ;
      time --;
    }

</script>
@endsection
