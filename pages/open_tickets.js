const ticketFilterSelect = document.querySelector('#ticket-filter');
ticketFilterSelect.addEventListener('change', () => {
  ticketFilterSelect.form.submit();
});