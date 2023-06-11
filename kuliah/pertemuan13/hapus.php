<?php 
require 'functions.php';
// jika tidak ada id url
if(!isset($_GET['id'])){
  header("Location: index.php");
  exit;
}
// mengambil id dari functions dari url
$id = $_GET['id'];
// jika kita memiliki fungsi hapus dan angka idnya lebih dari 0 jalankan maka kita jalankan echo dan dipindahkan ke halaman index
    if (delete($id) > 0) {
      echo "<script>
              alert('data berhasil dihapus');
              document.location.href = 'index.php';
           </script>";
    } else {
      echo "data gagal ditambahkan!";
    }
  


?>