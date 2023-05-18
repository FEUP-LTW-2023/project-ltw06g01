/*verificar onde colocar esta função, serve para colocar os itens da nav bar todos ao mesmo tamanho*/
var itemMenus = document.querySelectorAll('.item-menu');
console.log(itemMenus);
var maxWidth = 0;
for (var i = 0; i < itemMenus.length; i++) {
  var width = itemMenus[i].offsetWidth;
  if (width > maxWidth) {
    maxWidth = width;
  }
}
for (var i = 0; i < itemMenus.length; i++) {
  itemMenus[i].style.width = maxWidth + 'px';
}