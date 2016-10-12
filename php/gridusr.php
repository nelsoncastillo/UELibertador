<?
if (isset($_GET['modo'])=="")
{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Grid Usuarios</title>
<style type="text/css">

a:link {
    color: #333333;
}

</style></head>

<body>
<? 
include_once("conexion.php");

$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
$cadena= "SELECT * FROM usuarios ORDER BY id";
$resultadoc = $con->consultar($cadena); //mysql_query($cadena,$con);
if ($resultadoc) { $cont=$con->contar($resultadoc);
	}else{
		$cont =' - sin registros - ';
		}
	$nuevo=$cont +1;
?>

<form action="gridusr.php?modo=g&cont=<? echo $nuevo;?>" method="post" name="frm_usuarios" id="frm_usuarios">
  <table width="300" border="1" align="center" cellpadding="0" cellspacing="0">
	<TR BGCOLOR="#58ACFA">
      <td colspan="2"><div align="center">USUARIOS</div></td>
    </tr>
    <tr>
      <td colspan="2">
      <center>
      <input name="grabar" type="submit" id="grabar" value="Agregar Nuevo">
      </center>
    </tr>
  </table>
</form>
<br>
<br>
<table width="600" border="1" align="center" cellpadding="0" cellspacing="0">
  <TR BGCOLOR="#58ACFA">
    <td colspan="6"><div align="center">Listado de Usuarios </div></td>
  </tr>
  <tr>
    <td width="40">Id</td>
    <td width="200">Usuario</td>
    <td width="80">Tipo</td>
    <td width="100">Email</td>
    <td width="20"></td>
    <td width="20"></td>
  </tr> 
    <?

  while($rowc=$con->registros($resultadoc))
  {
  ?> 
    <tr>
    <td><? echo $rowc->id;?></td>
    <td><? echo $rowc->username;?></td>
    <td><? echo $rowc->type;?></td>
    <td><? echo $rowc->email;?></td>
    <td><a href="gridusr.php?modo=m&id=<? echo $rowc->id;?>&usuario=<? echo $rowc->username;?>&tipo=<? echo $rowc->type;?>&email=<? echo $rowc->email;?>">Edt</a></td>
    <td><a href="gridusr.php?modo=e&id=<? echo $rowc->id;?>">Elm</a></td>
    </tr>
  <?
  }
  ?>
  <TR BGCOLOR="#58ACFA">
	 <?  
   echo ' <td colspan="6"><div align="center">Total: '.$cont.' Usuarios </div></td>'
    ?>
  </tr>
</table>


</body>
</html>
<?
}
else
{

$modo=$_GET['modo'];
if ($modo=="g")
{
// ******************************   Rutina para Guardar   ******************************
// aqui cargar el formulario de usuarios, guardar usuario nuevo, con indice total+1
$cont=$_GET['cont'];
echo '<form id="frm_usuarios_apend" action="gridusr.php?modo=a" method="get" name="frm_usuarios_apend" >
<table width="300" border="2" align="center" cellpadding="0" cellspacing="0">
	<TR BGCOLOR="#58ACFA">
      <td colspan="2"><div align="center"> Agregar Usuario '.$cont.'</div></td>
    </tr>
    <tr>
      <td colspan="2">
      <center>
<tr>
<td width="100">&nbsp;&nbsp;Usuario</td>
      <td width="194">&nbsp;
      <input name="usuario" type="text" id="usuario" size="27" maxlength="25" value=""></td></tr>
<td width="100">&nbsp;&nbsp;Tipo &nbsp;&nbsp;&nbsp;&nbsp;</td>
      <td width="194">&nbsp;
      <input name="tipo" type="text" id="tipo" size="27" maxlength="25" value=""></td></tr>
<td width="100">&nbsp;&nbsp;Email &nbsp;&nbsp;</td>
      <td width="194">&nbsp;
      <input name="email" type="email" id="email" size="27" maxlength="25" value=""></td></tr>
      <input name="id" type="hidden" value="'.$cont.'">';

session_start();
if ($_SESSION['tipo']=='admin'){
?>
<td width="100">&nbsp;&nbsp;Password</td>
      <td width="194">&nbsp;
      <input name="password" type="text" id="password" size="27" maxlength="25" value=''>
      </td>
</tr>
<?
}

?>
<input name="modo" type="hidden" id="guardar" value="a">
<TR ALIGN=center>
<TD></TD><td>
<button type="submit">Guardar</button>
</td></tr>
<?
echo '</center>
    </tr>
  </table>
  </form>';
}
//==================== rutina append ==================================
$modo=$_GET['modo'];
if ($modo=="a")
{
include_once("conexion.php");
$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
$id=$_GET['id'];
$usuario=$_GET['usuario'];
$tipo=$_GET['tipo'];
$email=$_GET['email'];
$pass=$_GET['password'];
if(empty($pass)) $pass="1234";
$cadena= "INSERT INTO usuarios (id, username,type,email,password) values ('$id','$usuario','$tipo','$email','$pass')";
$resultado = $con->consultar($cadena); 
header("location:gridusr.php");
}
//================= Rutina Uptade ====================================
if ($modo=="u")
{
include_once("conexion.php");	
$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
$id=$_GET['id'];
$usuario=$_GET['usuario'];
$tipo=$_GET['tipo'];
$email=$_GET['email'];
$pass=$_GET['password'];
if(empty($pass)) $pass="1234";
$cadena= "UPDATE usuarios  set id ='$id', username='$usuario' ,type='$tipo',email='$email',password='$pass' WHERE id='$id' ;";
$resultado = $con->consultar($cadena); 
header("location:gridusr.php");
}

// ******************************   Formulario para Modificar ******************************
if ($modo=="m")
{
$id=$_GET['id'];
$usuario=$_GET['usuario'];
$tipo=$_GET['tipo'];
$email=$_GET['email'];

echo '<form id="frm_usuarios_update" action="gridusr.php?modo=u" method="get" name="frm_usuarios_update" >
<table width="300" border="2" align="center" cellpadding="0" cellspacing="0">
	<TR BGCOLOR="#58ACFA">
      <td colspan="2"><div align="center"> Modificar Usuario '.$id.'</div></td>
    </tr>';
?>   
<tr>
<td width="100">&nbsp;&nbsp;Usuario</td>
      <td width="194">&nbsp;
      <input name="usuario" type="text" id="usuario" size="27" maxlength="25" value='<?echo $usuario?>'></td>
</tr>
<tr>
<td width="100">&nbsp;&nbsp;Tipo &nbsp;&nbsp;&nbsp;&nbsp;</td>
      <td width="194">&nbsp;
      <input name="tipo" type="text" id="tipo" size="27" maxlength="25" value='<?echo $tipo?>'></td>
      <br>
</tr>
<tr>
<td width="100">&nbsp;&nbsp;Email &nbsp;&nbsp;</td>
      <td width="194">&nbsp;
      <input name="email" type="text" id="email" size="27" maxlength="25" value='<?echo $email?>'></td>
      <br>
</tr>
<?
session_start();
if ($_SESSION['tipo']=='admin'){
?>   
<tr>
<td width="100">&nbsp;&nbsp;Password</td>
      <td width="194">&nbsp;
      <input name="password" type="text" id="password" size="27" maxlength="25" value=''></td>
</tr>

<?	
	}
?>
<TR ALIGN=center>
<TD></TD><td>
<input name="modo" type="hidden" id="guardar" value="u">
 <input name="id" type= "hidden" value="<?echo $id;?>">
<button type="submit">Guardar</button>
</td>
</tr>
</form>

<?
//echo "</div>";
// ******************************   Rutina para Eliminar  ******************************
}if ($modo=="e")
{
include_once("conexion.php");	
$id=$_GET['id'];
$wsql="SELECT * FROM productos WHERE idcategoria = '$id'";
$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
$resultado = $con->consultar($wsql); 
$row=pg_fetch_object($resultado);
if ($row==0)
{
	$nombre=$_POST['usuario'];
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "DELETE FROM usuarios WHERE id = '$id'";
	$resultado = $con->consultar($cadena); 

}
else
{
    $_SESSION['msgcat'] = "No se Puede Eliminar usuario";
}
header("location:gridusr.php");
}
}
?>
