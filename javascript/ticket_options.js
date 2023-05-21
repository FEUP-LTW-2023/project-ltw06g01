const tickets = document.querySelectorAll('.ticket-display')

tickets.forEach((ticket) => {
  const filtersToggle = ticket.querySelector('.filters-toggle')
  const filtersContainer = ticket.querySelector('.filters-container')

  filtersToggle.onclick = function() {
    if (filtersContainer.style.display === 'none') {
      filtersContainer.style.display = 'grid'
    } else {
      filtersContainer.style.display = 'none'
    }
  }
})