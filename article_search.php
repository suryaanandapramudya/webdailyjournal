<?php
include "koneksi.php";

$keyword = $_POST['keyword'];

$sql = "SELECT * FROM article 
        WHERE judul LIKE ? OR isi LIKE ? OR tanggal LIKE ? OR username LIKE ?
        ORDER BY tanggal DESC";

$stmt = $conn->prepare($sql);
$search = "%" . $keyword . "%";
$stmt->bind_param("ssss", $search, $search, $search, $search);
$stmt->execute();

$hasil = $stmt->get_result();
                    $no    = 1;

                    while ($row = $hasil->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>

                            <td>
                                <strong><?= $row["judul"] ?></strong>
                                <br>pada : <?= $row["tanggal"] ?>
                                <br>oleh : <?= $row["username"] ?>
                            </td>

                            <td><?= $row["isi"] ?></td>

                            <td>
                                <?php
                                if ($row["gambar"] != '') {
                                    if (file_exists('img/' . $row["gambar"])) {
                                        echo '<img src="img/' . $row["gambar"] . '" class="img-fluid" alt="Gambar Artikel">';
                                    }
                                }
                                ?>
                            </td>

                            <td>
                                <a
                                    href="#"
                                    title="edit"
                                    class="badge rounded-pill text-bg-success"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalEdit<?= $row["id"] ?>"
                                >
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <a
                                    href="#"
                                    title="delete"
                                    class="badge rounded-pill text-bg-danger"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalHapus<?= $row["id"] ?>"
                                >
                                    <i class="bi bi-x-circle"></i>
                                </a>

                                <!-- Awal Modal Edit -->
                                <div
                                    class="modal fade"
                                    id="modalEdit<?= $row["id"] ?>"
                                    data-bs-backdrop="static"
                                    data-bs-keyboard="false"
                                    tabindex="-1"
                                >
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5">Edit Article</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <form method="post" enctype="multipart/form-data">
                                                <div class="modal-body">

                                                    <div class="mb-3">
                                                        <label class="form-label">Judul</label>
                                                        <input type="hidden" name="id" value="<?= $row["id"] ?>">
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            name="judul"
                                                            value="<?= $row["judul"] ?>"
                                                            required
                                                        >
                                                    </div>

                                                    <div class="mb-3">
                                                        <label>Isi</label>
                                                        <textarea
                                                            class="form-control"
                                                            name="isi"
                                                            required
                                                        ><?= $row["isi"] ?></textarea>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Ganti Gambar</label>
                                                        <input type="file" class="form-control" name="gambar">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Gambar Lama</label>
                                                        <?php
                                                        if ($row["gambar"] != '') {
                                                            if (file_exists('img/' . $row["gambar"])) {
                                                                echo '<br><img src="img/' . $row["gambar"] . '" class="img-fluid">';
                                                            }
                                                        }
                                                        ?>
                                                        <input type="hidden" name="gambar_lama" value="<?= $row["gambar"] ?>">
                                                    </div>

                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <input type="submit" name="simpan" value="simpan" class="btn btn-primary">
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                                <!-- Akhir Modal Edit -->

                                <!-- Awal Modal Hapus -->
                                <div
                                    class="modal fade"
                                    id="modalHapus<?= $row["id"] ?>"
                                    data-bs-backdrop="static"
                                    data-bs-keyboard="false"
                                    tabindex="-1"
                                >
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5">Konfirmasi Hapus Article</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <form method="post">
                                                <div class="modal-body">
                                                    <p>
                                                        Yakin akan menghapus artikel
                                                        "<strong><?= $row["judul"] ?></strong>"?
                                                    </p>
                                                    <input type="hidden" name="id" value="<?= $row["id"] ?>">
                                                    <input type="hidden" name="gambar" value="<?= $row["gambar"] ?>">
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <input type="submit" name="hapus" value="hapus" class="btn btn-primary">
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                                <!-- Akhir Modal Hapus -->
                            </td>
                        </tr>
                    <?php } ?>