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
  $stmt = $conn->prepare("INSERT INTO vista_contrato (id_imovel, id_proprietario, id_locatario, data_inicio, data_fim, taxa_adm, valor_aluguel, valor_condominio, valor_iptu, data_criado) VALUES (:idimovel, :idproprietario, :idlocatario, :datainicio, :datafim, :taxaadm, :valoraluguel, :valorcondominio, :valoriptu, :datacriado)");
  $stmt->bindParam(':idimovel', $imovel);
  $stmt->bindParam(':idproprietario', $proprietario);
  $stmt->bindParam(':idlocatario', $locatario);
  $stmt->bindParam(':datainicio', $datainicio);
  $stmt->bindParam(':datafim', $datafim);
  $stmt->bindParam(':taxaadm', $taxaadm);
  $stmt->bindParam(':valoraluguel', $valoraluguel);
  $stmt->bindParam(':valorcondominio', $valorcondominio);
  $stmt->bindParam(':valoriptu', $valoriptu);
  $stmt->bindParam(':datacriado', $datacriado);

  // insert a row
  $imovel = $_POST["slcImovel"];
  $proprietario = $_POST["slcProprietario"];
  $locatario = $_POST["slcLocatario"];
  $datainicio = $_POST["dataInicio"];
  $datafim = $_POST["dataFim"];
  $taxaadm = $_POST["taxaAdm"];
  $valoraluguel = $_POST["valorAluguel"];
  $valorcondominio = $_POST["valorCondominio"];
  $valoriptu = $_POST["valorIptu"];
  $datacriado = date("Y-m-d h:i:s");
  $stmt->execute();

  echo "New records created successfully";
} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}
$conn = null;
header("location: ../");

?>