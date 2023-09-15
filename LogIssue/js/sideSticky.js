var side = document.getElementById("sidebar");
var pencarian = document.getElementById('navbar');
var menuNav = document.getElementsByClassName("humber")[0];

window.addEventListener("scroll", function () {
  var sidebarTop = side.getBoundingClientRect().top;
  var pencarianTop = side.getBoundingClientRect().top;
  var menuNavTop = side.getBoundingClientRect().top;
  side.style.position = sidebarTop <= 0 ? "sticky" : "sticky";
    pencarian.style.position = sidebarTop <= 0 ? "sticky" : "sticky";
    menuNav.style.position = sidebarTop <= 0 ? "sticky" : "sticky";
});
