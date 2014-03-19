<?php
abstract class Form_Abstract extends Zend_Form
{
	protected $customView			= '';	
	protected $params				= array();
	
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
				'PrepareElements',
				array('ViewScript', array(
					'viewScript' => 'forms/' . $tpl,
				)),
				'Form',
			));
		}
		/* else
		{
			$this->setDecorators(array(
				'FormElements', 
				array('HtmlTag', array(
                     'tag' => 'dl',
                 )),
				'Form',
			));
		} */
		
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

	protected function _($text)
	{
		return Zend_Registry::get('translator')->_($text);
	}	
}