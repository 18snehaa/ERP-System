// Wait until page loads
document.addEventListener("DOMContentLoaded", () => {

  // ------------------- PURCHASE FORM -------------------
  const purchaseForm = document.getElementById("purchaseForm");
  const purchaseSuccess = document.getElementById("successMessage");

  if (purchaseForm) {
    purchaseForm.addEventListener("submit", function (event) {
      event.preventDefault();
      purchaseSuccess.classList.remove("d-none");
      purchaseForm.reset();

      // Hide after 3 sec
      setTimeout(() => purchaseSuccess.classList.add("d-none"), 3000);
    });
  }

  // ------------------- ISSUE FORM -------------------
  const issueForm = document.getElementById("issueForm");
  const issueSuccess = document.getElementById("issueSuccess");

  if (issueForm) {
    issueForm.addEventListener("submit", function (event) {
      event.preventDefault();
      issueSuccess.classList.remove("d-none");
      issueForm.reset();

      setTimeout(() => issueSuccess.classList.add("d-none"), 3000);
    });
  }

  // ------------------- RETURN FORM -------------------
  const returnForm = document.getElementById("returnForm");
  const returnSuccess = document.getElementById("returnSuccess");

  if (returnForm) {
    returnForm.addEventListener("submit", function (event) {
      event.preventDefault();
      returnSuccess.classList.remove("d-none");
      returnForm.reset();

      setTimeout(() => returnSuccess.classList.add("d-none"), 3000);
    });
  }

  // ------------------- CONSUMPTION FORM -------------------
  const consumptionForm = document.getElementById("consumptionForm");
  const consumptionSuccess = document.getElementById("consumptionSuccess");

  if (consumptionForm) {
    consumptionForm.addEventListener("submit", function (event) {
      event.preventDefault();
      consumptionSuccess.classList.remove("d-none");
      consumptionForm.reset();

      setTimeout(() => consumptionSuccess.classList.add("d-none"), 3000);
    });
  }

});
