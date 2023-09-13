<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Patient</title>
</head>
<style>
    body, .wrapper, .aside {
        width: 100%;
    }
    body {
        background-color: #f5f8fa;
    }
    .wrapper {
        display: flex;
    }
    .aside {
        margin-left: 265px;
    }
</style>
<body>
    <div class="wrapper">
        <?php
            include_once "MVC/Views/Pages/navbar.php"
        ?>
        <div class="aside">
            <?php
                include_once './MVC/Views/Pages/'.$data['page'];
            ?>
        </div>
    </div>
</body>
</html>