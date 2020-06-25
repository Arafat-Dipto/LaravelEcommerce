<!doctype html>
<html lang="en">

<body>
<p>Verify your account: <a href=" {{ url('/verify/'.$token )}}">Click here</a></p>
<p>localhost:8000/verify/{{ $token }}</p>
</body>
</html>