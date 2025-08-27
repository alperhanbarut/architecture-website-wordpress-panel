document.addEventListener("DOMContentLoaded", () => {
  /* ================== SLIDER ================== */
  const sliderContainer = document.getElementById("slider-container");
  const slides = document.querySelectorAll(".slide");
  const prevArrow = document.getElementById("prev-arrow");
  const nextArrow = document.getElementById("next-arrow");
  const dotsContainer = document.querySelector(".dots-container");

  if (sliderContainer && slides.length > 0 && dotsContainer) {
    let currentSlide = 0;
    const images = Array.from(slides).map((slide) => slide.dataset.bg);

    function wrapLettersInSpans() {
      slides.forEach((slide) => {
        const h2 = slide.querySelector(".content-container h2");
        if (h2 && !h2.dataset.wrapped) {
          const text = h2.textContent;
          h2.innerHTML = "";
          text.split("").forEach((char, index) => {
            const span = document.createElement("span");
            span.textContent = char;
            span.style.transitionDelay = `${index * 0.05}s`;
            h2.appendChild(span);
          });
          h2.dataset.wrapped = "true";
        }
      });
    }

    function triggerH2Animation(slideElement) {
      const h2Spans = slideElement.querySelectorAll(
        ".content-container h2 span"
      );
      h2Spans.forEach((span) => {
        span.style.opacity = "1";
        span.style.transform = "translateY(0)";
      });
    }

    function updateSlider() {
      if (!images[currentSlide]) return;
      sliderContainer.style.backgroundImage = `url(${images[currentSlide]})`;

      slides.forEach((slide) => {
        slide.classList.remove("active");
        const h2Spans = slide.querySelectorAll(".content-container h2 span");
        h2Spans.forEach((span) => {
          span.style.opacity = "0";
          span.style.transform = "translateY(20px)";
          span.style.transitionDelay = "0s";
        });
      });

      const dots = dotsContainer.querySelectorAll(".dot");
      dots.forEach((dot) => dot.classList.remove("active"));

      slides[currentSlide].classList.add("active");
      if (dots[currentSlide]) dots[currentSlide].classList.add("active");

      setTimeout(() => {
        triggerH2Animation(slides[currentSlide]);
      }, 100);
    }

    function nextSlide() {
      currentSlide = (currentSlide + 1) % slides.length;
      updateSlider();
    }

    function prevSlide() {
      currentSlide = (currentSlide - 1 + slides.length) % slides.length;
      updateSlider();
    }

    function createDots() {
      images.forEach((_, index) => {
        const dot = document.createElement("span");
        dot.classList.add("dot");
        dot.addEventListener("click", () => {
          currentSlide = index;
          updateSlider();
        });
        dotsContainer.appendChild(dot);
      });
    }

    if (prevArrow) prevArrow.addEventListener("click", prevSlide);
    if (nextArrow) nextArrow.addEventListener("click", nextSlide);

    createDots();
    wrapLettersInSpans();
    updateSlider();

    let autoSlideInterval = setInterval(nextSlide, 5000);
    sliderContainer.addEventListener("mouseenter", () =>
      clearInterval(autoSlideInterval)
    );
    sliderContainer.addEventListener(
      "mouseleave",
      () => (autoSlideInterval = setInterval(nextSlide, 5000))
    );
  }

  /* ================== MOBİL MENÜ ACCORDION ================== */
  if (typeof $ !== "undefined" && $("#accordion").length) {
    var Accordion = function (el, multiple) {
      this.el = el || {};
      this.multiple = multiple || false;
      var links = this.el.find(".link");
      links.on(
        "click",
        { el: this.el, multiple: this.multiple },
        this.dropdown
      );
    };
    Accordion.prototype.dropdown = function (e) {
      var $el = e.data.el;
      var $this = $(this),
        $next = $this.next();
      $next.slideToggle();
      $this.parent().toggleClass("open");
      if (!e.data.multiple) {
        $el.find(".submenu").not($next).slideUp().parent().removeClass("open");
      }
    };
    new Accordion($("#accordion"), false);
  }

  /* ================== SCROLL BUTTON ================== */
  const scrollBtn = document.getElementById("scrollTopBtn");
  const whatsappBtn = document.querySelector(".whatsapp-button");

  if (scrollBtn && whatsappBtn) {
    window.addEventListener("scroll", () => {
      if (
        document.body.scrollTop > 100 ||
        document.documentElement.scrollTop > 100
      ) {
        scrollBtn.classList.add("active");
        whatsappBtn.classList.add("active");
      } else {
        scrollBtn.classList.remove("active");
        whatsappBtn.classList.remove("active");
      }
    });

    scrollBtn.addEventListener("click", () => {
      window.scrollTo({ top: 0, behavior: "smooth" });
    });
  }

  /* ================== PROJELER ================== */
  const items = document.querySelectorAll(".item");
  if (items.length > 0) {
    const animationDuration = 700;

    items.forEach((item) => {
      item.addEventListener("click", (e) => {
        document.querySelectorAll(".item-overlay").forEach((o) => {
          if (o !== item.querySelector(".item-overlay")) {
            o.style.transition = "";
            o.style.opacity = 0;
            o.style.transform = "translateY(20px) scale(0.95)";
            o.style.pointerEvents = "none";
          }
        });

        const overlay = item.querySelector(".item-overlay");
        if (overlay.style.opacity === "1") {
          overlay.style.transition = "opacity 0.3s ease, transform 0.3s ease";
          overlay.style.opacity = 0;
          overlay.style.transform = "translateY(20px) scale(0.95)";
          overlay.style.pointerEvents = "none";
        } else {
          setTimeout(() => {
            overlay.style.transition = "opacity 0.5s ease, transform 0.5s ease";
            overlay.style.opacity = 1;
            overlay.style.transform = "translateY(0) scale(1)";
            overlay.style.pointerEvents = "auto";
          }, animationDuration);
        }

        e.stopPropagation();
      });
    });

    document.addEventListener("click", () => {
      document.querySelectorAll(".item-overlay").forEach((overlay) => {
        overlay.style.transition = "opacity 0.3s ease, transform 0.3s ease";
        overlay.style.opacity = 0;
        overlay.style.transform = "translateY(20px) scale(0.95)";
        overlay.style.pointerEvents = "none";
      });
    });
  }

  /* ================== HABERLER ================== */
  const articles = document.querySelectorAll("article");
  const popup = document.getElementById("popup");
  const overlay = document.getElementById("overlay");
  const popupContent = document.getElementById("popup-content");

  if (articles.length > 0 && popup && overlay && popupContent) {
    articles.forEach((article) => {
      article.addEventListener("click", (event) => {
        let blockquote = article.querySelector("blockquote[data-url]");
        if (blockquote) {
          window.open(blockquote.getAttribute("data-url"), "_blank");
          return;
        }

        let rect = article.getBoundingClientRect();
        let x = event.clientX - rect.left;
        let y = event.clientY - rect.top;

        let figcaption = article.querySelector("figcaption span:first-child");
        let figcaptionText = figcaption ? figcaption.textContent : "";
        let dateAndTimeText =
          article.querySelector(".date-and-time")?.textContent.trim() || "";
        let authorText =
          article
            .querySelector("figcaption span:last-child")
            ?.textContent.trim() || "";

        let img = article.querySelector("img");
        let imgSrc = img ? img.getAttribute("src") : "";
        let imgElement = imgSrc
          ? `<img src="${imgSrc}" alt="Popup Image">`
          : "";

        popupContent.innerHTML = `
          ${imgElement}
          <div>${figcaptionText}</div>
          <div class="flex"><div class="dt-popup">${dateAndTimeText}</div><div>${authorText}</div></div>
          <p>Lorem ipsum dolor sit amet...</p>
        `;

        popup.style.top = rect.top + y + "px";
        popup.style.left = rect.left + x + "px";
        overlay.style.display = "block";
        popup.style.display = "block";

        setTimeout(() => {
          popup.style.top = "50%";
          popup.style.left = "50%";
        }, 10);
      });
    });

    overlay.addEventListener("click", () => {
      popup.style.display = "none";
      overlay.style.display = "none";
    });

    const closeBtn = document.getElementById("close-btn");
    if (closeBtn) {
      closeBtn.addEventListener("click", () => {
        popup.style.display = "none";
        overlay.style.display = "none";
      });
    }
  }

  /* ================== PROJELER TOGGLE ================== */
  const toggleBtn = document.querySelector(".toggle-btn");
  const title = document.querySelector(".title");
  const devam = document.querySelector(".devam-projeler");
  const tamam = document.querySelector(".tamamlanan-projeler");

  if (toggleBtn && title && devam && tamam) {
    let showingDevam = true;

    toggleBtn.addEventListener("click", () => {
      if (showingDevam) {
        devam.classList.remove("aktif");
        title.textContent = "Tamamlanan Projelerimiz";
        setTimeout(() => tamam.classList.add("aktif"), 50);
      } else {
        tamam.classList.remove("aktif");
        title.textContent = "Devam Eden Projelerimiz";
        setTimeout(() => devam.classList.add("aktif"), 50);
      }
      showingDevam = !showingDevam;
    });
  }
});
