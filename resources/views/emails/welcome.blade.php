<!DOCTYPE html>
<html>
<head>
	<title>welcome</title>
</head>
<body>
<h2>Welcome {{ $user->name }}</h2>

<p>Your account has been created successfully.</p>

<p>Email: {{ $user->email }}</p>
<p>Password: {{ $password }}</p>

</body>
</html>