const loginBox = document.querySelector('#login-box');
const loginBox2 = document.querySelector('#login-box-animated');
const signupBox = document.querySelector('#signup-box');
const signupBox2 = document.querySelector('#signup-box-animated');
const loginButton = document.querySelector('#login-button');
const signupButton = document.querySelector('#Register-button');
const logoutBox = document.querySelector('.logout-box');
const profileBox = document.querySelector('.profile-box');
const menuBox = document.querySelector('nav');
const playAnimation = document.querySelector('#animation');
const playLogin = document.querySelector('#loggedin');

const allTicketsDiv = document.querySelector('#allTickets');


const animationFlag = playAnimation.getAttribute('value');

const loggedinFlag = playLogin.getAttribute('value');  //para verificar a sessão iniciada ou não
const faqsSection = document.querySelector('.FAQs');
