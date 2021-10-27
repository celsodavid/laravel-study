<?php

namespace App\Http\Controllers;

use App\Models\Equipamento;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class EquipamentosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|Application|View
     */
    public function index()
    {
        $equipamentos = Equipamento::paginate(10);;
        return view('equipamentos.index', compact('equipamentos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|Application|View
     */
    public function create()
    {
        return view('equipamentos.create', ['action' => route('equipamento.store'), 'method' => 'post']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $url = $request->get('redirect_to', route('equipamento.index'));
        if (!$request->has('cancel') ) {
            $dados = $request->all();
            Equipamento::create($dados);
            $request->session()->flash('message', 'Equipamento cadastrado com sucesso');
        } else {
            $request->session()->flash('message', 'Operação cancelada pelo usuário');
        }

        return redirect()->to($url);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Equipamento  $equipamento
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function update(Equipamento $equipamento, Request $request): RedirectResponse
    {
        if (! $request->has('cancel') ){
            $equipamento->tipo = $request->input('tipo');
            $equipamento->modelo = $request->input('modelo');
            $equipamento->fabricante = $request->input('fabricante');
            $equipamento->update();

            Session::flash('message', 'Equipamento atualizado com sucesso !');
        } else {
            $request->session()->flash('message', 'Operação cancelada pelo usuário');
        }

        return redirect()->route('equipamento.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Equipamento  $equipamento
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function destroy(Equipamento $equipamento, Request $request): RedirectResponse
    {
        if (!$request->has('cancel') ){
            $equipamento->delete();
            Session::flash('message', 'Equipamento excluído com sucesso !');
        } else {
            $request->session()->flash('message', 'Operação cancelada pelo usuário');
        }

        return redirect()->route('equipamento.index');
    }
}
