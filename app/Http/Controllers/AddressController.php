<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $addresses = DB::table('addresses')->select('*')->where('user_id', '=', Auth::user()->id)->get();
        return view('store.address', [
            'addresses' => $addresses
        ]);
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


        try {
            $addresses = DB::table('addresses')->select('*')->where('user_id', '=', Auth::user()->id)->get();
            if(sizeof($addresses) === 3) {
                return redirect('/profile/address')->with([
                    'error' => "Erro ao adicionar endereço, delete um para prosseguir"
                ]);
            }


            $address = new Address();

            $request->postal_code = trim(str_replace('-', '', $request->postal_code));

            $address->address = trim($request->address);
            $address->district = trim($request->district);
            $address->number = trim($request->number);
            $address->complement = "-";
            $address->city = trim($request->city);
            $address->state = trim($request->state);
            $address->postal_code = trim($request->postal_code);
            $address->user_id = Auth::user()->id;
            $address->save();
            return redirect('/profile/address')->with([
                'response' => "Adicionado endereço com sucesso!"
            ]);
        } catch (\Exception $e) {
            return redirect('/profile/address')->with([
                'error' => "Erro ao adicionar endereço, tente novamente"
            ]);

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            Address::find($id)->delete();
            return redirect('/profile/address')->with([
                'response' => "Deltado com sucesso!"
            ]);
        } catch (\Exception $e) {
            return redirect('/profile/address')->with([
                'error' => "Erro ao deletar!"
            ]);
        }
    }
}
