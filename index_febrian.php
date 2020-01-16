<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="#" method="post">
        <input type="text" name="username" id="">
        <input type="submit" name="submit" value="Simpan">
    </form>

    <?php
    if(isset($_POST['submit'])){
        var_dump($_POST['username']);
    }
    ?>
</body>
</html>