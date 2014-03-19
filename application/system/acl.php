<?php
$acl = new Zend_Acl();
$acl->addRole(new Zend_Acl_Role(Users::ROLE_GUEST))
	->addRole(new Zend_Acl_Role(Users::ROLE_USER))
	->addRole(new Zend_Acl_Role(Admin_Users::ROLE_ADMIN))
	
	->addResource('index')
	->allow(Users::ROLE_GUEST, 'index', 'index')
	->allow(Users::ROLE_GUEST, 'index', 'terms')
	->allow(Users::ROLE_USER, 'index', 'terms')
	->allow(Users::ROLE_USER, 'index', 'show-perfect-match')
	->allow(Users::ROLE_USER, 'index', 'show-partial-match')
	
	->addResource('admin:index')
	->deny(Users::ROLE_GUEST, 'admin:index')
	->deny(Users::ROLE_USER, 'admin:index')
	->allow(Users::ROLE_GUEST, 'admin:index', 'login')
	->deny(Admin_Users::ROLE_ADMIN, 'admin:index', 'login')
	
	->addResource('admin:admin')
	->deny(Users::ROLE_GUEST, 'admin:admin')
	->deny(Users::ROLE_USER, 'admin:admin')
	->allow(Admin_Users::ROLE_ADMIN, 'admin:admin')
	
	->addResource('admin:customers')
	->deny(Users::ROLE_GUEST, 'admin:customers')
	->deny(Users::ROLE_USER, 'admin:customers')
	->allow(Admin_Users::ROLE_ADMIN, 'admin:customers')
	
	->addResource('admin:studies')
	->deny(Users::ROLE_GUEST, 'admin:studies')
	->deny(Users::ROLE_USER, 'admin:studies')
	->allow(Admin_Users::ROLE_ADMIN, 'admin:studies')
	
	->addResource('admin:patients')
	->deny(Users::ROLE_GUEST, 'admin:patients')
	->deny(Users::ROLE_USER, 'admin:patients')
	->allow(Admin_Users::ROLE_ADMIN, 'admin:patients')
	
	->addResource('admin:incoming-requests')
	->deny(Users::ROLE_GUEST, 'admin:incoming-requests')
	->deny(Users::ROLE_USER, 'admin:incoming-requests')
	->allow(Admin_Users::ROLE_ADMIN, 'admin:incoming-requests')
	;