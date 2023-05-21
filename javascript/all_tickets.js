const ticketFilterSelect = document.querySelector('.ticket-filter');
ticketFilterSelect.addEventListener('change', () => {
  ticketFilterSelect.form.submit();
});

const logoutBox1 = document.querySelector('.logout-box');

logoutBox1.onclick = function() {
  logoutBox.style.animation = 'slideOutLoginToLogout 2s ease-in-out';
  
  setTimeout(() => {
    window.location.href = 'page.php';
  }, 500)
}

var filtersContainer = document.querySelector('.ticket-filter-container');
var filtersButton = document.getElementById('filters-button');

filtersButton.onclick = function() {
  if (filtersContainer.style.display === 'none') {
    filtersContainer.style.display = 'grid';
    filtersButton.style.borderRadius = '15px 15px 0 0';
  } else {
    filtersContainer.style.display = 'none';
    filtersButton.style.borderRadius = '15px';
  }

  ajustarLarguraElementos();

}

function ajustarLarguraItensMenu() {
  var itemMenus = document.querySelectorAll('.item-menu');
  var maxWidth = 0;

  // Encontra a largura máxima
  for (var i = 0; i < filtersContainer.length; i++) {
    var width = itemMenus[i].offsetWidth;
    if (width > maxWidth) {
      maxWidth = width;
    }
  }

  // Define a largura máxima para todos os itens de menu
  for (var i = 0; i < itemMenus.length; i++) {
    itemMenus[i].style.width = maxWidth + 'px';
  }
}




