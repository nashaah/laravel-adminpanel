<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderDetail;
use App\Models\Orders;
use App\Models\Product;
use App\Models\Invoice;
use Carbon\Carbon;
use App\Models\Payment;
use App\Models\Purchase;
use DB;

class DashboardController extends Controller
{

    // Function to display the dashboard view
    public function index()
    {
        return view('dashboard');
    }

    // Function to retrieve data for the dashboard

    function showDashboard(){

        $ongoingOrdersCount = Orders::where('orderStatus', 'Ongoing')->count();
        $ongoingPurchasesCount = Purchase::where('purchaseStatus', 'Ongoing')->count();


        $orderData= Orders::orderBy('id', 'desc')->take(3)->get();

        $bestProducts = OrderDetail::select('product.productName', DB::raw('SUM(orderdetail.qty) as totalSales'))
        ->join('product','orderdetail.productID','=','product.productID')
        ->groupBy('orderdetail.productID','product.productName')
        ->orderByDesc('totalSales')
        ->take(3)
        ->get();

        $paidInvoicesCount = Invoice::where('paidStatus', 'Paid')->count();
        $unpaidInvoicesCount = Invoice::where('paidStatus', 'Unpaid')->count();
        $totalRevenue = Payment::sum('amount');

        return view('dashboard', ['orderData' => $orderData, 'bestProducts' => $bestProducts, 'paidInvoicesCount' => $paidInvoicesCount, 'unpaidInvoicesCount' => $unpaidInvoicesCount, 'totalRevenue' => $totalRevenue, 'ongoingOrdersCount' => $ongoingOrdersCount, 'ongoingPurchasesCount' => $ongoingPurchasesCount,]);
    }

}
