<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PT SIS | Make Purchase</title>
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
</head>

<body>
    @include('navbar')

    @if(session('status'))
    <div class="statusmessage">
        <i class="fa-solid fa-circle-info"></i>{{session('status')}}
    </div>
    @endif

    <main class="content">

        <div class="formcontent">
            <div class="titletext">
                <h1>Purchase Form</h1>
                <form action="" method="post">
                    @csrf
                    <h3>Purchase ID<span class="idnum" id="idnum">{{ $nextPurchaseID }}</span></h3>
                    <input type="hidden" name="purchaseID" id="hiddenPurchaseID" value="1">
                </form>
            </div>
            <div class="tablecontent">
                <div class="leftside">
                    <form action="{{ route('purchase.cart') }}" method="POST" class="productform">
                        @csrf
                        <label for="productID">Product Name</label>
                        <select name="products" id="product">
                            <option value="" selected disabled>Select a Product</option>
                            @foreach ($products as $productID => $productName)
                            <option value="{{ $productID }}">{{ $productName }}</option>
                            @endforeach
                        </select>
                        <label for="quantity">Quantity</label>
                        <input type="number" id="quantity" name="quantity" min="1">
                        <label for="price">Price of Each (Rp)</label>
                        <input type="number" id="price" name="price" min="1000">
                        <button class="addbtn" type="submit">Add to Purchase</button>
                    </form>
                </div>
                <div class="rightside">
                    <div class="calculation">
                        <h3>Summary</h3>
                        <table class="summarytable" id="summarytable">
                            <tr>
                                <th>Product ID</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                                <th>Action</th>
                            </tr>
                            @foreach($data as $data)
                            <tr>
                                <td>{{$data->productID}}</td>
                                <td>{{$data->productName}}</td>
                                <td>{{$data->priceForEach}}</td>
                                <td>{{$data->qty}}</td>
                                <td class="subtotal">{{$data->priceForEach * $data->qty}}</td>
                                <td><a href="{{ url('delete/'.$data->id) }}"><i class='fa-solid fa-trash'
                                            title='Delete'></i></a></td>
                            </tr>
                            @endforeach

                        </table>
                        <form method="POST" action="{{ route('purchase.store') }}" id="purchaseForm">
                            @csrf
                            <div class="fullsummary">
                                <div class="tablesummary">
                                    <p>Shipping Fee<span>Rp. 150,000</span></p>
                                    <p>Tax<span>11%</span>
                                    <p>Other<span>Rp. 30,000</span></p>
                                </div>
                                <div class="finalprice">
                                    <p>Expected Price<span id="currency">Rp. </span><span id="expectedPrice">0</span>
                                    </p>
                                    <input type="hidden" name="totalPrice" id="hiddenTotalPrice" value="0">
                                </div>
                            </div>
                    </div>

                    <div class="rightcol2">
                        <div class="locationinput">
                            <label for="location">Location</label>
                            <select name="locationID" id="location">
                                <option value="" selected disabled>Select a Location</option>
                                @foreach ($locations as $locationID => $locationName)
                                <option value="{{ $locationID }}">{{ $locationName }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button class="purchasebtn" type="submit" id="purchasebtn">Create Purchase</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="{{ asset('js/table.js') }}"></script>
</body>

</html>