<?php
class NyaaFormInputSelect extends NyaaFormInput
{
	public $template = '<select id=":id" name=":name" class=":class" style=":style">:option</select>';
	public $options = array();
	public $blank = "-";

	function __construct( )
	{
		parent::__construct( );
	}

	function setOptions( $options )
	{
		$this->options = $options;
	}
	function setBlank( $blank )
	{
		$this->blank = $blank;
	}


	function toHtml()
	{
		$html = "";
		if( $this->blank != false )
		{
			$option = NyaaFormInput::factory(
				array(
					'type'=>'option',
					'value'=>"",
					'label'=> $this->blank
				)
			);
			$html = $option->toHtml( );
		}
		foreach( $this->options as $k=>$v )
		{
			$option = NyaaFormInput::factory(
				array(
					'type'=>'option',
					'value'=>$k,
					'label'=>$v
				)
			);
			$option->setValue( $this->getProp('value') );
			$html .= $option->toHtml( );
		}
		$this->option = $html;

		return parent::toHtml( );
	}

}
?>
