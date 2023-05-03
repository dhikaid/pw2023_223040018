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
        });
      } else {
        toastBootstrapFailed.show();
      }
    } else {
      toastBootstrapFailed.show();
    }
  });
}
