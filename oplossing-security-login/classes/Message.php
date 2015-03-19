<?php

	class Message
	{
		private $text	=	'';
		private $type	=	'';

		public function __construct( $text, $type )
		{
			$this->text	=	$text;
			$this->type	=	$type;

			$_SESSION['message']	=	array( "text" => $this->text,
												"type" => $this->type );
		}

		public static function hasMessage()
		{
			$hasMessage	=	false; 

			if ( isset( $_SESSION[ 'message' ] ) )
			{
				$hasMessage	=	true;
			}

			return $hasMessage;
		}

		public static function getMessage()
		{
			$message = $_SESSION[ 'message' ];

			return $message;
		}

		public static function remove()
		{
			unset( $_SESSION[ 'message' ] );
		}
	}

?>