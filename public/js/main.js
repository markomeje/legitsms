(function () {
  //===== Prealoder

  window.onload = function () {
    window.setTimeout(fadeout, 500);
  };

  function fadeout() {
    document.querySelector(".preloader").style.opacity = "0";
    document.querySelector(".preloader").style.display = "none";
  }

  /*=====================================
    Sticky
    ======================================= */
  window.onscroll = function () {
    const headerNavbar = document.querySelector(".navbar-area");
    if (headerNavbar) {
      const logoText = document.querySelector(".logo-text");
      const sticky = headerNavbar.offsetTop;

      if (window.pageYOffset > sticky) {
        headerNavbar.classList.add("sticky");
        logoText.classList.add("text-dark");
        logoText.classList.remove("text-white");
      } else {
        headerNavbar.classList.remove("sticky");
        logoText.classList.remove("text-dark");
        logoText.classList.add("text-white");
      }
    }

    // show or hide the back-top-top button
    const backToTop = document.querySelector(".scroll-top");
    if(backToTop) {
      if ( document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
        backToTop.style.display = "flex";
      } else {
        backToTop.style.display = "none";
      }
    }
      
  };

  // for menu scroll
  const pageLink = document.querySelectorAll(".page-scroll");

  pageLink.forEach((elem) => {
    elem.addEventListener("click", (e) => {
      e.preventDefault();
      document.querySelector(elem.getAttribute("href")).scrollIntoView({
        behavior: "smooth",
        offsetTop: 1 - 60,
      });
    });
  });

  // section menu active
  function onScroll(event) {
    const sections = document.querySelectorAll(".page-scroll");
    const scrollPos =
      window.pageYOffset ||
      document.documentElement.scrollTop ||
      document.body.scrollTop;

    for (let i = 0; i < sections.length; i++) {
      const currLink = sections[i];
      const val = currLink.getAttribute("href");
      const refElement = document.querySelector(val);
      const scrollTopMinus = scrollPos + 73;
      if (refElement) {
        if (refElement.offsetTop <= scrollTopMinus && refElement.offsetTop + refElement.offsetHeight > scrollTopMinus) {
          document.querySelector(".page-scroll").classList.remove("active");
          currLink.classList.add("active");
        } else {
          currLink.classList.remove("active");
        }
      }
        
    }
  }

  window.document.addEventListener("scroll", onScroll);

  //===== close navbar-collapse when a  clicked
  let navbarToggler = document.querySelector(".navbar-toggler");
  const navbarCollapse = document.querySelector(".navbar-collapse");
  if (navbarToggler) {
    document.querySelectorAll(".page-scroll").forEach((e) =>
      e.addEventListener("click", () => {
        navbarToggler.classList.remove("active");
        if(navbarCollapse) navbarCollapse.classList.remove("show");
      })
    );
    navbarToggler.addEventListener("click", function () {
      navbarToggler.classList.toggle("active");
    });
  }
  // WOW active
  new WOW().init();
})();
