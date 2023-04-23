<?php
  session_start();
  if (isset($_SESSION['animation'])) {
    $animation = $_SESSION['animation'];
    unset($_SESSION['animation']);
  }
  else {
    $animation = 0;
  }
?>
<!DOCTYPE html>
<html>
<head>
<title>Ticket System</title>
  <script src="scr.js" defer></script>
  <link rel="stylesheet" href="pagestyle.css">
</head>
<body>
<header class="header">
    <h1>Ticket System</h1>
    <section id="logout" >
      <div class ="logout-box">
        <p>Logout</p>
      </div>
    </section>
</header>
<form>
  <input type="hidden" id="animation" value=<?=$animation?>>
</form>
  <section id="login">
          <div class ="form-box-login" id="login-box">
            <div class="form-value">
              <form>
                <h2>Login</h2>
                <div class="inputbox">
                  <ion-icon name="person-outline"></ion-icon>
                  <input type="text" required id="username" name="username">
                  <label for="username">Username:</label>
                </div>
                <div class="inputbox">
                  <ion-icon name="lock-closed-outline"></ion-icon>
                  <input type="password" required id="password" name="password">
                  <label for="password">Password:</label>
                </div>
                <button type="submit" class="submit-login" formaction="/../actions/login.action.php" formmethod="post">Login</button>
                <div class="Reg-forget">
                  <div class="Register" id="Register-button">
                    <p>New account?</p>
                  </div>
                  <div class="forget">
                    <a href="#">Forget Password?</a>
                  </div>
                </div>
              </form>
            </div>
          </div>
    </section>
    
    <section id="signup">
      <div class ="form-box-signup" id="signup-box">
        <div class="form-value">
          <form action='/../actions/register.action.php' method = "post">
            <h2>Sign Up</h2>
            <div class="inputbox">
              <ion-icon name="person-outline"></ion-icon>
              <input type="text" required id="username" name="username">
              <label for="username">Username:</label>
            </div>
            <div class="inputbox">
              <ion-icon name="mail-outline"></ion-icon>
              <input type="text" required id="email" name="email">
              <label for="email">Email:</label>
            </div>
            <div class="inputbox">
              <ion-icon name="lock-closed-outline"></ion-icon>
              <input type="password" required id="password" name="password">
              <label for="password">Password:</label>
            </div>
            <div class="inputbox">
              <ion-icon name="lock-closed-outline"></ion-icon>
              <input type="password" required id="confirm-password" name="confirm-password">
              <label for="confirm-password">Confirm Password:</label>
            </div>
            <button type="submit" class="submit-signup">Sign Up</button>
            <div class="Enter" id="login-button">
              <p>Already have an account? </p>
            </div>
          </form>
        </div>
      </div>
    </section>
  <section>
    <nav class="buttons">
    <div class="before-menu">
      </div>
      <div class="menu">
      <?php $user_type = 'client'; ?>
      <?php if ($user_type === 'client'): ?>
        <div class="client-button"><a href="#"></a>
            <p> Criar um novo Ticket </p>
            <ion-icon name="ticket-outline"></ion-icon></div>
        <div class="client-button"><a href="#"></a>
            <p>Tickets abertos</p>
            <ion-icon name="file-tray-stacked-outline"></ion-icon></div>
      <?php elseif ($user_type === 'agent'): ?>
        <div class="agent-button"><a href="#"></a>
            <p>Tickets do próprio departamento</p>
            <ion-icon name="construct-outline"></ion-icon></div>
      <?php elseif ($user_type === 'admin'): ?>
        <div class="admin-button"><a href="#"></a>
            <p>Associar agentes a departamentos</p>
            <ion-icon name="construct-outline"></ion-icon></div>
        <div class="admin-button"><a href="#"></a>
            <p>Adicionar novos departamentos/dados/entidades</p>
            <ion-icon name="add-circle-outline"></ion-icon></div>
        <div class="admin-button"><a href="#"></a>
            <p>Promover</p>
            <ion-icon name="person-add-outline"></ion-icon></div>
      <?php endif; ?>
      </div>
      </nav>
  </section>
  <section class="FAQs">
      <ion-icon name="help-circle-outline" id="Faqs-icon"></ion-icon>
      <p>FAQ's</p>
    </section>
<footer>
<p>Algum footer que queiramos</p>
</footer>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
