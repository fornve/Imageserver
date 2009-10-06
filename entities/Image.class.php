<?php

class Image extends Entity
{
	protected $schema = array( 'id', 'file', 'created', 'last_access' ); 

	static function RetrieveByFile( $file )
	{
		$query = "SELECT * FROM image WHERE file = ?";
		$entity = new Entity();
		return $entity->GetFirstResult( $query, $file, __CLASS__ );
	}

	function PreDelete()
	{
		if( file_exists( $this->file ) )
			unlink( $this->file );
	}
}
