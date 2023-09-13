<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Patient</title>
</head>
<style>
    .aside {
        margin-left: 320px;
    }
</style>
<body>
        <?php
            include_once "MVC/Views/Pages/navbar.php"
        ?>
    <div class="aside">
		<?php
			include_once './MVC/Views/Pages/'.$data['page'].'.php';
		?>
	</div>
</body>
</html>