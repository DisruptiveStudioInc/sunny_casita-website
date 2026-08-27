/* ==============================================
    MODAL
============================================== */
// Función para abrir el modal
function openModal(modalId) {
  var modal = document.getElementById(modalId);
  if (modal) {
    modal.classList.add("open"); // Muestra el modal
    document.body.classList.add("no-scroll"); // Bloquea el scroll
  }
}

// Función para cerrar el modal
function closeModal(modalId) {
  var modal = document.getElementById(modalId);
  if (modal) {
    modal.classList.remove("open"); // Oculta el modal
    if (modal.classList.contains("modal-video")) {
      modal.querySelector(".modal-video-player").replaceChildren();
    }
    checkModalsOpen(); // Verifica si hay otros modales abiertos
  }
}

// Función para verificar si hay modales abiertos y desbloquear el scroll
function checkModalsOpen() {
  var openModals = document.querySelectorAll(".modal.open");
  if (openModals.length === 0) {
    document.body.classList.remove("no-scroll"); // Reactiva el scroll
  }
}

// Función para cerrar el modal si se hace clic fuera de él
window.onclick = function (event) {
  var modals = document.querySelectorAll(".modal");
  modals.forEach(function (modal) {
    if (event.target === modal) {
      closeModal(modal.id);
    }
  });
};

document.addEventListener("DOMContentLoaded", function () {
  /* ============================================== */
  /* PRODUCT VIDEO MODAL */
  /* ============================================== */

  function getVideoModal() {
    var modal = document.getElementById("productVideoModal");

    if (modal) {
      return modal;
    }

    modal = document.createElement("div");
    modal.id = "productVideoModal";
    modal.className = "modal modal-video";
    modal.setAttribute("role", "dialog");
    modal.setAttribute("aria-modal", "true");
    modal.setAttribute("aria-label", "Product video");

    var content = document.createElement("div");
    content.className = "modal-content modal-video-content rel";

    var closeButton = document.createElement("button");
    closeButton.type = "button";
    closeButton.className = "v-white c-pri icon icon-close";
    closeButton.setAttribute("aria-label", "Close video");
    closeButton.addEventListener("click", function () {
      closeModal(modal.id);
    });

    var player = document.createElement("div");
    player.className = "modal-video-player";

    content.append(closeButton, player);
    modal.appendChild(content);
    document.body.appendChild(modal);

    return modal;
  }

  function openProductVideo(videoId) {
    if (!videoId) {
      return;
    }

    var modal = getVideoModal();
    var player = modal.querySelector(".modal-video-player");
    var iframe = document.createElement("iframe");

    iframe.src = "https://player.vimeo.com/video/" + encodeURIComponent(videoId) + "?autoplay=1";
    iframe.setAttribute("allow", "autoplay; fullscreen; picture-in-picture");
    iframe.setAttribute("allowfullscreen", "");
    iframe.title = "Product video";

    player.replaceChildren(iframe);
    modal.classList.add("open");
    document.body.classList.add("no-scroll");
  }

  document.querySelectorAll(".js-product-video").forEach(function (button) {
    button.addEventListener("click", function () {
      openProductVideo(button.dataset.video);
    });
  });

  document.addEventListener("keydown", function (event) {
    if (event.key === "Escape") {
      var videoModal = document.getElementById("productVideoModal");
      if (videoModal && videoModal.classList.contains("open")) {
        closeModal(videoModal.id);
      }
    }
  });

  /* ============================================== */
  /* VIDEO HERO */
  /* ============================================== */

  const desktopMotion = window.matchMedia(
    "(min-width: 1081px) and (prefers-reduced-motion: no-preference)"
  );
  const heroVideo = document.querySelector(".video-iframe-wrapper[data-vimeo-id]");
  const heroPlaceholder = document.querySelector(".video-placeholder");

  if (desktopMotion.matches && heroVideo) {
    const loadHeroVideo = () => {
      const iframe = document.createElement("iframe");
      iframe.id = "hero-video";
      iframe.src = `https://player.vimeo.com/video/${encodeURIComponent(heroVideo.dataset.vimeoId)}?background=1&autoplay=1&muted=1&loop=1&dnt=1&api=1&player_id=hero-video`;
      iframe.allow = "autoplay; fullscreen; picture-in-picture";
      iframe.title = "Sunny Casitas Video";
      iframe.tabIndex = -1;

      let revealFallback;
      const revealVideo = () => {
        window.clearTimeout(revealFallback);
        window.removeEventListener("message", onVimeoMessage);
        heroPlaceholder?.classList.add("is-playing");
      };
      const subscribeToPlayback = () => {
        iframe.contentWindow?.postMessage(
          { method: "addEventListener", value: "play" },
          "https://player.vimeo.com"
        );
      };
      const onVimeoMessage = (event) => {
        if (event.origin !== "https://player.vimeo.com" || event.source !== iframe.contentWindow) return;
        let data = event.data;
        if (typeof data === "string") {
          try { data = JSON.parse(data); } catch { return; }
        }
        if (data?.event === "ready") subscribeToPlayback();
        if (data?.event === "play") revealVideo();
      };

      window.addEventListener("message", onVimeoMessage);
      iframe.addEventListener("load", () => {
        subscribeToPlayback();
        revealFallback = window.setTimeout(revealVideo, 3000);
      }, { once: true });
      heroVideo.appendChild(iframe);
    };

    // Let the browser paint the local hero first, then start Vimeo immediately.
    window.requestAnimationFrame(() => window.requestAnimationFrame(loadHeroVideo));
  }

  document.querySelectorAll(".js-vimeo-facade").forEach((facade) => {
    facade.addEventListener("click", () => {
      if (facade.classList.contains("is-playing")) return;
      const iframe = document.createElement("iframe");
      iframe.src = `https://player.vimeo.com/video/${encodeURIComponent(facade.dataset.vimeoId)}?autoplay=1&dnt=1`;
      iframe.allow = "autoplay; fullscreen; picture-in-picture";
      iframe.allowFullscreen = true;
      iframe.title = facade.getAttribute("aria-label") || "Video";
      facade.classList.add("is-playing");
      facade.replaceChildren(iframe);
    });
  });

  /* ============================================== */
  /* TABS */
  /* ============================================== */

  const tabs = document.querySelectorAll(".tab");
  const contents = document.querySelectorAll(".content");
  const indicator = document.querySelector(".active-indicator");

  function typeWriterEffect(element, text, speed = 30) {
    element.textContent = "";
    let i = 0;
    function type() {
      if (i < text.length) {
        element.textContent += text.charAt(i);
        i++;
        setTimeout(type, speed);
      }
    }
    type();
  }

  tabs.forEach((tab, index) => {
    tab.addEventListener("click", () => {
      tabs.forEach((t) => t.classList.remove("active"));
      contents.forEach((c) => c.classList.remove("active"));

      tab.classList.add("active");
      const content = contents[index];
      content.classList.add("active");

      const text = content.getAttribute("data-text") || "";
      typeWriterEffect(content, text);

      indicator.style.transform = `translateX(${tab.offsetLeft}px)`;
      indicator.style.width = `${tab.offsetWidth}px`;
    });
  });

  window.addEventListener("load", () => {
    const activeTab = document.querySelector(".tab.active");
    const activeContent = document.querySelector(".content.active");

    indicator.style.transform = `translateX(${activeTab.offsetLeft}px)`;
    indicator.style.width = `${activeTab.offsetWidth}px`;

    const text = activeContent.getAttribute("data-text") || "";
    typeWriterEffect(activeContent, text);
  });

  /* ==============================================
       SCROLL-MAGIC SOLO DESKTOP
    ============================================== */
  if (desktopMotion.matches) {
    function loadScript(src) {
      return new Promise((resolve, reject) => {
        const script = document.createElement("script");
        script.src = src;
        script.onload = resolve;
        script.onerror = reject;
        document.head.appendChild(script);
      });
    }

    // Cargar librerías
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
        ])
      )
      .then(() => {
        var controller = new ScrollMagic.Controller();
        var animationSpeed = 0.75;
        var animationLinear = Power3.easeInOut;
        var animationInOutQuart = Expo.easeInOutQuart;
        var animationIn = Expo.easeIn;

        // ========== GALLERY
        var textoTimeline = new TimelineMax();
        textoTimeline
          .fromTo(
            ".word_01",
            animationSpeed,
            { opacity: 1, scale: 1 },
            {
              opacity: 0,
              scale: 4,
              ease: animationLinear,
              immediateRender: false,
            }
          )
          .fromTo(
            ".word_02",
            animationSpeed,
            { opacity: 0, scale: 1 },
            {
              opacity: 1,
              scale: 1,
              ease: animationLinear,
              immediateRender: false,
            }
          )
          .to(".word_02", animationSpeed, {
            opacity: 0,
            scale: 4,
            ease: animationLinear,
          })
          .fromTo(
            ".word_03",
            animationSpeed,
            { opacity: 0, scale: 1 },
            {
              opacity: 1,
              scale: 1,
              ease: animationLinear,
              immediateRender: false,
            }
          )
          .to(".word_03", animationSpeed, {
            opacity: 0,
            scale: 4,
            ease: animationLinear,
          })
          .fromTo(
            ".word_04",
            animationSpeed,
            { opacity: 0, scale: 1 },
            {
              opacity: 1,
              scale: 1,
              ease: animationLinear,
              immediateRender: false,
            }
          )
          .to(".word_04", animationSpeed, {
            opacity: 0,
            scale: 4,
            ease: animationLinear,
          })
          .fromTo(
            ".word_05",
            animationSpeed,
            { opacity: 0, scale: 1 },
            {
              opacity: 1,
              scale: 1,
              ease: animationLinear,
              immediateRender: false,
            }
          );

        var imgTimeline = new TimelineMax();
        imgTimeline
          .fromTo(
            ".img_01",
            animationSpeed,
            { opacity: 1 },
            { opacity: 0, ease: animationLinear, immediateRender: false },
            animationSpeed * 0.25
          )
          .fromTo(
            ".img_02",
            animationSpeed,
            { opacity: 1 },
            { opacity: 0, ease: animationLinear, immediateRender: false },
            animationSpeed * 2.25
          )
          .fromTo(
            ".img_03",
            animationSpeed,
            { opacity: 1 },
            { opacity: 0, ease: animationLinear, immediateRender: false },
            animationSpeed * 4
          )
          .fromTo(
            ".img_04",
            animationSpeed,
            { opacity: 1 },
            { opacity: 0, ease: animationLinear, immediateRender: false },
            animationSpeed * 5.75
          )
          .fromTo(
            ".img_05",
            animationSpeed,
            { opacity: 1 },
            { opacity: 1, ease: animationLinear, immediateRender: false },
            animationSpeed * 7
          );

        var master = new TimelineMax();
        master.add(textoTimeline, 0);
        master.add(imgTimeline, 0);

        new ScrollMagic.Scene({
          triggerElement: ".vertical-slides",
          duration: "300%",
          triggerHook: 0,
        })
          .setPin(".vertical-slides")
          .setTween(master)
          //.addIndicators()
          .addTo(controller);

        // ========== HERO
        var heroTimeline = new TimelineMax();
        heroTimeline.fromTo(
          ".hero-text",
          animationSpeed,
          { opacity: 0 },
          { opacity: 1 },
          "+=0.5"
        );

        new ScrollMagic.Scene({
          triggerElement: ".hero-pin",
          duration: "100%",
          triggerHook: 0,
        })
          .setPin(".hero-pin")
          .setTween(heroTimeline)
          //.addIndicators()
          .addTo(controller);

        // ========== PARALLAX
        var parallaxTimeline = new TimelineMax();
        parallaxTimeline
          .from(".parallax .box_1", animationSpeed, {
            scale: 1.2,
            x: "-100",
            y: "0",
            opacity: 0,
            ease: animationIn,
          })
          .from(
            ".parallax .box_2",
            animationSpeed,
            { scale: 1.2, x: "100", y: "0", opacity: 0, ease: animationIn },
            0
          )
          .from(
            ".parallax .box_3",
            animationSpeed,
            { scale: 1.2, x: "-100", y: "30", opacity: 0, ease: animationIn },
            0
          )
          .from(
            ".parallax .box_4",
            animationSpeed,
            { scale: 1.2, x: "100", y: "30", opacity: 0, ease: animationIn },
            0
          );

        new ScrollMagic.Scene({
          triggerElement: ".parallax",
          duration: "50%",
          triggerHook: 0.65,
        })
          //.setPin('.parallax')
          .setTween(parallaxTimeline)
          //.addIndicators()
          .addTo(controller);

        // ========== LICENSES
        var licensesTimeline = new TimelineMax();
        licensesTimeline
          .from(".licence-title", animationSpeed, { scale: 2, y: 200 })
          .staggerFrom(
            ".licence-text",
            animationSpeed,
            { y: 40, opacity: 0 },
            0.2
          )
          .staggerFrom(
            ".licence-box",
            animationSpeed,
            { x: 80, opacity: 0 },
            0.2
          );

        new ScrollMagic.Scene({
          triggerElement: ".licence-wrap",
          duration: "200%",
          triggerHook: 0,
        })
          .setPin(".licence-wrap")
          .setTween(licensesTimeline)
          .addTo(controller);

        // ========== CONTENT SCROLL
        document.querySelectorAll(".products").forEach((productsSection) => {
            var productsElement = productsSection.querySelector(".wrap_products");
            if (productsElement) {
              new ScrollMagic.Scene({
                triggerElement: productsSection,
                triggerHook: 0.2,
                duration: "80%",
              })
                .setClassToggle(productsElement, "fade-in")
                .addTo(controller);
            }
        });

        // ========== EVOLVERS
        var EVO = new TimelineMax();
        EVO.fromTo(
          ".evolvers_wrap .evolvers",
          animationSpeed,
          { x: "8%" },
          { x: "-48%", ease: animationInOutQuart },
          0
        );

        new ScrollMagic.Scene({
          triggerElement: ".evolvers_wrap",
          duration: "200%",
          triggerHook: 0,
        })
          .setPin(".evolvers_wrap")
          .setTween(EVO)
          //.addIndicators()
          .addTo(controller);
      })
      .catch((err) =>
        console.error("Error cargando scripts ScrollMagic/GSAP:", err)
      );
  }

  /* ==============================================
       MOUSE HOVER
    ============================================== */
  const texts = document.querySelectorAll(".text_spirit div");
  const products = document.querySelectorAll(".img_product");

  if (texts.length && products.length) {
    texts.forEach((text, index) => {
      text.addEventListener("mouseenter", () => {
        products.forEach((product, i) => {
          const circle = product.querySelector(".img_reference");
          if (i === index) {
            product.style.opacity = "1";
            if (circle)
              circle.style.animation = "circleSlideFade 0.6s 0.2s forwards";
            product.classList.add("show");
          } else {
            product.style.opacity = "0";
            if (circle) circle.style.animation = "none";
            product.classList.remove("show");
          }
        });
      });
    });
  }

  /* ==============================================
       PARALLAX TEXTO SOLO EN DESKTOP
    ============================================== */
  document.querySelectorAll("ul.textos li").forEach((item) => {
    const span = item.querySelector("span");
    const img = span ? span.querySelector("img") : null;
    if (!img) return;

    if (window.innerWidth > 1080) {
      item.addEventListener("mousemove", (e) => {
        const rect = item.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        const moveX = (rect.width / 2 - x) / 20;
        const moveY = (rect.height / 2 - y) / 20;
        img.style.transform = `translate(${moveX}px, ${moveY}px)`;
      });
      item.addEventListener("mouseleave", () => {
        img.style.transform = "translate(0px,0px)";
      });
    } else {
      img.style.transform = "none";
    }
  });

  /* ==============================================
      STICKY BANNER EXPANSION SOLO EN DESKTOP
    ============================================== */
  const expansionBoxes = document.querySelectorAll(".expansion-boxes");
  const expansionBanners = document.querySelectorAll(".expansion-banner");

  if (expansionBoxes.length > 0 && expansionBanners.length > 0) {
    const optionsObserver = {
      rootMargin: `-80% 0px -15% 0px`,
    };
    const handleBannerImages = (entries, observer) => {
      entries.forEach((entry) => {
        const targetImg = document.getElementById(
          `exp-banner-${entry.target.dataset.image}`
        );
        if (entry.isIntersecting) {
          expansionBanners.forEach((banner) =>
            banner.classList.remove("active")
          );
          targetImg.classList.add("active");
        }
      });
    };
    const bannerObserver = new IntersectionObserver(
      handleBannerImages,
      optionsObserver
    );

    function handleInitObserver() {
      if (window.innerWidth > 768) {
        expansionBoxes.forEach((box) => bannerObserver.observe(box));
      } else {
        bannerObserver.disconnect();
      }
    }
    handleInitObserver();
    window.addEventListener("resize", handleInitObserver);
  }

  /* ==============================================
      PROCESS TEXTS
    ============================================== */

  const textsHome = document.querySelectorAll(".texts-home");

  if (textsHome.length > 0) {
    textsHome.forEach((element) => {
      // Store original background color
      const originalBgColor = window.getComputedStyle(element).backgroundColor;

      element.addEventListener("mouseenter", () => {
        // Set all other elements to transparent
        textsHome.forEach((el) => {
          if (el !== element) {
            el.style.backgroundColor = "transparent";
          }
        });
      });

      element.addEventListener("mouseleave", () => {
        // Restore original background color for all elements
        textsHome.forEach((el) => {
          el.style.backgroundColor = "";
        });
      });
    });
  }
});
