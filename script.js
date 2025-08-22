// script.js
document.addEventListener("DOMContentLoaded", () => {

  // ========== NAVBAR ACTIVE LINK ==========
  const navLinks = document.querySelectorAll(".nav-link");
  const currentPath = window.location.pathname.split("/").pop();

  navLinks.forEach(link => {
    if (link.getAttribute("href") === currentPath) {
      link.classList.add("active");
    }
  });

  // ========== REUSABLE MODERN DATE PICKER ==========
  function setupDatePicker(displayId, textId, inputId) {
    const dateDisplay = document.getElementById(displayId);
    const dateText = document.getElementById(textId);
    const dateInput = document.getElementById(inputId);

    if (dateDisplay && dateText && dateInput) {
      const today = new Date();
      dateText.textContent = today.toLocaleDateString("en-GB", {
        weekday: "short",
        day: "2-digit",
        month: "short",
        year: "numeric"
      });
      dateInput.valueAsDate = today;

      // Click badge → open picker
      dateDisplay.style.cursor = "pointer";
      dateDisplay.addEventListener("click", () => dateInput.showPicker());

      // Update badge when date chosen
      dateInput.addEventListener("change", () => {
        const selected = new Date(dateInput.value);
        if (!isNaN(selected)) {
          dateText.textContent = selected.toLocaleDateString("en-GB", {
            weekday: "short",
            day: "2-digit",
            month: "short",
            year: "numeric"
          });
        }
      });
    }
  }

  // Apply date picker setup for all main pages
  setupDatePicker("purchaseDateDisplay", "purchaseDateText", "purchaseDateInput");
  setupDatePicker("issueDateDisplay", "issueDateText", "issueDateInput");
  setupDatePicker("returnDateDisplay", "returnDateText", "returnDateInput");
  setupDatePicker("productsDateDisplay", "productsDateText", "productsDateInput");
  setupDatePicker("reportDateDisplay", "reportDateText", "reportDateInput");

  // ========== GENERIC FORM HANDLER ==========
  function setupForm(formId, successId) {
    const form = document.getElementById(formId);
    const successMsg = document.getElementById(successId);

    if (form && successMsg) {
      form.addEventListener("submit", (e) => {
        e.preventDefault();
        successMsg.classList.remove("d-none");
        form.reset();
      });
    }
  }

  setupForm("purchaseForm", "successMessage");
  setupForm("issueForm", "issueSuccess");
  setupForm("returnForm", "returnSuccess");
  setupForm("productsForm", "productsSuccess");

  // ========== INVENTORY PAGE ==========
  const inventoryTable = document.getElementById("inventoryTable");
  if (inventoryTable) {
    console.log("Inventory Page Loaded");
    inventoryTable.querySelectorAll("tr").forEach(row => {
      const qtyCell = row.querySelector(".qty");
      if (qtyCell && parseInt(qtyCell.textContent) < 5) {
        row.classList.add("low-stock");
      }
    });
  }

  // ========== REPORTS PAGE ==========
  const generateReportBtn = document.getElementById("generateReportBtn");
  if (generateReportBtn) {
    generateReportBtn.addEventListener("click", () => {
      alert("Report Generated!");
    });
  }

  // ========== PRINT FUNCTION ==========
  const printBtn = document.getElementById("printBtn");
  if (printBtn) {
    printBtn.addEventListener("click", () => {
      window.print();
    });
  }

});
