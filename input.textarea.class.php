<?php
/**
 * Textarea 
 * ----
 */
class NyaaFormInputTextarea extends NyaaFormInput
{
	public $template = '<textarea id=":id" name=":name" class=":class" style=":style" cols=":cols" rows=":rows">:value</textarea>';
	public $cols = 60;
	public $rows = 5;

	function setCols( $cols )
	{
		$this->cols = $cols;
	}
	function setRows( $rows )
	{
		$this->rows = $rows;
	}
}
?>
