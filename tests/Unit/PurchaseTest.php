<?php

namespace Tests\Unit;
use Tests\TestCase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use App\Models\PurchaseDetail;
use App\Models\Purchase;
use App\Models\TempPurchase;
use Illuminate\Foundation\Testing\DatabaseTransactions;


class PurchaseTest extends TestCase
{
    use DatabaseTransactions;
    // Test to check if the POST HTTP Request for creating purchase functions well
    public function test_stores_new_purchase()
    {
        // Create mockups of the classes
        $this->mock(TempPurchase::class);
        $this->mock(Purchase::class);
        $this->mock(PurchaseDetail::class);
        $currentDate = Carbon::now();

        // Starts mock session
        config(['session.driver' => 'array']);
        Session::start();
        session(['employeeID' => 1]);

        // Creates fake inputs within the session
        $response = $this->post('/createpurchase', [
            'locationID' => 1,
            'purchaseDate'=>$currentDate->format('Y-m-d'),
            'totalPrice'=>123000,
            'expectedArrival'=>$currentDate->addDays(60)->format('Y-m-d'),
            'purchaseStatus'=>'Ongoing'
        ]);

        // Asserting that the response is successful
        $response->assertRedirect()->assertSessionHas('status', 'Purchase successfully added');

        // Ends the session
        dump(session()->all());

    }
}
