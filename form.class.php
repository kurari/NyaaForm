<?php
require_once 'form/input.class.php';

class NyaaForm extends NyaaObject
{
	public $inputs       = array( );
	public $hiddens      = array( );
	public $name         = "";
	public $method       = "post";
	public $enctype      = "application/x-www-form-urlencode";
	public $headTemplate = '<form name=":name" method=":method" enctype=":enctype">';
	public $tailTemplate = '</form>';

	function loadFile( $file )
	{
		$store = NyaaConf::load($file);
		foreach( $store->get() as $k=>$v )
		{
			$v['type'] = isset($v['type']) ? $v['type']: 'text';
			$input = NyaaFormInput::factory(array_merge($v, array('name'=>$k)));
			$this->addInput( $input );
		}
	}

	function setEnctype( $enctype )
	{
		$this->enctype = $enctype;
	}

	function addInput( $object )
	{
		$index = count($this->inputs);
		$this->inputs[$index] = $object;
		$this->inputIndex[$object->getProp('name')] = $index;
	}

	function getInputs( )
	{
		$ret = array( );
		$args = func_get_args( );
		if(count($args) == 0)
			return $this->inputs;
		foreach($args as $k)
			$ret[$k] = $this->getInput($k);
		return $ret;
	}

	function getInput( $name )
	{
		if(!isset($this->inputIndex[$name]))
			return false;

		$index = $this->inputIndex[$name];
		return $this->inputs[$index];
	}

	function addHidden( $key,$value )
	{
		$this->hiddens[] = NyaaFormInput::factory(
			array(
				'type'=>'hidden',
				'name'=>$key,
				'value'=>$value
			)
		);
	}

	function getProp( $name )
	{
		return $this->$name;
	}

	function setValues( $values )
	{
		foreach( $values as $k=>$v )
		{
			if( $this->getInput($k) )
				$this->getInput($k)->setValue( $v );
		}
	}

	function toHead( )
	{
		$head = preg_replace('/:([a-zA-Z_]+)/e', '$this->getProp("\1")', $this->headTemplate );
		foreach( $this->hiddens as $input )
		{
			$head.= $input->toHtml();
		}
		return $head;
	}
	function toTail( )
	{
		return preg_replace('/:([a-zA-Z_]+)/e', '$this->getProp("\1")', $this->tailTemplate );
	}
}

?>
