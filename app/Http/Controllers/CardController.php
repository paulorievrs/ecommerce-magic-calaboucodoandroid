<?php

namespace App\Http\Controllers;

use App\Models\cardState;
use App\Models\Language;
use App\Models\Type;
use App\Models\Version;
use Illuminate\Http\Request;
use App\Models\Card;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $cards = Card::paginate(10);
        return view('admin.view.card', [
            'cards' => $cards
        ]);
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($name)
    {   $card = Card::where('name', '=', $name)->first();

        $cart_quantity = 0;
        if(Auth::check()) {

            $cart_quantity = DB::table('carts')->select('*')->where('user_id', '=', Auth::user()->id)->count('*');
        }

        return view('store.card', [
            'card' => $card,
            'cart_quantity' => $cart_quantity
        ]);
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
            return redirect('/card/edit/' . $id)->with([
                'error' => 'Erro ao alterar!'
            ]);
        }
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
            $card = Card::find($id);
            $card->delete();
            return redirect('/card')->with([
                'response' => 'Deletado com sucesso!'
            ]);
        } catch (\Exception $e) {
            return redirect('/card')->with([
                'error' => 'Erro ao deletar!'
            ]);
        }
    }

    public function welcome()
    {
        $cards = DB::table('cards')->select('id', 'name', 'english_name', 'value', 'quantity', 'imageLink')->orderBy('created_at')->paginate(6);

        $cart_quantity = 0;
        if(Auth::check()) {

            $cart_quantity = DB::table('carts')->select('*')->where('user_id', '=', Auth::user()->id)->count('*');
        }

        return view('store.index', [
            'cards' => $cards,
            'cart_quantity' => $cart_quantity
        ]);
    }


    public function searchHome(Request $request)
    {
        $cards = DB::table('cards')
            ->select('id', 'name', 'english_name', 'value', 'quantity', 'imageLink')
            ->orderBy('name')
            ->where('name', 'LIKE', '%' . $request->search . '%')
            ->orWhere('english_name', 'LIKE',  '%' . $request->search . '%')
            ->paginate(6);

        $cart_quantity = 0;
        if(Auth::check()) {

            $cart_quantity = DB::table('carts')->select('*')->where('user_id', '=', Auth::user()->id)->count('*');
        }

        return view('store.search', [
            'cards' => $cards,
            'cart_quantity' => $cart_quantity
        ]);
    }

    public function getCards()
    {
        $hasMore = true;
        $url = 'https://api.scryfall.com/cards/search?order=cmc&q=name=a';

        while ($hasMore) {

            $json = Http::get($url)->body();
            $decode = json_decode($json);

            $url = isset($decode->next_page) ? $decode->next_page : null;
            $hasMore = isset($decode->has_more) ? $decode->has_more : false;
            $cards = $decode->data;
            $colors = ($cards[0]->colors);

            $cor = "";
            for($i = 0; $i < sizeof($colors); $i++) {
                $right = $this->getColor($colors[$i]);
                if(sizeof($colors) - 1 === $i) {

                    $cor .= $right;
                } else {
                    $cor .= $right . ", ";

                }
            }

            foreach ($cards as $card) {

                if (isset($card->image_uris)) {
                    $version_name = $card->set_name;
                    $version_abbreviation = $card->set;
                    $version = Version::firstOrCreate([
                        'name' => $version_name,
                        'abbreviation' => $version_abbreviation
                    ]);

                    $type = Type::firstOrCreate([
                        'name' => $card->type_line
                    ]);

                    $name = $card->name;
                    $imageLink = $card->image_uris->normal;
                    $quantity = 0;
                    $cmc = isset($card->cmc) ? $card->cmc : 0;
                    $type_id = $type->id;
                    $rarity = $card->rarity;

                    $card = Card::firstOrCreate([

                        'name'           => $name,
                        'imageLink'      => $imageLink,
                        'quantity'       => $quantity,
                        'version_id'     => $version->id,
                        'value'          => 0.0,
                        'card_states_id' => 1,
                        'language_id'    => 1,
                        'type_id'        => $type_id,
                        'CMC'            => $cmc,
                        'rarity'         => $rarity,
                        'colors'         => $cor

                    ]);

                    $card = Card::find($card->id);
                    $card->card_states_id = 1;
                    $card->language_id = 1;
                    $card->save();
                }
            }
        }
    }

    private function getColor($i)
    {
        if($i === 'U') {
            return "Blue";
        }

        if($i === 'B') {
            return 'Black';
        }

        if($i === 'W') {
            return 'White';
        }

        if($i === 'G') {
            return 'Green';
        }

        if($i === 'R') {
            return 'Red';
        }
    }
}
