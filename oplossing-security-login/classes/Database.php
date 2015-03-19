<?php

	class Database
	{

		private $db;

		public function __construct( $dbConnection )
		{
			$this->db = $dbConnection;
		}

		public function query( $queryString, $placeholders = false )
		{
			$statement = $this->db->prepare( $queryString );

			if ( $placeholders )
			{
				foreach( $placeholders as $placeholderName => $placeholderValue )
				{
					$statement->bindValue( $placeholderName, $placeholderValue );
				}
			}

			$statement->execute();

			$result	=	array();

			while ( $row = $statement->fetch( PDO::FETCH_ASSOC ) )
			{
				$result[]	=	$row;
			}

			if ( empty( $result ) )
			{
				$result = false;
			}

			return $result;
		}
	}

?>