<?php
/**
 * コンポーネント
 */

class NyaaFormInputComp extends NyaaFormInput
{
	public $template = ':html';
	public $from = '1980-01-01';
	public $to = '1982-12-01';
	public $parseFormat = '([0-9]+)-([0-9]+)-([0-9]+)';

	public function __construct( )
	{
		$this->to = date('Y-m-d');
	}

	function setChild( $child )
	{
		$this->child = $child;
	}

	function setLayout( $layout )
	{
		$this->layout = $layout;
	}
	function setLayout_start( $layout )
	{
		$this->layout_start = $layout;
	}
	function setLayout_end( $layout )
	{
		$this->layout_end = $layout;
	}



	function toHtml( )
	{
		$html= $this->layout_start;
		foreach($this->child as $k=>$v)
		{
			$e = $this->factory(array_merge(array('name'=>$k), $v));
			$main = preg_replace('/%html/',$e->toHtml(), $this->layout);
			$main = preg_replace('/%label/',$e->toLabel(), $main);

			$html .= $main;
		}
		$html .= $this->layout_end;

		return $html;

	}
}
?>
