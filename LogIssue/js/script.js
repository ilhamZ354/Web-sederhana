const depan = document.getElementById("flip-card-front");
const blkg = document.getElementById("flip-card-back");

blkg.style.transform = "rotateY(-180deg)";
const btnregis = document.getElementById("btnregis");
btnregis.addEventListener("click", function () {
  document.getElementById("flip2").style.transform = "rotateY(180deg)";
  //depan menjadi di belakang
});

const btnlogin = document.getElementById("btnlogin");
btnlogin.addEventListener("click", function () {
  location.reload();
});

const passwordInput = document.getElementById("FirstPass");
const showPasswordIcon = document.getElementById("showOne");

showPasswordIcon.addEventListener("click", () => {
  if (passwordInput.type === "password") {
    passwordInput.type = "text";
    passwordInput.style.paddingRight = "60px";
    passwordInput.style.height = "45px";
    showPasswordIcon.classList.remove("bi-eye-slash");
    showPasswordIcon.classList.add("bi-eye");
  } else {
    passwordInput.type = "password";
    showPasswordIcon.classList.remove("bi-eye");
    showPasswordIcon.classList.add("bi-eye-slash");
  }
});

const passwordInput2 = document.getElementById("SecondPass");
const showPasswordIcon2 = document.getElementById("showSecond");

showPasswordIcon2.addEventListener("click", () => {
  if (passwordInput2.type === "password") {
    passwordInput2.type = "text";
    passwordInput2.style.paddingRight = "60px";
    passwordInput2.style.height = "45px";
    showPasswordIcon2.classList.remove("bi-eye-slash");
    showPasswordIcon2.classList.add("bi-eye");
  } else {
    passwordInput2.type = "password";
    showPasswordIcon2.classList.remove("bi-eye");
    showPasswordIcon2.classList.add("bi-eye-slash");
  }
});

const passwordInput3 = document.getElementById("ThridPass");
const showPasswordIcon3 = document.getElementById("showThree");

showPasswordIcon3.addEventListener("click", () => {
  if (passwordInput3.type === "password") {
    passwordInput3.type = "text";
    passwordInput3.style.paddingRight = "60px";
    passwordInput3.style.height = "45px";
    showPasswordIcon3.classList.remove("bi-eye-slash");
    showPasswordIcon3.classList.add("bi-eye");
  } else {
    passwordInput3.type = "password";
    showPasswordIcon3.classList.remove("bi-eye");
    showPasswordIcon3.classList.add("bi-eye-slash");
  }
});

