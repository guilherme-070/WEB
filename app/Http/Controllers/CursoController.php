<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Eixo;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Isset_;

class CursoController extends Controller
{
   
    public function index()
    {
        $data = Curso::with(['eixo'])->get();
        return view('curso.index', compact('data'));
    }

    
    public function create()
    {
        $eixos = Eixo::orderBy('name')->get();
        return view('curso.create', compact('eixos'));
    }

    
    public function store(Request $request)
    {
        $eixo = Eixo::find($request->eixo);

        if(isset($eixo)){
           $curso = new Curso();
           $curso->name = mb_strtoupper($request->name, 'UTF-8');
           $curso->abreviatura = mb_strtoupper($request->abreviatura,'UTF-8');
           $curso->duracao = $request->duracao;
           $curso->eixo()->associate($eixo);
           $curso->save();

           return redirect()->route('curso.index');
        }

        return "<h1>ERRO - EIXO NAO ENCONTRADO</h1>";
    }

    
    public function show($id)
    {
        $curso = Curso::find($id);

        if(isset($curso)){
            return view('curso.show', compact('curso'));
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
        $curso = Curso::find($id);
        $eixos = Eixo::orderBy('name')->get();

        if(isset($curso)){
            return view('curso.edit', compact (['curso', 'eixos']));
        }
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
        $curso =Curso::find($id);
        $eixo = Eixo::find($request->eixo);

        if(isset($eixo) && isset($curso)){
           $curso->name = mb_strtoupper($request->name, 'UTF-8');
           $curso->abreviatura = mb_strtoupper($request->abreviatura,'UTF-8');
           $curso->duracao = $request->duracao;
           $curso->eixo()->associate($eixo);
           $curso->save();

           return redirect()->route('curso.index');
        }

        return "<h1>ERRO - EIXO NAO ENCONTRADO</h1>";
    }

    /**
     * batata
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $curso = Curso::find($id);
        if(isset($curso)){
            $curso->delete();
            return redirect()->route('curso.index');
        }

        return "<h1>ERRO - EIXO NAO ENCONTRADO</h1>";
    }
}
