<?php

/*Эта функция предназначена чтобы вместо вот этого:
$full_name = htmlspecialchars(trim($_POST['full_name']));
$login = htmlspecialchars(trim($_POST['login']));
$email = htmlspecialchars(trim($_POST['email']));
$password = htmlspecialchars(trim($_POST['password']));
писать вот так: 
$fields = extractFields($_POST, ['full_name', 'login', 'email', 'password']);
В результате получим асоциотивный массив заполненный безопасными данными которые мы уже не опасаясь можем класть в БД
*/

function extractFields(array $target, array $fields): array{
    $res = [];

    foreach($fields as $field){
        $res[$field] = htmlspecialchars(trim($target[$field]));
    }

    return $res;
}