var side = document.getElementById("sidebar");

window.addEventListener("scroll", function () {
  var sidebarTop = side.getBoundingClientRect().top;
  sidebar.style.position = sidebarTop <= 0 ? "sticky" : "sticky";
});
