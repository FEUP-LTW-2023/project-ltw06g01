document.addEventListener('DOMContentLoaded', function () {
  var faqItems = document.querySelectorAll('.faq-item');

  faqItems.forEach(function (item) {
    item.addEventListener('click', function () {
      this.classList.toggle('active');
      var answer = this.querySelector('.faq-answer');
      if (answer.style.display === 'block') {
        answer.style.display = 'none';
      } else {
        answer.style.display = 'block';
      }
    });
  });

  var form = document.querySelector('.faq-form');
  var addButton = document.getElementById('add-faq-btn');

  addButton.addEventListener('click', function () {
    if (form.style.display === 'grid') {
      form.style.display = 'none';
    } else {
      form.style.display = 'grid';
    }
  });
});
