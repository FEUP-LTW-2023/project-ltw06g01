<?php
  require_once(__DIR__ . '/../classes/session.class.php');

  $session = new Session();
  
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
  $_GET['ticket-filter-tag'] = $_GET['ticket-filter-tag'] ?? "";

  if ($_GET['ticket-filter-agent'] == 'default') $_GET['ticket-filter-agent'] = -1;
  $_GET['ticket-filter-agent'] = $_GET['ticket-filter-agent'] ?? -1;

  $users = User::getUsersAdmin($db);
  $departments = getDepartments($db);
  $statuses = getAllStatuses($db);

  $user_id = isset($_SESSION['uid']) ? $_SESSION['uid'] : null;
  $oldLevel = isset($_SESSION['oldLevel']) ? $_SESSION['oldLevel'] : null;
  if (isset($oldLevel)) {
    unset($_SESSION['oldLevel']);
  }

  if ($user_id !== null) {
    $tickets = Ticket::getTicketsFromUser($db, $user_id);

    if (empty($tickets)) {
        $tickets = null;
    }
  } else {
      $tickets = null;
  }

  if (empty($tickets)) {
    $tickets = null;}

  if (isset($_SESSION['animation'])) {
    $animation = $_SESSION['animation'];
    unset($_SESSION['animation']);
  }
  else {
    $animation = 0;
  }

  if ($session->isLoggedIn()){
    $loggedin = 1;
  }
  else{
    $loggedin = 0;
  }
?>

<!DOCTYPE html>
<html>
<head>
<meta charset = "utf-8">
<title>Ticket System</title>
<meta name = "viewport" content = "width=device-width, initial-scale = 1.0">
<script src="/../javascript/all_variables.js" defer></script>
<script src="/../javascript/filters.js" defer></script>
<script src="/../javascript/page.js" defer></script>
<script src="/../javascript/login_logout_transitions.js" defer></script>
<script src="/../javascript/ticket_options.js" defer></script>
<script src="/../javascript/all_tickets.js" defer></script>
<script src="/../javascript/priority_change.js" defer></script>
<script src="/../javascript/tag_filter.js" defer></script>
 
<link rel="stylesheet" href="/../css/pageStyle.css">
  
</head>
<body>

  <?php if (!$loggedin) { ?>
    <header id="not-logged-in">
      <?php drawHeader($animation, 3,  ""); 
      drawMessages($session);?>
    </header>
  <?php } else { ?>
    <header id="logged-in">
      <?php drawHeader($animation, 3,  "Home"); 
      drawMessages($session); ?>
    </header>
  <?php } ?>
  
          <?php if (isset($oldLevel)) drawNav($oldLevel);
                else drawNav(null); ?>
  <main id="content-home">
          <?php drawEnterBoxes(); ?>

          <?php if($loggedin){ 
            if (!empty($tickets)) {?>

          <?php drawFilters($_GET, $departments, $users, array_map(fn($value) => $value['name'], $statuses)); 
            //$status = isset($_GET['ticket-filter-status']) ? $_GET['ticket-filter-status'] : 'open'; //// esta linha supostamente tem de sair?
            $tickets = Ticket::getFilteredTickets($db, $_GET['ticket-filter-status'], $_GET['ticket-filter-agent'], $_GET['ticket-filter-department']);
            $tagTickets = Ticket::getTicketsByTags($db, $_GET['ticket-filter-tag'] == "" ? array() : explode(",", $_GET['ticket-filter-tag']));
            $tickets = array_intersect($tickets, $tagTickets);
            //$ticketsAgent = Ticket::getTicketsFromAgent($db, $_GET['ticket-filter-agent']);
            //$departmentTickets = Ticket::getTicketsFromDepartment($db, $_GET['ticket-filter-department']);
            //$finalTickets = Ticket::joinFilters($tickets, $ticketsAgent, $departmentTickets); ?>

          <section id="allTickets" style="display: none;"> 
              <p>My tickets:</p>
                <?php foreach ((array)$tickets as $ticket) {
                        $tags = getTicketTags($db, $ticket->id); ?>
                        <div class="ticket-display">
                        
                          <?php drawTicketForm($ticket, false, $tags);
                          drawOpcions($db, $ticket); ?>
                          
                        </div>
                <?php }
              } else { ?>
                  <p id="no_tickets"> Ainda não tem tickets. </p>
            <?php }
          } ?>
           </section>
    </main>
    <section class="FAQs" >
      <a  href="../pages/faq.php">
        <ion-icon name="help-circle-outline" id="faqs-icon"></ion-icon>
        <h6>FAQ's</h6>
      </a>
    </section>
  <footer>
    <?php drawFooter(); ?>
  </footer>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>

