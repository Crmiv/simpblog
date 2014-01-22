//login module
<?php
require_once('conf.php');
require_once('db_login');
require_once('Auth/HTTP.php');
//pear DB function ,password use MD5
$AuthOptions = 
	array('dsn'=>"mysql://$db_username:$db_password@$db_host/$db_database",
		'table'=>"users",
		'usernamecol'=>"username",
		'passwordcol'=>"password",
		'cryptType'=>"md5",
		'db_fields'=>"*" //can fetch other by use *
	);
$authenticate = new Auth_HTTP("DB",$AuthOptions);
$authenticate->setRealm('Member');
$authenticate->setCancelText('<h2>Error!</h2>');
//start verify
$authenticate->start();

//if verify success
if($authenticate->getAuth())
	{
		session_start();

		$smarty->assign('blog',$blog);
		$smarty->display('header.tpl');
		$_SESSION['username'] = $authenticate->username;
		$_SESSION['first_name']=$authenticate->getAuthData('first_name');
		$_SESSION['last_name']=$authenticate->getAuthData('last_name');
		$_SESSION['user_id']=$authenticate->getAuthData('user_id');
		echo "Login success!"
		$smarty->display('footer.tpl');
	}
