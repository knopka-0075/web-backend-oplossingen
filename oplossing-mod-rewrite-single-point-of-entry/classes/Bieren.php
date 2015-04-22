<?php

	class Bieren
	{

		public function overview( $id )
		{
			echo( "<h1>Hallo vanuit de overview method, argument: " . $id . " (Class: Bieren)</h1>" );
		}

		public function insert( )
		{
			echo( "<h1><h1>Hallo vanuit de insert method (Class: Bieren)</h1>" );
		}

		public function update( $id )
		{
			echo( "<h1><h1>Hallo vanuit de update method, argument: " . $id . " (Class: Bieren)</h1>" );
		}

		public function delete( $id )
		{
			echo( "<h1><h1>Hallo vanuit de delete method, argument: " . $id . " (Class: Bieren)</h1>" );
		}

	}

?>