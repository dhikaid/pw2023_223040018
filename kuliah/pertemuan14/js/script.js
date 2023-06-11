const keyword = document.getElementById("keyword");
const searchContainer = document.getElementById("search-container");
const searchBtn = document.getElementById("search-button");

// // cara ku
// keyword.addEventListener("keyup", function () {
// });

searchBtn.style.display = "none";

// cara bapa
keyword.onkeyup = function () {
  fetch("ajax/search.php?keyword=" + keyword.value)
    .then((response) => response.text())
    .then((text) => (searchContainer.innerHTML = text));
};
