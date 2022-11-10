<?php

namespace App\Http\Controllers;

use App\Models\Construcoes;
use Illuminate\Http\Request;
use App\Models\Clientes;
use Session;

class ConstrucoesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $construcoes = Construcoes::paginate(5);
        return view('construcoes.index', array('construcoes' => $construcoes, 'busca' => null));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientes = Clientes::all();
        return view('construcoes.create',['clientes'=>$clientes]);
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
            'cliente_id' => 'required',
            'areaTerreno' => 'required',
            'dataInicio' => 'required',
            'dataFim' => 'required',
            'finalidade' => 'required',
            'preco' => 'required',
        ]);
        $construcao = new Construcoes();
        $construcao->cliente_id = $request->input('cliente_id');
        $construcao->areaTerreno = $request->input('areaTerreno');
        $construcao->preco = $request->input('preco');
        $construcao->finalidade = $request->input('finalidade');
        $construcao->dataInicio = \Carbon\Carbon::createFromFormat('d/m/Y H:i:s', $request->input('dataInicio'));
        $construcao->dataFim = \Carbon\Carbon::createFromFormat('d/m/Y H:i:s', $request->input('dataFim'));
        $construcao->aprovacaoBombeiros = "Não aprovado";
        $construcao->aprovacaoCelesc = "Não aprovado";
        $construcao->alvaraDeConstrucao = "Não aprovado";
        $construcao->pago = "Não";
        $construcao->situacao = "nsei";
        $construcao->detalhes = $request->input('detalhes');

        if($construcao->save()) {
            return redirect('construcoes');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Construcoes  $construcoes
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $construcao = Construcoes::find($id);
        return view('construcoes.show',array('construcao' => $construcao, 'busca'=>null));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Construcoes  $construcoes
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $construcao = Construcoes::find($id);
        $clientes = Clientes::all();
        return view('construcoes.edit',array('construcao' => $construcao, 'clientes'=>$clientes));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Construcoes  $construcoes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'cliente_id' => 'required',
            'areaTerreno' => 'required',
            'dataInicio' => 'required',
            'dataFim' => 'required',
            'finalidade' => 'required',
            'preco' => 'required',
        ]);
        $construcao = Construcoes::find($id);
        $construcao->cliente_id = $request->input('cliente_id');
        $construcao->areaTerreno = $request->input('areaTerreno');
        $construcao->preco = $request->input('preco');
        $construcao->finalidade = $request->input('finalidade');
        $construcao->dataInicio = \Carbon\Carbon::createFromFormat('d/m/Y H:i:s', $request->input('dataInicio'));
        $construcao->dataFim = \Carbon\Carbon::createFromFormat('d/m/Y H:i:s', $request->input('dataFim'));
        $construcao->aprovacaoBombeiros = "Não Aprovado";
        $construcao->aprovacaoCelesc = "Não aprovado";
        $construcao->alvaraDeConstrucao = $request->input('alvaraDeConstrucao');
        $construcao->pago = "Não";
        $construcao->situacao = "nsei";
        $construcao->detalhes = $request->input('detalhes');

        if($construcao->save()) {
            return redirect('construcoes');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Construcoes  $construcoes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $construcao = Construcoes::find($id);
        $construcao->delete();
        Session::flash('mensagem','Construção excluida com sucesso!');
        return redirect(url('construcoes/'));
    }
}
