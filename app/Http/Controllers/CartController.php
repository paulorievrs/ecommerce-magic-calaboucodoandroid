<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        if(!Auth::user()->id) {
            return redirect()->back()->with([
               'response' => 'Você precisa estar logado para acessar o carrinho!'
            ]);
        }
        $carts = DB::table('carts')->select('*')->where('user_id', '=', Auth::user()->id);

        dd($carts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        if(!Auth::check()) {
            return redirect('/')->with([
               'response' => "Faça login para adicionar cartas ao carrinho"
            ]);
        }


        $card = Card::find($request->card_id);

        $user_id = Auth::user()->id;

        if(!isset($request->quantity)) {
            $quantity = 1;
        } else {
            $quantity = $request->quantity;
        }

        if($this->verifyIfExistsTheSameCardInTheCart($card, $quantity)) {
            return redirect()->back()->with([
                'response' => 'Adicionada ' . $quantity . ' ' . $card->name . " com sucesso!"
            ]);
        }

        if(!$this->verifyCardQuantity($card, $quantity)) {
            return redirect()->back()->with([
                'response' => "Quantidade de cartas indisponível"
            ]);
        }

        if(!$this->removeQuantityFromCard($card, $quantity)) {
            return redirect('/')->with([
                'response' => "Erro, tente novamente."
            ]);
        }

        try {
            $cart = new Cart();
            $cart->card_id = $request->card_id;
            $cart->quantity = $quantity;
            $cart->user_id = $user_id;
            $cart->save();

            return redirect()->back()->with([
                'response' => 'Adicionada ' . $quantity . ' ' . $card->name . " com sucesso!"
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'response' => 'Erro ao adicionar ' . $quantity . ' carta(s)! Carta: ' . $card->name
            ]);
        }

    }

    private function verifyIfExistsTheSameCardInTheCart(Card $card, int $quantity)
    {
        $cart = DB::table('carts')
                    ->select('*')
                    ->where('card_id', '=', $card->id)
                    ->where('user_id', '=', Auth::user()->id)
                    ->get();

        if(isset($cart[0])) {
            $cart_alter = Cart::find($cart[0]->id);
            $cart_alter->quantity = $cart_alter->quantity + $quantity;
            $cart_alter->save();

            if(!$this->removeQuantityFromCard($card, $quantity)) {
                return redirect('/')->with([
                    'response' => "Erro, tente novamente."
                ]);
            }

            return true;
        }

        return false;
    }

    private function verifyCardQuantity(Card $card, int $quantity) : bool
    {
        if($card->quantity < $quantity) {
            return false;
        }

        return true;
    }

    private function removeQuantityFromCard(Card $card, int $quantity) : bool
    {
        try {
            DB::table('cards')->where('id', '=', $card->id)->decrement('quantity', $quantity);
            return true;
        } catch (\Exception $e) {
            return false;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        try {
            $cart = Cart::find($id);
            $cart->card_id = $request->card_id;
            $cart->quantity = $request->quantity;
            $cart->user_id = $request->user_id;
            $cart->save();
        } catch (\Exception $e) {
            dd($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $cart = Cart::find($id);
            $cart->delete();
        } catch(\Exception $e) {
            dd($e);
        }
    }
}
