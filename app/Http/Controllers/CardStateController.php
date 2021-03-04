<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cardState;

class CardStateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create.cardState');
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

            $cardState = new cardState();
            $cardState->name = $request->name;
            $cardState->abbreviation = $request->abbreviation;
            $cardState->save();
            return redirect('/cardstate/create')->with([
                'response' => 'Criado com sucesso!'
            ]);

        } catch (\Exception $e) {
            return redirect('/cardstate/create')->with([
                'error' => 'Erro ao criar!'
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {

            $cardstate = cardState::find($id);

            if($cardstate === null) {
                throw new \Exception();
            }

            return view('admin.edit.cardState')->with([
                'cardstate' => $cardstate,
            ]);
        } catch (\Exception $e) {
            return redirect('/admin')->with([
                'response' => 'Versão indisponível'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        try {

            $cardState = cardState::find($id);
            $cardState->name = $request->name;
            $cardState->abbreviation = $request->abbreviation;
            $cardState->save();

            return redirect('/cardstate/edit/' . $id)->with([
                'response' => 'Alterado com sucesso!'
            ]);

        } catch (\Exception $e) {
            return redirect('/cardstate/edit/' . $id)->with([
                'error' => 'Erro ao alterar!'
            ]);
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
            $cardState = cardState::find($id);
            $cardState->delete();

        } catch (\Exception $e) {
            dd($e);
        }
    }
}
