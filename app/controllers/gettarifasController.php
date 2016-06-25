<?php
		class gettarifasController extends BaseController {
		public function postData()
		{
		$tarifa_id = Input::get('tarifas');
		$tarifa = Tarifa::find($tarifa_id);


		$data = array(
		'success' => true,
		'id' => $tarifa->id,
		'nombrecabina1' => $tarifa->nombrecabina1,
		'codigoPais1' => $tarifa->codigoPais1,
		'nombrePais1' => $tarifa->nombrePais1,
		'cr_fijo1' => $tarifa->cr_fijo1,	
		'cr_celular1' => $tarifa->cr_celular1,
		'vr_fijo1' => $tarifa->vr_fijo1,
		'vr_celular1' => $tarifa->vr_celular1,
		'nombrecabina2' => $tarifa->nombrecabina2,
		'codigoPais2' => $tarifa->codigoPais2,
		'nombrePais2' => $tarifa->nombrePais2,
		'cr_fijo2' => $tarifa->cr_fijo2,	
		'cr_celular2' => $tarifa->cr_celular2,
		'vr_fijo2' => $tarifa->vr_fijo2,
		'vr_celular2' => $tarifa->vr_celular2					
		);
		return Response::json($data);
		}
		}
		?>