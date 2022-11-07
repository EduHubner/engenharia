<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Clientes;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Clientes::paginate(5);
        return view('clientes.index', array('contatos' => $clientes, 'busca' => null));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cliente.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'nome' => 'required|min:3',
            'email' => 'required|e-mail',
            'telefone' => 'required',
            'cidade' => 'required',
        ]);
        $cliente = new Clientes();
        $cliente->nome = $request->input('nome');
        $cliente->email = $request->input('email');
        $cliente->telefone = $request->input('telefone');
        $cliente->cidade = $request->input('cidade');
        if($cliente->save()) {
            if($request->hasFile('foto')){
                $imagem = $request->file('foto');
                $nomearquivo = md5($cliente->id).".".$imagem->getClientOriginalExtension();
                //dd($imagem, $nomearquivo,$contato->id);
                $request->file('foto')->move(public_path('.\imagens\clientes'),$nomearquivo);
            }
            return redirect('clientes');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cliente = Clientes::find($id);
        return view('clientes.show', array('cliente' => $cliente));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function edit(Clientes $clientes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clientes $clientes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clientes $clientes)
    {
        //
    }
}
