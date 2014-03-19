<?php
class Helper_PageNavigator extends Zend_Controller_Action_Helper_Abstract
{
	public function getNavigator($totalCnt, $page = null, $ipp = null)
	{
		$conf = Zend_Registry::get('config');
		
		$paginator = Zend_Paginator::factory((int)$totalCnt);
		$paginator->setCurrentPageNumber((int)($page ? $page : $this->getPage()));
		$paginator->setItemCountPerPage((int)($ipp ? $ipp : $this->getIpp()));
		$paginator->setPageRange((int)$conf->pn->pageRange);
		
		return $paginator;
	}
	
	public function getIpp()
	{
		return (int)Zend_Registry::get('config')->pn->ipp;
	}
	
	public function getIppSearch()
	{
		return (int)Zend_Registry::get('config')->pn->ippSearch;
	}
	
	public function getPage($namePageParam = 'page')
	{
		$page = (int)$this->getActionController()->getRequest()->getParam($namePageParam);
		
		return $page ? $page : 1;
	}
}