const sidebar = document.getElementsByClassName("sidebar")[0];
const content = document.getElementsByClassName("main")[0];
const menu = document.getElementById("menu-label");
const menuDown = document.getElementsByClassName("dropdown-menu")[0];
const navigasi = document.getElementsByClassName("nav-link")[0];
const isu = document.getElementsByClassName("menuIsu");
const profil = document.getElementsByClassName("akun")[0];

menu.addEventListener("click", function () {
  sidebar.classList.toggle("sidebar-kecil");
  content.classList.toggle("content-kecil");
  profil.classList.toggle("hide");

});


