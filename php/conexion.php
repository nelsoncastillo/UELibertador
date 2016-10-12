<?php
    //clase para conectarse con la base de datos postgreSQL y devuelve datos, registros, y contadores
    class Conector_pg
    {
        var $host;//direccion ip del host donde nos conectamos a la bd
        var $bd;//nombre de la base de datos
        var $usuario;//usuario de conexion
        var $password;//clave del usuario de conexion
        var $link;//almacenamos el link para luego destruirlo
        var $RecCount; //contador de registros
            //constructor en el constructor colocamos los datos por defecto, a fin de recibir de manera opcional
        function __construct($host='127.0.0.1', $bd='UELibertador', $user='junior', $pass='junior')
        {
                //asigno valores para ensamblar el string de conexion
                $this->host=$host;
                $this->bd=$bd;
                $this->usuario=$user;
                $this->password=$pass;
                $this->RecCount=0;
        }
     
         //funcion que ejecuta la consulta en la base de datos
        //en esta funcion envio el sql puede ser insert, update, select
        public function consultar($sql)
            {
            //emsamblamos el string de conexion
            $datos_bd="host='$this->host' dbname='$this->bd' user='$this->usuario' password='$this->password'";
            //establecemos el link
            $link=pg_connect($datos_bd);
            //cargamos la variable para el destructor el cual elimina la conexion
            $this->link = $link;
            //ejecutamos la consulta
            $query = pg_query($link,$sql);
            if(!$query){ 
				//si no ejecuta la consulta devuelvo error
				return -1;
				}
            return $query;
        }
        
        public function contar($dataobject){
			$this->RecCount =pg_affected_rows($dataobject);
			return $this->RecCount;
		}
		
		public function registros($dataobject){
			return pg_fetch_object($dataobject);
			}
        
        public function registrosArreglo($dataobject){
			return pg_fetch_array($dataobject);
			}

            //destructor: aca elimino la conexion con postgres
        function __destruct()
            {
               pg_close($this->link);
            }

    }
     
?>
