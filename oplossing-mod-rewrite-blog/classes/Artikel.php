<?php

	class Artikel
	{
		private $db;

		public function __construct( $database )
		{
			$this->db = $database;
		}

		public function add( $titel, $artikelBody, $kernwoorden, $datum )
		{
			$isAdded	=	false;

			$addQuery	=	"INSERT INTO artikels 
								( titel, 
									artikel, 
									kernwoorden, 
									datum) 
								VALUES (:titel, 
									:artikel, 
									:kernwoorden,
									:datum)";

			$addParameters	=	array( ":titel" => $titel,
										":artikel" => $artikelBody,
										":kernwoorden" => $kernwoorden,
										":datum" => $datum);

			$result = $this->db->query( $addQuery, $addParameters );

			$isAdded	=	true;

			return $isAdded;
		}

		public function edit( $id, $titel, $artikelBody, $kernwoorden, $datum, $is_active )
		{
			$isEdited	=	false;

			$editQuery	=	'UPDATE artikels 
								SET titel = :titel,
									artikel = :artikel, 
									kernwoorden = :kernwoorden, 
									datum = :datum, 
									is_active = :is_active
								WHERE id = :id';
var_dump($editQuery);
			$editParameters	=	array( 
										":titel" => $titel,
										":artikel" => $artikelBody,
										":kernwoorden" => $kernwoorden,
										":datum" => $datum,
										":is_active" => $is_active,
										":id"	=> $id);

			$result = $this->db->query( $editQuery, $editParameters );

			$isEdited	=	true;

			return $isEdited;
		}

		public function get( $id = false )
		{
			$queryString	=	'SELECT * 
									FROM artikels';

			$placeholders	=	false;
			
			if ( $id )
			{
				$queryString 	.= 	' AND id = :id';
				$placeholders	=	array( ':id' => $id ); 
			}

			$result = $this->db->query( $queryString, $placeholders );

			return $result;
		}

		public function query( $column, $value )
		{

			$queryString	=	'SELECT *
									FROM artikels
									WHERE ' . $column . ' LIKE :value';

			$placeholders	=	array( ":value" => $value );

			$result = $this->db->query( $queryString, $placeholders );

			return $result;

		} 

		public function queryDate( $year )
		{

			$queryString	=	'SELECT *
									FROM artikels
									WHERE datum BETWEEN "' . $year . '-01-01" AND "' . $year . '-12-31"';

			$placeholders	=	false;

			$result = $this->db->query( $queryString, $placeholders );

			return $result;

		} 

		public function toggle( $id )
		{
			$toggle = false;

			$toggleQuery	=	'UPDATE artikels 
									SET is_active = IF(is_active=1, 0, 1)
									WHERE id = :id
									LIMIT 1';

			$togglePlaceholders	=	array( ':id' => $id );

			$this->db->query( $toggleQuery, $togglePlaceholders );

			$delete = true;

			return $delete;
		}

		public function delete( $id )
		{
			$delete	=	false;

			$deleteQuery	=	'UPDATE artikels
									SET is_archived = 1
									WHERE id = :id
									LIMIT 1';

			$deletePlaceholders	=	array( ':id' => $id );

			$this->db->query( $deleteQuery, $deletePlaceholders );

			$delete = true;

			return $delete;
		}
	}

?>