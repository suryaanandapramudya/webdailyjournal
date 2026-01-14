<?php
//query untuk mengambil data article
$sql1 = "SELECT * FROM article ORDER BY tanggal DESC";
$hasil1 = $conn->query($sql1);

//menghitung jumlah baris data article
$jumlah_article = $hasil1->num_rows;

//query untuk mengambil data gallery
$sql2 = "SELECT * FROM gallery ORDER BY tanggal DESC";
$hasil2 = $conn->query($sql2);

//menghitung jumlah baris data gallery
$jumlah_gallery = $hasil2->num_rows;

//query untuk mengambil data user yang sedang login
$sql3 = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql3);
$stmt->bind_param("s", $_SESSION['username']);
$stmt->execute();
$hasil3 = $stmt->get_result();
$user = $hasil3->fetch_assoc();
$stmt->close();
?>

<div class="container">
    <div class="d-flex flex-column align-items-center text-center mt-5">
        <h4>Selamat Datang,</h4>
        <h2 class="text-danger fw-bold mb-4">
            <?= htmlspecialchars($user['username']) ?>
        </h2>
        <div class="mb-3">
            <?php if (!empty($user['foto'])) { ?>
                <img src="img/<?= $user['foto'] ?>"
                     class="rounded-circle shadow"
                     style="width: 200px;height: 200px;object-fit:cover;">
            <?php } else { ?>
                <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center shadow"
                     style="width: 200px;height: 200px;">
                    <i class="bi bi-person-fill text-white fs-1"></i>
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-md-4 g-4 justify-content-center pt-4">
    <div class="col">
        <div class="card border border-danger mb-3 shadow" style="max-width: 18rem;">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="p-3">
                        <h5 class="card-title"><i class="bi bi-newspaper"></i> Article</h5> 
                    </div>
                    <div class="p-3">
                        <span class="badge rounded-pill text-bg-danger fs-2"><?php echo $jumlah_article; ?></span>
                    </div> 
                </div>
            </div>
        </div>
    </div> 
    <div class="col">
        <div class="card border border-danger mb-3 shadow" style="max-width: 18rem;">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="p-3">
                        <h5 class="card-title"><i class="bi bi-camera"></i> Gallery</h5>
                    </div>
                    <div class="p-3">
                        <span class="badge rounded-pill text-bg-danger fs-2"><?php echo $jumlah_gallery; ?></span>
                    </div> 
                </div>
            </div>
        </div>
    </div> 
</div>

</div>