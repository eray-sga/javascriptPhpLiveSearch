<?php 

//$data = file_get_contents("php://input");

if(count($_POST) > 0)
{
    $text = $_POST['text'];

    $string = "mysql:host=localhost;dbname=livesearch_db";
    try{
        $con = new PDO($string,"root","");
    }catch(PDOException $e){
        die($e->getMessage());
    }

    $text = addslashes($text);
    $stm = $con->query("select * from users where name like '%$text%'");
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($result);
}
?>