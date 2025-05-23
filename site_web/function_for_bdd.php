<!-- SQL related functions -->
<?php
function executeSQLRequest(string $sql_request, array $parameters){
    try{
        $db = new PDO("mysql:host=localhost;port=3306;dbname=projet_if_energie;charset=utf8", "root", "");
    }
    catch (Exception $e){
        echo "la base de donnée n'a pas pu etre chargé";
        die('Erreur : '.$e->getMessage());
    }
    $req = $db->prepare($sql_request);
    $req->execute($parameters); 

    return $req;
}

function requestResultToArray($request_res){
    $data = [];
    $a = $request_res->fetch();
    while ($a != null){
        array_push($data ,$a);
        $a = $request_res->fetch();
    }

    return $data;
}
?>
