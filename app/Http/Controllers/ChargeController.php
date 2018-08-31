<?php

namespace App\Http\Controllers;

use App\Charge;
use App\Shipment;
use Illuminate\Http\Request;
use Auth;

class ChargeController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $charge = new Charge;
        $charge->branch = $request->schedule['branch_name'];
        $charge->branch_id = $request->schedule['id'];
        $charge->charge = $request->form['charges'];
        $charge->total = $request->form['total'];
        $charge->vat = $request->form['vat'];
        $charge->user_id = Auth::id();
        $charge->save();
        return $charge;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\vat  $charge
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $charge = Charge::find($id);
        $charge->branch = $request->schedule['branch_name'];
        $charge->branch_id = $request->schedule['id'];
        $charge->charge = $request->form['charge'];
        $charge->total = $request->form['total'];
        $charge->vat = $request->form['vat'];
        $charge->user_id = Auth::id();
        $charge->save();
        return $charge;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Charge  $charge
     * @return \Illuminate\Http\Response
     */
    public function destroy(Charge $charge)
    {
        //
    }

    public function shipCharge(Request $request, $id)
    {
        // return $request->all();
        $shipment = Shipment::find($id);
        $charges = $request->select['charges'];
        // return $charges->charge;
        foreach ($charges as $value) {
            $charge = $value['charge'];
        }
        // return $charge;
        $shipment->charges = $charge;
        $shipment->save();
        return $shipment;
    }

    public function getCharges()
    {
        return Charge::all();
    }
}
