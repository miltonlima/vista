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
  $stmt = $conn->prepare("INSERT INTO vista_cliente (nome, email, telefone, data_criado) VALUES (:nome, :email, :telefone, :data_criado)");
  $stmt->bindParam(':nome', $nome);
  $stmt->bindParam(':email', $email);
  $stmt->bindParam(':telefone', $telefone);
  $stmt->bindParam(':data_criado', $data_criado);

  // insert a row
  $nome = $_POST["nomeInput"];
  $email = $_POST["emailInput"];;
  $telefone = $_POST["telefoneInput"];
  $data_criado = date("Y-m-d h:i:s");
  $stmt->execute();

  echo "New records created successfully";
} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}
$conn = null;
header("location: ../");

?>