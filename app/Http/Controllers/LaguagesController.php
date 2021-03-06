<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Language;

class LaguagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function index()
    {
        $languages = Language::paginate(10);

        return view('admin.view.language',[
            'languages' => $languages
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create.language');
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

            $language = new Language();
            $language->name = $request->name;
            $language->abbreviation = $request->abbreviation;
            $language->save();

            return redirect('/language/create')->with([
                'response' => 'Criado com sucesso!'
            ]);

        } catch (\Exception $e) {
            return redirect('/language/create')->with([
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

            $language = Language::find($id);

            if($language === null) {
                throw new \Exception();
            }

            return view('admin.edit.language')->with([
                'language' => $language,
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

            $language = Language::find($id);
            $language->name = $request->name;
            $language->abbreviation = $request->abbreviation;
            $language->save();

            return redirect('/language/edit/' . $id)->with([
                'response' => 'Alterado com sucesso!'
            ]);

        } catch (\Exception $e) {
            return redirect('/language/edit/' . $id)->with([
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
            $language = Language::find($id);
            $language->delete();
            return redirect('/language')->with([
                'response' => 'Deletado com sucesso!'
            ]);
        } catch (\Exception $e) {
            return redirect('/language')->with([
                'error' => "Erro ao deletar!"
            ]);
        }
    }
}
