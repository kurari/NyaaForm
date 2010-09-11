<?php
/**
 * 日付入力
 */

class NyaaFormInputDate extends NyaaFormInput
{
	public $template = ':html';
	public $from = '1980-01-01';
	public $to = '1982-12-01';
	public $parseFormat = '([0-9]+)-([0-9]+)-([0-9]+)';

	public function __construct( )
	{
		$this->to = date('Y-m-d');
	}

	function setFrom( $from )
	{
		$this->from = $from;
	}

	function setTo( $to )
	{
		$this->to = $to;
	}

	function parseDate( $text )
	{
		if(preg_match('/'.$this->parseFormat.'/', $text, $m))
		{
			$ret['year']  = $m[1];
			$ret['month'] = $m[2];
			$ret['day']   = $m[3];
		}
		return $ret;
	}


	function toHtml( )
	{
		$from = $this->parseDate( $this->from );
		$to   = $this->parseDate( $this->to );
		$optYear = array();
		$optMonth = array();
		$optDay = array();

		for($i=$from['year']; $i <= $to['year']; $i++) $optYear[$i]=$i;
		for($i=1; $i <= 12; $i++) $optMonth[$i]=$i;
		for($i=1; $i <= 31; $i++) $optDay[$i]=$i;

		$year = NyaaFormInput::factory(
			array(
				'type'=>'select',
				'name'=>$this->getProp('name').'[year]',
				'options'=>$optYear
			)
		);
		$month = NyaaFormInput::factory(
			array(
				'type'=>'select',
				'name'=>$this->getProp('name').'[month]',
				'options'=>$optMonth
			)
		);
		$day = NyaaFormInput::factory(
			array(
				'type'=>'select',
				'name'=>$this->getProp('name').'[day]',
				'options'=>$optDay
			)
		);

		$year->setValue( $this->value['year'] );
		$month->setValue( $this->value['month'] );
		$day->setValue( $this->value['day'] );

		return sprintf('%s&nbsp;%s&nbsp;%s', $year, $month, $day);
	}


}
?>
