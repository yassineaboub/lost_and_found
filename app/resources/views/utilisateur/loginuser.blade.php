<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
   @include('index.head')
</head>
<body class="login">
	<div class="container">
			
		<div class="d-flex justify-content-center h-100">
			<div class="card">
					
				<div class="card-header">
					<h3>Sign In</h3>
					@if (session('error'))
					<div class="alert alert-danger">
					  {{ session('error') }}
					   </div>
					   @endif
				</div>
				<div class="card-body">
					<form method="POST" enctype="multipart/form-data" action="{{ url('authuser') }}">
						@csrf
						<div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" name="email" class="form-control" placeholder="username">
							
						</div>
						<div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" name="mdp" class="form-control" placeholder="password">
						</div>
						<div class="row align-items-center remember">
							<input type="checkbox">Remember Me
						</div>
						<div class="form-group">
							<input type="submit" value="Login" class="btn float-right login_btn">
						</div>
					</form>
				</div>
				<div class="card-footer">
					<div class="d-flex justify-content-center links">
						Don't have an account?<a href="{{route('utilisateur.index')}}">Sign Up</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	</body>
	</html>