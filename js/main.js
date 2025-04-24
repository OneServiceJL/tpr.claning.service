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
    if (e.target.closest(".nav") || e.target.closest(".js-nav-toggler")) return;
    nav.classList.remove("open");
    navToggler.classList.remove("active");
});

/* header bg reveal */

const headerBg = () => {
    const header = document.querySelector(".js-header");

    window.addEventListener("scroll", function () {
        if (this.scrollY > 0) {
            header.classList.add("bg-reveal");
        }
        else {
            header.classList.remove("bg-reveal");
        }
    });

}
headerBg();


document.getElementById('reservationForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch('post_reservation.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert(data.message);
                document.getElementById('reservationForm').reset();
                bootstrap.Modal.getInstance(document.getElementById('reservationModal')).hide();
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while submitting the reservation');
        });
});