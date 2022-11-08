<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Clientes;
use Illuminate\Http\Request;
use Session;

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
        return view('clientes.index', array('clientes' => $clientes, 'busca' => null));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function buscar(Request $request) {
        $clientes = Clientes::where('nome','LIKE','%'.$request->input('busca').'%')->orwhere('email','LIKE','%'.$request->input('busca').'%')->paginate(5);
        return view('clientes.index',array('clientes' => $clientes,'busca'=>$request->input('busca')));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clientes.create');
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
    public function edit($id)
    {
        $cliente = Clientes::find($id);
        return view('clientes.edit',array('cliente' => $cliente));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'nome' => 'required|min:3',
            'email' => 'required|e-mail',
            'telefone' => 'required',
            'cidade' => 'required',
        ]);
        $cliente = Clientes::find($id);
        if($request->hasFile('foto')){
            $imagem = $request->file('foto');
            $nomearquivo = md5($cliente->id).".".$imagem->getClientOriginalExtension();
            $request->file('foto')->move(public_path('.\imagens\clientes'),$nomearquivo);
        }
        $cliente->nome = $request->input('nome');
        $cliente->email = $request->input('email');
        $cliente->telefone = $request->input('telefone');
        $cliente->cidade = $request->input('cidade');
        if($cliente->save()) {
            Session::flash('mensagem','Cliente alterado com sucesso');
            return redirect()->back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $cliente = Clientes::find($id);
        if (isset($request->foto)) {
            unlink($request->foto);
        }
        $cliente->delete();
        Session::flash('mensagem','Cliente Excluído com Sucesso Foto:');
        return redirect(url('clientes/'));
    }
}
