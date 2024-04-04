<?php

namespace App\Http\Controllers;
use App\Models\Orders; 
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\TempOrder;
use App\Models\OrderDetail;
use Illuminate\Support\Carbon;


class OrderController extends Controller
{

    // Function to display order form
    function index(){
        $products = Product::pluck('productName', 'productID');
        $customers = Customer::pluck('customerName', 'customerID');
        $data = DB::table('temp_order')
        ->join('product','temp_order.productID','=','product.productID')
        ->select('temp_order.*','product.productName')
        ->get();

        $maxOrderID = DB::table('orders')->max('id');

        // Increments purchaseID by 1
        $nextOrderID = $maxOrderID + 1;

        return view('orderform',compact('products', 'customers','data','nextOrderID'));
    }

    // Function to temporarily store order details into a cart when creating an order
    public function storeCart (Request $request){
        $maxid = DB :: table('orders')->max('id');
        $nextid = $maxid + 1;
        $tempOrder = new TempOrder();
        $tempOrder->orderID=$nextid;
        $tempOrder->productID = $request->input('products');
        $tempOrder->priceForEach = $request->input('price');
        $tempOrder->qty = $request->input('quantity');
        $tempOrder->save();
        return redirect()->back(); 
        
    }

    // Function to store order & order details into database

    public function store(Request $request)
    {
        $currentDate = Carbon ::now();

        // Creates order object
        $order = new Orders;

        $order->employeeID = 1;
        $order->customerID = (int)$request->input('customers');
        $order->orderDate = $currentDate->format('Y-m-d');
        $order->orderTotalPrice = (int) $request->input('totalPrice');
        $order->orderStatus = 'Ongoing';
        $order->notes = '';
        $order->save();
        $orderitems = DB::table('temp_order')->get();

        // Creates multiple order details objects 

        foreach($orderitems as $items){
            OrderDetail::create([
                'orderID' => $items->orderID,
                'productID'=> $items->productID,
                'qty'=> $items->qty,
                'priceForEach'=> $items->priceForEach
            ]);
        } 

        // Truncates temporary order details table

        TempOrder::truncate();

        return redirect()->back()->with('status', 'Order successfully added');

    }

    // Function to display order/sales list

    function show(){
        $orderData= Orders::all();
        return view('saleslist',['order'=> $orderData]);
    }

    // Function to display order details view

    function showDetails($orderID){
        $order = Orders::with('customer','employee')->where('id',$orderID)->first();
        return view('orderview',compact('order'));
    }

    // Function to remove a product from the temporary order details

    public function removeRow($id){
        $temporder = TempOrder::find($id);
        $temporder->delete();
        return redirect()->back();
    }

    // Function to delete an order

    function delete($orderID){
        $order = Orders::find($orderID);
        $order->orderDetails()->delete();
        if ($order->invoice()) {
            // Delete the associated invoice if exists
            $order->invoice()->delete();
        }
        $order->delete();
        return redirect()->back()->with('status','Order successfully deleted');
    }

    // Function to update orderStatus based on a dropdown selection

    public function updateStatus($orderID, Request $request){
        $order = Orders::find($orderID);

        $order->update([
            'orderStatus' => $request->orderstatus
        ]);

        return redirect()->back()->with('status','Order status updated successfully');
    }


    }
