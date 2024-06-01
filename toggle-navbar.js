document.getElementById("burger-icon").addEventListener("click", function () {
  var leftNavbar = document.querySelector(".left-navi");
  var content = document.querySelector("main");
  var topNavbar = document.querySelector(".navbar");
  
  leftNavbar.classList.toggle("collapsed-navi");
  content.classList.toggle("collapsed-main");
  topNavbar.classList.toggle("collapsed-navbar");
});

// Handle window resize event
window.addEventListener("resize", function () {
  var leftNavbar = document.querySelector(".left-navi");
  var content = document.querySelector("main");
  var burgerIcon = document.getElementById("burger-icon");
  var topNavbar = document.querySelector(".navbar");

  if (window.innerWidth <= 992) {
    leftNavbar.classList.add("collapsed-navi");
    content.classList.add("collapsed-main");
    topNavbar.classList.add("collapsed-navbar");
    burgerIcon.classList.remove("hidden-burger");
  } else {
    leftNavbar.classList.remove("collapsed-navi");
    content.classList.remove("collapsed-main");
    topNavbar.classList.remove("collapsed-navbar");
    burgerIcon.classList.add("hidden-burger");
  }
});

// Initialize on page load
if (window.innerWidth <= 992) {
  document.querySelector(".left-navi").classList.add("collapsed-navi");
  document.querySelector("main").classList.add("collapsed-main");
  document.querySelector(".navbar").classList.add("collapsed-navbar");
  document.getElementById("burger-icon").classList.remove("hidden-burger");
} else {
  document.querySelector(".left-navi").classList.remove("collapsed-navi");
  document.querySelector("main").classList.remove("collapsed-main");
  document.querySelector(".navbar").classList.remove("collapsed-navbar");
  document.getElementById("burger-icon").classList.add("hidden-burger");
}
