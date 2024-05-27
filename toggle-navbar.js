document.getElementById("burger-icon").addEventListener("click", function () {
  var navbar = document.querySelector(".left-navi");
  var content = document.querySelector("main");
  
  navbar.classList.toggle("collapsed-navi");
  content.classList.toggle("collapsed-main");
});

// Handle window resize event
window.addEventListener("resize", function () {
  var navbar = document.querySelector(".left-navi");
  var content = document.querySelector("main");
  var burgerIcon = document.getElementById("burger-icon");

  if (window.innerWidth <= 768) {
    navbar.classList.add("collapsed-navi");
    content.classList.add("collapsed-main");
    burgerIcon.classList.remove("hidden-burger");
  } else {
    navbar.classList.remove("collapsed-navi");
    content.classList.remove("collapsed-main");
    burgerIcon.classList.add("hidden-burger");
  }
});

// Initialize on page load
if (window.innerWidth <= 768) {
  document.querySelector(".left-navi").classList.add("collapsed-navi");
  document.querySelector("main").classList.add("collapsed-main");
  document.getElementById("burger-icon").classList.remove("hidden-burger");
} else {
  document.querySelector(".left-navi").classList.remove("collapsed-navi");
  document.querySelector("main").classList.remove("collapsed-main");
  document.getElementById("burger-icon").classList.add("hidden-burger");
}
