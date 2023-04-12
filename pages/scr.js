function showButtons(userType) {
  // Esconder todos os botões primeiro
  var clientButtons = document.querySelectorAll('.client-button');
    for (var i = 0; i < clientButtons.length; i++) {
      clientButtons[i].style.display = 'inline-block';
    }
  
  // Mostrar botões relevantes com base no tipo de usuário
  if (userType === 'admin') {
    var agentButtons = document.querySelectorAll('.agent-button');
    for (var i = 0; i < agentButtons.length; i++) {
      agentButtons[i].style.display = 'inline-block';
    }
    var adminButtons = document.querySelectorAll('.admin-button');
    for (var i = 0; i < adminButtons.length; i++) {
      adminButtons[i].style.display = 'inline-block';
    }
  } 
  else if (userType === 'agent') {
    var agentButtons = document.querySelectorAll('.agent-button');
    for (var i = 0; i < agentButtons.length; i++) {
      agentButtons[i].style.display = 'inline-block';
    }
  } 
}

// Exemplo de autenticação 
var user = {
  type: 'client'
};

window.onload = function() {
  showButtons(user.type);
};