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
    <title>PT SIS | View Purchase</title>
</head>

<body>

    @include('navbar')

    @if(session('status'))
    <div class="statusmessage">
        <i class="fa-solid fa-circle-info"></i>{{session('status')}}
    </div>
    @endif

    <main class="content">
        <p class="back"><a href="{{ route('view.purchase') }}"><i
                    class="fa-solid fa-arrow-left"></i><span>Back</span></a></p>


        <h1>Purchase Order Detail #<span class="idnum">{{$purchase->id}}</span></h1>

        <div class="addinfo">
            <div class="left">
                <h3>Purchase Date: <span class="infodetail">{{
                        \Carbon\Carbon::parse($purchase->purchaseDate)->format('d-m-Y') }}</span></h3>
                <h3>Expected Arrival Date: <span class="infodetail">{{
                        \Carbon\Carbon::parse($purchase->expectedArrival)->format('d-m-Y') }}</span></h3>
                <h3>Location: <span class="infodetail">{{$purchase->location->locationName}}</span></h3>
                <h3>Total: <span class="infodetail">Rp.{{ number_format($purchase->totalPrice, 0, ',', '.') }}</span>
                </h3>
            </div>
            <div class="right">
                <form action="{{url('purchaselist/' . $purchase->id)}}" method="POST" class="statusform">
                    @csrf
                    @method('PUT')
                    <div class="statusinfo">
                        <h3>Current Status<span class="infodetail">{{$purchase->purchaseStatus}}</span></h3>
                    </div>
                    <div class="statusupdate">
                        <label for="purchasestatus">Change Status</label>
                        <select name="purchasestatus" id="statusupdate">
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
                @foreach ($purchase->purchaseDetails as $purchaseItem)
                <tr>
                    <td width=10%>{{$purchaseItem->productID}}</td>
                    <td>{{$purchaseItem->product->productName}}</td>
                    <td>Rp.{{ number_format($purchaseItem->priceForEach, 0, ',', '.') }}</td>
                    <td width=10%>{{$purchaseItem->qty}}</td>
                    <td>Rp.{{number_format($purchaseItem->priceForEach * $purchaseItem->qty, 0,',','.')}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </main>

</body>

</html>