<?php
/**
 * Option
 * ----
 */
class NyaaFormInputOption extends NyaaFormInput
{
	public $template = '<option value=":value" :etc>:label</option>';

	function setValue( $value )
	{
		if( empty($this->value) )
		{
			$this->value = $value;
		}
		elseif($value == $this->value)
		{
			$this->etc = 'selected="selected"';
		}
	}
}
?>
