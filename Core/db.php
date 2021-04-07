<?php

function dbInstance(): PDO{
    static $db;

    if($db === null){
        $db = new PDO('mysql:host='.DB_HOST.';dbname='. DB_NAME, DB_USER, DB_PASS,[ PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
    }

    $db->exec('SET NAMES UTF8');
    return $db;
}

//обертка над запросом к БД, пример использования ниже
// $sql = "SELECT * FROM article ORDER BY dt_add DESC";
// $qwery = dbQwery($sql);
// $article = $qwery->fetchAll();
// --------------------------------
// $sql = "SELECT * FROM article WHERE id_article = :id";
// $qwery = dbQwery($sql, ['id'=> $id]);
// $article = $qwery->fetch();

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
