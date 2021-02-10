<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "u501096072_vista";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // prepare sql and bind parameters
  $stmt = $conn->prepare("INSERT INTO vista_imovel (endereco, id_imovel_lista, proprietario, data_criado) VALUES (:endereco, :id_imovel_lista, :proprietario, :data_criado)");
  $stmt->bindParam(':endereco', $endereco);
  $stmt->bindParam(':id_imovel_lista', $idlista);
  $stmt->bindParam(':proprietario', $proprietario);
  $stmt->bindParam(':data_criado', $data_criado);

  // insert a row
  $endereco = $_POST["enderecoInput"];
  $idlista = $_POST["slcListaImovel"];;
  $proprietario = $_POST["proprietarioInput"];
  $data_criado = date("Y-m-d h:i:s");
  $stmt->execute();

  echo "New records created successfully";
} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}
$conn = null;
header("location: ../");

?>