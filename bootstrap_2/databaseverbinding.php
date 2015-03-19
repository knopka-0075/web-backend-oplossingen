<?php
if ($db = mysql_connect("localhost", "root", ""))
{}else die ('Verbinding maken met de database is mislukt.');
mysql_select_db("bootstrap");
?>
