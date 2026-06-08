@extends('layouts.admin.layout')

@section('content')

{{-- <h2>Admin Dashboard</h2> --}}

<h1>App Data </h1>

@if(session()->get('success'))
    <div class="alert alert-success">
        {{ Session::get('success')}}
    </div>    
@endif

@if(session()->get('error'))
    <div class="alert alert-danger">
        {{ Session::get('error')}}
    </div>    
@endif


<form method="post" action="{{ route('admin.save')}}">
  @csrf
  <input type="hidden" name="id" value="{{ $appData->id }}">
  <div class="form-group">
    <label for="exampleInputEmail1">Logo First Name:</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="logo_first_name" value="{{ $appData->logo_first_name}}" placeholder="Logo First Name" aria-describedby="emailHelp">
    @error('logo_first_name')
        <span class="text-danger">{{ $message }}</span>
    @enderror
  </div>

   <div class="form-group">
    <label for="exampleInputEmail1">Logo Last Name:</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="logo_last_name" value="{{ $appData->logo_last_name}}" placeholder="Logo Last Name" aria-describedby="emailHelp">
    @error('logo_last_name')
        <span class="text-danger">{{ $message }}</span>
    @enderror
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Heading:</label>
    <textarea name="heading" cols="130" rows="5" > {{ $appData->heading }} </textarea>
    @error('heading')
        <span class="text-danger">{{ $message }}</span>
    @enderror
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Location:</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="location" value="{{ $appData->location}}" placeholder="Location" aria-describedby="emailHelp">
    @error('location')
        <span class="text-danger">{{ $message }}</span>
    @enderror
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Email: </label>
    <input type="email" class="form-control" id="exampleInputPassword1" name="email" value="{{ $appData->email}}" placeholder="email">
    @error('email')
        <span class="text-danger">{{ $message }}</span>
    @enderror
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Mobile: </label>
    <input type="text" class="form-control" id="exampleInputPassword1" name="mobile" value="{{ $appData->mobile}}" placeholder="mobile">
    @error('mobile')
        <span class="text-danger">{{ $message }}</span>
    @enderror
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">SiteName: </label>
    <input type="text" class="form-control" id="exampleInputPassword1" name="site_name" value="{{ $appData->site_name}}" placeholder="SiteName">
    @error('site_name')
        <span class="text-danger">{{ $message }}</span>
    @enderror
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Facebook Url: </label>
    <input type="text" class="form-control" id="exampleInputPassword1" name="facebook" value="{{ $appData->facebook}}" placeholder="Facebook Url">
    @error('facebook')
        <span class="text-danger">{{ $message }}</span>
    @enderror
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Twitter Url: </label>
    <input type="text" class="form-control" id="exampleInputPassword1" name="twitter" value="{{ $appData->twitter}}" placeholder="Twitter Url">
    @error('twitter')
        <span class="text-danger">{{ $message }}</span>
    @enderror
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Linkedin Url: </label>
    <input type="text" class="form-control" id="exampleInputPassword1" name="linkedin" value="{{ $appData->linkedin}}" placeholder="Linkedin Url">
    @error('linkedin')
        <span class="text-danger">{{ $message }}</span>
    @enderror
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Instagram Url: </label>
    <input type="text" class="form-control" id="exampleInputPassword1" name="instagram" value="{{ $appData->instagram}}" placeholder="Instagram Url">
    @error('instagram')
        <span class="text-danger">{{ $message }}</span>
    @enderror
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Youtube: </label>
    <input type="text" class="form-control" id="exampleInputPassword1" name="youtube" value="{{ $appData->youtube}}" placeholder="Youtube Url">
    @error('youtube')
        <span class="text-danger">{{ $message }}</span>
    @enderror
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Contact Touch: </label>
    <input type="text" class="form-control" id="exampleInputPassword1" name="contact_touch" value="{{ $appData->contact_touch}}" placeholder="Contact Touch">
    @error('contact_touch')
        <span class="text-danger">{{ $message }}</span>
    @enderror
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection