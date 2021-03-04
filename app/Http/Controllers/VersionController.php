<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Version;

class VersionController extends Controller
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
     * @return float|\Illuminate\Http\Response|int
     */
    public function create()
    {
        return view('admin.create.version');
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

            $version = new Version();
            $version->name = $request->name;
            $version->abbreviation = $request->abbreviation;
            $version->imageLink = $request->imageLink;
            $version->save();

            return redirect('/version/create')->with([
                'response' => 'Criado com sucesso!'
            ]);

        } catch (\Exception $e) {
            return redirect('/version/create')->with([
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
    public function show($id)
    {
        try {

            $version = Version::find($id);

            if($version === null) {
                throw new \Exception();
            }

            return view('admin.edit.version')->with([
                'version' => $version,
            ]);
        } catch (\Exception $e) {
            return redirect('/admin')->with([
                'response' => 'Versão indisponível'
            ]);
        }
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        try {
            $version = Version::find($id);
            $version->name = $request->name;
            $version->abbreviation = $request->abbreviation;
            $version->imageLink = $request->imageLink;
            $version->save();

            return redirect('/version/edit/' . $id)->with([
                'response' => 'Alterado com sucesso!'
            ]);

        } catch (\Exception $e) {
            return redirect('/version/edit/' . $id)->with([
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
            $version = Version::find($id);
            $version->delete();

        } catch (\Exception $e) {
            dd($e);
        }
    }
}
