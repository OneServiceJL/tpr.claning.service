// WhatsApp contact form handling
document.addEventListener('DOMContentLoaded', function() {
    const whatsappForm = document.getElementById('whatsappContactForm');
    
    if (whatsappForm) {
        whatsappForm.addEventListener('submit', function(event) {
            event.preventDefault();
            sendToWhatsApp(event);
        });
    }
});

function sendToWhatsApp(event) {
    const form = document.getElementById('whatsappContactForm');
    
    // Get form data
    const name = form.querySelector('input[placeholder="Name"]').value.trim();
    const email = form.querySelector('input[placeholder="Email"]').value.trim();
    const phone = form.querySelector('input[placeholder="Phone"]').value.trim();
    const message = form.querySelector('textarea').value.trim();
    
    // Validate form data
    if (!name || !email || !phone || !message) {
        alert('Please fill in all fields');
        return false;
    }
    
    // Format message for WhatsApp
    const whatsappMessage = 
        `*New Contact Form Message*%0A%0A` +
        `*Name:* ${encodeURIComponent(name)}%0A` +
        `*Email:* ${encodeURIComponent(email)}%0A` +
        `*Phone:* ${encodeURIComponent(phone)}%0A` +
        `*Message:* ${encodeURIComponent(message)}`;
    
    // Clear form
    form.reset();
    
    // Open WhatsApp with the message
    window.location.href = `https://wa.me/13194318692?text=${whatsappMessage}`;
    
    return false;
}
