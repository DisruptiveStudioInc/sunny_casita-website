/* ============================================== */
/* LAZY-LOAD */
/* ============================================== */

const observer = lozad();
observer.observe();

/* ============================================== */
/* PRELOADER */
/* ============================================== */

window.addEventListener("load", () => {
  const progress = document.getElementById("progress");
  const data = document.getElementById("data");
  const preloader = document.getElementById("preloader");

  let index = 0;
  let interval = setInterval(() => {
    if (index >= 100) {
      clearInterval(interval);
      setTimeout(() => {
        preloader.classList.add("hidden"); // Activa el fade out con CSS
        setTimeout(() => {
          preloader.style.display = "none"; // Oculta completamente después del fade
        }, 200);
      }, 200);
    } else {
      index++;
      data.innerText = `${index}%`;
      progress.style.background = `conic-gradient(
          var(--color-acc) ${index * 3.6}deg,
          var(--color-pri) ${index * 3.6}deg
      )`;
    }
  }, 15);
});

/* ============================================== */
/* MENU HAMBURGUER */
/* ============================================== */

function initMobileMenu() {
  $(".hamburguer")
    .off("click")
    .on("click", function () {
      $(".navigation .menu").toggleClass("active");
      $(this).toggleClass("active");
    });

  $(".navigation .menu a")
    .off("click")
    .on("click", function (e) {
      if ($(this).closest("li").find(".sub-sub").length) {
        e.preventDefault();
        return;
      }
      $(".navigation .menu").removeClass("active");
      $(".hamburguer").removeClass("active");
    });
}

function checkMenu() {
  if ($(window).width() < 1080) {
    initMobileMenu();
  } else {
    // Limpia clases si vuelves a desktop
    $(".hamburguer").removeClass("active");
    $(".navigation .menu").removeClass("active");
    $(".hamburguer").off("click");
    $(".navigation .menu a").off("click");
  }
}

$(document).ready(checkMenu);
$(window).on("resize", checkMenu);

/* ============================================== */
/* NAVIGATION                                     */
/* ============================================== */

$(document).ready(function () {
  const sections = $(".anchor");
  const nav = $("nav .navigation");
  let navHeight = nav.outerHeight();
  let activeSection = null; // Para no actualizar clases si no cambió
  let ticking = false; // Control para requestAnimationFrame

  // Función para detectar sección activa
  function onScroll() {
    const curPos = $(window).scrollTop();
    let newActive = null;

    sections.each(function () {
      const top = $(this).parent().offset().top - navHeight;
      const bottom = top + $(this).parent().outerHeight();

      if (curPos >= top && curPos <= bottom) {
        newActive = this; // Guardamos la sección activa
        return false; // Rompe el each
      }
    });

    if (newActive && activeSection !== newActive) {
      activeSection = newActive;

      nav.find("a").removeClass("active");
      sections.removeClass("active");

      $(activeSection).addClass("active");
      nav.find(`a[href="#${$(activeSection).attr("id")}"]`).addClass("active");
    }
  }

  // Scroll con requestAnimationFrame
  $(window).on("scroll", function () {
    if (!ticking) {
      window.requestAnimationFrame(function () {
        onScroll();
        ticking = false;
      });
      ticking = true;
    }
  });

  // Scroll suave para anchors internos
  $('a[href*="#"]:not([href="#"])').click(function (e) {
    if (
      location.pathname.replace(/^\//, "") ===
        this.pathname.replace(/^\//, "") &&
      location.hostname === this.hostname
    ) {
      const target = $(
        this.hash.length ? this.hash : `[name=${this.hash.slice(1)}]`
      );
      if (target.length) {
        navHeight = nav.outerHeight(); // Recalcular por si cambió en responsive

        $("html, body")
          .stop()
          .animate(
            {
              scrollTop: target.offset().top - navHeight,
            },
            500,
            "swing"
          );

        // Cierra submenús si están abiertos
        document.querySelector(".lan")?.classList.remove("active");
        document.querySelector(".btn-lan")?.classList.remove("open");
        document.querySelector(".sub")?.classList.remove("active");
        document.querySelector(".btn-sub")?.classList.remove("open");

        return false;
      }
    }
  });

  // Ejecuta una vez al cargar
  onScroll();
});

/* ============================================== */
/* LANGUAGE + SUBMENU + SUB-SUBMENU
/* ============================================== */

document.addEventListener("DOMContentLoaded", () => {
  const menusSelector = ".lan, .sub, .get";
  const buttonsSelector = ".btn-lan, .btn-sub, .btn-get";

  const allMenus = document.querySelectorAll(menusSelector);
  const allButtons = document.querySelectorAll(buttonsSelector);

  function closeAll() {
    allMenus.forEach((menu) => menu.classList.remove("active"));
    allButtons.forEach((btn) => btn.classList.remove("open"));
    document
      .querySelectorAll(".sub li.open")
      .forEach((li) => li.classList.remove("open"));
  }

  document.addEventListener("click", (e) => {
    const clickedBtn = e.target.closest(buttonsSelector);
    const clickedMenu = clickedBtn?.nextElementSibling;

    // === Click en botón principal ===
    if (clickedBtn && clickedMenu) {
      e.preventDefault();

      // Cierra todos los demás menús y sub-sub
      closeAll();

      // Abre o cierra el actual
      clickedMenu.classList.toggle("active");
      clickedBtn.classList.toggle("open");
      return;
    }

    // === Click en item que tiene sub-sub ===
    const subSubTrigger = e.target.closest(".sub > li");
    const isRealLink = e.target.closest(".sub-sub a");

    if (
      subSubTrigger &&
      subSubTrigger.querySelector(".sub-sub") &&
      !isRealLink
    ) {
      e.preventDefault();

      // Cierra otros sub-sub en el mismo nivel
      subSubTrigger.parentElement.querySelectorAll("li.open").forEach((li) => {
        if (li !== subSubTrigger) li.classList.remove("open");
      });

      // Alterna el actual
      subSubTrigger.classList.toggle("open");
      return;
    }

    // === Click fuera de cualquier menú ===
    if (!e.target.closest(menusSelector)) {
      closeAll();
    }
  });

  // === Cerrar todo con Escape ===
  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") {
      closeAll();
    }
  });
});

/* ============================================== */
/* EFFECT MENU */
/* ============================================== */

$(function () {
  $(window).on("scroll", function () {
    // Solo activa si ancho > 768px
    if ($(window).width() > 768) {
      if ($(window).scrollTop() > 1) {
        $(".navigation").addClass("effect");
      } else {
        $(".navigation").removeClass("effect");
      }
    } else {
      // En móviles asegúrate de quitar la clase si estaba aplicada
      $(".navigation").removeClass("effect");
    }
  });
});

/* ============================================== */
/* SECTIONS */
/* ============================================== */

document.querySelectorAll(".section-arrows").forEach((arrows) => {
  const section = arrows.closest("section");
  const allSections = Array.from(document.querySelectorAll("section"));

  arrows.querySelector(".arrow.down")?.addEventListener("click", () => {
    const next = allSections[allSections.indexOf(section) + 1];
    if (next) next.scrollIntoView({ behavior: "smooth" });
  });

  arrows.querySelector(".arrow.up")?.addEventListener("click", () => {
    const prev = allSections[allSections.indexOf(section) - 1];
    if (prev) prev.scrollIntoView({ behavior: "smooth" });
  });
});
