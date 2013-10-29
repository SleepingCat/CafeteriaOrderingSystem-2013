<?php defined('SYSPATH') OR die('No direct access allowed.');

class Odtphp {
	
	protected $odf;
	
	public function __construct($template, $config = NULL)
	{
		if (!class_exists('odf', FALSE)) {
			require Kohana::find_file('vendor', 'odtphp/odf');
		}
		
		if ($config === NULL) {
			$config = (array) Kohana::$config;
		}
		
		$this->odf = new odf($template, $config);
	}
	
	public function setVars($varname, $value, $encode = TRUE, $charset='UTF-8')
	{
		$this->odf->setVars($varname, $value, $encode, $charset);
	}
	
	public function setSegment($segment)
	{
		return $this->odf->setSegment($segment);
	}
	
	public function mergeSegment($segment)
	{
		return $this->odf->mergeSegment($segment);
	}
	
	public function exportAsAttachedFile($name="Отчет")
	{
		$this->odf->exportAsAttachedFile();
	}
	
}

