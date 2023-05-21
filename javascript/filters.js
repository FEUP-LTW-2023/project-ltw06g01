const filtersContainer = document.querySelector('.ticket-filter-container')
const filtersButton = document.getElementById('filters-button')

filtersButton.onclick = function() {
  if (filtersContainer.style.display === 'none') {
    filtersContainer.style.display = 'grid'
    filtersButton.style.borderRadius = '15px 15px 0 0'
  } else {
    filtersContainer.style.display = 'none'
    filtersButton.style.borderRadius = '15px'
  }

  ajustarLarguraItensMenu()

}