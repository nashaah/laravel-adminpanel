<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

use App\Models\Product;
use App\Models\Location;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\TempPurchase;

class PurchaseController extends Controller
{

    // Function to display purchase form

    function index()
    {
        //Takes all products & locations to display in purchase form
        $products = Product::pluck('productName', 'productID');
        $locations = Location::pluck('locationName', 'locationID');

        // Gets the ID of the most recent purchase

        $maxPurchaseID = DB::table('purchaseorder')->max('id');

        // Increments purchaseID by 1
        $nextPurchaseID = $maxPurchaseID + 1;

        //Sets first location as default
        $selectedLocationID = $locations->first();

        // Joins the temporary & products table

        $data = DB::table('temp_purchase')
            ->join('product', 'temp_purchase.productID', '=', 'product.productID')
            ->select('temp_purchase.*', 'product.productName')
            ->get();

        //Redirects to the purchaseform view while also bringing along the previous values
        return view('purchaseform', compact('products', 'locations', 'selectedLocationID', 'nextPurchaseID', 'data'));
    }

    // Function to display purchase list

    function show()
    {

        $purchaseData = DB::table('purchaseorder')
            ->join('location', 'purchaseorder.locationID', '=', 'location.locationID')
            ->select('purchaseorder.*', 'location.locationName')
            ->get();
        return view('purchaselist', ['purchase' => $purchaseData]);
    }

    // Function to display purchase details view
    function showDetails($purchID)
    {
        $purchase = Purchase::with('location')->where('id', $purchID)->first();

        return view('purchaseview', compact('purchase'));
    }

    // Function to insert new purchase & purchase details

    public function store(Request $request)
    {

        // Get current date
        $currentDate = Carbon::now();

        // Create purchase object
        $purchase = new Purchase;

        // Insert values for each attributes
        $purchase->locationID = (int) $request->input('locationID');
        $purchase->purchaseDate = $currentDate->format('Y-m-d');

        $purchase->totalPrice = (int) $request->input('totalPrice');

        // Adds 60 days to current date to get expected arrival date
        $expectedArrivalDate = $currentDate->addDays(60)->format('Y-m-d');

        $purchase->expectedArrival = $expectedArrivalDate;
        $purchase->purchaseStatus = 'Ongoing';

        // Store values in purchaseorder table in MySQL database
        $purchase->save();

        // Store each purchase item as a purchaseorderdetail in MySQL database

        $purchaseitems = DB::table('temp_purchase')->get();

        foreach ($purchaseitems as $item) {
            PurchaseDetail::create([
                'purchaseOrderID' => $item->purchaseOrderID,
                'productID' => $item->productID,
                'qty' => $item->qty,
                'priceForEach' => $item->priceForEach
            ]);
        }

        // Removes all entries in temporary purchase table

        TempPurchase::truncate();

        // Returns with confirmation message
        return redirect()->back()->with('status', 'Purchase successfully added');
    }

    // Temporarily store purchase products into a cart
    public function storeCart(Request $request)
    {
        //Gets highest purchaseID
        $maxPurchaseID = DB::table('purchaseorder')->max('id');

        // Increments purchaseID by 1
        $nextPurchaseID = $maxPurchaseID + 1;

        // Creates temporary purchase detail object

        $temppurchase = new TempPurchase();

        $temppurchase->purchaseOrderID = $nextPurchaseID;
        $temppurchase->productID = $request->input('products');
        $temppurchase->qty = $request->input('quantity');
        $temppurchase->priceForEach = $request->input('price');

        $temppurchase->save();

        return redirect()->back();

    }

    // Removes records from the temporary purchase table
    public function removeRow($id)
    {
        $temppurchase = TempPurchase::find($id);
        $temppurchase->delete();
        return redirect()->back();
    }

    // Function to delete purchase & its corresponding purchase details

    public function delete($purchID){
        $purchase = Purchase::find($purchID);

        $purchase->purchaseDetails()->delete();
        $purchase->delete();

        return redirect()->back()->with('status','Purchase successfully deleted.');
    }

    // Function to update status of purchase
    public function updateStatus($purchID, Request $request){
        $purchase = Purchase::find($purchID);

        $purchase->update([
            'purchaseStatus' => $request->purchasestatus
        ]);

        return redirect()->back()->with('status','Purchase status updated successfully');
    }


}
