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
        <div class="summary">
            <div class="top">
            <div class="ordertable">
                <div class="ordertitle">
                    <h2>Recent Orders</h2>
                    <a href="{{ route('view.order') }}">View all</a>
                </div>
                <table class="Order List">
                    <tr>
                        <th>Order ID</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Amount</th>
                    </tr>
                    @foreach ($orderData as $order)
                    <tr class="tablerow">
                        <td>{{$order['id']}}</td>
                        <td>{{$order['customerID']}}</td>
                        <td>{{$order['orderStatus']}}</td>
                        <td>{{$order['orderDate']}}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
            <div class="bestsellers">
                <h2>Best-Selling</h2>
                <table class="besttable">
                    <tr>
                        <th class="ProductName">Product Name</th>
                        <th class="TotalSales">Sold</th>
                    </tr>
                    @foreach ($bestProducts as $product)
                    <tr class="tablerow">
                        <td class="ProductName">{{ $product->productName }}</td>
                        <td class="TotalSales">{{ $product->totalSales }}</td>
                    </tr>
                    @endforeach
                </table>
                </div>
            </div>
            <div class="bottom">
            <div class="info">
                <h2>Paid Invoice</h2>
                <h3>{{ $paidInvoicesCount }}</h3>
            </div>
            <div class="info">
                <h2>Unpaid Invoice</h2>
                <h3>{{ $unpaidInvoicesCount }}</h3>
            </div>
            <div class="info">
                <h2>Total Revenue</h2>
                <h3 class="rev">Rp.{{ number_format($totalRevenue, 0, ',', '.') }}</h3>

            </div>
            <div class="info">
                <h2>Current Orders</h2>
                <h3>{{ $ongoingOrdersCount }}</h3>
            </div>
            <div class="info">
                <h2>Current Purchases</h2>
                <h3>{{ $ongoingPurchasesCount }}</h3>
            </div>
            </div>
        </div>
    </main>
</body>

</html>