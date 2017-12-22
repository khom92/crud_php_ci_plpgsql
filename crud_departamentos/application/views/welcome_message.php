<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
    <head> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome</title>
    <link href="<?php echo base_url('public/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('public/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">
    </head> 
<body>
    
    <!--script para setear compos al modal cuando edita-->
     <script>
     function editando(nombre, dep_id, mun_id){
        $(document).ready(function(){
            $("#tipo").val(1);
            $("#id_Municipio").val(mun_id);
            $("#nombre_Municipio").val(nombre);
            $("#departamentos option[value="+ dep_id +"]").attr("selected",true);
        });
    }
    </script>
    
    <!--script para setear compos vacios al modal cuando agregara-->
    <script>
        function limpiaModal(){
               $("#tipo").val(2);
               $("#id_Municipio").val("");
               $("#nombre_Municipio").val("");
               $("#departamentos option[value="+ 6 +"]").attr("selected",true);
        }
    </script>    
    
    <!--Script para hacer el ajax de editar y agregar desde el mismo modal-->
    <script>
    function actualizando(){  
   
            $(document).ready(function(){
                    var mun_id = $("#id_Municipio").val();
                    var nombrem = $("#nombre_Municipio").val();
                    var dep_id = $("#departamentos").val();
                if ($("#tipo").val() == 1){ //tipo 1 es editar
                    jQuery.ajax({
                        url: "<?php echo base_url(); ?>" + "index.php/welcome/editar"+"/"+mun_id+"/"+nombrem+"/"+dep_id,
                        type: "GET",
                        success: function(data)
                        {
                            table.ajax.reload(null,false); //reload datatable ajax
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert('Error get data from ajax');
                        }
                       
                    });
                }
                else if($("#tipo").val() == 2){ 
                    jQuery.ajax({
                        url: "<?php echo base_url(); ?>" + "index.php/welcome/agregar"+"/"+nombrem+"/"+dep_id,
                        type: "GET",
                        success: function(data)
                        {
                            table.ajax.reload(null,false); //reload datatable ajax
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert('Error get data from ajax');
                        }
                    });
                }
                
            });
        }
        
    </script>
    
    <!--Script para obtener id y hacer el ajax eliminar-->
        <script>
        function liquidalo(id){  
        $(document).ready(function(){
                       
            jQuery.ajax({
                url: "<?php echo base_url(); ?>" + "index.php/welcome/eliminar"+"/"+id,
                type: "GET",
                success: function(data)
                {
                    table.ajax.reload(null,false); //reload datatable ajax
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
            
        });
    }
    </script>
    
    <!--Datatable Esqueleto-->
    <div class="container" style="margin-top: 50px;">
        <button class="btn btn-primary" onclick="limpiaModal()" data-toggle='modal' data-target='#myModal'>Agregar Municipio</button>
        <br><br>
        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Municipio</th>
                    <th>Departamento</th>
                    <th>Acción a realizar</th>
                </tr>
            </thead>
        </table>
    </div>
    

   
    <!--Script Seteando lista al datatable-->
    <script src="<?php echo base_url('public/jquery/jquery-2.1.4.min.js')?>"></script>
    <script src="<?php echo base_url('public/datatables/js/jquery.dataTables.min.js')?>"></script>
    <script src="<?php echo base_url('public/datatables/js/dataTables.bootstrap.js')?>"></script>
    <script src="<?php echo base_url('public/bootstrap/js/bootstrap.min.js')?>"></script>
    <script>
    $(document).ready(function(){
        //datatables
        table = $('#example').DataTable({ 
	//"processing": true, //Muestra el mensaje procesando mientras carga el datatable
        "serverSide": true, //Del lado del servidor
        "order": [[ 0, "asc" ]], //Ordenado por defecto por la primera columna ascendente.
        
         // Envio los parametros (POST) del datatable (Ej: search, order, etc) y 
        // Recibo los datos desde la url por ajax
        "ajax": {
            "url": "<?php echo base_url(); ?>" + "index.php/welcome/drawTable",
            "type": "POST"
        }
    });
    });
    </script>
    
  <!-- Modal Para Editar y Agregar-->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Municipio</h4>
        </div>
        <div class="modal-body">
            <input class="form-control" type="hidden" id ="id_Municipio" name="id_Municipio" value="" disabled="true" />
            <input class="form-control" type="hidden" id ="tipo" name="tipo" value="" disabled="true" />
            <input class="form-control" type="text" id ="nombre_Municipio" name="nombre_Municipio" required="true" value="" />
            <br>
            <select class="form-control" name="departamentos" id="departamentos">
                <option value="1">Ahuachapan</option>
                <option value="2">Santa Ana</option>
                <option value="3">Sonsonate</option>
                <option value="4">Chalatenango</option>
                <option value="5">La libertad</option>
                <option value="6">San Salvador</option>
                <option value="7">Cuscatlan</option>
                <option value="8">La Paz</option>
                <option value="9">Cabañas</option>
                <option value="10">San vicente</option>
                <option value="11">Usulutan</option>
                <option value="12">San Miguel</option>
                <option value="13">Morazan</option>
                <option value="14">La Union</option>
            </select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="actualizando()" >Guardar</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
      
    </div>
  </div>
    
</body>
</html>