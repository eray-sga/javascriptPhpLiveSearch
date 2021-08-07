<?php 

if(isset($_GET))
{
    $id = $_GET['id'];

    $string = "mysql:host=localhost;dbname=livesearch_db";
    try{
        $con = new PDO($string,"root","");
    }catch(PDOException $e){
        die($e->getMessage());
    }

    $id = intval($id);
    $stm = $con->query("select * from users where id = '$id' limit 1");
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INFO</title>
</head>
<body>
<style>
    *{
        font-family: tahoma;
        font-size: 14px;
    }

    .form{
        margin: auto;
        width: 300px;
        padding: 10px;
        margin-top: 30px;
        box-shadow: 0px 0px 10px #aaa;
        border-radius: 10px;
    }
</style>

    <div class="form">
        <?php if(isset($result) && is_array($result)): ?>
            <div>Name: <?php echo $result[0]['name']?></div><br>
            <div>Details:<br> <?php echo $result[0]['description']?></div>
        <?php else:?>
            <div>Sorry, that record was not found</div>
        <?php endif; ?>
    </div>
</body>
</html>