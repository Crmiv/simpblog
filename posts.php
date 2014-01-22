<?php
session_start();

//dependency
require_once('config.php');
require_once('db_login.php');
require_once('DB.php');

$smarty->assign('blog',$blog);
$smarty->display('header.tpl');

if (!isset($_SESSION['username']))
{
	//use href login
	echo 'First you should <a href="login.php">login</a>';
}
else{
	//connect database
	$connection = DB::connect("mysql://$db_username:$db_password$db_host/$db_database");

	if(DB::isError($connection))
	{
		//can't connect database
		die("could not connect database! " . DB::errorMessage($connection));
	}
	$query = "SELECT * FROM users NATURAL JOIN posts NATURAL JOIN categories ORDER BY posted DESC";

	$result = $connection->query($query);
	if (DB::isError($result)){
		die(DB::errorMessage($result));
	}

	while ($result_row = $result->fetchRow(DB_FETCHMODE_ASSOC)){
		$test[] = $result_row;
	}

	$smarty->assign('posts',$test);
	$smarty->display('posts.tpl');
	$connection->disconnect();
	$smarty->display('footer.tpl');
}

