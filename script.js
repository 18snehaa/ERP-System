// -------------------------
// Common JS for all pages
// -------------------------
document.addEventListener("DOMContentLoaded", () => {
  /** -------------------------
   * Navbar + Header
   * ------------------------- */
  const headerEl = document.getElementById("header-placeholder");
  if (headerEl) {
    const currentPage = window.location.pathname.split("/").pop();
    const headerFile = "header.html";

    fetch(headerFile)
      .then(res => res.text())
      .then(data => {
        headerEl.innerHTML = data;

        // Highlight active link
        document.querySelectorAll(".nav-item").forEach(link => {
          if (link.getAttribute("href") === currentPage) {
            link.classList.add("active");
          } else {
            link.classList.remove("active");
          }
        });
      })
      .catch(err => console.error("Navbar load error:", err));
  }

  /** -------------------------
   * Mobile Hamburger Menu
   * ------------------------- */
  const hamburgerBtn = document.getElementById("hamburgerBtn");
  const navLinks = document.getElementById("navLinks");
  if (hamburgerBtn && navLinks) {
    hamburgerBtn.addEventListener("click", () => {
      navLinks.classList.toggle("show");
    });
  }

  /** -------------------------
   * Unit Converter
   * ------------------------- */
  const converterForm = document.getElementById("converterForm");
  if (converterForm) {
    converterForm.addEventListener("submit", function (e) {
      e.preventDefault();
      const value = parseFloat(document.getElementById("value").value);
      const from = document.getElementById("fromUnit").value;
      const to = document.getElementById("toUnit").value;

      if (isNaN(value)) {
        document.getElementById("result").innerText =
          "⚠️ Please enter a valid number";
        return;
      }

      const units = {
        meter: 1,
        kilometer: 1000,
        feet: 0.3048,
        inch: 0.0254
      };
      const result = (value * units[from]) / units[to];
      document.getElementById("result").innerText =
        `${value} ${from} = ${result.toFixed(4)} ${to}`;
    });
  }

  /** -------------------------
   * Generic Form Success Message
   * ------------------------- */
  document.querySelectorAll("form").forEach(form => {
    const successMsg = form.querySelector(".success-message");
    if (successMsg) {
      form.addEventListener("submit", e => {
        e.preventDefault();
        successMsg.classList.remove("d-none");
        setTimeout(() => {
          successMsg.classList.add("d-none");
        }, 3000);
        form.reset();
      });
    }
  });

  /*-------------------------
  Dashboard Cards - Dynamic Data
  -------------------------*/
  const menuToggle = document.getElementById("menuToggle");
  const sidebar = document.getElementById("sidebar");
  if (menuToggle && sidebar) {
    menuToggle.addEventListener("click", () => {
      sidebar.classList.toggle("open");
    });
  }
   
   /** -------------------------
 * Login Page Password Toggle + Strength
 * ------------------------- */
const loginForm = document.getElementById("loginForm");
const loginPassword = document.getElementById("loginPassword");
const toggleLoginPassword = document.getElementById("toggleLoginPassword");
const loginStrength = document.getElementById("passwordStrength");

const strongRegex =
  /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@_$!%*?&])[A-Za-z\d@_$!%*?&]{8,}$/;

if (toggleLoginPassword && loginPassword) {
  // 👁️ Toggle visibility
  toggleLoginPassword.addEventListener("click", function () {
    const type = loginPassword.type === "password" ? "text" : "password";
    loginPassword.type = type;

    const icon = this.querySelector("i");
    if (icon) {
      icon.classList.toggle("fa-eye");
      icon.classList.toggle("fa-eye-slash");
    }
  });

  // Password strength indicator
  loginPassword.addEventListener("input", () => {
    if (!loginPassword.value) {
      if (loginStrength) loginStrength.textContent = "";
      return;
    }
    if (strongRegex.test(loginPassword.value)) {
      if (loginStrength) {
        loginStrength.textContent = "✅ Strong password";
        loginStrength.style.color = "green";
      }
    } else {
      if (loginStrength) {
        loginStrength.textContent =
          "⚠️ Use 8+ chars with upper, lower, number & symbol";
        loginStrength.style.color = "red";
      }
    }
  });

  // Prevent weak passwords on submit
  if (loginForm) {
    loginForm.addEventListener("submit", e => {
      if (!strongRegex.test(loginPassword.value)) {
        e.preventDefault();
        if (loginStrength) {
          loginStrength.textContent = "❌ Please enter a strong password!";
          loginStrength.style.color = "red";
        }
      }
    });
  }
}

  
  /** -------------------------
   * Report Page (generate_report.php)
   * ------------------------- */
  const reportForm = document.getElementById("reportForm");
  const reportResult = document.getElementById("reportResult");
  const reportTableBody = document.getElementById("reportTableBody");

  if (reportForm && reportTableBody && reportResult) {
    reportForm.addEventListener("submit", async e => {
      e.preventDefault();
      const formData = new FormData(reportForm);

      try {
        const response = await fetch("generate_report.php", {
          method: "POST",
          body: formData
        });

        let result;
        try {
          result = await response.json();
        } catch (jsonErr) {
          console.error("Invalid JSON:", await response.text());
          alert("Server returned invalid response. Check console.");
          return;
        }

        reportTableBody.innerHTML = "";

        if (result.status === "success" && result.data.length > 0) {
          result.data.forEach((row, index) => {
            reportTableBody.innerHTML += `
              <tr>
                <td>${index + 1}</td>
                <td>${row.details ?? "-"}</td>
                <td>${row.date ?? "-"}</td>
                <td>${row.qty ?? "-"}</td>
              </tr>`;
          });
        } else {
          reportTableBody.innerHTML =
            `<tr><td colspan="4" class="text-center">No records found</td></tr>`;
        }

        reportResult.classList.remove("d-none");
      } catch (error) {
        console.error(error);
        alert("Error fetching report. Check console.");
      }
    });
  }

  /** -------------------------
   * Issue Form Validation
   * ------------------------- */
  const issueForm = document.getElementById("issueForm");
  const customAlert = document.getElementById("customAlert");

  if (issueForm && customAlert) {
    issueForm.addEventListener("submit", e => {
      let valid = true;
      issueForm.querySelectorAll("[required]").forEach(input => {
        if (!input.value.trim()) valid = false;
      });

      if (!valid) {
        e.preventDefault();
        customAlert.classList.remove("d-none");
        customAlert.scrollIntoView({ behavior: "smooth" });
      } else {
        customAlert.classList.add("d-none");
      }
    });

    issueForm.querySelectorAll("[required]").forEach(input => {
      input.addEventListener("input", () => {
        customAlert.classList.add("d-none");
      });
    });
  }

  /** -------------------------
   * Datepicker
   * ------------------------- */
  document.addEventListener("DOMContentLoaded", () => {
 
  const dateInput = document.getElementById("pageDate");
  if (dateInput) {
    const today = new Date().toISOString().split("T")[0];
    dateInput.value = today;
  }

  // Print functionality
  const printBtn = document.getElementById("printBtn");
  if (printBtn) {
    printBtn.addEventListener("click", () => {
      window.print();
    });
  }
});

});
