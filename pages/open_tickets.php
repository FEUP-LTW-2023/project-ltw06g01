<?php 
  session_start();
  if (!isset($_SESSION['uid'])) {
    header('Location: page.php');
  }

  require_once(__DIR__ . '/../classes/ticket.class.php');
  require_once(__DIR__ . '/../database/connection.php');
  require_once(__DIR__ . '/../templates/ticket.tpl.php');

  $db = getDatabaseConnection();

  if (empty($tickets)) {
    $tickets = null;}
?>

<!DOCTYPE html>
<html>
<head>
<title>All Tickets</title>
  <script src="open_tickets.js" defer></script>
  <link rel="stylesheet" href="open_ticketsstyle.css">
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>
<body>
  <header class="header">
    <section>
      <h1>Ticket System</h1>
      <h2>All tickets<h2>
    </section>
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
      <?php $user_type = 'client'; ?>
      <?php if ($user_type === 'client'): ?>
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
      <?php elseif ($user_type === 'agent'): ?>
      <li class="item-menu">
        <a href = "#">
          <span class = "icon"><ion-icon name="cog-outline"></ion-icon></span>
          <span class = "txt-link">Tickets do Departamento</span>
        </a>
      </li>
      <?php elseif ($user_type === 'admin'): ?>
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
  <form method="get" class="ticket-filter-container">
    <label for="ticket-filter">Mostrar:</label>
    <select name="ticket-filter" id="ticket-filter" onchange="this.form.submit()">
      <option value="all" <?php if ($_GET['ticket-filter'] == 'all') echo 'selected'; ?>>Todos</option>
      <option value="open" <?php if ($_GET['ticket-filter'] == 'open') echo 'selected'; ?>>Abertos</option>
      <option value="closed" <?php if ($_GET['ticket-filter'] == 'closed') echo 'selected'; ?>>Fechados</option>
    </select>
  </form>
  <?php
    $status = isset($_GET['ticket-filter']) ? $_GET['ticket-filter'] : 'open'; //// esta linha supostamente tem de sair?
    $_GET['ticket-filter'] = $_GET['ticket-filter'] ?? 'all';
    $tickets = getFilteredTickets($db, $_GET['ticket-filter']);

    foreach ($tickets as $ticket) {
        $ticketObj = new Ticket($ticket['id'], $ticket['title'], $ticket['text'], $ticket['status'], $ticket['dateCreated'], $ticket['uID'], $ticket['department']);
        drawTicketForm($ticketObj, false);
    }
  ?>
  </main>
</body>    