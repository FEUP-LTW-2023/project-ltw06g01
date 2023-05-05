const editIcon = document.querySelector("#edit");
const backIcon = document.querySelector("#back");
const profile = document.querySelector("#profile_box");
const profileEdit = document.querySelector("#profile-edit");

editIcon.addEventListener("click", () => {
    profile.style.display = "none"
    profileEdit.style.display = "grid";
  
  });
  
  backIcon.addEventListener("click", () => {
    profile.style.display = "grid"
    profileEdit.style.display = "none";
  })