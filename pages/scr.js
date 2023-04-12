function showButtons(userType) {
  if(userType != 'none'){
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
}

// Exemplo de autenticação 
var user = {
  type: 'admin'
};

window.onload = function() {
  showButtons(user.type);
};

// Selecionar os elementos de login e inscrição
var loginSection = document.getElementById("login");
var signupSection = document.getElementById("signup");
console.log(signupSection);

// Esconder a seção de inscrição inicialmente
signupSection.style.display = "none";

// Adicionar um evento de clique no botão "Ainda não tens conta?"
var signupButton = signupSection.querySelector("#login-button");
console.log(signupButton);
signupButton.addEventListener("click", function() {
  // Esconder a seção de login
  loginSection.style.display = "none";
  // Mostrar a seção de inscrição
  signupSection.style.display = "flex";
});

// Adicionar um evento de clique no botão "Já tens conta?"
var loginButton = loginSection.querySelector("#signup-button");
loginButton.addEventListener("click", function() {
  // Esconder a seção de inscrição
  signupSection.style.display = "none";
  // Mostrar a seção de login
  loginSection.style.display = "flex";
});

// Esconder a seção de inscrição quando a página é carregada
window.onload = function() {
  showButtons(user.type);
  signupSection.style.display = "none";
  loginSection.style.display = "flex";

};



