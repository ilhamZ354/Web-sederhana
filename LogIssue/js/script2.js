const sidebar = document.getElementsByClassName("sidebar")[0];
const content = document.getElementsByClassName("main")[0];
const menu = document.getElementById("menu-label");
const menuDown = document.getElementsByClassName("dropdown-menu")[0];
const navigasi = document.getElementsByClassName('nav-link')[0];
const isu = document.getElementsByClassName("menuIsu");
const profil = document.getElementsByClassName("akun")[0];

menu.addEventListener("click", function () {
  sidebar.classList.toggle("sidebar-kecil");
  menuDown.classList.toggle("dropdownMenu");
  content.classList.toggle("content-kecil");
  profil.classList.toggle("hide");

    isu[0].classList.toggle("menuIsuHidden");
    isu[1].classList.toggle("menuIsuHidden");
    isu[2].classList.toggle("menuIsuHidden");
  
});


const menuIsu = document.getElementById("dropdownMenuButton");

menuIsu.addEventListener('click',function(){
    isu[0].classList.toggle("menuIsuShow");
    isu[1].classList.toggle("menuIsuShow");
    isu[2].classList.toggle("menuIsuShow");
})
