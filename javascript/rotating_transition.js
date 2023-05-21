function rotatePage(pageOut, pageIn) {
  pageOut.classList.add("rotate-out")
  pageIn.classList.add("rotate-in")

  pageOut.addEventListener("animationend", () => {
    pageOut.style.display = "none"
    pageOut.classList.remove("rotate-out")
    pageIn.style.display = "grid"
  })

  pageIn.addEventListener("animationend", () => {
    pageIn.style.display = "grid"
    pageIn.classList.remove("rotate-in")
    pageOut.style.display = "none"
  })
}

document.addEventListener("DOMContentLoaded", () => {
  const allUserBoxes = document.querySelectorAll(".user-box")
  const allUserBoxPopups = document.querySelectorAll(".user-box-popup")

  allUserBoxes.forEach((userBox) => {
    const userId = userBox.dataset.userId
    const userBoxPopup = document.getElementById("userBoxPopup-" + userId)
    const backButton = userBoxPopup.querySelector(".back-button")

    userBox.onclick = function() {
      rotatePage(userBox, userBoxPopup)
    }

    backButton.onclick = function() {
      rotatePage(userBoxPopup, userBox)
    }
  })
})
