@extends("layouts.auth")
@section("style")
<style>
    html,
    body{
        height: 100%;
    }
    .form-signin{
        max-width: 330px;
        padding: 1rem
    }
    .form-signin .form-floating:focus-within{
        z-index: 2;
    }
    .form-signin input[type="email"]{
        border-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }
    .form-signin input[type="password"]{
        border-top-right-radius: 0;
        border-top-left-radius: 0;
    }
</style>

@section("content")
<main class="form-signin w-100 m-auto">
    <form method="POST" action="{{route("login.post")}}" >
        @csrf
        <img class="mb-4 " src="{{asset("assets/img/login.jpeg")}}" alt="" width="72" height="57"/>
        <h1 class="h3 mb-3 fw-normal">Please Sign in</h1>

        <div class="form-floating">
            <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput "> Email address</label>
            @error('email')
                <span class="text-denger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-floating" style="margin-bottom: 10px">
            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="password">
            <label for="floatingPassword "> Password</label>
            @error('password')
                <span class="text-denger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-check text-start my-3">
            <input type="checkbox" name="rememberme" class="form-ckeck-input" value="remember-me" id="flexCheckDefault">
            <label for="flexCheckDefault" class="form-check-lable"> Remember me</label>
        </div>
        @if(session()->has("success"))
            <div class="alert alert-success">
                {{session()->get("success")}}
            </div>
        @endif
        @if(session("error"))
            <div class="alert alert-dander">
                {{session("error")}}
            </div>
        @endif
            <button class="btn btn-primary w-100 py-2 " type="submit">
                Sign in
            </button>
            <a href="{{route('register')}}" class="text-center">Create new account </a>
            <p class="mt-5 mb-3 text-body-secondary"> &copy; 2017-2025</p>
    </form>
</main>
@endsection




