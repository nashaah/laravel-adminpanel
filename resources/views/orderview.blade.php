@php
use Carbon\Carbon;
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/viewdetails.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>PT SIS | View Order</title>
</head>

<body>

    @include('navbar')

    @if(session('status'))
    <div class="statusmessage">
        <i class="fa-solid fa-circle-info"></i>{{session('status')}}
    </div>
    @endif

    <main class="content">
        <p class="back"><a href="{{ route('view.order') }}"><i class="fa-solid fa-arrow-left"></i><span>Back</span></a>
        </p>


        <h1>Customer Order Detail #<span class="idnum">{{$order->id}}</span></h1>

        <div class="addinfo">
            <div class="left">
                <h3>Order Date: <span class="infodetail">{{ \Carbon\Carbon::parse($order->orderDate)->format('d-m-Y')
                        }}</span></h3>
                <h3>Customer: <span class="infodetail">{{$order->customer->customerName}}</span></h3>
                <h3>Employee-in-Charge: <span class="infodetail">{{$order->employee->employeeName}}</span></h3>
                <h3>Total: <span class="infodetail">Rp.{{ number_format($order->orderTotalPrice, 0, ',', '.') }}</span>
                </h3>
            </div>
            <div class="right">

                <form action="{{url('orderlist/' . $order->id)}}" method="POST" class="statusform">
                    @csrf
                    @method('PUT')
                    <div class="statusinfo">
                        <h3>Current Status<span class="infodetail">{{$order->orderStatus}}</span></h3>
                    </div>
                    <div class="statusupdate">
                        <label for="orderstatus">Change Status</label>
                        <select name="orderstatus" id="statusupdate">
                            <option value="Ongoing">Ongoing</option>
                            <option value="Finished">Finished</option>
                            <option value="Cancelled">Cancelled</option>
                        </select>
                    </div>
                    <button type="submit">Update</button>
                </form>
            </div>
        </div>
        <table class="summarytable">
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->orderDetails as $item)
                <tr>
                    <td width=10%>{{$item->productID}}</td>
                    <td>{{$item->product->productName}}</td>
                    <td>Rp.{{ number_format($item->priceForEach, 0, ',', '.') }}</td>
                    <td width=10%>{{$item->qty}}</td>
                    <td>Rp.{{number_format($item->priceForEach * $item->qty, 0,',','.')}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </main>

</body>

</html>