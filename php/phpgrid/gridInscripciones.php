 <?php

include("lib/inc/jqgrid_dist.php");

// Database config file to be passed in phpgrid constructor
$db_conf = array(     
                    "type"         => "pgsql", 
                    "server"     => "127.0.0.1",
                    "user"         => "junior",
                    "password"     => "junior",
                    "database"     => "UELibertador"
                );

$g = new jqgrid($db_conf);

$grid = array();
$grid["sortname"] = 'id';
$grid["rowNum"] = 10;
$grid["caption"] = "Inscripciones";
$grid["autowidth"] = true;
$grid["sortable"] = true;
//$grid["rownumWidth"] = 35;
$grid["forceFit"] = true;
$grid["autoresize"] = true;
$grid["altRows"] = true;

$col = array();
$col["autoid"] = false;
$col["title"] = "Id"; // caption of column, can use HTML tags too
$col["name"] = "id"; // grid column name, same as db field or alias from sql
$col["width"] = "40"; // width on grid
$col["editable"] = true;
$cols[] = $col;

$g->table = "inscripciones";
$g->select_command = "SELECT * FROM inscripciones";

$g->set_columns($cols,true);
$g->set_options($grid);

$out = $g->render("listinscripciones");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
<head>
    <link rel="stylesheet" type="text/css" media="screen" href="lib/js/themes/redmond/jquery-ui.custom.css"></link>    
    <link rel="stylesheet" type="text/css" media="screen" href="lib/js/jqgrid/css/ui.jqgrid.css"></link>    
 
    <script src="lib/js/jquery.min.js" type="text/javascript"></script>
    <script src="lib/js/jqgrid/js/i18n/grid.locale-en.js" type="text/javascript"></script>
    <script src="lib/js/jqgrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>    
    <script src="lib/js/themes/jquery-ui.custom.min.js" type="text/javascript"></script>
</head>
<body>
	<title>Listado de Inscripciones</title>
    <div>
    <?php echo $out?>
    </div>
</body>
</html>

