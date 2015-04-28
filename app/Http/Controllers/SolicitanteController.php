<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use \App\Solicitante;

class SolicitanteController extends Controller {


	public function index()
	{
		return view("add-solicitante");
	}

	public function add(Request $request)
	{
		$solicitante = new Solicitante;
		$solicitante->nome = $request->input('nome');
		$solicitante->telefone = $request->input('telefone');
		$solicitante->dataCriacao = date('Y-m-d H:i:s');
		try {
			$solicitante->save();
			return ["type" => "true", "data" => $solicitante];
		} catch(Exception $e) {
			return ["type" => "false", "data" => "Não foi possível cadastrar o solicitante"]; 
		}
	}

	public function show($id)
	{
		$solicitante = Solicitante::find($id);
		if(isset($solicitante)) {
			return ["type" => "true", "data" => $solicitante];
		}else {
			return ["type" => "false", "data" => "Solicitante não encontrado"];
		}
	}

	public function edit($id)
	{
		//
	}

}
