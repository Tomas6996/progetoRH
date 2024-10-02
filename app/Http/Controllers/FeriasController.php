<?php

namespace App\Http\Controllers;

use App\Models\Ferias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeriasController extends Controller
{
    public function index(){
        $ferias = Ferias::all();
        return view('page.ferias', compact('ferias'));
    }
    public function store(Request $request){
        $ferias=null;
        if(isset($request->id)){
            $ferias=Ferias::find($request->id);
        }else{
            $fererias=new Ferias();
            $fererias->data_inicio = $request->data_inicio;
            $fererias->data_fim =$request->data_fim;
            $fererias->funcionario_id =$request->funcionario_id;
            $fererias->aporvador_por =Auth::user()->name;
            $fererias->estado = "pendente";
            $fererias->save();
        }

        if($ferias){
            return redirect()->back()->with('Sucesso','Adicionado com sucesso');
        }else{
            return redirect()->back()->with('Erro','Erro ao cadastrar o ferias');
        }
      
    }
    public function apagar($id){
        Ferias::find($id)->delete();
        return redirect()->back();
    }
    public function aprovado($id){
        $ferias = Ferias::find($id);
  $ferias->estado="Aprovado";
  $ferias->save();
        return redirect()->back();
    }
    public function recusado($id){
        $ferias = Ferias::find($id);
  $ferias->estado="Recusado";
  $ferias->save();
        return redirect()->back();
    }
}
