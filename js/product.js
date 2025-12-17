/* ============================================== */
/* SCROLL-MAGIC */
/* ============================================== */

document.addEventListener("DOMContentLoaded", function () {
  // Solo ejecutar si ancho >= 1080px
  if (window.innerWidth >= 1080) {
    // Función para cargar scripts dinámicamente
    function loadScript(src) {
      return new Promise((resolve, reject) => {
        const script = document.createElement("script");
        script.src = src;
        script.onload = resolve;
        script.onerror = reject;
        document.head.appendChild(script);
      });
    }

    // Cargar librerías en orden
    Promise.all([
      loadScript(
        "https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js"
      ),
      loadScript(
        "https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.3/ScrollMagic.min.js"
      ),
    ])
      .then(() =>
        Promise.all([
          loadScript(
            "https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.3/plugins/animation.gsap.min.js"
          ),
          loadScript(
            "https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/plugins/debug.addIndicators.min.js"
          ),
        ])
      )
      .then(() => {
        var controller = new ScrollMagic.Controller();
        var animationSpeed = 0.75;
        var animationLinear = Power3.easeInOut;
        var animationIn = Expo.easeIn;

        $(".ingredients_wrap").each(function () {
          var ingredientsElement = this.querySelector(".ingredients");
          if (ingredientsElement) {
            var scene = new ScrollMagic.Scene({
              triggerElement: this,
              triggerHook: 0.8,
              duration: "80%",
            })
              .setClassToggle(ingredientsElement, "fade-in")
              //.addIndicators()
              .addTo(controller);
          }
        });

        new ScrollMagic.Scene({
          triggerElement: ".img_med",
          duration: "150%",
          triggerHook: 1,
        })
          .setTween(
            new TimelineMax().fromTo(
              ".img_med img",
              1,
              { y: "-20%" },
              { y: "3%" }
            )
          )
          //.addIndicators()
          .addTo(controller);
      });
  }
});

/* ============================================== */
/* BANNER */
/* ============================================== */

document.addEventListener("DOMContentLoaded", () => {
  const slides = document.querySelectorAll(".banner li");
  let current = 0;
  let interval;

  function showSlide(index) {
    slides.forEach((slide, i) => {
      slide.classList.remove("active", "fade-out");
      if (i === index) slide.classList.add("active");
    });
  }

  function nextSlide() {
    slides[current].classList.add("fade-out"); // Fade-out texto antes de salir
    setTimeout(() => {
      current = (current + 1) % slides.length;
      showSlide(current);
    }, 600);
  }

  function startSlider() {
    interval = setInterval(nextSlide, 4000); // cada 4s
  }

  function stopSlider() {
    clearInterval(interval);
  }

  // Inicialización
  showSlide(current);
  startSlider();

  // Detener al hacer hover
  const banner = document.querySelector(".banner");
  banner.addEventListener("mouseenter", stopSlider);
  banner.addEventListener("mouseleave", startSlider);
});

/* ============================================== */
/* TILT */
/* ============================================== */

const imgContainer = document.querySelector(".c-sub .h-100");
const img = document.querySelector(".c-sub .img-middle");

imgContainer.addEventListener("mousemove", (e) => {
  const rect = imgContainer.getBoundingClientRect();
  const x = e.clientX - rect.left;
  const y = e.clientY - rect.top;

  const centerX = rect.width / 2;
  const centerY = rect.height / 2;

  const deltaX = (x - centerX) / centerX; // -1 a 1
  const deltaY = (y - centerY) / centerY; // -1 a 1

  // inclinación
  const rotateX = deltaY * 15;
  const rotateY = deltaX * -15;

  img.style.transform = `rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale(1.05)`;
});

imgContainer.addEventListener("mouseleave", () => {
  img.style.transform = "rotateX(0deg) rotateY(0deg) scale(1)";
});
