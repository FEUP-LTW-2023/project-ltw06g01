<?php
  require_once(__DIR__ . '/../classes/session.class.php');

  $session = new Session();
  
  require_once(__DIR__ . '/../templates/common.tpl.php');

  if (isset($_SESSION['animation'])) {
    $animation = $_SESSION['animation'];
    unset($_SESSION['animation']);
  }
  else {
    $animation = 0;
  }

  if (isset($_SESSION['loggedin'])){
    $loggedin = $_SESSION['loggedin'];
  }
  else{
    $loggedin = 0;
  }
?>

<!DOCTYPE html>
<html>
<head>
<title>Ticket System</title>
<script src="/../javascript/scr.js" defer></script>
  <link rel="stylesheet" href="/../css/faqStyle.css">
</head>
<body>
    <header id="header">
      <?php drawHeader($animation, 3,  "Home"); ?>
    </header>
  <div id="faqs">
    <section class="FAQs">
      <div id="Faqs-icon">
      <ion-icon name="help-circle-outline" id="icon"></ion-icon>
      <p id="p">FAQ's</p>
      <div>
    </section>
  </div>
  <div id="footer">
      <p>Algum footer que queiramos</p>
  </div>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>

