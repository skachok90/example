<?phpclass Helper_SystemAlert extends Zend_Controller_Action_Helper_Abstract{	const SESSION_INDEX					= 'SA';		const MSG_PASSWORD_CHANGED			= 'MSG_PASSWORD_CHANGED';		private static $messages			= array(											self::MSG_PASSWORD_CHANGED => array(												'title' => 'Изменение пароля',												'text' => 'Пароль успешно изменён',											),										);		public function direct($msg)	{		$session = Zend_Registry::get('session');		$msgList = (array)$session->{self::SESSION_INDEX};				if (self::$messages[$msg])
		{
			$msgList[] = self::$messages[$msg];
		}
		else		{
			$msgList[] = $msg;
		}				$session->{self::SESSION_INDEX} = $msgList;	}		public function clean()	{		if(!$this->getResponse()->isRedirect())		{			Zend_Registry::get('session')->{self::SESSION_INDEX} = null;		}	}		public function getMessages()	{		return (array)Zend_Registry::get('session')->{self::SESSION_INDEX};	}}