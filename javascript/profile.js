const editIcon = document.querySelector("#edit");
const backIcon = document.querySelector("#back");
const profile = document.querySelector("#profile_box");
const profileEdit = document.querySelector("#profile-edit");

editIcon.onclick = function() {
  rotatePage(profile, profileEdit);
}

backIcon.onclick = function() {
  rotatePage(profileEdit, profile);
}

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