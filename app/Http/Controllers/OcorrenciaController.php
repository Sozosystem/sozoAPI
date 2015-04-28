<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Request;
use Input;

use \App\Ocorrencia;

class OcorrenciaController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$ocorrencias = null;
		$situacao = Request::route('situacao');
		if($situacao == 'todas') {
			$ocorrencias = Ocorrencia::all();
		}else {
			$ocorrencias = Ocorrencia::where('situacaoOcorrencia', '=', $situacao)->get();
		}
		return $ocorrencias;
	}

	public function getAdd()
	{
		return view('add');
	}

	public function postAdd()
	{
		$o = new Ocorrencia;
		$o->dataCriacao = date('Y-m-d H:i:s');
		$o->latitude = Request::input('latitude');
		$o->longitude = Request::input('longitude');
		$o->solicitante_id = Request::input('solicitante_id');
		$o->foto = Request::input('file');
		try {
			$o->save();
		}catch (Exception  $e){
			return ['type' => 'false', 'data' => 'Não foi possível registrar a ocorrência'];
		}
		return ['type' => 'true', 'data' => 'Ocorência registrada com sucesso'];
	}

	public function upload() {
		
		$file = Input::file('file');
		$formato = Input::input('formato');

		$extension = $file->getClientOriginalExtension();

		$file_name = date('H_i_s')."_".Request::input('solicitante_id').".".$formato;

		$size = $file->getClientSize();
		$is_image = false;
		$is_video = false;
		if($extension == 'jpg' || $extension == "png" || $extension == "jpeg") {
			$is_image = true;
			if($size >= 1048576 * 5) return ['type' => 'false', 'data' => 'A imagem excedeu o limite de 5mb'];
		}else if($extension == 'mp4' || $extension == 'wmv') {
			$is_video = true;
			if($size >= 1048576 * 10) return ['type' => 'false', 'data' => 'O video excedeu o limite de 10mb'];
		}else {
			return ['type' => 'false', 'data' => 'formato não compatível'];
		}
		Input::file('file')->move(public_path() . '/uploads/' . date('Y') . "/" . date('m') . "/" . date('d') . "/", $file_name);
		$path = date('Y') . "/" . date('m') . "/" . date('d') . "/" . $file_name;
		return ['type' => 'true', 'data' =>  $path];
	}

	public function show($id)
	{
		$ocorrencia =  Ocorrencia::find($id);
		if(!isset($ocorrencia)) {
			return ["type" => 'false', "data" => "Nenhuma ocorrência encontrada"];
		}else {
			return ["type" => 'true', "data" => $ocorrencia];
		}
		return $ocorrencia;
	}

	public function delete($id)
	{
		$ocorrencia =  Ocorrencia::find($id);
		if(isset($ocorrencia)) {
			$ocorrencia->delete();
			return ["type" => 'true', "data" => "Ocorrência cancelada com sucesso"];
		}else {
			return ["type" => 'false', "data" => "Não foi possível cancelar a ocorrência"];
		}
	}

	public function solicitante($id) {
		$ocorrencias = Ocorrencia::where('solicitante_id', '=', $id)->get();
		if(isset($ocorrencias)) {
			return ["type" => "true", "data" => $ocorrencias];
		}else {
			return ["type" => "false", "data" => "Não foi possível acessar as ocorrências"];
		}

	}

	public function updateViaturaPosition($placa, $lat, $lon) {
		$viatura = Viatura::where('situacaoOcorrencia', '=', $placa)->get();
		return $viatura;
	}

}
