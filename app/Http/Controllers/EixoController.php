<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use App\Models\Eixo;
use App\Models\Curso;
use Illuminate\Http\Request;

class EixoController extends Controller
{

    private $regras = [
        'name' => 'required|max:20|min:3|unique:eixos',
        'description' => 'required|max:300|min:10',
        ];

    private $msgs = ["required" => "O preenchimento do campo [:attribute] é obrigatório!",
    "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
    "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
    "unique" => "Já existe um endereço cadastrado com esse [:attribute]!"
];    
    
    public function index()
    {
        $data = Eixo::with('curso')->get();
        return view('eixo.index', compact(['data']));
    }

    
    public function create()
    {
        return view('eixo.create');
    }

     
    public function store(Request $request)
    {
        $request->validate($this->regras, $this->msgs);

        $eixo = new Eixo();
        $eixo->name = $request->name;
        $eixo->description = $request->description;
        $eixo->save();

        return redirect()->route('eixo.index');
    }

    
    public function show($id)
    {
        $eixo = Eixo::find($id);

        if(isset($eixo)){
            return view('eixo.show', compact('eixo'));
        }

        return "<h1>ERRO - EIXO NAO ENCONTRADO</h1>";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $eixo = Eixo::find($id);

        if(isset($eixo)){
            return view('eixo.edit', compact('eixo'));
        }

        return "<h1>ERRO - EIXO NAO ENCONTRADO</h1>";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $eixo = Eixo::find($id);

        if(isset($eixo)){
            $eixo->name = $request->name;
            $eixo->description = $request->description;
            $eixo->save();
            return redirect()->route('eixo.index');
        }

        return "<h1>ERRO - EIXO NAO ENCONTRADO</h1>";


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $eixo = Eixo::find($id);
        if(isset($eixo)){
            $eixo->delete();
            return redirect()->route('eixo.index');

        }

        return "<h1>ERRO - EIXO NAO ENCONTRADO</h1>";
    }

    public function report($id){

        $curso = Curso::where('eixo_id',$id)->get();
        
        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('eixo.report',compact('curso')));    
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("relatorio-horas-turma.pdf", array("Attachment" => false));


    }

    public function graph(){

        $eixos = Eixo::with('curso')->orderBy('name')->get();

        
           $data= [
            ["EIXO", "NÚMERO DE CURSOS"],
           ];
           $cont =1;
           foreach($eixos as $item){
                $data[$cont] = [
                    $item->name, count($item->curso)
                ];
                $cont++;
           }
              //dd($data);
           $data = json_encode($data);

        
        return view('eixo.graph', compact(['data']));

    }


}
