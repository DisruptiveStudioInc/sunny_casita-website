// Join form submission handler
document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("contact-form");

  if (!form) return;

  const alertsMsg = JSON.parse(form.dataset.alerts);

  // Create message container
  const messageContainer = document.createElement("div");
  messageContainer.className = "form-message span-2 med-span-1";
  messageContainer.style.cssText = `
    display: none;
    padding: 15px 20px;
    border-radius: 10px;
    margin-bottom: 20px;
    font-size: 16px;
    text-align: center;
    transition: all 0.3s ease;
  `;
  form.insertAdjacentElement("beforeend", messageContainer);

  form.addEventListener("submit", async function (e) {
    e.preventDefault();

    // Get form data
    const formData = new FormData(form);

    // Get submit button
    const submitBtn = form.querySelector('button[type="submit"]');
    const originalBtnText = submitBtn.textContent;

    // Disable button and show loading state
    submitBtn.disabled = true;
    submitBtn.textContent = alertsMsg.processing;
    submitBtn.style.opacity = "0.6";

    // Hide previous messages
    messageContainer.style.display = "none";

    try {
      const response = await fetch("/api/form/join", {
        method: "POST",
        body: formData,
      });

      const data = await response.json();

      // Show message
      messageContainer.style.display = "block";

      if (data.success) {
        // Success message
        messageContainer.textContent = alertsMsg.sendSuccess;
        messageContainer.style.backgroundColor = "#d4edda";
        messageContainer.style.color = "#155724";
        messageContainer.style.border = "1px solid #c3e6cb";

        // Reset form
        form.reset();

        // Auto-hide success message after 5 seconds
        setTimeout(() => {
          messageContainer.style.display = "none";
        }, 5000);
      } else {
        // Error message
        messageContainer.textContent = data.message;
        messageContainer.style.backgroundColor = "#f8d7da";
        messageContainer.style.color = "#721c24";
        messageContainer.style.border = "1px solid #f5c6cb";
      }

      // Scroll to message
      messageContainer.scrollIntoView({ behavior: "smooth", block: "nearest" });
    } catch (error) {
      // Network or other error
      messageContainer.style.display = "block";
      messageContainer.textContent = alertsMsg.sendFailed;
      messageContainer.style.backgroundColor = "#f8d7da";
      messageContainer.style.color = "#721c24";
      messageContainer.style.border = "1px solid #f5c6cb";

      console.error("Form submission error:", error);
    } finally {
      // Re-enable button
      submitBtn.disabled = false;
      submitBtn.textContent = originalBtnText;
      submitBtn.style.opacity = "1";
    }
  });
});
