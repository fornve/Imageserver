<?php

class IndexController extends Controller
{
	function Index()
	{
		$entity = new Entity();
		$collection = $entity->Collection( "SELECT * FROM image" );
		var_dump( $entity );
		echo "ImageServer. Nothing to see here.";
	}

	function Images()
	{
		$images = Image::GetAll( 'Image' );
		$this->Assign( 'images', $images );
		echo $this->Decorate( 'images.tpl' );
	}

}
