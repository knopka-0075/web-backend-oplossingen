<?php

	class Message
	{
		private $type;
		private $text;

		public function __construct($type, $text)
		{
			$this->type = $type;
			$this->text = $text;

			$this->addMessageToSession();
		}

		private function addMessageToSession()
		{
			$_SESSION['message']['type'] = $this->type;
			$_SESSION['message']['text'] = $this->text;
		}

		private function removeMessageFromSession()
		{
			unset($_SESSION['message']);
		}

		public static function getMessage()
		{
			$message = false;

			if(isset($_SESSION['message']))
			{
				$message['type'] = $_SESSION['message']['type'];
				$message['text'] = $_SESSION['message']['text'];

				self::removeMessageFromSession( );
			}

			return $message;
		}
		
	}

?>