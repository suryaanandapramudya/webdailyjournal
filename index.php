<?php
//menyertakan file koneksi.php
include "koneksi.php"

?>

<!DOCTYPE html>
<html lang="en" data-theme="light">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>My Daily Journal</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"
    />
    <link rel="icon" href="img/logo.png" />
    <style>
      .accordion-button:not(.collapsed) {
        background-color: #da6a73;
        color: white;
      }

      [data-theme='dark'] body {
        background-color: #212529 !important;
        color: white !important;
      }

      [data-theme='dark'] #hero,
      [data-theme='dark'] #gallery,
      [data-theme='dark'] .card,
      [data-theme='dark'] .card-body {
        background-color: #6b757d !important;
        color: white !important;
        border-color: #5a646b !important;
      }
    </style>
  </head>

  <body>
    <!-- NAVBAR START -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
      <div class="container">
        <a class="navbar-brand" href="#">My Daily Journal</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-dark">
            <li class="nav-item">
              <a class="nav-link" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#article">Article</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="gallery.php">Gallery</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="login.php" target="_blank">Login</a>
            </li>
            <li class="nav-item">
              <button id="darkBtn" class="btn btn-dark">
                <i class="bi bi-moon-stars-fill"></i>
              </button>
            </li>
            <li class="nav-item">
              <button id="lightBtn" class="btn btn-danger">
                <i class="bi bi-brightness-high"></i>
              </button>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- NAVBAR END -->
    <!-- HERO START -->
    <section id="hero" class="text-center bg-danger-subtle p-5 text-sm-start">
      <div class="container">
        <div class="d-sm-flex flex-sm-row-reverse align-items-center">
          <img src="img/banner.jpg" class="img-fluid" width="300" />
          <div>
            <h1 class="fw-bold display-4">
              Create Memories, Save Memories, Everyday
            </h1>
            <h4 class="lead display-6">
              Mencatat semua kegiatan sehari-hari yang ada tanpa terkecuali
            </h4>
            <h6>
              <span id="tanggal"></span>

              <span id="jam"></span>
            </h6>
          </div>
        </div>
      </div>
    </section>
    <!-- HERO END -->
    <!-- ARTICLE START -->
    <section id="article" class="text-center p-5">
      <div class="container">
        <h1 class="fw-bold display-4 pb-3">Article</h1>
        <div class="row row-cols-1 row-cols-md-4 g-4 justify-content-center">
        
        <?php
        $sql = "SELECT * FROM article ORDER BY tanggal DESC";
        $hasil = $conn->query($sql); 

        while ($row = $hasil->fetch_assoc()) {
        ?>
          <!-- col begin -->
          <div class="col">
            <div class="card h-100">
              <img src="img/<?=  $row['gambar'] ?>" class="card-img-top" alt="..." />
              <div class="card-body">
                <h5 class="card-title"><?= $row['judul'] ?></h5>
                <p class="card-text">
                  <?= $row['isi'] ?>
                </p>
              </div>
              <div class="card-footer">
                <small class="text-body-secondary">
                  <?= $row['tanggal'] ?>
                </small>
              </div>
            </div>
          </div>
          <!-- col end -->
          <?php 
        }
          ?>
        </div>
      </div>
    </section>
    <!-- ARTICLE END -->
    <!-- GALLERY START -->
    <section id="gallery" class="bg-danger-subtle text-center p-5">
      <div class="container">
        <h1 class="fw-bold display-4 pb-3">Gallery</h1>
        <div id="carouselExample" class="carousel slide">
          <div class="carousel-inner">
            <?php
            $sql_gallery = "SELECT * FROM gallery ORDER BY tanggal DESC";
            $hasil_gallery = $conn->query($sql_gallery);
            $is_active = true;

            while ($row_gallery = $hasil_gallery->fetch_assoc()) {
                $active_class = $is_active ? 'active' : '';
                $is_active = false;
            ?>
              <div class="carousel-item <?= $active_class ?>">
                <img src="img/<?= $row_gallery['gambar'] ?>" class="d-block w-100" alt="<?= $row_gallery['judul'] ?>" />
              </div>
            <?php
            }
            ?>

          </div>
          <button
            class="carousel-control-prev"
            type="button"
            data-bs-target="#carouselExample"
            data-bs-slide="prev"
          >
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button
            class="carousel-control-next"
            type="button"
            data-bs-target="#carouselExample"
            data-bs-slide="next"
          >
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
    </section>
    <!-- GALLERY END -->
     <section id="schedule" class="text-center p-5">
    <div class="container">
      <h1 class="fw-bold display-4 pb-3">schedule</h1>
      <div class="row row-cols-1 row-cols-md-4 g-4 justify-content-center">
        <div class="col">
          <div class="card h-100">
            <div class="card-header bg-danger text-white">SENIN</div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">
                Etika Profesi<br>16.20-18.00 | H.4.4
              </li>
              <li class="list-group-item">
                Sistem Operasi<br>18.30-21.00 | H.4.8
              </li>
            </ul>
          </div>
        </div>
        <div class="col">
          <div class="card h-100">
            <div class="card-header bg-danger text-white">SELASA</div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">
                Pendidikan Kewarganegaraan<br>12.30-13.10 | Kulino
              </li>
              <li class="list-group-item">
                Probabilitas dan Statistik<br>15.30-18.00 | H.4.9
              </li>
              <li class="list-group-item">
                Kecerdasan Buatan<br>18.30-21.00 | H.4.11
              </li>
            </ul>
          </div>
        </div>
        <div class="col">
          <div class="card h-100">
            <div class="card-header bg-danger text-white">RABU</div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">
                Manajemen Proyek Teknologi Informasi<br>15.30-18.00 | H.4.6
              </li>
            </ul>
          </div>
        </div>
        <div class="col">
          <div class="card h-100">
            <div class="card-header bg-danger text-white">KAMIS</div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">
                Bahasa Indonesia<br>12.30-14.10 | Kulino
              </li>
              <li class="list-group-item">
                Pendidikan Agama Islam<br>16.20-18.00 | Kulino
              </li>
              <li class="list-group-item">
                Penambangan Data<br>18.30-21.00 | H.4.9
              </li>
            </ul>
          </div>
        </div>
        <div class="col">
          <div class="card h-100">
            <div class="card-header bg-danger text-white">JUMAT</div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">
                Pemrograman Web Lanjut<br>10.20-12.00 | D.2.K
              </li>
            </ul>
          </div>
        </div>
        <div class="col">
          <div class="card h-100">
            <div class="card-header bg-danger text-white">SABTU</div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">FREE</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
    <!-- FOOTER START -->
    <footer class="text-center p-5">
      <div>
        <i class="h2 bi bi-instagram p-2"></i>
        <i class="h2 bi bi-twitter p-2"></i>
        <i class="h2 bi bi-whatsapp p-2"></i>
      </div>
      <div>
        <p>Aprilyani Nur Safitri &copy; 2023</p>
      </div>
    </footer>
    <!-- FOOTER END -->
    <!-- Tombol Back to Top -->
    <button
      id="backToTop"
      class="btn btn-danger rounded-circle position-fixed bottom-0 end-0 m-3 d-none"
    >
      <i class="bi bi-arrow-up" title="Back to Top"></i>
    </button>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"
    ></script>
    <script type="text/javascript">
      function tampiWaktu() {
        const waktu = new Date()
        const tanggal = waktu.getDate()
        const bulan = waktu.getMonth()
        const tahun = waktu.getFullYear()
        const jam = waktu.getHours()
        const menit = waktu.getMinutes()
        const detik = waktu.getSeconds()

        const arrBulan = [
          '1',
          '2',
          '3',
          '4',
          '5',
          '6',
          '7',
          '8',
          '9',
          '10',
          '11',
          '12',
        ]

        const tanggal_full = tanggal + '/' + arrBulan[bulan] + '/' + tahun
        const jam_full = jam + ':' + menit + ':' + detik

        document.getElementById('tanggal').innerHTML = tanggal_full
        document.getElementById('jam').innerHTML = jam_full
      }
      setInterval(tampiWaktu, 1000)

      // back to top function
      window.addEventListener('scroll', function () {
        if (window.scrollY > 300) {
          backToTop.classList.remove('d-none')
          backToTop.classList.add('d-block')
        } else {
          backToTop.classList.remove('d-block')
          backToTop.classList.add('d-none')
        }
      })

      const backToTop = document.getElementById('backToTop')

      backToTop.addEventListener('click', function () {
        window.scrollTo({ top: 0, behavior: 'smooth' })
      })

      const darkBtn = document.getElementById('darkBtn')
      const lightBtn = document.getElementById('lightBtn')

      darkBtn.addEventListener('click', function () {
        document.documentElement.setAttribute('data-theme', 'dark')
      })

      lightBtn.addEventListener('click', function () {
        document.documentElement.setAttribute('data-theme', 'light')
      })
    </script>
  </body>
</html>
