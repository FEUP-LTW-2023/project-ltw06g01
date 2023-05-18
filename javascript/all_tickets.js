const ticketFilterSelect = document.querySelector('.ticket-filter');
ticketFilterSelect.addEventListener('change', () => {
  ticketFilterSelect.form.submit();
});

const logoutBox1 = document.querySelector('.logout-box');

logoutBox1.addEventListener('click', (event) => {
  logoutBox.style.animation = 'slideOutLoginToLogout 2s ease-in-out';
  
  setTimeout(() => {
    window.location.href = 'page.php';
  }, 500)
});

var filtersContainer = document.querySelector('.ticket-filter-container');
var filtersButton = document.getElementById('filters-button');

filtersButton.addEventListener('click', function() {
  if (filtersContainer.style.display === 'none') {
    filtersContainer.style.display = 'grid';
    filtersButton.style.borderRadius = '15px 15px 0 0';
  } else {
    filtersContainer.style.display = 'none';
    filtersButton.style.borderRadius = '15px';
  }
});


