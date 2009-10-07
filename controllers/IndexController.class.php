<?php

class IndexController extends Controller
{
	function Index()
	{
		echo "ImageServer. Nothing to see here.";
	}

	function Images()
	{
		echo '<pre>';	
		$images = Image::GetAll( 'Image' );
		$i = 1;

		echo "Images: ". count( $images ) . "\n\n";
		if( $images ) foreach( $images as $image )
		{
			echo $i++ ." - ". basename( $image->file ) ."\n";	
		}
	}

}
