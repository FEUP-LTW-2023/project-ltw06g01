
var menuItem = document.querySelectorAll('.item-menu')

function selectLink(){
  menuItem.forEach((item) =>
    item.classList.remove('ativo')
  )
  this.classList.add('ativo')
}

menuItem.forEach((item) =>
  item.addEventListener('click', selectLink)
)

const ticketFilterSelect = document.querySelector('#ticket-filter');
ticketFilterSelect.addEventListener('change', () => {
  ticketFilterSelect.form.submit();
});


const logoutForm = document.querySelector('.logout-box');
const logoutBox = document.querySelector('.logout-box');

logoutForm.addEventListener('click', (event) => {
  logoutBox.style.animation = 'slideOutLoginToLogout 2s ease-in-out';
  
  setTimeout(() => {
    window.location.href = 'page.php';
  }, 500)
});


/* colocar isto a funcionar

document.querySelectorAll('ticket-form').forEach(ticket => {
  ticket.addEventListener('click', () => {
    const ticketId = getTicket($db, $_GET['id']);
    window.location.href = `view_ticket.php?id=${ticketId}`; 
  });
}); */