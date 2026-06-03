@extends('layouts.frontend.layout')

@section('content')

   <div class="container mt-2">
    <div class="card">
        <div class="card-header text-center text-info">Forgot Password</div>
        <div class="card-body">

                @include('layouts.frontend.message')

                <form action="{{ route('forgotPassword')}}" method="post">
                        @csrf
                                            
                        <div class="mb-3">
                            <label>Email:</label>
                            <input type="text" class="form-control" name="email" value="{{ old('email')}}" placeholder="Enter email"/>
                            @error('email')
                                <span class="text-danger" > {{ $message}}</span>
                            @enderror
                        </div>
                         
                        <div>
                            <label></label>
                            <input type="submit" value="Forgot Password" class="btn btn-danger btn-xs" />
                        </div>
                </form>

                
        </div>
        <div class="card-footer">🙏 © 2026</div>
    </div>
</div>

@endsection