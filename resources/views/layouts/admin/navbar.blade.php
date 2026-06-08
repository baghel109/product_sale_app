<nav id="sidebar">
				<div class="custom-menu">
					<button type="button" id="sidebarCollapse" class="btn btn-primary">
					  <i class="fa fa-bars"></i>
					  <span class="sr-only">Toggle Menu</span>
					</button>
				</div>
					<h1><a href="index.html" class="logo">Hi {{ Auth::user()->name }}</a></h1>
				<ul class="list-unstyled components mb-5">
				  <li class="active">
					<a href="{{ route('admin.dashboard')}}"><span class="fa fa-home mr-3"></span> App Data</a>
				  </li>
				  <li>
					  <a href="{{ route('admin.menus')}}"><span class="fa fa-user mr-3"></span> Menu</a>
				  </li>
				  <li>
					  <a href="{{ route('admin.categories')}}"><span class="fa fa-user mr-3"></span> Categories</a>
				  </li>
				  <li>
				</ul>

			</nav>