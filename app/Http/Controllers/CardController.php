<?php

namespace App\Http\Controllers;

use App\Models\cardState;
use App\Models\Language;
use App\Models\Version;
use Illuminate\Http\Request;
use App\Models\Card;

class CardController extends Controller
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {

        $versions = Version::all();
        $languages = Language::all();
        $states = cardState::all();

        return view('admin.create.card', [
            'versions'  => $versions,
            'languages' => $languages,
            'states'    => $states,
        ]);
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
            $card = new Card();
            $card->value = $request->value;
            $card->imageLink = $request->imageLink;
            $card->name = $request->name;
            $card->english_name = $request->english_name;
            $card->quantity = $request->quantity;
            $card->card_states_id = $request->card_states_id;
            $card->version_id = $request->version_id;
            $card->language_id = $request->language_id;
            $card->save();

            return redirect('/card/create')->with([
                'response' => 'Criado com sucesso!'
            ]);

        } catch (\Exception $e) {
            return redirect('/card/create')->with([
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function edit($id)
    {
        try {

            $card = Card::find($id);

            if($card === null) {
                throw new \Exception();
            }

            return view('admin.edit.card')->with([
                    'card' => $card,
                    'states' => cardState::all(),
                    'versions' => Version::all(),
                    'languages' => Language::all()
            ]);
        } catch (\Exception $e) {
            return redirect('/admin')->with([
                    'response' => 'Carta indisponível'
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
            $card = Card::find($id);
            $card->value = $request->value;
            $card->imageLink = $request->imageLink;
            $card->name = $request->name;
            $card->english_name = $request->english_name;

            $card->quantity = $request->quantity;
            $card->card_states_id = $request->card_states_id;
            $card->version_id = $request->version_id;
            $card->language_id = $request->language_id;
            $card->save();

            return redirect('/card/edit/' . $id)->with([
                'response' => 'Alterado com sucesso!'
            ]);

        } catch (\Exception $e) {
            dd($e);
            return redirect('/card/edit/' . $id)->with([
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
            $card = Card::find($id);
            $card->delete();
        } catch (\Exception $e) {
            dd($e);
        }
    }
}
