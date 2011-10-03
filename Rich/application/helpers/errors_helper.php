<?php

if ( ! function_exists('show_403'))
{
	function show_403( $reason = '' )
	{
		$error =& load_class('Exceptions');
		$error->show_403($reason);
		exit;
	}
}

?>