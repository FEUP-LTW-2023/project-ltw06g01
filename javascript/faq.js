document.addEventListener('DOMContentLoaded', function () {
  const faqItems = document.querySelectorAll('.faq-item');

  faqItems.forEach(function (item) {
    item.addEventListener('click', function () {
      this.classList.toggle('active');
      const answer = this.querySelector('.faq-answer');
      if (answer.style.display === 'block') {
        answer.style.display = 'none';
      } else {
        answer.style.display = 'block';
      }
    });
  });
});

const faqForm = document.querySelector('.faq-form');

if (typeof userType !== 'undefined' && userType >= 1) {
  faqForm.style.display = 'grid';
} else {
  faqForm.style.display = 'none';
}


