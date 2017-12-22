<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
        
        //Creamos un contructor para inicializar objetos
        public function __construct(){
            parent::__construct();
            //llamamos el modelo que usaremos
            $this->load->model('ModelWelcome');
        }
        
	public function index(){
		$this->load->view('welcome_message');
	}
	
        public function drawTable(){
                 //llamamos a la funcion que trae la lista del modelo 
		$list = $this->ModelWelcome->obtener_todo();
                
                //Creamos el array para almacenar las columnas con datos
                // para enviar al datatable
                $data = array();
		
                foreach ($list as $mun) {
		                        
			$row = array();
                        
			$row[] = $mun->nombrem;
			$row[] = $mun->nombred;
			$row[] = "<button type='button' class='btn btn-success' data-toggle='modal' data-target='#myModal' onClick='editando(\"$mun->nombrem\",$mun->dep_id, $mun->mun_id)'>Editar</button> "
                                . "<button type='button' class='btn btn-danger' onClick='liquidalo($mun->mun_id)'>Eliminar</button>";
                        
			$data[] = $row;
		}
                
                $totalData = $this->db->count_all_results('municipios');
                
                //Creamos otro array que tiene el array de columnas y
                //ademas lleva campos de configuracion del datable
		$todoParaTable = array(
                    "draw"              =>  intval($_POST['draw']),
                    "recordsTotal"      =>  intval($totalData),
                    "recordsFiltered"   =>  intval($totalData),
                    "data"              => $data
		);
                
		//Retornamos el array en formato JSON
		echo json_encode($todoParaTable);
                
	}

        public function eliminar($mun_id){
		$this->ModelWelcome->elimina($mun_id);
	}
        
        public function editar($mun_id, $nombrem, $dep_id){
                //urldecode porque ajax lo codifica y los espacios los toma como %20
                $this->ModelWelcome->edita($mun_id, urldecode($nombrem), $dep_id);
	}
        
        public function agregar($nombrem, $dep_id){
                $this->ModelWelcome->agrega(urldecode($nombrem), $dep_id);
	}
        
}