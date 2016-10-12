<?php
include_once("conexion.php");

class GrillaS{

public $tabla;
public $recordcount;
public $paginacion;
public $indice;
public $manejador;

public function set_tabla($tabla){
	$this->tabla=$tabla;
	}
	
public function set_Manejador($manejador){
	$this->manejador=$manejador;
	}

public function crear_grilla($tabla,$orden=0,$campoBy=''){
$this->tabla= $tabla;
// contruyendo el encabezado de la tabla
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
LEFT JOIN information_schema.columns e on e.column_name= a.attname AND e.table_name = '".$this->tabla."'
WHERE c.relname = '".$this->tabla."' AND a.attnum > 0 AND t.oid = a.atttypid ORDER BY orden;";
$resultadoc = $con->consultar($cadena); 
$cont=0;
if ($resultadoc) { 
	$cont=$con->contar($resultadoc);
	}else{
		$cont =' - sin registros - '; 	}


$strout= '<!DOCTYPE html>
<html lang="en">
    <head>
    	<meta charset="UTF-8" />
        <title>Listar '.$tabla.'</title>
	</head>
    <body><div align="center">
    	<table border="1"  id='.$tabla.' style="width: 3%;" border="2" cellpadding="1">
		<thead>
			<b> Datos de '.$tabla.'</div><TR BGCOLOR="#58ACFA">';
		//Aqui armo las columnas de la tabla con la definicion que obtengo del schema
		while($col=$con->registros($resultadoc))
		{
				$strout.= '<th>'.ucwords($col->column_name).'</th>';
				$arr[] = $col->column_name;
				if($col->key=='PRI') $this->indice = $col->column_name;
		}
		$strout .= 	'<th colspan="2"> Acciones';
		$strout .= 	'</tr></thead><tbody>';
		// hasta aqui arme el encabezado de la lista 
		// desde aqui se procesan los datos de la tabla y se ingresan a la datatable
$cadena= "SELECT * FROM ".$this->tabla." ";
if(isset($orden)){
	if($orden==1) {
		if (isset($campoBy)){
			if(strlen($campoBy)>=2){
				$cadena.=" ORDER BY ".$campoBy;
				}else{
				if($campoBy=='i') $cadena.=" ORDER BY ".$this->indice;	
					}
			}
		}
	}
//si tiene indice deberia ordenarse
unset($resultadoc);
$resultarow = $con->consultar($cadena); 
$cont=0;
$strout2='';
if ($resultarow) { 
	$this->recordcount=$con->contar($resultarow);
	}else{
		$this->recordcount=0;
		//exit ; 
		}
    $strout2='';
    $id='1';
    $k2=0;
    switch ($tabla) {
    case "alumnos":
        $tabla2=0;
        break;
    case "representantes":
        $tabla2=1;
        break;
    case "procedencias":
        $tabla2=2;
        break;	
   case "viviendas":
        $tabla2=3;
        break;	
   case "datos_habitacion":
        $tabla2=4;
        break;	
        }
    
    
	while ($row = pg_fetch_array($resultarow,null,PGSQL_ASSOC))
	{	$k2=$k2+1;
		$cont=0;
		//$strout2.='<tr >';
		$strout2.='<tr id="fila_'.$k2.'" onclick="myFunction( this, '.$tabla2.' );" >';
		//$strout2.='<tr id="fila_'.$k2.'" onclick="myFunction(this);" >';
		//echo ' id="fila_'.$k2.'" onclick="myFunction(this, '.$tabla.');" ';
		foreach ($arr as $rec) {
		//echo var_dump ($row);	
		//print_r($row);
		if($cont==0) {
		$id = $row[$this->indice];
		//$strout2.='<td><a href="'.$this->manejador.'?modo=si&id='.$id.'">'.$id.'</a></td>';
		$strout2.='<td>'.$id.'</td>';
		}else{
		$strout2.= '<td>'.$row[$rec].'</td>';
		}
		$cont=$cont+1;
		 }
		$id = $row[$this->indice];
		//$strout2.='<td><a href="'.$this->manejador.'?modo=m&id='.$id.'">Edit</a></td>';
		//$strout2.='<td><a href="'.$this->manejador.'?modo=e&id='.$id.'">Elim</a></td>';
		$strout2.='<td><a href="'.$this->manejador.'?modo=si&id='.$id.'">Seleccion</a></td>';
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
 $strout2.='</tbody></table></html>';

$salida= $strout.$strout2;
return $salida;
//json_encode($salida); 

/*
//convirtiendo en json
	$table = $strout.$strout2;
     
    */
}


}
?>
