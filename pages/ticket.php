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
  <script src = "nav.js" defer> </script>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
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
  <nav class="menu-lateral">
  <div class="btn-expandir">
    <ion-icon name="ticket-outline"></ion-icon>
  </div>
  <ul>
    <?php $user_type = $_SESSION['level'] ?>
    <?php if (isset($user_type)): ?>
      <li class="item-menu">
        <a href = "#">
          <span class = "icon"><ion-icon name="cog-outline"></ion-icon></span>
          <span class = "txt-link">Enviar Ticket</span>
        </a>
      </li>
      <li class="item-menu">
        <a href = "open_tickets.php">
          <span class = "icon"><ion-icon name="cog-outline"></ion-icon></span>
          <span class = "txt-link">Tickets Abertos</span>
        </a>
    </li>
    <?php endif; if ($user_type >= 1): ?>
    <li class="item-menu">
      <a href = "#">
        <span class = "icon"><ion-icon name="cog-outline"></ion-icon></span>
        <span class = "txt-link">Tickets do Departamento</span>
      </a>
    </li>
    <?php endif; if ($user_type == 2): ?>
    <li class="item-menu">
      <a href = "#">
        <span class = "icon"><ion-icon name="cog-outline"></ion-icon></span>
        <span class = "txt-link">Associar Agentes</span>
      </a>
    </li>
    <li class="item-menu">
      <a href = "#">
        <span class = "icon"><ion-icon name="cog-outline"></ion-icon></span>
        <span class = "txt-link">Associar novos departamentos/dados/entidades</span>
      </a>
    </li>
    <li class="item-menu">
      <a href = "#">
        <span class = "icon"><ion-icon name="cog-outline"></ion-icon></span>
        <span class = "txt-link">Promover</span>
      </a>
    </li>
    <?php endif; ?>
  </ul>
</nav>
    <?php drawTicketForm($ticket, true); ?>
  </main>
  <footer>
    <p>Algum footer que queiramos</p>
  </footer>
</body>
</html>
