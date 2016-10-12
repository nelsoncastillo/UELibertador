<?php 
// aqui se contuyen los encabezados de la tabla
include_once ("../php/conexion.php");
$tabla='docentes';
//$this->tabla= $tabla;
$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
$cadena="SELECT  distinct (a.attname) as column_name, t.typname as data_type, e.ordinal_position as orden,
CASE
WHEN cc.contype= 'p' THEN 'PRI'
WHEN cc.contype= 'u' THEN 'UNI'
WHEN cc.contype= 'f' THEN 'FK'
ELSE '' END AS key,
CASE WHEN a.attnotnull=false THEN 'YES' ELSE 'NO' END AS is_nullable,
CASE WHEN a.attlen= '-1' THEN (a.atttypmod  - 4) ELSE a.attlen END as max_length,
d.adsrc as column_default
FROM pg_catalog.pg_attribute a
LEFT JOIN pg_catalog.pg_type t ON t.oid = a.atttypid
LEFT JOIN pg_catalog.pg_class c ON c.oid = a.attrelid
LEFT JOIN pg_catalog.pg_constraint cc ON cc.conrelid = c.oid AND cc.conkey[1] = a.attnum
LEFT JOIN pg_catalog.pg_attrdef d ON d.adrelid = c.oid AND a.attnum = d.adnum
LEFT JOIN information_schema.columns e on e.column_name= a.attname AND e.table_name = '".$tabla."'
WHERE c.relname = '".$tabla."' AND a.attnum > 0 AND t.oid = a.atttypid ORDER BY orden;";
$resultadoc = $con->consultar($cadena); 
$cont=0;
if ($resultadoc) { 
	$cont=$con->contar($resultadoc);
	}else{
		$cont =' - sin registros - '; 	
	}
   
	$encabezado='<thead>';
	$encabezado.='<tr  BGCOLOR="#58ACFA">';	
	$pie='<tfoot>';
	$pie.='<tr  BGCOLOR="#58ACFA">';	
		while($col=$con->registros($resultadoc))
		{
				$encabezado.= '<th>'.ucwords($col->column_name).'</th>';
				$pie.= '<th>'.ucwords($col->column_name).'</th>';
				$arr[] = $col->column_name;
				if($col->key=='PRI') $indice = $col->column_name;
		}
		$encabezado .= 	'</tr> </thead>';
		$pie .= 	'</tr> </tfoot>';
  // echo $encabezado;

// aqui se contuyen los encabezados de la tabla
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html><head>
<meta charset="utf-8">
<title>Prueba tablas de datos</title>
<link rel="stylesheet" type="text/css" media="all" href="jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" media="all" href="dataTables.bootstrap.min.css">

<script type="text/javascript" src="jquery-1.12.3.js"></script>
<script type="text/javascript" src="jquery.dataTables.min.js"></script>
<script type="text/javascript" src="dataTables.bootstrap.min.js"></script>

</head>
<body>
<script>
	$(document).ready(function() {
		$('#tabla').DataTable();
	} );
</script>

<table id="tabla" class="dataTable" cellspacing="0" width="100%">
<?php 
echo $encabezado;
echo $pie;
?>
        <tbody>
			
            <tr>
                <td>Tiger Nixon</td>
                <td>System Architect</td>
                <td>Edinburgh</td>
                <td>61</td>
                <td>2011/04/25</td>
            </tr>
            <tr>
                <td>Garrett Winters</td>
                <td>Accountant</td>
                <td>Tokyo</td>
                <td>63</td>
                <td>2011/07/25</td>
            </tr>
            
        </tbody>
    </table>
</body>

