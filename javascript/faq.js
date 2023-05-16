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
  });

  $(document).ready(function() {
    var faqItems = $('.faq-item');
    var maxWidth = 0;
  
    faqItems.each(function() {
      var itemWidth = $(this).outerWidth();
      maxWidth = Math.max(maxWidth, itemWidth);
    });
  
    maxWidth = Math.min(maxWidth, 800);
  
    faqItems.css('max-width', maxWidth + 'px');
  });
  