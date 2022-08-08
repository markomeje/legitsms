(function () {
  /* ========= sidebar toggle ======== */
  
  const overlay = document.querySelector(".overlay");
  const menuToggleButton = document.querySelector("#menu-toggle");
  const sidebarNavWrapper = document.querySelector(".sidebar-nav-wrapper");
  const mainWrapper = document.querySelector(".main-wrapper");

  if (menuToggleButton) {
    const menuToggleButtonIcon = document.querySelector("#menu-toggle i");
    menuToggleButton.addEventListener("click", () => {
      sidebarNavWrapper.classList.toggle("active");
      overlay.classList.add("active");
      mainWrapper.classList.toggle("active");

      if (document.body.clientWidth > 1200) {
        if (menuToggleButtonIcon.classList.contains("lni-chevron-left")) {
          menuToggleButtonIcon.classList.remove("lni-chevron-left");
          menuToggleButtonIcon.classList.add("lni-menu");
        } else {
          menuToggleButtonIcon.classList.remove("lni-menu");
          menuToggleButtonIcon.classList.add("lni-chevron-left");
        }
      } else {
        if (menuToggleButtonIcon.classList.contains("lni-chevron-left")) {
          menuToggleButtonIcon.classList.remove("lni-chevron-left");
          menuToggleButtonIcon.classList.add("lni-menu");
        }
      }
    });
  }

  if (overlay) {
    overlay.addEventListener("click", () => {
      sidebarNavWrapper.classList.remove("active");
      overlay.classList.remove("active");
      mainWrapper.classList.remove("active");
    });
  }
    
})();
