<?php
class NyaaFormInputImage extends NyaaFormInput
{
	public $type = "file";
	public $url = "file";

	function __construct( )
	{
		parent::__construct( );
	}

	function setUrl( $url )
	{
		$this->url = $url;
	}

	function toHtml( )
	{
		$e = $this->factory( array('type'=>'file', 'name'=>$this->getProp('name')) );

		$html = '<img src="'.$this->getProp('url').'/'.$this->getProp('value').'"/><br />';
		$html.= $e->toHtml();
		return $html;
	}
}
?>
