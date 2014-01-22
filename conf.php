<?php
//depend smarty
require('/usr/local/lib/Smarty-3.1.16/libs/Smarty.class.php');
$smarty = new Smarty();

$blog = "Blog";

//smart is used as a location that template save files in, 
//server has write-right

$smarty->template_dir = 'smart/templates';
$smarty->compile_dir = 'smart/templates_c';
$smarty->cache_dir = 'smart/cache';
$smarty->config_dir = 'smart/configs';

?>
