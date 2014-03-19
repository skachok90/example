<?php
$router = new Zend_Controller_Router_Rewrite();
$router->addRoutes(array(
	//default
	'index'						=> new Zend_Controller_Router_Route_Regex('', array('module' => 'default', 'controller' => 'index', 'action' => 'index'), array(), ''),
	
	'default:search'			=> new Zend_Controller_Router_Route_Regex('search(\.html)?', array('module' => 'default', 'controller' => 'index', 'action' => 'search'), array(), 'search.html'),
	'default:show-perfect-match'=> new Zend_Controller_Router_Route_Regex('show-perfect-match(\.html)?', array('module' => 'default', 'controller' => 'index', 'action' => 'show-perfect-match'), array(), 'show-perfect-match.html'),
	'default:show-partial-match'=> new Zend_Controller_Router_Route_Regex('show-partial-match(\.html)?', array('module' => 'default', 'controller' => 'index', 'action' => 'show-partial-match'), array(), 'show-partial-match.html'),
	'default:terms'				=> new Zend_Controller_Router_Route_Regex('terms(\.html)?', array('module' => 'default', 'controller' => 'index', 'action' => 'terms'), array(), 'terms.html'),
	
	'default:login'				=> new Zend_Controller_Router_Route_Regex('login(\.html)?', array('module' => 'default', 'controller' => 'auth', 'action' => 'login'), array(), 'login.html'),
	'default:logout'			=> new Zend_Controller_Router_Route_Regex('logout(\.html)?', array('module' => 'default', 'controller' => 'auth', 'action' => 'logout'), array(), 'logout.html'),
	'default:registration'		=> new Zend_Controller_Router_Route_Regex('registration(\.html)?', array('module' => 'default', 'controller' => 'auth', 'action' => 'registration'), array(), 'registration.html'),
	'default:forgot'			=> new Zend_Controller_Router_Route_Regex('forgot(\.html)?', array('module' => 'default', 'controller' => 'auth', 'action' => 'forgot'), array(), 'forgot.html'),
	'default:password-recovery' => new Zend_Controller_Router_Route_Regex('password-recovery(\.html)?', array('module' => 'default', 'controller' => 'auth', 'action' => 'password-recovery'), array(), 'password-recovery.html'),

	//admin
	'admin'						=> new Zend_Controller_Router_Route_Regex('admin(\.html)?', array('module' => 'admin', 'controller' => 'index', 'action' => 'index'), array(), 'admin.html'),
	
	'admin:login'				=> new Zend_Controller_Router_Route_Regex('admin/login(\.html)?', array('module' => 'admin', 'controller' => 'auth', 'action' => 'login'), array(), 'admin/login.html'),
	'admin:logout'				=> new Zend_Controller_Router_Route_Regex('admin/logout(\.html)?', array('module' => 'admin', 'controller' => 'auth', 'action' => 'logout'), array(), 'admin/logout.html'),

	'admin:profile'				=> new Zend_Controller_Router_Route_Regex('admin/profile(\.html)?', array('module' => 'admin', 'controller' => 'admin', 'action' => 'profile'), array(), 'admin/profile.html'),
	
	'admin:customers'			=> new Zend_Controller_Router_Route_Regex('admin/customers(\.html)?', array('module' => 'admin', 'controller' => 'customers', 'action' => 'index'), array(), 'admin/customers.html'),
	'admin:edit-customer'		=> new Zend_Controller_Router_Route_Regex('admin/edit-customer/(\d+)(\.html)?', array('module' => 'admin', 'controller' => 'customers', 'action' => 'edit'), array(1 => 'id'), 'admin/edit-customer/%d.html'),
	'admin:delete-customer'		=> new Zend_Controller_Router_Route_Regex('admin/delete-customer/(\d+)(\.html)?', array('module' => 'admin', 'controller' => 'customers', 'action' => 'delete'), array(1 => 'id'), 'admin/delete-customer/%d.html'),

	'admin:studies'				=> new Zend_Controller_Router_Route_Regex('admin/studies(\.html)?', array('module' => 'admin', 'controller' => 'studies', 'action' => 'index'), array(), 'admin/studies.html'),
	'admin:edit-study'			=> new Zend_Controller_Router_Route_Regex('admin/edit-study/(\d+)(\.html)?', array('module' => 'admin', 'controller' => 'studies', 'action' => 'edit'), array(1 => 'id'), 'admin/edit-study/%d.html'),
	'admin:add-study'			=> new Zend_Controller_Router_Route_Regex('admin/add-study(\.html)?', array('module' => 'admin', 'controller' => 'studies', 'action' => 'edit'), array(), 'admin/add-study.html'),
	'admin:delete-study'		=> new Zend_Controller_Router_Route_Regex('admin/delete-study/(\d+)(\.html)?', array('module' => 'admin', 'controller' => 'studies', 'action' => 'delete'), array(1 => 'id'), 'admin/delete-study/%d.html'),
	
	'admin:patients'			=> new Zend_Controller_Router_Route_Regex('admin/patients/(\d+)(\.html)?', array('module' => 'admin', 'controller' => 'patients', 'action' => 'index'), array(1 => 'study-id'), 'admin/patients/%d.html'),
	'admin:edit-patient'		=> new Zend_Controller_Router_Route_Regex('admin/edit-patient/(\d+)(\.html)?', array('module' => 'admin', 'controller' => 'patients', 'action' => 'edit'), array(1 => 'id'), 'admin/edit-patient/%d.html'),
	'admin:add-patient'			=> new Zend_Controller_Router_Route_Regex('admin/add-patient/(\d+)(\.html)?', array('module' => 'admin', 'controller' => 'patients', 'action' => 'edit'), array(1 => 'study-id'), 'admin/add-patient/%d.html'),
	'admin:delete-patient'		=> new Zend_Controller_Router_Route_Regex('admin/delete-patient/(\d+)(\.html)?', array('module' => 'admin', 'controller' => 'patients', 'action' => 'delete'), array(1 => 'id'), 'admin/delete-patient/%d.html'),
	'admin:import-patients'		=> new Zend_Controller_Router_Route_Regex('admin/import-patients/(\d+)(\.html)?', array('module' => 'admin', 'controller' => 'patients', 'action' => 'import'), array(1 => 'study-id'), 'admin/import-patients/%d.html'),

	'admin:incoming-requests'	=> new Zend_Controller_Router_Route_Regex('admin/incoming-requests(\.html)?', array('module' => 'admin', 'controller' => 'incoming-requests', 'action' => 'index'), array(), 'admin/incoming-requests.html'),
	'admin:edit-incoming-request'	=> new Zend_Controller_Router_Route_Regex('admin/edit-incoming-request/(\d+)(\.html)?', array('module' => 'admin', 'controller' => 'incoming-requests', 'action' => 'edit'), array(1 => 'id'), 'admin/edit-incoming-request/%d.html'),
	'admin:delete-incoming-request'	=> new Zend_Controller_Router_Route_Regex('admin/delete-incoming-request/(\d+)(\.html)?', array('module' => 'admin', 'controller' => 'incoming-requests', 'action' => 'delete'), array(1 => 'id'), 'admin/delete-incoming-request/%d.html'),

));
