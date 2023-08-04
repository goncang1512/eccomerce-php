// JavaScript

document.getElementById("image").addEventListener("change", function () {
  const previewImage = document.getElementById("previewImage");
  const fileInput = this.files[0];

  if (fileInput) {
    const reader = new FileReader();

    reader.addEventListener("load", function () {
      previousImageSrc = previewImage.src; // Simpan URL gambar sebelumnya sebelum diubah
      previewImage.src = reader.result;
    });

    reader.readAsDataURL(fileInput);
  }
});
