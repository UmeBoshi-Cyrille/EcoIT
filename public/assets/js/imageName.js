const imageName = document.getElementById("imageName");
const instructorName = document.getElementById("name");
const instructorSurname = document.getElementById("surname");

function attachName() {
  imageName.value = instructorName.value + "" + instructorSurname.value;
}
