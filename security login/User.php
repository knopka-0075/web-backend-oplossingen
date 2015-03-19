<?php

	class User
	{
		public static function createNewUser($connection, $email, $password)
		{
			$salt = uniqid(mt_rand(), true);

			$hashedPassword = hash('sha512', $salt . $password);

			$db = new Database( $connection );

			$query = 'INSERT INTO users 
											(email,
											salt,
											password,
											lastlogin)
									VALUES (:email,
											:salt,
											:password,
											NOW())';

			$tokens = array(':email' => $email,
								':salt' => $salt,
								':password' => $hashedPassword);

			$userData = $db->query($query, $tokens);

			$cookie = self::createCookie($salt, $email);

			return $cookie;
		}

		public static function logout()
		{
			unset($_SESSION['login']);

			$unsetCookie = setcookie('authenticated', '', 0);

			return $unsetCookie;
		}

		public static function validate($connection)
		{
			if(isset($_COOKIE['authenticated']))
			{

				$userData = explode('##', $_COOKIE['authenticated']);
				$email = $userData[0];
				$saltedEmail = $userData[1];

				$db = new Database($connection);

				$userData = $db->query( 'SELECT * 
											FROM users 
											WHERE email = :email', 
										array(':email' => $email ) );

				if(isset($userData['data'][0]))
				{
					$salt = $userData['data'][0]['salt'];
					$newlaySaltedEmail = hash('sha512', $salt . $email);

					if($newlaySaltedEmail == $saltedEmail)
					{
						return true;
					}
					else
					{
						return false;
					}
				}

				else
				{
					return false;
				}
			}

			else
			{
				return false;
			}
		}
	}

?>