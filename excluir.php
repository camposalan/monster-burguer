<?php

require ('./data/conection.php');
require ('./data/ProdutosRepository.php');

$id = $_POST['id'];
$repository = new ProdutosRepository($pdo);
$repository->deleteById($id);

header("Location: /admin.php");
