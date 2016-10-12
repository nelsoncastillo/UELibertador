 <?php
/**
 * PHP Grid Component
 *
 * @author Abu Ghufran <gridphp@gmail.com> - http://www.phpgrid.org
 * @version 2.0.0
 * @license: see license.txt included in package
 */

/**
 * Basic Grid Sample
 * You can use inline edit mode or dialog edit mode
 */
//include_once("../../config.php");

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

$grid["caption"] = "Usuarios";
$grid["autowidth"] = true;
$grid["sortable"] = true;
$grid["rownumWidth"] = 20;
$grid["autoresize"] = true;
$grid["altRows"] = true; 


$grid["rowNum"] = 15;
$g->set_options($grid);
$g->table = "usuarios";

$out = $g->render("listUsuarios");
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
    <div>
    <?php echo $out?>
    </div>
</body>
</html>

 
