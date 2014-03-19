<?php
class Helper_Mailer extends Zend_Controller_Action_Helper_Abstract
{
	const TPL_REGISTRATION 						= 'registration.eml';
	const TPL_PASSWORD_RECOVERY 				= 'password-recovery.eml';
	const TPL_REGISTRATION_ADMIN_NOTIFICATION 	= 'registration-admin-notification.eml';
	
	private static $config 			= null;
	
	private $subjects				= array(
										self::TPL_REGISTRATION => 'Регистрация на сайте %s',
										self::TPL_PASSWORD_RECOVERY => 'Восстановление пароля на сайте %s',
									);
	
	public function init()
    {
    	if (!self::$config)
		{
			self::$config = Zend_Registry::get('config');
		}
    }

	public function direct($template, array $to, array $data = array(), array $from = array())
	{
		$conf = self::$config->email;
		$from = array_merge(array(
			'name' => $conf->from->name,
			'email' => $conf->from->email,
		), $from);	
		$site = $this->getSite();
		$subject = sprintf($this->subjects[$template], $site['name']);
		
		ob_start();
		include $this->getFrontController()->getModuleDirectory() . $conf->templatesPath . $template;
		$body = ob_get_contents();
		ob_end_clean();

		$mail = new Zend_Mail('UTF-8');
		$mail->setHeaderEncoding(Zend_Mime::ENCODING_BASE64);
		$mail->setBodyHtml($body);
		$mail->setFrom($from['email'], $from['name']);
		$mail->addTo($to['email'], $to['name']);
		$mail->setSubject($subject);
		//@$mail->send();
		
		 //echo $body;
		 //exit;
	}

	public function getSite()
	{
		$server = $this->getRequest()->getServer();
			
		$site = array(
			'name' => self::$config->resources->view->title,
			'host' => $server['HTTP_HOST'],
			'url' => 'http://' . $server['HTTP_HOST'],
			'email_support' => self::$config->email->support,
		);
		
		return $site;
	}

}
