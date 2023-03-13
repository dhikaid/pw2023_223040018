<?php
$mahasiswa = [
    [
        "nrp" => "223040018",
        "nama" => "Bhadrika Aryaputra Hermawan",
        "email" => "bhadrika.223040018@mail.unpas.ac.id",
        "jurusan" => "Teknik Informatika",
        "gambar" => "https://storage.googleapis.com/assets-edlink/p/thumb-705040234983518e26aec4852265e59878140e5d3dfc80fb13cf49157dd6e719-img-20220927-143935-5141519066088781035.jpg"
    ],
    [
        "nrp" => "223040155",
        "nama" => "Narapati Keysa Anandi",
        "email" => "narapati.2230400155@mail.unpas.ac.id",
        "jurusan" => "Teknik Informatika",
        "gambar" => "https://storage.googleapis.com/assets-edlink/p/thumb-cafe954742d93b3d882339023ca399240da58b4497ca672a8fadfe0baff67a5b-dsc-8633.png"
    ],
    [
        "nrp" => "223040029",
        "nama" => "Ahmad Mulia Huda",
        "email" => "ahmad.223040029@mail.unpas.ac.id",
        "jurusan" => "Teknik Informatika",
        "gambar" => "https://storage.googleapis.com/assets-edlink/p/thumb-8506ec65a9c98bb45a2341d24196a6e5945e931a98d36a2fc78cc53f5f31a056-ahmad-mulia-huda.jpeg"
    ],
    [
        "nrp" => "223040025",
        "nama" => "Daffaa Aprilino",
        "email" => "daffaa.223040025@mail.unpas.ac.id",
        "jurusan" => "Teknik Informatika",
        "gambar" => "https://storage.googleapis.com/assets-edlink/p/thumb-d63765a636ac53cf77cc21c2941ac9ee565fef1ea8ec52d4742b11432bd45c3d-img-20220928-130835-3985632523089886993.jpg"
    ],
    [
        "nrp" => "223040003",
        "nama" => "Ali Imran Rodja",
        "email" => "ali.223040003@mail.unpas.ac.id",
        "jurusan" => "Teknik Informatika",
        "gambar" => "https://storage.googleapis.com/assets-edlink/p/thumb-cdb4efa66df3e552ba302b5926570292ab0d683c4a91286a07f27f4f3adf99bd-img-6318-1.jpg"
    ],
    [
        "nrp" => "223040016",
        "nama" => "Davina Putri Kusuma",
        "email" => "davina.223040016@mail.unpas.ac.id",
        "jurusan" => "Teknik Informatika",
        "gambar" => "https://storage.googleapis.com/assets-edlink/p/thumb-ef6f00406f260e29c468eefbaa8ae7bc8ab7a63322a546915e05c4fbf5ebc3b4-img-20220927-143600-7757812424449762994.jpg"
    ],
    [
        "nrp" => "223040006",
        "nama" => "Gina Meirina",
        "email" => "gina.223040006@mail.unpas.ac.id",
        "jurusan" => "Teknik Informatika",
        "gambar" => "https://storage.googleapis.com/assets-edlink/p/thumb-a778c8d5ad33114131d652591b919899f4d26ac30719022639af9300871b5e75-fotoku.jpeg"
    ],
    [
        "nrp" => "223040013",
        "nama" => "Ilham Ramadhana Hartono",
        "email" => "ilham.223040013@mail.unpas.ac.id",
        "jurusan" => "Teknik Informatika",
        "gambar" => "https://storage.googleapis.com/assets-edlink/p/thumb-ef4e5b9694be5a6cfa95ba4d1fd3a1745670be8c5f1de87f9e753ccf2f2ef54a-764a3d43-2040-454f-82e7-a88fbcb87302.jpeg"
    ],
    [
        "nrp" => "223040009",
        "nama" => "Indri Tania Lestari",
        "email" => "indri.223040009@mail.unpas.ac.id",
        "jurusan" => "Teknik Informatika",
        "gambar" => "https://storage.googleapis.com/assets-edlink/p/thumb-c117e426e816e3e493cc2cdef93260b2861d54c91c0732c5908458c78aed69a3-img-20221020-090423-3522844684604256569.jpg"
    ],
    [
        "nrp" => "223040014",
        "nama" => "Muhamad Alfath Septian",
        "email" => "alfath.223040014@mail.unpas.ac.id",
        "jurusan" => "Teknik Informatika",
        "gambar" => "https://storage.googleapis.com/assets-edlink/p/thumb-d325b46340c66f1179d47be1bd8c10198d303d1ad7992b9813c70f45f69a3b70-img-20230205-131026-1163504815349143048.jpg"
    ],
]
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mahasiswa</title>
</head>

<body>

    <h1>Daftar Mahasiswa</h1>

    <?php foreach ($mahasiswa as $mhs) : ?>
        <ul>
            <li>
                <img src="<?= $mhs["gambar"]; ?>" alt="">
            </li>
            <li>Nama : <?= $mhs["nama"]; ?></li>
            <li>NRP : <?= $mhs["nrp"]; ?></li>
            <li>Jurusan : <?= $mhs["jurusan"]; ?></li>
            <li>Email : <?= $mhs["email"]; ?></li>
        </ul>

    <?php endforeach; ?>

</body>

</html>