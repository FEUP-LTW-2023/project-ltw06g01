<?php 
require_once(__DIR__ . '/../classes/session.class.php');

$session = new Session();

if (!$session->isLoggedIn()) {
    header('Location: page.php');
}
  require_once(__DIR__ . '/../classes/ticket.class.php');
  require_once(__DIR__ . '/../classes/user.class.php');
  require_once(__DIR__ . '/../database/connection.php');
  require_once(__DIR__ . '/../database/status.php');
  require_once(__DIR__ . '/../database/client.php'); 
  require_once(__DIR__ . '/../database/departments.php');
  require_once(__DIR__ . '/../templates/ticket.tpl.php');
  require_once(__DIR__ . '/../templates/common.tpl.php');
  require_once(__DIR__ . '/../database/tags.php');

  $db = getDatabaseConnection();
  
  $_GET['ticket-filter-status'] = $_GET['ticket-filter-status'] ?? 'all';
  $_GET['ticket-filter-agent'] = $_GET['ticket-filter-agent'] ?? 'default';
  $_GET['ticket-filter-department'] = $_GET['ticket-filter-department'] ?? 'unassigned';

  if ($_GET['ticket-filter-agent'] == 'default') $_GET['ticket-filter-agent'] = -1;
  $_GET['ticket-filter-agent'] = $_GET['ticket-filter-agent'] ?? -1;

  $user_id = $_SESSION['uid'];
  $users = getUser($db, $user_id);
  $departments = getDepartments($db);

  if (empty($tickets)) {
    $tickets = null;}
?>

<!DOCTYPE html>
<html>
<head>
<title>All Tickets</title>
  <script src="/../javascript/all_variables.js" defer></script>
  <script src="/../javascript/login_logout_transitions.js" defer></script>
  <script src="/../javascript/open_tickets.js" defer></script>
  <script src="/../javascript/agent_assign.js" defer></script>
  <script src="/../javascript/status_change.js" defer></script>
  <script src="/../javascript/priority_change.js" defer></script>
  <link rel="stylesheet" href="/../css/geralStyle.css">
  <link rel="stylesheet" href="/../css/open_ticketsStyle.css">
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>
<body>
  <header>
    <?php drawHeader(0, 4, "Your Tickets"); 
    drawMessages($session);?>
  </header>
  <div id="nav">
    <?php drawNav(); ?>
  </div>
  <div id="content">
    <form id="filtro" method="get" class="ticket-filter-container">
      <label id="ticket-filter-status-title" for="ticket-filter-status">Status</label>
      <select id="ticket-filter-status" class="ticket-filter" onchange="this.form.submit()">
        <option value="all" <?php if ($_GET['ticket-filter-status'] == 'all') echo 'selected'; ?>>Todos</option>
        <option value="open" <?php if ($_GET['ticket-filter-status'] == 'open') echo 'selected'; ?>>Abertos</option>
        <option value="closed" <?php if ($_GET['ticket-filter-status'] == 'closed') echo 'selected'; ?>>Fechados</option>
      </select>
      
  <select name="ticket-filter-department" class="ticket-filter" onchange="this.form.submit()">
        <option value="unassigned" <?php if ($_GET['ticket-filter-department'] == 'unassigned') echo 'selected'; ?>>Unassigned</option>
        <?php foreach ($departments as $department) { ?>
          <option value=<?= $department ?> <?php if ($_GET['ticket-filter-department'] == $department) echo 'selected'; ?>><?= $department ?></option>
        <?php } ?>
  </select>
    </form>
    <?php
      $status = isset($_GET['ticket-filter-status']) ? $_GET['ticket-filter-status'] : 'open'; //// esta linha supostamente tem de sair?
      $tickets = Ticket::getFilteredTickets($db, $_GET['ticket-filter-status']);
      $ticketsUser = Ticket::getTicketsFromUser($db, $users['uid']);
      $departmentTickets = Ticket::getTicketsFromDepartment($db, $_GET['ticket-filter-department']);
      $finalTickets = Ticket::joinFilters($tickets, $ticketsUser, $departmentTickets); ?>
    
      <div id="allTickets">
        <?php foreach ($finalTickets[0] as $ticket) {
                $tags = getTicketTags($db, $ticket->id); ?>
                <div id="ticket-display">
                
                  <?php drawTicketForm($ticket, false, $tags); ?>
                
                  <div id="options">
                        <div id="filters-toggle">
                            <ion-icon id="settings-not-hover" name="settings-outline"></ion-icon>
                            <ion-icon id="settings-hover" name="settings"></ion-icon>
                        </div>
                        <div id="filters-container">
                            <?php drawAssignAgent($db, $ticket);
                                  drawChangeStatus($db, $ticket); 
                                  drawPriorityButtons($ticket); ?>
                        </div>

                      <a href="/../pages/view_ticket.php?id=<?php echo $ticket->id ?>">
                        <ion-icon id="view-not-hover" name="eye-outline"></ion-icon>
                        <ion-icon id="view-hover" name="eye"></ion-icon>
                      </a>

                      <div id="delete-button">
                          <button type="submit" onclick="window.location.href = '../actions/delete_ticket.action.php';">
                              <ion-icon id="delete-not-hover" name="trash-outline"></ion-icon>
                              <ion-icon id="delete-hover" name="trash"></ion-icon>
                          </button>
                      </div>
                  </div>
                </div>
        <?php } ?>
      </div>

  </div>
  <div id="footer">
    <footer>
      <p>Algum footer que queiramos</p>
    </footer>
  </div>
</body>
</html>