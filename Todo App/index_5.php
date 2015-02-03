<?php

	session_start();
	// Удалить Sessie  
	if (isset($_GET['session']))
	{
		if($_GET['session'] === 'destroy')
		{
			session_destroy();
			// Для перезагрузки
			header('Location: index_5.php'); 
		}
	}

	
	//добаить задание
	if ( isset( $_POST['voegTaak'] ) )
	{
		//ошибка если не чего не введено
		if(empty($_POST['description'])) {
			$error = 'Ahh, damn. Lege todos zijn niet toegestaan...';
        }
		//если введено то выводить задание
        else {
		    $_SESSION['taak'][] = $_POST[ 'description'];
		}
	}
	
	//устанавливаем функцыю удалить
	if ( isset( $_GET[ 'verwijderen' ] ) )
	{
		//черес функцию удалить удаляем то что установили ранее
		unset($_SESSION['taak'][$_GET ['verwijderen']]);
	}
	
	//переносим задание в другой список в список сделанных дел
	if(isset($_GET['gedaanTaak'])){
		$_SESSION['gedaan'][] = $_SESSION['taak'][$_GET['gedaanTaak']];
		unset($_SESSION['taak'][$_GET ['gedaanTaak']]);
	}
	
	//устанавливаем функцыю удалить из списка сделанных дел
	if ( isset( $_GET[ 'verwijderenGedaan' ] ) )
	{
		//черес функцию удалить удаляем то что установили ранее
		unset($_SESSION['gedaan'][$_GET ['verwijderenGedaan']]);
	}
	
	//пеносим из списка сделаных дел в список не сделанных дел
	if(isset($_GET['nietGedaan'])){
		$_SESSION['taak'][] = $_SESSION['gedaan'][$_GET['nietGedaan']];
		unset($_SESSION['gedaan'][$_GET ['nietGedaan']]);
	}
	
	//задание 
	if(isset($_SESSION['taak']))
		$taak = $_SESSION['taak'];
	
	//сделанное задание
	if(isset($_SESSION['gedaan']))
		$gedaan = $_SESSION['gedaan'];

		
?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Todo App</title>
<link rel="stylesheet" type="text/css" href="css/global.css">
</head>

<body>


<div class="modal error"><?php if(isset($error)) echo $error ?></div>

    <h1>Todo app</h1>

					
                    <!--если все пусто то...-->
        			<?php if(empty($taak)) : ?>
						<p>Je hebt nog geen TODO's toegevoegd. Zo weinig werk of meesterplanner?</p>
						
					<!--если нет то...-->
					<?php else : ?>
                    	<h2>Nog te doen</h2>
						<ul>
                        <!--задание-->
						<?php foreach ($taak as $taaken => $taakenDescription) : ?> 
						<li>
                        <!--задание в список сделанно-->
                        <a href="index_5.php?gedaanTaak=<?= $taaken ?>">
                        <button class="taak"></button>
                        </a>
                        <!--задание удалить-->
                        <?php echo $taakenDescription ?>
                        <a href="index_5.php?verwijderen=<?= $taaken ?>">
                        <button class="taakver"></button>
                        </a>
                        </li>
		
						<?php endforeach ?>
						</ul>
						<?php endif ?>
                        
		<h1>Todo toevoegen</h1>
        
        <!--если сделанно пусто то...-->
        <?php if(empty($gedaan)) : ?>

						<p>Werk aan de winkel...</p>
					
                    <!--если нет то...-->
					<?php else : ?>
                    	<h2>Done and done!</h2>
						<ul>
                        
                        <!--задание в список несделанно-->
						<?php foreach ($gedaan as $gedaanen => $gedaanDescription) : ?> 
						<li>
                         <a href="index_5.php?nietGedaan=<?= $gedaanen ?>">
                         <button class="taak"></button>
                         </a>
                         
                         <!--задание удалить-->
                         <?php echo $gedaanDescription ?> 
                         <a href="index_5.php?verwijderenGedaan=<?= $gedaanen ?>">
                         <button class="taakver"></button>
                         </a>
                         </li>
		
						<?php endforeach ?>
						</ul>
                        
						<?php endif ?>
                        
        
        

		<form action="index_5.php" method="POST" name="todo_form">

			<ul>
				<li>
					<label for="product">Beschrijving: </label>
                    <input type="text" id="description" name="description" >
                    <!--required="required"-->
                    <!-- для того что бы не отправлять пустую форму-->
				</li>
			</ul>

			<input type="submit" name="voegTaak" value="Toevoegen">

		</form>
        
</body>
</html>