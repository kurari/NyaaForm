<?php
class NyaaFormInputCheckbox extends NyaaFormInput
{
	public $type = "checkbox";
	public $value = "on";

	function __construct( )
	{
		parent::__construct( );
	}

	function setValue( $value )
	{
		if($value == $this->value)
		{
			$this->etc = 'checked="checked"';
		}
		//$this->value = $value;
	}
}
?>
