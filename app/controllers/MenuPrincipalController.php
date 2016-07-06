<?php
class MenuPrincipalController extends BaseController {


	public function __construct(){

		$this->beforeFilter('auth');
	}

	public function getIndex(){
		  //  $my_id = Auth::user()->id;
			//$level = Auth::user()->nivel;
			//control permissions only access administrator (ad)
			//if($level==1){
			//$users = DB::table('users')->where('nivel','<>','1')->where('id','<>',$my_id)->get();
			return View::make('index');
			//}else{
			//return View::make('Docentes.index');
			//}

		
	}
}