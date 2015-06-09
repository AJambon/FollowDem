<?php
/**
*	Classe Erreur - Permet la remont�e des messages d'erreur et la gestion des codes syst�mes � travers les Exceptions
*	@author Fabien Selles
*	@copyright Parc national des �crins
*	
*/
//@include_once trackedobjects.class.php
//extends tracked_objects

class erreur extends Exception 
{

	public function __construct($code = 0, Exception $previous = null)
	{
		$message =  traduction::t('error_'.$code);
		
		parent::__construct($message, $code, $previous);
	}	

}