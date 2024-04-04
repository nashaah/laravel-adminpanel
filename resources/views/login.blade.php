<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT SIS | Login</title>
    <link rel="icon" type="image/x-icon" href="../../public/images/logo.png">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <div class="loginbg">
        <div class="loginbg-overlay"></div>
        <div class="loginicons">
            <img src="https://www.federaloil.co.id/themes/web/desktop2020/img/fo-logo-2021-tm-512-a.png?v=697"
                alt="Federal Oil" class="brand">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ae/Repsol_company_logo.svg/927px-Repsol_company_logo.svg.png"
                alt="Repsol" class="brand">
        </div>
        <h1>Authorized Solution Partner</h1>
    </div>

    <div class="rightside">
        @if($errors->any())
        <div class="error-message">
            {{ $errors->first() }}
        </div>
        @endif

        <h1>Login</h1>
        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            <label for="employeeID">Employee ID</label>
            <input type="text" maxlength="2" placeholder="Ex: 1" name="employeeID" required autocomplete="off">
            <label for="password">Password</label>
            <input type="password" name="password" required>
            <label for="remember" class="remember-section">
                <input type="checkbox" name="rememberme" class="checkremember">Remember Me
            </label>
            <button type="submit">Log In</button>
        </form>

    </div>

</body>

</html>