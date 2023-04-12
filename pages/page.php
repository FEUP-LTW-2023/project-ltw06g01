<!DOCTYPE html>
<html>
<head>
<title>Ticket System</title>
  <script src="scr.js"></script>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
  <h1>Ticket System</h1>
  <nav>
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="index.php">Login/Sign up</a></li>
    </ul>
  </nav>
</header>
<main>
<section id="login">
      <h2>Login</h2>
      <form>
        <div>
          <label for="username">Username:</label>
          <input type="text" id="username" name="username">
        </div>
        <div>
          <label for="password">Password:</label>
          <input type="password" id="password" name="password">
        </div>
        <button type="submit">Login</button>
      </form>
    </section>
    
    <section id="signup">
      <h2>Sign Up</h2>
      <form>
        <div>
          <label for="username">Username:</label>
          <input type="text" id="username" name="username">
        </div>
        <div>
          <label for="email">Email:</label>
          <input type="email" id="email" name="email">
        </div>
        <div>
          <label for="password">Password:</label>
          <input type="password" id="password" name="password">
        </div>
        <div>
          <label for="confirm-password">Confirm Password:</label>
          <input type="password" id="confirm-password" name="confirm-password">
        </div>
        <button type="submit">Sign Up</button>
      </form>
    </section>
  <section>
    <h2>Secção 1</h2>
    <nav class="buttons">
      <?php $user_type = get_user_type(); ?>
      <?php if ($user_type === 'client'): ?>
        <div class="button client-button">Criar um novo Ticket</div>
        <div class="button client-button">Tickets abertos</div>
      <?php elseif ($user_type === 'agent'): ?>
        <div class="button agent-button">Tickets do próprio departamento</div>
      <?php elseif ($user_type === 'admin'): ?>
        <div class="button admin-button">Associar agentes a departamentos</div>
        <div class="button admin-button">Adicionar novos departamentos/dados/entidades</div>
        <div class="button admin-button">Promover</div>
      <?php endif; ?>
      </nav>
  </section>
  <section>
    <h2>Secção 2</h2>
    <p>Perguntas frequentes</p>
  </section>
</main>
<footer>
<p>Algum footer que queiramos</p>
</footer>
</body>
</html>
