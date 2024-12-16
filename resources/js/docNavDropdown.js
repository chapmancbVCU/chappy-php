/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
document.addEventListener("DOMContentLoaded", () => {
  const dropdowns = document.querySelectorAll(".dropdown-btn");

  dropdowns.forEach((dropdown) => {
    dropdown.addEventListener("click", function () {
      // Toggle the "active" class for the clicked dropdown button
      this.classList.toggle("active");

      // Find the next sibling element (assumes it's the dropdown content)
      const dropdownContent = this.nextElementSibling;

      if (dropdownContent) {
        dropdownContent.classList.toggle("show");
      }
    });
  });
});

