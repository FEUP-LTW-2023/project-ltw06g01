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

  $users = User::getUsersAdmin($db);
  $departments = getDepartments($db);

  if (!hasAccessToPage(1, $_SESSION['level'])) {
    $session->addMessage('error', 'Insufficient permissions');
    header('Location: /../pages/page.php');
}

  if (empty($tickets)) {
    $tickets = null;}

?>

<!DOCTYPE html>
<html>
<head>
<title>All Tickets</title>
  <script src="/../javascript/all_variables.js" defer></script>
  <script src="/../javascript/login_logout_transitions.js" defer></script>
  <script src="/../javascript/ticket_options.js" defer></script>
  <script src="/../javascript/all_tickets.js" defer></script>
  <script src="/../javascript/agent_assign.js" defer></script>
  <script src="/../javascript/status_change.js" defer></script>
  <script src="/../javascript/priority_change.js" defer></script>
  <link rel="stylesheet" href="/../css/geralStyle.css">
  <link rel="stylesheet" href="/../css/all_ticketsStyle.css">
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>
<body>
  <header>
    <?php drawHeader(0, 4, "All Tickets"); 
    drawMessages($session);?>
  </header>
    <?php drawNav(); ?>
  <main>
    <?php drawFilters($_GET, $departments, $users); 
      //$status = isset($_GET['ticket-filter-status']) ? $_GET['ticket-filter-status'] : 'open'; //// esta linha supostamente tem de sair?
      $tickets = Ticket::getFilteredTickets($db, $_GET['ticket-filter-status'], $_GET['ticket-filter-agent'], $_GET['ticket-filter-department']);
      //$ticketsAgent = Ticket::getTicketsFromAgent($db, $_GET['ticket-filter-agent']);
      //$departmentTickets = Ticket::getTicketsFromDepartment($db, $_GET['ticket-filter-department']);
      //$finalTickets = Ticket::joinFilters($tickets, $ticketsAgent, $departmentTickets); ?>

      <section id="allTickets">
        <?php foreach ($tickets as $ticket) {
                $tags = getTicketTags($db, $ticket->id); ?>
                <div class="ticket-display">
                
                  <?php drawTicketForm($ticket, false, $tags); 
                        drawOpcions($db, $ticket);?>
                </div>
        <?php } ?>
        </section>

  </main>
    <footer>
      <p>Algum footer que queiramos</p>
    </footer>
</body>
</html>
