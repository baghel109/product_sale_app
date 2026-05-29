@extends('layouts.frontend.layout')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@29.0.3/dist/js/intlTelInput.min.js"></script>
<div class="container mt-2">
    <div class="card">
        <div class="card-header text-center text-info">Register</div>
        <div class="card-body">

                @include('layouts.frontend.message')

                <form action="{{ route('register.save')}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label>Name:</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name')}}" placeholder="Enter name"/>
                            @error('name')
                                <span class="text-danger" >Name is required</span>
                            @enderror
                        </div>                        
                        <div class="mb-3">
                            <label>Email:</label>
                            <input type="text" class="form-control" name="email" value="{{ old('email')}}" placeholder="Enter email"/>
                            @error('email')
                                <span class="text-danger" > {{ $message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Phone:</label>
                            <input type="text" class="form-control" name="phone_number" value="{{ old('phone_number')}}"placeholder="Enter phone"/>
                            @error('phone_number')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Password:</label>
                            <input type="text" class="form-control" name="password" placeholder="Enter password"/>
                            @error('password')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Confirm Password:</label>
                            <input type="text" class="form-control" name="password_confirmation" placeholder="Enter confirm password"/>
                            @error('password_confirmation')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div>
                            <label></label>
                            <input type="submit" value="Register" class="btn btn-danger btn-xs" />
                        </div>
                </form>
        </div>
        <div class="card-footer">🙏 © 2026</div>
    </div>
</div>
@endsection