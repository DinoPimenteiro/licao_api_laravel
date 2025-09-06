<?php

namespace App\Http\Controllers;

use App\Models\Sapatos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SapatosController extends Controller
{
    public function index()
    {
        $sapatos = Sapatos::all();

        $count = $sapatos->count();

        if($count > 0){
            return response()->json([
                'success' => true,
                'message' => 'Dados Listados com sucesso.',
                'data' => $sapatos
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Falha ao listar dados.',
            ], 418);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'marca' => 'required',
            'modelo' => 'required',
            'numeracao' => 'required',
            'preco' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Dados Inválidos',
                'errors' => $validators->errors()
            ], 400);
        }

        $created_shoes = Sapatos::create($request->all());

        if ($created_shoes) 
        {
            return response()->json([
                'success' => true,
                'message' => 'Calçado criado com sucesso.',
                'data' => $created_shoes
            ], 201);

        } else {

            return response()->json([
                'success' => false,
                'message' => 'Falha ao criar produto.',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $sapato = Sapatos::find($id);

        if($sapato){
            return response()->json([
                'success' => true,
                'message' => 'Calçado achado com sucesso.',
                'data' => $sapato
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Calçado não achado.',
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'modelo' => 'required',
            'marca' => 'required',
            'preco' => 'required',
            'numeracao' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => 'Erro na inserção dos dados.',
                'errors' => $validator->errors()
            ], 400);
        }

        $sapato = Sapatos::find($id);

        if(!$sapato){
            return response()->json([
                'success' => false,
                'message' => 'Calçado não achado.',
            ], 404);
        }

        $sapato->numeracao = $request->numeracao;
        $sapato->marca = $request->marca;
        $sapato->preco = $request->preco;
        $sapato->modelo = $request->modelo;

        if($sapato->save()){
            return response()->json([
                'success' => true,
                'message' => 'Calçado editado.',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Calçado não achado.',
            ], 404);
        }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $sapta = Sapatos::find($id);

        if(!$sapta){
            return response()->json([
                'success' => false,
                'message' => 'Calçado não achado.',
            ], 404);
        }

        if($sapta->delete()){
            return response()->json([
                'success' => true,
                'message' => 'Calçado deletado com sucesso.',
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Falha na deleção.',
        ], 500);
    }
}
