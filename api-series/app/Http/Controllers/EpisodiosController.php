<?php


namespace App\Http\Controllers;


use App\Models\Espisodio;
use http\Env\Response;
use Illuminate\Http\Request;

class EspisodiosController
{
    public function index()
    {
        return Espisodio::all();
    }

    public function store(Request $request)
    {
        return response()

            ->json(
                Espisodio::create(['nome'=>$request->nome]),
                201
            );
    }

    public function show(int $id)
    {

       if(Espisodio::find($id)){
           $serie = Espisodio::find($id);
           return response()->json($serie);
       }
       return response()->json(['error' => 'Não existe esse ID'], 204); # 204: not content


    }

    public function update(int $id, Request $request)
    {
        $serie = Espisodio::find($id);
        if($serie){
            $serie->fill($request->all()); //pegar todos os elementos do request e atualizar
            $serie->save();
            return response()->json($serie, 202); #Accepted
        }
        return response()->json(['error' => 'Série não encontrada'], 404); #not found
    }

    public function destroy(int $id)
    {
        if(Espisodio::find($id)){
            Espisodio::destroy($id);
            return response()->json(['message'=>'Removido com sucesso'], 202);
        }
        return response()->json(['error'=> 'Não existe esse recurso'], 404);

    }

}
