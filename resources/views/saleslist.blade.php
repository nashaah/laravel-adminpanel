@php
    use Carbon\Carbon;
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">


    <title>PT SIS | Order List</title>
</head>

<body>

    @include('navbar')

    @if(session('status'))
    <div class="statusmessage">
        <i class="fa-solid fa-circle-info"></i>{{session('status')}}
    </div>
    @endif
    <h1>Sales Order List</h1>

    <table id="myTable" class="content-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer ID</th>
                <th>Employee ID</th>
                <th>Order Date</th>
                <th>Order Total Price</th>
                <th>Order Status</th>
                <th>Action</th>
        </thead>
        <tbody>

            @foreach ($order as $order)

            <tr>

                <td>{{$order['id']}}</td>
                <td>{{$order['customerID']}}</td>
                <td>{{$order['employeeID']}}</td>
                <td>{{ \Carbon\Carbon::parse($order['orderDate'])->format('d-m-Y') }}</td>
                <td>Rp.{{ number_format($order['orderTotalPrice'], 0, ',', '.') }}</td>
                <td>{{$order['orderStatus']}}</td>
                <td><a href="{{url('orderlist/' . $order->id)}}" class="action-icon view"><i class='fa-solid fa-eye' title='View'></i></a>
                <a href="{{url('removeorder/' . $order->id)}}" class="action-icon delete"><i class='fa-solid fa-trash' title='Delete'></i></a>
                </td>
            </tr>
            @endforeach

        </tbody>

    </table>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script>
        let table = new DataTable('#myTable');
    </script>

</body>

</html>