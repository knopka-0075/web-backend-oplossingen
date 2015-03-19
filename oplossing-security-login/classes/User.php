<?php

	class User
	{
		private $db 	=	'';

		private $cookieDelimiter	=	'#@#';

		private $email		=	'';
		private $password	=	'';
		private $salt		=	'';
		private $usertype	=	'';

		public function __construct( $db )
		{
			$this->db = $db;
		}

		public function register( $email, $password )
		{
			$register = false;

			if ( !$this->checkIfUserExists( $email ) )
			{
				$usertype	=	1;

				$salt 	=	$this->generateSalt();

				$hashedPassword = $this->hash( $password, $salt );

				$registerQuery	=	'INSERT INTO users( email, 
														password, 
														salt, 
														user_type, 
														date) 
										VALUES ( :email,
													:password,
													"' . $salt . '", 
													' . $usertype . ',
													NOW() )';

				$registerPlaceholders	=	array( ':email' => $email,
													':password' => $hashedPassword,
													);

				$this->db->query( $registerQuery, $registerPlaceholders );

				$this->email 		=	$email;
				$this->salt			=	$salt;
				$this->usertype		=	$usertype;

				$this->createCookie();

				$register	=	true;
				
			}
			
			// TODO: Foutboodschap wanneer gebruiker reeds voorkomt
			
			return $register;
		}

		public function login( $email, $password )
		{
			$login = false;

			if ( $this->checkIfUserExists( $email ) )
			{

				$loginQuery	=	'SELECT password, salt
									FROM users
									WHERE email = :email';

				$loginPlaceholders	=	array(':email' => $email );

				$result = $this->db->query( $loginQuery, $loginPlaceholders );

				$this->email 	=	$email;
				$this->salt		=	$result[0]['salt'];
				$this->password	=	$result[0]['password'];

				$saltedInputPassword = $this->hash( $password, $this->salt );

				if ( $this->password === $saltedInputPassword )
				{
					$this->createCookie();
					$login = true;
				}

				return $login;
			}
		}

		public function logout()
		{
			$loggedOut = false;

			setcookie( "authenticate", "", 0);

			$loggedOut	=	true;

			return $loggedOut;
		}

		public function validate()
		{
			$isValid = false;


			if ( isset( $_COOKIE[ 'authenticate' ] ) )
			{
				$cookie	=	$_COOKIE['authenticate'];

				$rawCookieData	=	explode( $this->cookieDelimiter, $cookie );

				$cookieEmail		=	$rawCookieData[ 0 ];
				$cookieHashedEmail	=	$rawCookieData[ 1 ];

				$validateQuery	=	'SELECT salt
										FROM users
										WHERE email = :email';

				$validatePlaceholders	=	array(':email' => $cookieEmail );

				$result = $this->db->query( $validateQuery, $validatePlaceholders );

				if ( $result )
				{
					$this->salt		=	$result[0]['salt'];

					$hashedEmail 	=	$this->hash( $cookieEmail, $this->salt );

					if ( $hashedEmail === $cookieHashedEmail )
					{
						$isValid	=	true;
					}
				}
				
			}

			return $isValid;
		}

		public function generateSalt()
		{
			$salt = uniqid(mt_rand(), true);

			return $salt;
		}

		public function hash( $text, $salt )
		{
			$saltedText	=	$salt . $text;
			$hash = hash( 'sha512', $saltedText );

			return $hash;
		}

		public function createCookie()
		{
			$timeToLive	=	60 * 60 * 24 * 30; // 30 dagen;
			$email	=	$this->email;
			$salt	=	$this->salt;

			$hashedEmail 	=	$this->hash( $email, $salt );

			$cookieValue 	=	$email . $this->cookieDelimiter . $hashedEmail;

			var_dump( $cookieValue );

			setcookie( "authenticate", $cookieValue, time() + $timeToLive );
		}

		public function checkIfUserExists( $email )
		{
			$userExists	=	false;

			$checkQuery	=	'SELECT * 
								FROM users
								WHERE email = :email';
			
			$placeholders	=	array( ':email' => $email );

			$result = $this->db->query( $checkQuery, $placeholders );

			if( $result )
			{
				$userExists	=	true;
			}

			return $userExists;
		}
	}

?>