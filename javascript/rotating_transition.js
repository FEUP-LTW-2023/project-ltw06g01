function toggleUserBoxPopup(userId) {
  const backButton = document.querySelector(".back-button");
  const userBox = document.getElementById("userBox-" + userId);
  const userBoxPopup = document.getElementById("userBoxPopup-" + userId);
  
  userBox.addEventListener("click", () => {
    rotatePage(userBox, userBoxPopup);
  });
  
  backButton.addEventListener("click", () => {
    rotatePage(userBoxPopup, userBox);
  });
    
    function rotatePage(pageOut, pageIn) {
      pageOut.classList.add("rotate-out");
      pageIn.classList.add("rotate-in");
    
      pageOut.addEventListener("animationend", () => {
        pageOut.style.display = "none";
        pageOut.classList.remove("rotate-out");
        pageIn.style.display = "grid";
      });
    
      pageIn.addEventListener("animationend", () => {
        pageIn.style.display = "grid";
        pageIn.classList.remove("rotate-in");
        pageOut.style.display = "none";
      });
    }
  }