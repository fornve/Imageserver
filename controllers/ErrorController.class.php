<?php

class ErrorController extends Controller
{
	function NotFound()
	{
		header( "HTTP/1.0 404 Not Found" );
		echo 'Not found.';	
	}
}
