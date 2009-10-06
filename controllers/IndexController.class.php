<?php

class IndexController extends Controller
{
	function Index()
	{
		echo "ImageServer. Nothing to see here.";
	}

	function Images()
	{
		$images = Image::GetAll( 'Image' );
		$this->Assign( 'images', $images );
		echo $this->Decorate( 'images.tpl' );
	}

}
