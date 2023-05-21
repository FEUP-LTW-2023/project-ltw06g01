


function ajustarLarguraItensMenu() {
  var itemMenus = document.querySelectorAll('.item-menu')
  var maxWidth = 0

  // Encontra a largura máxima
  for (var i = 0; i < filtersContainer.length; i++) {
    var width = itemMenus[i].offsetWidth
    if (width > maxWidth) {
      maxWidth = width
    }
  }

  // Define a largura máxima para todos os itens de menu
  for (var i = 0; i < itemMenus.length; i++) {
    itemMenus[i].style.width = maxWidth + 'px'
  }
}




