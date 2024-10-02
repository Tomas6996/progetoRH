<?php

namespace App\Http\Controllers;

use App\Models\Recrutamento;
use Illuminate\Http\Request;

class RecrutamentoController extends Controller
{
    public function index(){
        $recrutamento = Recrutamento::all();
        return view('page.recrutamento', compact('recrutamento'));
    }
    public function store(Request $request){
        $recrutamento=null;
        if(isset($request->id)){
            $recrutamentor=Recrutamento::find($request->id);
        }else{
            $recrutamento=new Recrutamento();
        }
        $recrutamento->nome =$request->nome;
        $recrutamento->categoria = $request->categoria;
        $recrutamento->datanascimento = $request->datanascimento;
        $recrutamento->telefone = $request->telefone;  
        $recrutamento->email =$request->email;
        $recrutamento->nbi = $request->nbi;
        $recrutamento->genero = $request->genero;
        $recrutamento->save();
        return redirect()->back();
    }
    public function apagar($id){
        Recrutamento::find($id)->delete();
        return redirect()->back();
    }
}
