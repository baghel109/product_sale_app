<!doctype html>
<html lang="en">
  <head>
  	<title>{{ env('APP_NAME') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
  </head>
  <body>
		
		<div class="wrapper d-flex align-items-stretch">
			@include('layouts.admin.navbar')

        <!-- Page Content  -->
		  <div id="content" class="p-4 p-md-5 pt-5">
            @yield('content')
          </div>
		</div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    {{-- <script src="{{ asset('admin/js/jquery.min.js') }}"></script> --}}
    <script src="{{ asset('admin/js/main.js') }}"></script>
  </body>
</html>