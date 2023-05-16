const tickets = document.querySelectorAll('#ticket-display');

tickets.forEach((ticket) => {
  const filtersToggle = ticket.querySelector('#filters-toggle');
  const filtersContainer = ticket.querySelector('#filters-container');

  filtersToggle.addEventListener('click', () => {
    if (filtersContainer.style.display === 'none') {
      filtersContainer.style.display = 'grid';
    } else {
      filtersContainer.style.display = 'none';
    }
  });
});
