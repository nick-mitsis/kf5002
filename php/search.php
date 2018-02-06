<?php

require_once('functions.php');

$dbConn = getConnection();

$term = isset($_REQUEST['term']) ? $_REQUEST['term'] : null;
if (empty($term)) {
    echo '';
    return;
}

$sqlQuery = "SELECT bookISBN AS value, bookTitle AS label, bookYear AS year, catDesc AS cat, bookPrice AS price, pubName AS pub
             FROM `nbc_books` LEFT JOIN `nbc_category` ON (nbc_books.catID = nbc_category.catID)
             LEFT JOIN `nbc_publisher` ON (nbc_books.pubID = nbc_publisher.pubID)
             WHERE bookTitle LIKE :term
             ORDER BY bookTitle";

$stmt = $dbConn->prepare($sqlQuery);
// get $term safely from the request stream
$stmt->execute(array(':term' => "%{$term}%"));
$array = $stmt->fetchAll(PDO::FETCH_ASSOC);


header('Content-Type: application/json');
echo json_encode($array);