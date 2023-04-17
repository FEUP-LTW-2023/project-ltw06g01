<?php 
  session_start();
  if (!isset($_SESSION['uid'])) {
    header('Location: page.php');
  }
  require_once(__DIR__ . '/../database/connection.php');
  require_once(__DIR__ . '/../database/departments.php');
?>
<!DOCTYPE html>
<html>
<head>
  <title>Enviar Ticket</title>
  <link rel="stylesheet" href="styles2.css">
</head>
<body>
  <header>
    <h1>Enviar Ticket</h1>
  </header>
  <main>
    <div class="container">
      <section id="ticket-form">
        <h2>Preencha o Formulário do Ticket</h2>
        <form action="../actions/open_ticket.action.php" method="post">
          <input type="hidden" name="uid" value=<?=$_GET["uid"]?>>
          <div>
            <label for="department">Departamento:</label>
            <select id="department" name="department">
              <?php foreach (getDepartments(getDatabaseConnection()) as $department) { ?>
                <option value=<?=$department['name']?>><?=$department['name']?></option>
              <?php } ?>
            </select>
          </div>
          <div>
            <label for="title">Assunto:</label>
            <input type="text" id="subject" name="title">
          </div>
          <div>
            <label for="fulltext">Mensagem:</label>
            <textarea id="message" name="fulltext"></textarea>
          </div>
          <button type="submit">Enviar</button>
        </form>
      </section>
    </div>
  </main>
  <footer>
    <p>Algum footer que queiramos</p>
  </footer>
</body>
</html>
