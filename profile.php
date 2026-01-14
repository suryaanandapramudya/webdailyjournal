<?php
include "upload_foto.php";
$username_session = $_SESSION['username'];

// Query data user
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username_session);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();
?>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <form method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" value="<?= $user['username'] ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Ganti Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Tuliskan Password Baru jika ingin mengganti Password saja">
                </div>
                <div class="mb-3">
                    <label class="form-label">Ganti Foto Profil</label>
                    <input type="file" class="form-control" name="foto">
                </div>
                <div class="mb-3">
                    <label class="form-label">Foto profil saat ini </label>
                    <?php if ($user['foto'] != '') { ?>
                        <br><img src="img/<?= $user['foto'] ?>" class="img-fluid" style="max-width: 150px;">
                    <?php } else { ?>
                    <?php } ?>
                </div>
                <button type="submit" name="update" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>

<?php
if (isset($_POST['update'])) {
    $new_password = $_POST['password'];
    $foto_lama = $user['foto'];
    $foto_baru = '';

    // Handle file upload
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $cek_upload = upload_foto($_FILES["foto"]);
        if ($cek_upload['status']) {
            $foto_baru = $cek_upload['message'];
            // Hapus foto lama jika ada
            if ($foto_lama != '' && file_exists("img/" . $foto_lama)) {
                unlink("img/" . $foto_lama);
            }
        } else {
            echo "<script>alert('{$cek_upload['message']}');</script>";
            $foto_baru = $foto_lama;
        }
    } else {
        $foto_baru = $foto_lama;
    }

    // Update database
    if ($new_password != '') {
        $hashed_password = md5($new_password);
        $sql_update = "UPDATE users SET password=?, foto=? WHERE username=?";
        $stmt = $conn->prepare($sql_update);
        $stmt->bind_param("sss", $hashed_password, $foto_baru, $username_session);
    } else {
        $sql_update = "UPDATE users SET foto=? WHERE username=?";
        $stmt = $conn->prepare($sql_update);
        $stmt->bind_param("ss", $foto_baru, $username_session);
    }

    if ($stmt->execute()) {
        echo "<script>alert('Profile updated successfully'); window.location='admin.php?page=profile';</script>";
    } else {
        echo "<script>alert('Failed to update profile');</script>";
    }
    $stmt->close();
}
?>