@extends('layouts.frontend.layout')

@section('content')

   <div class="container mt-2">
    <div class="card">
        <div class="card-header text-center text-info">Reset Password</div>
        <div class="card-body">

                @include('layouts.frontend.message')

                {{-- {{ $user }} --}}
                <form action="{{ route('resetPassword', $token)}}" method="post">
                        @csrf
                                            
                        <div class="mb-3">
                            <input type="hidden" name="id" value="{{ $user->id }}" />
                            <label>Password:</label>
                            <input type="text" class="form-control" name="password" value="{{ old('password')}}" placeholder="Enter password"/>
                            @error('password')
                                <span class="text-danger" > {{ $message}}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label>Confirm Password:</label>
                            <input type="text" class="form-control" name="confirmation_password" value="{{ old('confirmation_password')}}" placeholder="Enter confirm password"/>
                            
                        </div>
                         
                        <div>
                            <label></label>
                            <input type="submit" value="Update Password" class="btn btn-info btn-xs" />
                        </div>
                </form>

                
        </div>
        <div class="card-footer">🙏 © 2026</div>
    </div>
</div>

@endsection