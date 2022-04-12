<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Http\Requests\StoreMemberRequest;
use App\Models\Payment;
use Carbon\Carbon;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Member::all();
        return response()->json($members);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMemberRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMemberRequest $request)
    {
        $newMember = new Member();
        $newMember->fill($request->all());
        $newMember->save();
        return response()->json($newMember);
    }

    public function pay(int $id) {
        $newPayment = new Payment();
        $newPayment->member_id = $id;
        $newPayment->amount = 5000;
        $newPayment->paid_at = Carbon::now();

        if (Member::where('id', '=', $id)->count() <= 0) {
            return response()->json([
                'message' => 'A Member was not found with this id!'
            ], 404);
        }
        /*$csekkolandoPayment = Payment::where('member_id', '=', $id)->get();
        if (Payment::where('member_id', '=', $id)->count() >= 1 && $csekkolandoPayment->paid_at->floatDiffInDays(Carbon::now()) <= 30) {
            return response()->json([
                'message' => 'The member in question has made a payment in the last 30 days!'
            ], 409);
        }*/
        $newPayment->save();
        return response()->json($newPayment);
    }
}
