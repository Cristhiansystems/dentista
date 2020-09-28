	
	<?php
	

		include ('../conexion.php');
		
	 
		
		
		$query =$base->prepare("select id_agencia as id, nombre as title from tbl_agencias where estado!='desactivo' ");
		$query->execute();
		if(!$query):			
			    echo 'Error al ejecutar la consulta';
		else:
 				//echo 'intentando obtener registros';
    			$results = $query->fetchAll(PDO::FETCH_ASSOC);
   				echo json_encode($results);
		endif;
	?>