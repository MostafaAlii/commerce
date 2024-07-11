const listBarOne = document.getElementById("bar-one");
const sideBarOne = document.querySelector(".content-one");
listBarOne.addEventListener("click", () => {
  sideBarOne.classList.toggle("appear");
});
document.addEventListener("keyup", (e) => {
  console.log(e.key);
  if (e.key === "Escape") {
    sideBarOne.classList.remove("appear");
  }
});
