/* Mobile Menu */
const navToggler = document.querySelector(".js-nav-toggler");
const nav = document.querySelector(".nav");

function toggleNav() {
    nav.classList.toggle("open");
    navToggler.classList.toggle("active");
}

navToggler.addEventListener("click", toggleNav);

// Close nav when clicking outside
document.addEventListener("click", (e) => {
    if(e.target.closest(".nav") || e.target.closest(".js-nav-toggler")) return;
    nav.classList.remove("open");
    navToggler.classList.remove("active");
});

/* header bg reveal */

const headerBg = () => {
    const header = document.querySelector(".js-header");

    window.addEventListener("scroll", function()  {
        if(this.scrollY > 0){
            header.classList.add("bg-reveal");
        }
        else{
            header.classList.remove("bg-reveal");
        }
    });

}
headerBg();