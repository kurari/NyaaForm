<?php
/**
 * Input element
 * ----
 */
require_once 'form/input.text.class.php';
require_once 'form/input.radio.class.php';
require_once 'form/input.checkbox.class.php';
require_once 'form/input.submit.class.php';

		/*
$input = new NyaaFormInputCheckbox( );
$input->setName( 'email' );
$input->setValue( "hajime@avap.co.jp" );
$input->setId('email1');
$input->setLabel('email1');
$input->addClass('test');
$input->addStyle('color','red');
echo $input->toHtml( );
echo $input->toLabel( );
echo htmlspecialchars($input->toHtml( ));
echo htmlspecialchars($input->toLabel( ));
		 */
class NyaaFormInput extends NyaaObject
{
	public $value;
	public $name;
	public $type;
	public $default;
	public $classes  = array();
	public $styles   = array();
	public $template = '<input type=":type" id=":id" name=":name" value=":value" class=":class" style=":style" :etc/>';
	

	public $label = "";
	public $labelTemplate = '<label for=":id">:label</label>';

	function __toString( )
	{
		return $this->toHtml( );
		return get_class($this);
	}

	/**
	 * Input element factory
	 *
	 * option type:
	 * text
	 * radio
	 * checkbox
	 * submit
	 */
	static function factory( $option )
	{
		$file = dirname(__FILE__).'/input.'.$option['type'].'.class.php';
		$class = 'NyaaFormInput'.ucfirst($option['type']);

		require_once $file;
		$input = new $class;
		foreach( $option as $k=>$v )
		{
			$input->setProp($k, $v);
		}
		return $input;
	}

	function setId( $id )
	{
		$this->id = $id;
	}

	function setName( $name )
	{
		$this->name = $name;
	}

	function setValue( $value )
	{
		$this->value = $value;
	}

	function setType( $type )
	{
		$this->type = $type;
	}

	function setDefault( $value )
	{
		$this->default = $value;
	}

	function setLabel( $label )
	{
		$this->label = $label;
	}

	function addClass( $class )
	{
		$this->classes[] = $class;
	}
	function addStyle( $key, $style )
	{
		$this->styles[$key] = $style;
	}

	function setProp( $key, $value )
	{
		return call_user_func(array($this,'set'.ucfirst($key)), $value);
	}

	function getProp($name)
	{
		$value = isset($this->$name) ? $this->$name: null;
		if( empty($value) ) switch($name)
		{
		case 'id':
			return $this->getProp('name');
			break;
		case 'value':
			return $this->getProp('default');
			break;
		case 'class':
			return implode(' ', $this->classes);
			break;
		case 'style':
			$aWork = array( );
			foreach($this->styles as $k=>$v) $aWork[] = "$k:$v;";
			return implode(' ', $aWork);
			break;
		}
		return $value;
	}

	function toHtml( )
	{
		return preg_replace('/:([a-zA-Z_]+)/e', '$this->getProp("\1")', $this->template );
	}

	function toLabel( )
	{
		return preg_replace('/:([a-zA-Z_]+)/e', '$this->getProp("\1")', $this->labelTemplate );
	}
}
?>
