<?php
class NyaaFormInputSubmit extends NyaaFormInput
{
	public $type = "submit";

	function __construct( )
	{
		parent::__construct( );
	}

	function getProp( $name )
	{
		if($name == "value"){
			return parent::getProp( 'label' );
		}
		return parent::getProp($name);
	}
}
?>
