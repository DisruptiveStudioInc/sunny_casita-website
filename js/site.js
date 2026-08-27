(() => {
  "use strict";

  const desktopMotion = window.matchMedia(
    "(min-width: 1081px) and (prefers-reduced-motion: no-preference)"
  );

  function finishPreloader() {
    const preloader = document.getElementById("preloader");
    const progress = document.getElementById("progress");
    const label = document.getElementById("data");

    if (!preloader) return;
    if (!desktopMotion.matches) {
      preloader.remove();
      return;
    }

    const startedAt = performance.now();
    const duration = 320;
    const tick = (now) => {
      const percent = Math.min(100, Math.round(((now - startedAt) / duration) * 100));
      if (label) label.textContent = `${percent}%`;
      if (progress) {
        progress.style.background = `conic-gradient(var(--color-acc) ${percent * 3.6}deg, var(--color-pri) 0deg)`;
      }
      if (percent < 100) {
        requestAnimationFrame(tick);
        return;
      }
      preloader.classList.add("hidden");
      window.setTimeout(() => preloader.remove(), 500);
    };
    requestAnimationFrame(tick);
  }

  function initMenu() {
    const hamburger = document.querySelector(".hamburguer");
    const menu = document.querySelector(".navigation .menu");
    if (!hamburger || !menu) return;

    hamburger.addEventListener("click", () => {
      hamburger.classList.toggle("active");
      menu.classList.toggle("active");
    });

    menu.addEventListener("click", (event) => {
      const link = event.target.closest("a");
      if (!link || link.closest("li")?.querySelector(".sub-sub")) return;
      hamburger.classList.remove("active");
      menu.classList.remove("active");
    });
  }

  function initNavigation() {
    const navigation = document.querySelector("nav .navigation");
    const anchors = [...document.querySelectorAll(".anchor")];
    if (!navigation) return;

    const updateNavigationEffect = () => {
      navigation.classList.toggle(
        "effect",
        window.innerWidth > 768 && window.scrollY > 1
      );
    };
    updateNavigationEffect();
    window.addEventListener("scroll", updateNavigationEffect, { passive: true });

    if (anchors.length && "IntersectionObserver" in window) {
      const observer = new IntersectionObserver(
        (entries) => {
          const current = entries.find((entry) => entry.isIntersecting);
          if (!current) return;
          anchors.forEach((anchor) => anchor.classList.remove("active"));
          navigation.querySelectorAll('a[href*="#"]').forEach((link) =>
            link.classList.remove("active")
          );
          current.target.classList.add("active");
          const id = CSS.escape(current.target.id);
          navigation.querySelector(`a[href="#${id}"]`)?.classList.add("active");
        },
        { rootMargin: "-25% 0px -65% 0px" }
      );
      anchors.forEach((anchor) => observer.observe(anchor));
    }

    document.addEventListener("click", (event) => {
      const link = event.target.closest('a[href*="#"]');
      if (!link || !link.hash || link.origin !== location.origin || link.pathname !== location.pathname) return;
      const target = document.querySelector(link.hash);
      if (!target) return;
      event.preventDefault();
      const offset = navigation.getBoundingClientRect().height;
      window.scrollTo({
        top: target.getBoundingClientRect().top + window.scrollY - offset,
        behavior: "smooth",
      });
    });
  }

  function initDropdowns() {
    const buttonSelector = ".btn-lan, .btn-sub, .btn-get";
    const menuSelector = ".lan, .sub, .get";
    const closeAll = () => {
      document.querySelectorAll(menuSelector).forEach((menu) => menu.classList.remove("active"));
      document.querySelectorAll(buttonSelector).forEach((button) => button.classList.remove("open"));
      document.querySelectorAll(".sub li.open").forEach((item) => item.classList.remove("open"));
    };

    document.addEventListener("click", (event) => {
      const button = event.target.closest(buttonSelector);
      const dropdown = button?.nextElementSibling;
      if (button && dropdown?.matches(menuSelector)) {
        const wasOpen = dropdown.classList.contains("active");
        event.preventDefault();
        closeAll();
        if (!wasOpen) {
          dropdown.classList.add("active");
          button.classList.add("open");
        }
        return;
      }

      const submenuItem = event.target.closest(".sub > li");
      if (submenuItem?.querySelector(".sub-sub") && !event.target.closest(".sub-sub a")) {
        event.preventDefault();
        submenuItem.classList.toggle("open");
        return;
      }
      if (!event.target.closest(menuSelector)) closeAll();
    });
    document.addEventListener("keydown", (event) => {
      if (event.key === "Escape") closeAll();
    });
  }

  function initSectionArrows() {
    const sections = [...document.querySelectorAll("section")];
    document.querySelectorAll(".section-arrows").forEach((controls) => {
      const section = controls.closest("section");
      const index = sections.indexOf(section);
      controls.querySelector(".arrow.down")?.addEventListener("click", () =>
        sections[index + 1]?.scrollIntoView({ behavior: "smooth" })
      );
      controls.querySelector(".arrow.up")?.addEventListener("click", () =>
        sections[index - 1]?.scrollIntoView({ behavior: "smooth" })
      );
    });
  }

  finishPreloader();
  initMenu();
  initNavigation();
  initDropdowns();
  initSectionArrows();
})();
