// Slider Animation Controller
class Slider {
  constructor(
    sliderElement,
    typeWriterSpeed = 30,
    titleAnimationDuration = 800
  ) {
    this.slider = sliderElement;
    this.slides = Array.from(sliderElement.querySelectorAll(".content-slide"));
    this.currentIndex = 0;
    this.typeWriterSpeed = typeWriterSpeed;
    this.titleAnimationDuration = titleAnimationDuration;
    this.isAnimating = false;

    this.init();
  }

  init() {
    // Hide all slides initially
    this.slides.forEach((slide, index) => {
      slide.style.opacity = "0";
      slide.style.display = index === 0 ? "block" : "none";

      const title = slide.querySelector(".content-title");
      const text = slide.querySelector(".content-text");

      // Set permanent transition for title
      const duration = this.titleAnimationDuration / 1000;
      title.style.transition = `opacity ${duration}s ease, transform ${duration}s ease`;

      // Set initial states
      title.style.opacity = "0";
      title.style.transform = "scale(0.5)";
      text.style.opacity = "0";
    });

    // Start with the first slide
    this.showSlide(0);
  }

  async showSlide(index) {
    if (this.isAnimating) return;
    this.isAnimating = true;

    const slide = this.slides[index];
    const title = slide.querySelector(".content-title");
    const text = slide.querySelector(".content-text");
    const textContent = text.getAttribute("data-text");

    // Show the slide container
    slide.style.display = "block";
    slide.style.opacity = "1";

    // Animate title: scale up
    await this.animateTitle(title);

    // Typewriter effect for text
    const typewriterDuration = await this.typeWriterEffect(text, textContent);

    // Wait 3 seconds after typewriter finishes
    await this.wait(3000);

    // Fade out the slide
    await this.fadeOut(slide);

    // Move to next slide
    this.currentIndex = (index + 1) % this.slides.length;
    this.isAnimating = false;

    // Continue to next slide
    this.showSlide(this.currentIndex);
  }

  animateTitle(title) {
    return new Promise((resolve) => {
      // Force a reflow to ensure transition is applied
      title.offsetHeight;

      // Now apply the changes
      title.style.opacity = "1";
      title.style.transform = "scale(1)";

      setTimeout(resolve, this.titleAnimationDuration);
    });
  }

  typeWriterEffect(element, text) {
    return new Promise((resolve) => {
      element.textContent = "";
      element.style.opacity = "1";
      let i = 0;

      const type = () => {
        if (i < text.length) {
          element.textContent += text.charAt(i);
          i++;
          setTimeout(type, this.typeWriterSpeed);
        } else {
          resolve(text.length * this.typeWriterSpeed);
        }
      };

      type();
    });
  }

  fadeOut(slide) {
    return new Promise((resolve) => {
      slide.style.transition = "opacity 0.5s ease";
      slide.style.opacity = "0";

      setTimeout(() => {
        slide.style.display = "none";

        // Reset for next time (but keep title transition)
        const title = slide.querySelector(".content-title");
        const text = slide.querySelector(".content-text");
        title.style.opacity = "0";
        title.style.transform = "scale(0.5)";
        text.style.opacity = "0";
        slide.style.transition = "";

        resolve();
      }, 500);
    });
  }

  wait(ms) {
    return new Promise((resolve) => setTimeout(resolve, ms));
  }
}

// Initialize the slider when DOM is ready
document.addEventListener("DOMContentLoaded", () => {
  const sliderElement = document.querySelector(".slider");
  if (sliderElement) {
    new Slider(sliderElement, 40, 500); // 30ms typewriter speed, 800ms title animation
  }
});
