// Common JS for all pages
document.addEventListener("DOMContentLoaded", () => {
  /** -------------------------
   * Load Navbar + Header
   * ------------------------- */
  const headerEl = document.getElementById("header-placeholder");

  if (headerEl) {
    // Current file name
    const currentPage = window.location.pathname.split("/").pop();

    // Pages that should use form-header.html
    const formPages = [
      "site_engineer.html",
      "add_contractor.html",
      "add_product.html",   // ✅ fixed name
      "add_supplier.html",  // ✅ fixed name
      "forms.html"
    ];

    const headerFile = formPages.includes(currentPage)
      ? "form-header.html"
      : "header.html";

    fetch(headerFile)
      .then(res => res.text())
      .then(data => {
        headerEl.innerHTML = data;

        /** -------------------------
         * Highlight active link
         * ------------------------- */
        document.querySelectorAll(".nav-item").forEach(link => {
          if (link.getAttribute("href") === currentPage) {
            link.classList.add("active");
          } else {
            link.classList.remove("active");
          }
        });

        /** -------------------------
         * Date Picker in Header
         * ------------------------- */
        const datePicker = document.getElementById("datePicker");
        const dateBadge = document.getElementById("dateBadge");

        if (datePicker && dateBadge) {
          const options = { day: "2-digit", month: "short", year: "numeric" };

          // ✅ Default: show "Choose Date" until user selects
          dateBadge.textContent = "📅 Choose Date";

          // Open picker when badge clicked
          dateBadge.addEventListener("click", () => {
            datePicker.showPicker ? datePicker.showPicker() : datePicker.click();
          });

          // Update badge when date changes
          datePicker.addEventListener("change", () => {
            const selectedDate = new Date(datePicker.value);
            if (!isNaN(selectedDate)) {
              dateBadge.textContent = selectedDate.toLocaleDateString("en-GB", options);
            }
          });
        }
      })
      .catch(err => console.error("Navbar load error:", err));
  }

  /** -------------------------
   * Generic Form Success Message
   * ------------------------- */
  document.querySelectorAll("form").forEach(form => {
    const successMsg = form.querySelector(".success-message");

    if (successMsg) {
      form.addEventListener("submit", (e) => {
        e.preventDefault();

        successMsg.classList.remove("d-none");

        setTimeout(() => {
          successMsg.classList.add("d-none");
        }, 3000);

        form.reset();
      });
    }
  });

  /** -------------------------
   * Toast (for Issue Form only)
   * ------------------------- */
  const issueForm = document.getElementById("issueForm");
  const issueToastEl = document.getElementById("issueToast");

  if (issueForm && issueToastEl) {
    issueForm.addEventListener("submit", (e) => {
      e.preventDefault();

      const toast = new bootstrap.Toast(issueToastEl);
      toast.show();

      issueForm.reset();
    });
  }

  /** -------------------------
   * Bootstrap Form Validation
   * ------------------------- */
  (() => {
    'use strict';
    const forms = document.querySelectorAll('.needs-validation');
    forms.forEach(form => {
      form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  })();
});
