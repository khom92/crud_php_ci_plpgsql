<?php

/**
 * Description of newPHPClass
 *
 * @author daniel ortiz
 */ 
    
class ModelWelcome extends CI_Model{ //Agregamos extend CI_Model
    
    //Representa cada columna del datatable, a ordenar por:
    var $column_order = array('m.nombre','d.nombre','m.nombre');
    
    //Create. Type C of CRUD
    public function agrega($nombre, $dep_id){
        $tipo = 'C';
        $sql = "select * from sf_cud_mun('".$tipo."', 0, '".$nombre."', ".$dep_id .")" ;
        $query = $this->db->query($sql);
    }
    
    //Read. Type R of CRUD
    public function obtener_todo(){
        //Store Function pl/pgSql -- basado en pl/sql de oracle
        $sql = "select * from sf_crud_mun("
                ."'".$_POST['search']['value']."' ,"
                ."'".$this->column_order[$_POST['order']['0']['column']]."' ,"
                ."'".$_POST['order'][0]['dir']."' ,"
                .$_POST['length']." ,"
                .$_POST['start']." "
                . ")";
        
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    //Update. Type U of CRUD
    public function edita($mun_id, $nombre, $dep_id){
        $tipo = 'U';
        $sql = "select * from sf_cud_mun('".$tipo."', ".$mun_id.", '".$nombre."', ".$dep_id .")" ;
        $query = $this->db->query($sql);
    }
    
    //Delete. Type D of CRUD
    public function elimina($mun_id){
        $tipo = 'D';
        $sql = "select * from sf_cud_mun('".$tipo."', ".$mun_id.", '', 0)" ;
        $query = $this->db->query($sql);
    }
    
}
