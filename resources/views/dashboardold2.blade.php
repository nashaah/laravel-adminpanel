
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <title>PT SIS | Dashboard</title>
</head>

<body>
    @include('navbar')
    <main class="content">
        <h1>Dashboard</h1>

        {{dd($monthCounts)}}
        {{dd($months)}}
</main>

</body>
</html>