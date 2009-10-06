<?php

class UploadController extends Controller
{
	function Index()
	{
		self::Redirect( '/Error/NotFound' );
	}

	function File()
	{
		if( $_SERVER[ 'HTTP_REQUEST' ] == 'POST' )
		{
			$input = Common::Inputs( array( 'token', 'dir', 'filename' ), INPUT_POST );
			if( self::ValidateToken( $input->token ) )
			{
				if( strlen( $input->dir ) < 1 )
					$input->dir = '/';	

				if( strlen( $input->filename ) < 1 )
					$input->filename = $_FILES[ 'file' ][ 'name' ];

				$dir = PROJECT_PATH .'/resources' . $input->dir;
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
		if( md5( date( "Y-m-d" ) . AUTH_SECRET ) == $token )
			return true;
	}
}
