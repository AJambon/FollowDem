<?php
/**
*	Classe Config
*	Permet de r�cup�rer les donn�es de configuration
*	@author Fabien Selles
*	@copyright Parc National des �crins
*	
*/

class config 
{
	static function get($value='',$array_value='')
	{
		global $config;
		if($array_value!=='')
			return ($value!='' && isset($config[$value][$array_value]))?$config[$value][$array_value]:'';
		else
			return ($value!='' && isset($config[$value]))?$config[$value]:'';
	}
}
?>