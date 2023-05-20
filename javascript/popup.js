function toggleUserBoxPopup(userId) {
    const userBoxPopup = document.getElementById("userBoxPopup-" + userId);
    const backdrop = document.getElementById("backdrop");
  
    userBoxPopup.classList.toggle("active");
    backdrop.style.display = userBoxPopup.classList.contains("active") ? "block" : "none";
  }