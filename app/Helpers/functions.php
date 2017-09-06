<?php
function selected($pr1, $pr2){
	$return = $pr1 == $pr2 ? ' selected' : null;
	return $return;
}