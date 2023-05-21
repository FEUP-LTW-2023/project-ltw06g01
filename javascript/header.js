const message = document.querySelector('.message-category')

if (message !== null) {
  setTimeout(function () {
    message.classList.add('show')
  }, 100)

  setTimeout(function () {
    message.classList.add('hide')
  }, 6100)
}    