<?php
class Admin_IndexController extends Controller_Abstract
{
	public function indexAction()
	{
	}
	
	public function menuAction()
	{
		$fcr = $this->getFrontController()->getRequest();
		$currentModule = $fcr->getControllerName();
		
		$m = new Admin_Modules();
		
		$modules = $m->getAll();
		
		for ($i = 0, $sz = count($modules); $i < $sz - 1; $i++) 
		{
			for ($j = 1; $j < $sz; $j++) 
			{
				if ($modules[$i]['sort_order'] > $modules[$j]['sort_order']) {
					$tmp = $modules[$i];
					$modules[$i] = $modules[$j];
					$modules[$j] = $tmp;
				}
			}
		}
		
		for ($i = 0; $i < $sz; $i++)
		{
			$module = $modules[$i];
			$list[$i]['url_name'] = strtolower(str_replace(' ', '-', $module['name']));
			$list[$i]['current'] = $list[$i]['url_name'] == $currentModule;
			$list[$i]['name'] = $module['name'];
		}

		$this->view->assign(array(
			'modules' => $list,
		));
		
	}
}
