<?php 
  session_start();
  if (!isset($_SESSION['uid'])) {
    header('Location: page.php');
  }

  require_once(__DIR__ . '/../classes/ticket.class.php');
  require_once(__DIR__ . '/../database/connection.php');
  require_once(__DIR__ . '/../templates/ticket.tpl.php');

  $db = getDatabaseConnection();

  if (isset($_GET['id'])) {
    $ticket = Ticket::getTicket($db, $_GET['id']);
  }
  else {
    $ticket = null;
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Enviar Ticket</title>
  <link rel="stylesheet" href="ticketstyle.css">
</head>
<body>
<header class="header">
    <h1>Enviar Ticket</h1>
    <section id="logout" >
      <div class ="logout-box">
        <p>Logout</p>
      </div>
    </section>
</header>
  <main>
    <?php drawTicketForm($ticket, true); ?>
  </main>
  <footer>
    <p>Algum footer que queiramos</p>
  </footer>
</body>
</html>
