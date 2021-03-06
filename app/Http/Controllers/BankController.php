<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $banks = DB::table('banks')->select('*')->where('user_id', '=', Auth::user()->id)->get();
        return view('store.bank', [
            'banks' => $banks
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
            $banks = DB::table('banks')->select('*')->where('user_id', '=', Auth::user()->id)->get();
            if(sizeof($banks) === 3) {
                return redirect('/profile/bank')->with([
                    'error' => "Erro ao adicionar conta bancária, delete um para prosseguir"
                ]);
            }

            $bank = new Bank();

            $request->bank_code = trim(str_replace('-', '', $request->bank_code));
            $request->agency = trim(str_replace('-', '', $request->agency));
            $request->account = trim(str_replace('-', '', $request->account));

            $request->bank_cpf = (str_replace("-","", str_replace(".", "", $request->bank_cpf)));


            $bank->bank_code = trim($request->bank_code);
            $bank->bank_name = trim($request->bank_name);
            $bank->agency = trim($request->agency);
            $bank->account = trim($request->account);
            $bank->bank_cpf = trim($request->bank_cpf);
            $bank->user_id = Auth::user()->id;
            $bank->save();
            return redirect('/profile/bank')->with([
                'response' => "Adicionado conta bancária com sucesso!"
            ]);
        } catch (\Exception $e) {
            return redirect('/profile/bank')->with([
                'error' => "Erro ao adicionar conta bancária, tente novamente"
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
            Bank::find($id)->delete();
            return redirect('/profile/bank')->with([
                'response' => "Deltado com sucesso!"
            ]);
        } catch (\Exception $e) {
            return redirect('/profile/bank')->with([
                'error' => "Erro ao deletar!"
            ]);
        }
    }
}
