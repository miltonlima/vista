<?php

$key = "";
$url = "";
$postFields = "";

$dados = array('fields' => array('Cidade', 'Bairro', 'ValorVenda'));

$key         =  'c9fdd79584fb8d369a6a579af1a8f681';
$postFields  =  json_encode($dados);
$url         =  'http://sandbox-rest.vistahost.com.br/imoveis/listar?key=' . $key;
$url        .=  '&pesquisa=' . $postFields;

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
$result = curl_exec($ch);

$result = json_decode($result, true);

$output = "";
$output .= "<select class='form-select' name='slcListaImovel' required><option value=''>Lista de imóveis</option>";
foreach ($result as $fields) {
  $output .= "<option value='$fields[Codigo]'>$fields[Codigo] - $fields[Cidade] - $fields[Bairro] - $fields[ValorVenda] - </option>";
}
$output .= "</select>";

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
    <h5 class="text-center">Cadastro de Imóvel</h5>
    <hr>
    <form method="POST" action="insert/">
      <div class="mb-3">
        <input type="text" class="form-control" name="enderecoInput" placeholder="Endereço" required>
        <div id="inputHelp" class="form-text">Endereço</div>
      </div>
      <div class="mb-3">
        <?php echo $output; ?>
        <div id="inputHelp" class="form-text">Lista de Imóveis</div>
      </div>
      <div class="mb-3">
        <input type="text" class="form-control" name="proprietarioInput" placeholder="proprietario" required>
        <div id="inputHelp" class="form-text">Proprietário</div>
      </div>
      <div class="mb-3 text-center">
        <button type="submit" class="btn btn-primary">Cadastrar</button>
      </div>
    </form>

    <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "u501096072_vista";

    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $conn->prepare("SELECT * FROM vista_imovel");
      $stmt->execute();

      $output = "<hr><div class='row'>";
      $output .= "<div class='col-3'><strong>Endereço</strong></div><div class='col-3'><strong>Id. Imóvel</strong></div><div class='col-3'><strong>Proprietario</strong></div><div class='col-3'><strong>Criado</strong></div>";

      $data = $stmt->fetchAll();
      // and somewhere later:
      foreach ($data as $row) {
        $output .= "<div class='col-3 long-text'>$row[endereco]</div><div class='col-3'>$row[id_imovel_lista]</div><div class='col-3 long-text'>$row[proprietario]</div><div class='col-3'>$row[data_criado]</div>";
      }
      $output .= "</div>";
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