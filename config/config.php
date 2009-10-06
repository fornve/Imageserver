<?php
#error_reporting( E_ALL ^E_WARNING ^E_NOTICE );
error_reporting( E_ALL );
define( 'TIMER', microtime( true ) );
define( 'PROJECT_PATH', substr( __file__, 0, strlen( __file__ ) - 18 ) );
 
/* configuration begins */
 
define( 'PROJECT_NAME', 'imageserver' );
  
define( 'INCLUDE_PATH', '/var/www/include/' );
define( 'SMARTY_DIR', INCLUDE_PATH .'smarty/' );
define( 'SMARTY_TEMPLATES_DIR', PROJECT_PATH ."/templates/" );
define( 'PRODUCTION', false );
 
define( 'ADMIN_EMAIL', 'marek@dajnowski.net' );
define( 'SMARTY_COMPILE_DIR', '/tmp/shop' );
define( 'ASSETS_PATH', '/home/fornve/assets/shop' );

require_once( 'database.php' );
 
/* end of configuration */
 
if( !file_exists( INCLUDE_PATH .'/class/Entity.class.php' ) )
{
	die('LiteEntityLib not found, please follow <a href="http://www.sum-e.com/Page/Installation/#LiteEntityLib">instructions</a> to install it.');
}
 
if( !file_exists( SMARTY_COMPILE_DIR ) )
mkdir( SMARTY_COMPILE_DIR );
 
require_once( SMARTY_DIR .'Smarty.class.php' );
 
function __autoload( $name )
{
	$path_array = array( 'classes/', 'entities/', 'controllers/', INCLUDE_PATH .'class/' );
	 
	foreach( $path_array as $path )
	{
		if( file_exists( $path . $name .'.class.php' ) )
		{
		include_once( $path . $name .'.class.php' );
		return true;
		}
	}
}
