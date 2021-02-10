<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "u501096072_vista";

// Imóvel
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("SELECT * FROM vista_imovel");
  $stmt->execute();

  $imovel = "<select class='form-select' name='slcImovel' required><option value=''>Imóveis</option>";

  $data = $stmt->fetchAll();
  // and somewhere later:
  foreach ($data as $row) {
    $imovel .= "<option value='$row[id]'>$row[endereco] - $row[id_imovel_lista] - $row[proprietario] - $row[data_criado]</option>";
  }
  $imovel .= "</select><div id='inputHelp' class='form-text'>Imóveis</div>";
} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
}

// Proprietário
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("SELECT * FROM vista_proprietario");
  $stmt->execute();

  $proprietario = "<select class='form-select' name='slcProprietario' required><option value=''>Proprietário</option>";

  $data = $stmt->fetchAll();
  // and somewhere later:
  foreach ($data as $row) {
    $proprietario .= "<option value='$row[id]'>$row[nome] - $row[email] - $row[telefone] - $row[dia_repasse]</option>";
  }
  $proprietario .= "</select><div id='inputHelp' class='form-text'>Proprietário</div>";
} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
}

// Locatário
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("SELECT * FROM vista_cliente");
  $stmt->execute();

  $locatario = "<select class='form-select' name='slcLocatario' required><option value=''>Locatário</option>";

  $data = $stmt->fetchAll();
  // and somewhere later:
  foreach ($data as $row) {
    $locatario .= "<option value='$row[id]'>$row[nome] - $row[email] - $row[telefone]</option>";
  }
  $locatario .= "</select><div id='inputHelp' class='form-text'>Locatário</div>";
} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <!-- Style CSS -->
  <link href="../css/style.css" rel="stylesheet">
  <title>Teste - Vista</title>
</head>

<body>
  <div class="container pt-5">
    <!-- Content here -->
    <h4 class="text-center">Vista - Sistema de Gestão de Locação para Imobiliária</h4>
    <hr>
    <h5 class="text-center">Cadastro de Contrato</h5>
    <hr>
    <form method="POST" action="insert/">
      <div class="mb-3">
        <?php echo $imovel; ?>
      </div>
      <div class="mb-3">
        <?php echo $proprietario; ?>
      </div>
      <div class="mb-3">
      <?php echo $locatario ; ?>
      </div>
      <div class="mb-3">
        <input type="text" class="form-control" name="dataInicio" placeholder="Data Início" required>
        <div id="inputHelp" class="form-text">Data Início</div>
      </div>
      <div class="mb-3">
        <input type="text" class="form-control" name="dataFim" placeholder="Data Fim" required>
        <div id="inputHelp" class="form-text">Data Fim</div>
      </div>
      <div class="mb-3">
        <input type="text" class="form-control" name="taxaAdm" placeholder="Taxa de Administração" required>
        <div id="inputHelp" class="form-text">Taxa de Administração</div>
      </div>
      <div class="mb-3">
        <input type="text" class="form-control" name="valorAluguel" placeholder="Valor do Aluguel" required>
        <div id="inputHelp" class="form-text">Valor do Aluguel</div>
      </div>
      <div class="mb-3">
        <input type="text" class="form-control" name="valorCondominio" placeholder="Valor do Condomínio" required>
        <div id="inputHelp" class="form-text">Valor do Condomínio</div>
      </div>
      <div class="mb-3">
        <input type="text" class="form-control" name="valorIptu" placeholder="Valor do IPTU" required>
        <div id="inputHelp" class="form-text">Valor do IPTU</div>
      </div>
      <div class="mb-3 text-center">
        <button type="submit" class="btn btn-primary">Cadastrar</button>
      </div>
    </form>

    <?php

    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $conn->prepare("SELECT * FROM vista_contrato");
      $stmt->execute();

      $output = "<hr><div class='row'>";
      $output .= "<div class='col-1'><strong>Id Imóvel</strong></div><div class='col-1'><strong>Id Proprietário</strong></div><div class='col-1'><strong>Id Locatário</strong></div><div class='col-2'><strong>Data Início</strong></div><div class='col-2'><strong>Data Fim</strong></div><div class='col-2'><strong>Taxa</strong></div><div class='col-1'><strong>Aluguel</strong></div><div class='col-1'><strong>Condominio</strong></div><div class='col-1'><strong>Iptu</strong></div>";

      $data = $stmt->fetchAll();
      // and somewhere later:
      foreach ($data as $row) {
        $output .= "<div class='col-1'>$row[id_imovel]</div><div class='col-1'>$row[id_proprietario]</div><div class='col-1'>$row[id_locatario]</div><div class='col-2'>$row[data_inicio]</div><div class='col-2'>$row[data_fim]</div><div class='col-2'>$row[taxa_adm]</div><div class='col-1'>$row[valor_aluguel]</div><div class='col-1'>$row[valor_condominio]</div><div class='col-1'>$row[valor_iptu]</div>";
      }
      $output .= "<hr></div>";
      echo $output;
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }

    $conn = null;

    ?>

  </div>
  <!-- Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>