<?php
include_once("conexion.php");
// contruyendo el encabezado de la tabla
$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
//$cadena= "SELECT column_name , is_nullable, data_type, character_maximum_length ,udt_name  FROM information_schema.columns WHERE table_name = 'docentes' order by ordinal_position;";
$tablita='docentes';
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
LEFT JOIN information_schema.columns e on e.column_name= a.attname AND e.table_name = '$tablita'
WHERE c.relname = '$tablita' AND a.attnum > 0 AND t.oid = a.atttypid";
$resultadoc = $con->consultar($cadena); 
$cont=0;
if ($resultadoc) { $cont=$con->contar($resultadoc);
	}else{
		$cont =' - sin registros - '; 	}

$strout= '<!DOCTYPE html>
<html lang="en">
    <head>
    	<meta charset="UTF-8" />
        <title>Tabla de datos </title>
	</head>
    <body><div align="center">
    	<table border="2">
		<thead>
			<b>'.$tablita.'</td></tr></div><TR BGCOLOR="#58ACFA">';
		//Aqui armo las columnas de la tabla con la definicion que obtengo del schema
		while($col=$con->registros($resultadoc))
		{
				$strout.= '<th>'.ucwords($col->column_name).'</th>';
				$arr[] = $col->column_name;
		}		
		$strout .= 	'</tr></thead><tbody>';
		// hasta aqui arme el encabezado de la lista 
		
		
		// aqui se procesan los datos de la tabla y se ingresan a la datatable
$cadena= "SELECT * FROM $tablita";
unset($resultadoc);
$resultarow = $con->consultar($cadena); 
$cont=0;
$strout2='';
if ($resultarow) { $cont=$con->contar($resultarow);
	}else{
		$cont =' - sin registros - ';  
		//exit ; 
		}
    $strout2='';
	while ($row = pg_fetch_array($resultarow,null,PGSQL_ASSOC))
	{		
		$strout2.='<tr>';
		foreach ($arr as $rec) {
		//echo " Datos  ".$row." val ".$row[$rec];
		//<td><a href="searchEmployee.php?id='.$row[$rec].'">'.$row[$rec].'</a></td>
		$strout2.= '<td>'.$row[$rec].'</td>';
		 }
		 $strout2.='</tr>';
	 }
/*
 * 			<tr>
				<td><a href="searchEmployee.php?id=<?php echo $row['id_empleado']; ?>"><?php echo $row['id_empleado']; ?></a></td>
				<td><?php echo $row['nombre']; ?></td>
				<td><?php echo $row['email']; ?></td>
				<td><?php echo $row['telefono']; ?></td>
			</tr>
			* 
			* */
 $strout2.='</tbody></table></div></html>';
echo $strout;
echo $strout2;

?>
