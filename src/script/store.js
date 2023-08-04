const productDescriptions = document.querySelectorAll(".card-text");
productDescriptions.forEach((description) => {
  description.addEventListener("click", function () {
    this.classList.toggle("expanded");
    const cardBody = this.closest(".card-body");
    cardBody.classList.toggle("ixpanded");
  });
});
