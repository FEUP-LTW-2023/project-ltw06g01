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
    <li class="item-menu">
      <a href = "#">
        <span class = "icon"><ion-icon name="cog-outline"></ion-icon></span>
        <span class = "txt-link">Tickets</span>
      </a>
    </li>
    <li class="item-menu">
      <a href = "#">
        <span class = "icon"><ion-icon name="cog-outline"></ion-icon></span>
        <span class = "txt-link">Tickets</span>
      </a>
    </li>
    <li class="item-menu">
      <a href = "#">
        <span class = "icon"><ion-icon name="cog-outline"></ion-icon></span>
        <span class = "txt-link">Tickets</span>
      </a>
    </li>
    <li class="item-menu">
      <a href = "#">
        <span class = "icon"><ion-icon name="cog-outline"></ion-icon></span>
        <span class = "txt-link">Tickets</span>
      </a>
    </li>
    <li class="item-menu">
      <a href = "#">
        <span class = "icon"><ion-icon name="cog-outline"></ion-icon></span>
        <span class = "txt-link">Tickets</span>
      </a>
    </li>
  </ul>
</nav>
    <?php drawTicketForm($ticket, true); ?>
  </main>
  <footer>
    <p>Algum footer que queiramos</p>
  </footer>
</body>
</html>
