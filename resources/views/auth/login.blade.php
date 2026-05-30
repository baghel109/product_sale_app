@extends('layouts.frontend.layout')

@section('content')

   <div class="container mt-2">
    <div class="card">
        <div class="card-header text-center text-info">Login</div>
        <div class="card-body">

                @include('layouts.frontend.message')

                <form action="{{ route('login.save')}}" method="post">
                        @csrf
                                            
                        <div class="mb-3">
                            <label>Email:</label>
                            <input type="text" class="form-control" name="email" value="{{ old('email')}}" placeholder="Enter email"/>
                            @error('email')
                                <span class="text-danger" > {{ $message}}</span>
                            @enderror
                        </div>
                         
                        <div class="mb-3">
                            <label>Password:</label>
                            <input type="text" class="form-control" name="password" placeholder="Enter password"/>
                            @error('password')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div> 
                        <div>
                            <label></label>
                            <input type="submit" value="Login" class="btn btn-danger btn-xs" />
                        </div>
                </form>
        </div>
        <div class="card-footer">🙏 © 2026</div>
    </div>
</div>

@endsection