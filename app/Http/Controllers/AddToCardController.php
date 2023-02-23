<?php

namespace App\Http\Controllers;

use App\Models\ManageBook;
use Illuminate\Http\Request;

class AddToCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // session()->forget('buyBookCard');
        $buyBookCard = session()->get('buyBookCard');
        $carts=[];
        $sum=0;
        $n=0;
        
        if (session()->has('buyBookCard')) {
            foreach ($buyBookCard as $key => $card_arr) {
                foreach ($card_arr as $quantity_key => $quantity_val) {
                    $carts[] = ManageBook::find($key);
                    $sum+=$carts[$n]->price;
                    $carts[$n]['cart_quantity']=$quantity_val;
                }
                $n++;
            } 
        }

        // return count($carts);
        return view('add-to-card.card',compact('carts','sum'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = $request->id;
        $quantity = $request->quantity ?? '1';
        $noOfItems =0;
        $msg ='already added';
        if (!ManageBook::where('id',$id)->exists()) {
            return response()->json(['success'=>false,'msg'=>'Something Error please try again.']);
        }

        $buyBookCard=session()->get('buyBookCard');
        // session add start here 
        if (!$buyBookCard) {
            $buyBookCard=[
                $id=>[
                    'quantity'=>$quantity,
                ]
            ];
            session()->put('buyBookCard',$buyBookCard);
            $noOfItems++;
            $msg= 'Added';
        }
        // session add end here 

        // // session add quantity start here 
        // if (isset($buyBookCard[$id])) {
        //     $buyBookCard[$id]['quantity']=$quantity;
        //     session()->put('buyBookCard',$buyBookCard);
        // }

        if (!array_key_exists($id,$buyBookCard)) {
            $buyBookCard[$id]=[
                'quantity'=>$quantity,
                ];
                session()->put('buyBookCard',$buyBookCard);
                $noOfItems++;
                $msg= 'Added';
        }

        // return $buyBookCard;
        return response()->json(['success'=>true,'msg'=>$msg,'no'=>$noOfItems]);
    }


    public function update(Request $request)
    {
        $id = $request->id;
        $quantity = $request->quantity;
        $noOfItems=0;
        $msg='Added';

        if (!ManageBook::where('id',$id)->exists()) {
            return response()->json(['success'=>false,'msg'=>'Something Error please try again.']);
        }

       $buyBookCard=session()->get('buyBookCard');

       if (!$buyBookCard) {
            $buyBookCard=[
                $id=>[
                    'quantity'=>$quantity,
                ]
            ];
            session()->put('buyBookCard',$buyBookCard);
            $noOfItems++;
            $msg= 'Added';
        }elseif(array_key_exists($id,$buyBookCard)) {
            $buyBookCard[$id]=[
                'quantity'=>$quantity,
                ];
                session()->put('buyBookCard',$buyBookCard);
            $msg= 'Update';
        }
        return response()->json(['success'=>true,'msg'=>$msg,'no'=>$noOfItems]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $buyBookCard = session()->get('buyBookCard');
        if (isset($buyBookCard[$id])) {
            unset($buyBookCard[$id]);
            session()->put('buyBookCard',$buyBookCard);
            return response()->json(['success'=>true]);
        }
        return response()->json(['success'=>false]);
    }
}
