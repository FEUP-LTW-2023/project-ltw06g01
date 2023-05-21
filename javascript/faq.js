document.addEventListener('DOMContentLoaded', function () {
  const faqItems = document.querySelectorAll('.faq-item')

  faqItems.forEach(function (item) {
    item.onclick = function() {
      this.classList.toggle('active')
      const answer = this.querySelector('.faq-answer')
      if (answer.style.display === 'block') {
        answer.style.display = 'none'
      } else {
        answer.style.display = 'block'
      }
    }
  })

  const form = document.querySelector('.faq-form')
  const addButton = document.getElementById('add-faq-btn')

  addButton.onclick = function() {
    if (form.style.display === 'grid') {
      form.style.display = 'none'
    } else {
      form.style.display = 'grid'
    }
  }
  
  backButton.onclick = function() {
    if (form.style.display === 'grid') {
      form.style.display = 'none'
    } else {
      form.style.display = 'grid'
    }
  }
})