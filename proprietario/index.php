<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <title>Teste - Vista</title>
</head>

<body>
  <div class="container pt-5">
    <!-- Content here -->
    <h4 class="text-center">Vista - Sistema de Gestão de Locação para Imobiliária</h4>
    <hr>
    <h5 class="text-center">Cadastro de Proprietário</h5>
    <hr>
    <form method="POST" action="insert/">
    <div class="mb-3">
        <input type="text" class="form-control" name="nomeInput" placeholder="Nome" required>
        <div id="inputHelp" class="form-text">Nome</div>
      </div>
      <div class="mb-3">
        <input type="email" class="form-control" name="emailInput" placeholder="Email" required>
        <div id="inputHelp" class="form-text">Email</div>
      </div>
      <div class="mb-3">
        <input type="text" class="form-control" name="telefoneInput" placeholder="Telefone" required>
        <div id="inputHelp" class="form-text">Telefone</div>
      </div>
      <div class="mb-3">
        <input type="text" class="form-control" name="repasseInput" placeholder="Dia do repasse" required>
        <div id="inputHelp" class="form-text">Dia do repasse</div>
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
      $stmt = $conn->prepare("SELECT * FROM vista_proprietario");
      $stmt->execute();

      $output = "<hr><div class='row'>";
      $output .= "<div class='col-3'><strong>Nome</strong></div><div class='col-3'><strong>Email</strong></div><div class='col-2'><strong>Telefone</strong></div><div class='col-2'><strong>Dia repasse</strong></div><div class='col-2'><strong>Criado</strong></div>";

      $data = $stmt->fetchAll();
      // and somewhere later:
      foreach ($data as $row) {
        $output .= "<div class='col-3'>$row[nome]</div><div class='col-3'>$row[email]</div><div class='col-2'>$row[telefone]</div><div class='col-2'>$row[dia_repasse]</div><div class='col-2'>$row[data_criado]</div>";
      }
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
    $output .= "</div>";
    echo $output;
    $conn = null;

    ?>

  </div>
  <!-- Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>