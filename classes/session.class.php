<?php
  class Session {

    private array $messages;

    public function __construct() {
      //session_set_cookie_params(0, '/', 'localhost', true, true);
      session_start();
      if (!isset($_SESSION['csrf'])) {
        $_SESSION['csrf'] = $this->generate_random_token();
      }
      $this->messages = isset($_SESSION['messages']) ? $_SESSION['messages'] : array();
      unset($_SESSION['messages']);
    }

    public function isLoggedIn() : bool {
      return isset($_SESSION['uid']);    
    }

    public function isValidSession(string $token) : bool {
        return $token === $_SESSION['csrf'];
    }

    public function addMessage(string $type, string $text) {
      $_SESSION['messages'][] = array('type' => $type, 'text' => $text);
    }

    public function getMessages() {
      return $this->messages;
    }

    private function generate_random_token() {
      return bin2hex(openssl_random_pseudo_bytes(32));
    }
  }
?>