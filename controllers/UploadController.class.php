<?php

class UploadController extends Controller
{
	protected static $token = '0a1e90c83d89fd1bf0be8b82a9ff1575';

	function Index()
	{
		self::Redirect( '/Error/NotFound' );
	}

	function File()
	{
		if( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' )
		{
			$input = Common::Inputs( array( 'token', 'dir', 'filename', 'service' ), INPUT_POST );
			if( self::ValidateToken( $input->token ) )
			{
				if( strlen( $input->dir ) < 1 )
					$input->dir = '/';	

				if( strlen( $input->filename ) < 1 )
					$input->filename = $_FILES[ 'file' ][ 'name' ];

				$dir = PROJECT_PATH .'/resources/'. $input->service .'/' . $input->dir;
				if( !file_exists( $dir ) )
					mkdir( $dir, 0700, true );

				$file = $dir . $input->filename;

				if( move_uploaded_file( $_FILES[ 'file' ][ 'tmp_name' ], $file ) )
				{
					$image = new Image();
					$image->file = $file; 
					$image->created = time();
					$image->Save();

					echo 'true';
				}
			}
		}
	}

	protected static function ValidateToken( $token )
	{
		if( md5( self::$token . date( "Y-m-d" ) ) == $token )
			return true;
	}
}
