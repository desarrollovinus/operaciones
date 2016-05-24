<?php

function ReplaceChar($phrase){
		$chars=array("'",'"',"%","#","$","!","&");
		$replace=str_replace($chars,"",$phrase);
		return $replace;
	}	




function Concatena($vec){
	// Concateno los campos de la tabla a consultar con comas 
	$tam=sizeof($vec);
	$text="";
	for($i=0;$i<$tam;$i++){
		if($i==0){
			$text=$text.$vec[$i];
		}
		else{
			$text=$text.", ".$vec[$i];
		}
	}
	return $text;
}


?>