<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/navigation.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<!-- Navigation bar -->
<nav>
    <ul>
        <li>
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/logowhitesis.png') }}" alt="" class="logo">
            </a>
        </li>
        <li>
            <a href="{{ route('home') }}" class="navlink"><i class="fa fa-house"></i><span class="nav-item">Home</span></a>
        </li>
        <li>
            <a href="{{ route('make.order') }}" class="navlink"> <i class="fa fa-file-lines"></i><span class="nav-item">Make Order</span></a>
        </li>
        <li>
            <a href="{{ route('view.order') }}" class="navlink"><i class="fa-solid fa-truck"></i><span class="nav-item">Order List</span></a>
        </li>
        <li>
            <a href="{{ route('make.purchase') }}" class="navlink"><i class="fa-solid fa-cart-shopping"></i><span class="nav-item">Make
                    Purchase</span></a>
        </li>
        <li>
            <a href="{{ route('view.purchase') }}" class="navlink"><i class="fa-solid fa-tag"></i><span class="nav-item">Purchase List</span></a>
        </li>
        <li>
            <a href="{{ route('logout') }}" class="navlink"><i class="fa-solid fa-right-from-bracket"></i><span class="nav-item">Log Out</span></a>
        </li>
        <li>
            <a href="#" class="profile">
                <i class="fa-regular fa-circle-user"></i>
                <div class="profiletext">
                    <span class="emp-name">
                        @if(isset($employee))
                        {{ $employee->employeeName }}
                        @endif
                    </span>
                    <span class="emp-role">
                        @if(isset($employee))
                        {{ $employee->employeeDivision }}
                        @endif
                    </span>
                </div>
            </a>
        </li>
    </ul>
</nav>

</html>