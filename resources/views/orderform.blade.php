<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="{{ asset('css/orderform.css') }}">
   <title>PT SIS | Order Form</title>
</head>

<body>
   @include('navbar');

   @if(session('status'))
   <div class="statusmessage">
      <i class="fa-solid fa-circle-info"></i>{{session('status')}}
   </div>
   @endif

   <main class="content">
      <div class="everything">
         <div class="titletext">
            <h1 class="OrderForm">Order Form</h1>
            <h3 class="OrderID">Order ID<span class="idnum" id="idnum">{{ $nextOrderID }}</span></h3>
         </div>
         <div class="ordercontent">
            <div class="addorder">
               <form action="{{ route('order.cart') }}" method="POST">
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

                  <label for="leftbox">Price of Each</label>
                  <input type="number" id="price" name="price" min="1000">

                  <button class="AddtoOrder" type="submit">Add To Order</button>
               </form>
            </div>
            <div class="rightside">
               <div class="summarytable">
                  <h3 class="summary">Summary</h3>
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
                        <td><a href="{{ url('deletes/'.$data->id) }}"><i class='fa-solid fa-trash'
                                 title='Delete'></i></a></td>
                     </tr>
                     @endforeach

                  </table>
                  <form method="POST" action="{{ route('order.store') }}" id="orderForm">
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
               <div class="bottom">
                  <label for="customerID">Customer Name</label>
                  <select name="customers" id="customer">
                     <option value="" selected disabled>Select a Customer</option>
                     @foreach ($customers as $customerID => $customerName)
                     <option value="{{ $customerID }}">{{ $customerName }}</option>
                     @endforeach
                  </select>
                  <button class="CreateOrder">Create Order</button>
               </div>
            </div>
            </form>
         </div>
   </main>

   <script src="{{ asset('js/table.js') }}"></script>
</body>

</html>