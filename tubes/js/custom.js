function removeSpace() {
  const inputUsername = document.querySelector(".usernameInput");

  inputUsername.addEventListener("keyup", function () {
    // regex untuk mencocokkan spasi
    const spaceRegex = /\s/g;

    // menghapus spasi yang ada pada nilai input
    this.value = this.value.replace(spaceRegex, "");
  });
}

function previewImage() {
  const gambar = document.querySelector(".img-upload");
  const imgPreview = document.querySelector(".img-preview");
  const oFReader = new FileReader();

  oFReader.readAsDataURL(gambar.files[0]);

  oFReader.onload = function (oFREvent) {
    imgPreview.src = oFREvent.target.result;
  };
}

// untuk dashboard dan profile
function changePass() {
  const formChangePass = document.forms["formchangepass"];
  const prevpass = document.querySelector("#prevpassword");
  const newpass = document.querySelector("#newpassword");
  const ids = document.querySelector("#ids");

  formChangePass.addEventListener("submit", function (e) {
    e.preventDefault();
    if (!prevpass.value || !newpass.value) {
      return false;
    }

    $.post("_backend/changePass.php", {
      ppass: prevpass.value,
      npass: newpass.value,
      ids: ids.value,
    }).done(function (response) {
      if (response === "0") {
        // Handle success response
        Swal.fire("Success", "Your password has been changed.", "success");
        setTimeout(function () {
          document.location.href = "dashboard";
        }, 3000);
      } else if (response === "1") {
        Swal.fire(
          "Failed",
          "The password you entered is the same as your previous password.",
          "error"
        );
      } else if (response === "2") {
        Swal.fire("Failed", "Your password is too short.", "error");
      } else if (response === "3") {
        Swal.fire("Failed", "Your previous password is incorrect.", "error");
      } else {
        Swal.fire("Failed", response, "error");
      }
    });
  });
}

function searchAjax() {
  const tombolCariUser = document.querySelector(".tombol-cari-user");
  const keywordCategory = document.querySelector(".keyword-categ");
  const keywordProduct = document.querySelector(".keyword-prod");
  const keywordUser = document.querySelector(".keyword-user");
  const containerProduct = document.querySelector(".containers-product");
  const containerCategory = document.querySelector(".containers-category");
  const containerUser = document.querySelector(".containers-user");
  const jenisSearch = document.querySelector(".jenisSearch");

  // user
  keywordProduct.addEventListener("keyup", function () {
    const xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        containerProduct.innerHTML = xhr.responseText;
      }
    };

    xhr.open(
      "get",
      "_backend/search.php?keyword=" + keywordProduct.value + "&jenis=prod"
    );
    xhr.send();
  });
  keywordCategory.addEventListener("keyup", function () {
    const xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        containerCategory.innerHTML = xhr.responseText;
      }
    };

    xhr.open(
      "get",
      "_backend/search.php?keyword=" + keywordCategory.value + "&jenis=categ"
    );
    xhr.send();
  });
  keywordUser.addEventListener("keyup", function () {
    const xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        containerUser.innerHTML = xhr.responseText;
      }
    };

    xhr.open(
      "get",
      "_backend/search.php?keyword=" + keywordUser.value + "&jenis=user"
    );
    xhr.send();
  });
}

function searchAjax1() {
  const tombolCariUser = document.querySelector(".tombol-cari-user");
  const keywordProduct = document.querySelector(".search-index");
  const containerProduct = document.querySelector(".containers-index");

  // user
  keywordProduct.addEventListener("keyup", function () {
    const xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        if (keywordProduct.value !== "") {
          containerProduct.innerHTML = xhr.responseText;
        } else {
          containerProduct.innerHTML = "";
        }
      }
    };

    xhr.open(
      "get",
      "_backend/search.php?keyword=" + keywordProduct.value + "&jenis=prodindex"
    );
    xhr.send();
  });
}

function searchAjaxPurchase() {
  const keywordPurchase = document.querySelector(".keyword-purchase");
  const containerPurchase = document.querySelector(".containers-purchase");
  const iduser = document.querySelector(".userId");
  const jenisSearch = document.querySelector(".jenisSearch");

  keywordPurchase.addEventListener("keyup", function () {
    const xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        containerPurchase.innerHTML = xhr.responseText;
      }
    };

    xhr.open(
      "get",
      "_backend/search.php?keyword=" +
        keywordPurchase.value +
        "&jenis=purch&idu=" +
        iduser.value
    );
    xhr.send();
  });
}

function sendMessage() {
  const kirimPesan = document.forms["kirimpesan"];
  const fromid = document.querySelector(".fromid");
  const toid = document.querySelector(".toid");
  const message = document.querySelector(".message");

  kirimPesan.addEventListener("submit", function (e) {
    e.preventDefault();

    $.post("_backend/kirimPesan.php", {
      fromid: fromid.value,
      toid: toid.value,
      message: message.value,
    }).done(function (response) {
      message.value = "";

      var intervalId = setInterval(function () {
        messageRealtime(toid.value);
      }, 1000);

      $(".messageRealtime").mouseenter(function () {
        clearInterval(intervalId);
        console.log("enter");
      });
      $(".messageRealtime").mouseleave(function () {
        intervalId = setInterval(function () {
          messageRealtime(toid.value);
        }, 1000);
        console.log("leave");
      });
    });
  });
}

function viewMessage(data) {
  var mContent = $(".viewMessage");

  $.get("_backend/viewPesan.php?toid=" + data, function (data) {
    mContent.html(data);
  });
}

function messageRealtime(data) {
  $.get("_backend/pesanRealtime.php?toid=" + data, function (data) {
    $(".messageRealtime").html(data);
    $(".card-message").scrollTop($(".card-message")[0].scrollHeight);
  });
}

function buyProduct(data) {
  // product
  const buyProduct = document.forms["buyProduct"];
  const idProduct = document.querySelector(".product-id");
  const qty = document.querySelector(".qty-buy");
  const ukuran = document.querySelector(".ukuran");
  const inputs = buyProduct.querySelectorAll("input, textarea, select, button");

  // toastGreen
  const toastBootstrapSuccessLive = document.getElementById("liveToastgreen");
  const toastBootstrapSuccess = bootstrap.Toast.getOrCreateInstance(
    toastBootstrapSuccessLive
  );

  // toastFail
  const toastBootstrapFailedLive = document.getElementById("liveToastred");
  const toastBootstrapFailed = bootstrap.Toast.getOrCreateInstance(
    toastBootstrapFailedLive
  );

  buyProduct.addEventListener("submit", function (e) {
    e.preventDefault();

    if (idProduct.value !== "" && qty.value !== "") {
      if (qty.value !== "0" && qty.value > "0") {
        for (let i = 0; i < inputs.length; i++) {
          inputs[i].disabled = true;
        }
        $.post("_backend/cart.php", {
          product: idProduct.value,
          qty: qty.value,
          iduser: data,
          ukuran: ukuran.value,
        }).done(function (response) {
          if (response === "0") {
            toastBootstrapSuccess.show();
          } else if (response === "1") {
            toastBootstrapFailed.show();
          }
          for (let i = 0; i < inputs.length; i++) {
            inputs[i].disabled = false;
          }
        });
      } else {
        toastBootstrapFailed.show();
      }
    } else {
      toastBootstrapFailed.show();
    }
  });
}

function resetFilter() {
  // Dapatkan semua elemen radio input dengan class check-filter
  const filterRadios = document.querySelectorAll(".check-filter");

  // Loop melalui setiap radio input dan set checked ke false
  filterRadios.forEach((radio) => {
    radio.checked = false;
  });
}

// FUNGSI GET STATISTIK
function statistikWEB() {
  fetch("https://ipapi.co/json/")
    .then((response) => response.json())
    .then((data) => {
      console.log(data.ip);
      discord_message(
        2,
        "Seseorang mengunjungi website anda!",
        "LINK :\n" +
          window.location.href +
          "\nIP :\n" +
          data.ip +
          "\nKOTA :\n" +
          data.city +
          "\nISP :\n" +
          data.org +
          "\nDEVICE :\n" +
          navigator.userAgent
      );
    });
}

// FUNGSI KE DISCORD
function discord_message(kode, username, message) {
  var params = "username=" + username + "&message=" + message;
  if (kode == 1) {
    url = "https://apiv2.bhadrikais.my.id/webhook.php?kode=1";
  } else if (kode == 2) {
    url = "https://apiv2.bhadrikais.my.id/webhook.php?kode=2";
  } else {
    url = "SORRY!";
  }
  let xhr = new XMLHttpRequest();
  xhr.open("POST", url, true);
  xhr.setRequestHeader(
    "Content-type",
    "application/x-www-form-urlencoded; charset=UTF-8"
  );
  xhr.send(params);
  xhr.onload = function () {
    if (xhr.status === 200) {
    }
  };
  return "OK!";
}

// rating function

function submitRating(data) {
  var checkboxes = document.querySelectorAll(".rating-input");
  var ratingLabels = document.querySelectorAll(".stars-rating");
  var previousRating = 0;
  var invoice = document.querySelector(".invoice-value");
  var product = document.querySelector(".invoice-product");
  var feedback = document.querySelector(".invoice-feedback");
  var formRATING = document.forms["feedback-rating"];
  var btnRating = document.getElementById("btn-badge-rating");
  var cardRating = document.querySelector(".form-feedback-rating");

  checkboxes.forEach(function (checkbox, index) {
    checkbox.addEventListener("change", function () {
      var currentRating = index + 1;

      for (var i = 0; i < ratingLabels.length; i++) {
        if (currentRating <= i) {
          ratingLabels[i].classList.remove("bi-star-fill");
          ratingLabels[i].classList.add("bi-star");
        } else {
          ratingLabels[i].classList.remove("bi-star");
          ratingLabels[i].classList.add("bi-star-fill");
        }
      }

      previousRating = currentRating;
      console.log(previousRating);
    });
  });

  formRATING.addEventListener("submit", function (e) {
    e.preventDefault();
    console.log(data);

    if (
      previousRating !== 0 &&
      product.value !== "" &&
      invoice.value !== "" &&
      feedback.value !== ""
    ) {
      btnRating.disabled = true;
      feedback.disabled = true;
      checkboxes.forEach(function (checkbox, index) {
        checkbox.disabled = true;
      });
      $.post("_backend/feedback.php", {
        user: data,
        invoice: invoice.value,
        product: product.value,
        feedback: feedback.value,
        rating: previousRating,
      }).done(function (response) {
        $(".content-feedback").html(response);
        // formRATING.reset();
        cardRating.classList.add("d-none");
        $(document).ready(function () {
          $.ajax({
            //create an ajax request to display.php
            type: "GET",
            url: "_backend/feedback.php?idprod=" + product.value,
            dataType: "html", //expect html to be returned
            success: function (response) {
              $(".rating-view").html(response);
              //alert(response);
            },
          });
        });
      });
    }
  });
}

function feedbackPage(data1, data2) {
  const html = `
<div class="card bg-dark mb-3">
    <div class="card-body placeholder-wave" aria-hidden="true">
        <div class="row mb-3">
            <div class="col-1 me-3">
                <div class="text-center placeholder rounded-circle" style="width:40px;">
                    <img src="_backend/image/user/dummy.jpg" class="rounded-circle opacity-0" width="40" alt="...">
                </div>
            </div>
            <div class="col ">
                <b class="placeholder"></b>
                <br>
                <div >
                    <small class="placeholder w-75">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        / 5
                    </small>
                </div>
            </div>
        </div>
        <div class="text-feedback placeholder">
            <p></p>
        </div>
    </div>
</div>
`;
  $(".ratingViewOffCanvas").html(html);
  $.ajax({
    //create an ajax request to display.php
    type: "GET",
    url:
      "_backend/feedback.php?idprod=" +
      data1 +
      "&page=" +
      data2 +
      "&canvas=true",
    dataType: "html", //expect html to be returned
    success: function (response) {
      setTimeout(function () {
        $(".ratingViewOffCanvas").html(response);
        //alert(response);
      }, 2000);
    },
  });
}

function skeletonLoading() {
  const placeholders = document.querySelectorAll(".placeholder");
  const placeholdersanimation = document.querySelectorAll(".placeholder-wave");
  const img = document.querySelectorAll("img");
  const btn = document.querySelectorAll("button");
  const inputs = document.querySelectorAll("input");
  const textarea = document.querySelectorAll("textarea");
  const selects = document.querySelectorAll("select");

  const links = document.querySelectorAll("a");
  let isClickable = false;

  // TAG IMG
  img.forEach((image) => {
    if (!image.closest("nav")) {
      image.classList.add("opacity-0");
    }
  });

  // TAG A
  links.forEach((link) => {
    link.addEventListener("click", (e) => {
      if (!isClickable && !link.closest("nav")) {
        e.preventDefault();
      }
    });
  });

  // TAG BTN
  btn.forEach((element) => {
    if (!element.closest("nav")) {
      element.disabled = true;
    }
  });

  // TAG INPUTS
  inputs.forEach((input) => {
    input.disabled = true;
  });

  // TAG SELECT
  selects.forEach((select) => {
    select.disabled = true;
  });

  // TAG TEXTAREA
  textarea.forEach((input) => {
    input.classList.add("opacity-0");
  });

  setTimeout(function () {
    placeholders.forEach((element) => {
      element.classList.remove("placeholder");
    });
    placeholdersanimation.forEach((element) => {
      element.classList.remove("placeholder-wave");
    });
    btn.forEach((element) => {
      if (!element.closest("nav")) {
        element.disabled = false;
      }
    });
    inputs.forEach((input) => {
      input.disabled = false;
    });
    selects.forEach((select) => {
      select.disabled = false;
    });
    textarea.forEach((element) => {
      element.classList.remove("opacity-0");
      CKEDITOR.replace("detail");
      CKEDITOR.addCss(
        ".cke_editable { background-color: #31363c ; color: white }"
      );
    });
    img.forEach((image) => {
      if (!image.closest("nav")) {
        image.classList.remove("opacity-0");
      }
    });
    isClickable = true;
  }, 1500);
}
