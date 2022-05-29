// JavaScript Document

const hamburger = document.querySelector(".hamburger");
const navLinks = document.querySelector(".nav-links");
const links = document.querySelectorAll(".nav-links li");

hamburger.addEventListener('click', ()=>{
   //Animate Links
    navLinks.classList.toggle("open");
    links.forEach(link => {
        link.classList.toggle("fade");
    });

    //Hamburger Animation
    hamburger.classList.toggle("toggle");
});
    
    
function opacityMenu () {
  var navElement = document.querySelector("nav");
  this.scrollY > 100 ? navElement.classList.add("back"): navElement.classList.remove("back");
}
window.addEventListener("scroll", opacityMenu , false);