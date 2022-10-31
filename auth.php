<?php

function Auth($authorization){
	list($type, $authorization) = explode(" ", $authorization);
	
	$valid_tokens = array(
		'FREETOKEN',
	);
	
	if(in_array($authorization, $valid_tokens)) return true;
	
	return false;
}

?>