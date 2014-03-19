<?php
abstract class Form_AbstractSubForm extends Zend_Form_SubForm
{
	protected $params				= array();
	protected $customView			= '';
	
	public function __construct($params = array(), $options = null)
	{
		$this->params = $params;
		
		parent::__construct($options);
	}
	
	public function render()
	{
		if ($tpl = $this->getCustomView())
		{
			$this->setDecorators(array(
				array('ViewScript', array('viewScript' => 'forms/' . $tpl)),
			));
		}
		else
		{
			$this->setDecorators(array(
				'FormElements', 
			));
		}
		
		return parent::render();
	}
	
	public function setCustomView($tpl)
	{
		$this->customView = $tpl;
		
		return $this;
	}
	
	public function getCustomView()
	{
		return $this->customView;
	}

	public function addParam($name, $value)
	{
		$this->params[$name] = $value;
		
		return $this;
	}
	
	public function addParams($params)
	{
		$this->params = array_merge_recursive($this->params, $params);
		
		return $this;
	}
	
	public function getParam($param, $default = null)
	{
		return isset($this->params[$param]) ? $this->params[$param] : $default;
	}
	
	public function getParams()
	{
		return $this->params;
	}
}