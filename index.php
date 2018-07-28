<?php
$host='ec2-23-21-238-28.compute-1.amazonaws.com';
$dbname='d5hb6iga0kqmnd';
$user='qjpjdxczqljfdi';
$pass='51bf424af67c828b222d1fff444a74a87247aefcd9570560d19dc6e027c34529';

$url_conn = "pgsql:host=$host;dbname=$dbname";

$conn = new PDO($url_conn,$user,$pass);

$rs = $conn->query("SELECT * FROM polls");
if($rs !== null){
    echo $rs->rowCount();
}

/* INSERT */
/*
$params = array(
    'user_id'=> $event['source']['userId'] , 
    'slip_date'=> date('Y-m-d'),
    'name'=> $event['message']['text'],
);
$statement=$connection->prepare('INSERT INTO slips (user_id, slip_date, name)VALUES(:user_id, :slip_date, :name)');
$statement->execute($params);
*/

/* UPDATE */
/*
$params = array(
    'name'=> $event['message']['text'], 
    'slip_date'=> date('Y-m-d'),
    'user_id'=> $event['source']['userId'], 
);
$statement=$connection->prepare('UPDATE slips SET name=:name WHERE slip_date=:slip_date AND user_id=:user_id');
$statement->execute($params);
*/