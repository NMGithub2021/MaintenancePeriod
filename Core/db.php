<?php

function dbInstance(): PDO{
    static $db;

    if($db === null){
        $db = new PDO('mysql:host=localhost;dbname=hw4', 'root', '',[ PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
    }

    $db->exec('SET NAMES UTF8');
    return $db;
}


function dbQwery(string $sql, array $params = []):PDOStatement{
    $db = dbInstance();
    $qwery = $db->prepare($sql);
    $qwery->execute($params);
    dbCheckError($qwery);
    return $qwery;
}


function dbCheckError(PDOStatement $qwery):bool{
    $errInfo = $qwery->errorInfo(); 

    if($errInfo[0] !== PDO::ERR_NONE){
        echo $errInfo[2];
        exit();
    }

    return true;
}

function dbLastId(): string{
    $db = dbInstance();
    return $db->lastInsertId();
}
