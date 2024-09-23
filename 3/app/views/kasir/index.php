<div id="content">
    <div class="p-5 gap-5">
        <h2 class="mb-5">Kasir</h2>

        <div class="col-6">
            <?php Flasher::flash(); ?>
        </div>

        <div>
            <form action="<?= BASEURL; ?>/kasir/index" method="post">
                <input type="text" name="keyword" class="form-control mb-3" placeholder="Search...">
            </form>
                                <button type="button" class="btn btn-primary"
                                    data-bs-toggle="modal"
                                    data-bs-target="#CreateKasirModal">
                                    Tambah Data
                                </button>
        </div>

        <div class="d-flex flex-column">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">ID Kasir</th>
                        <th scope="col">Username</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Nomor HP</th>
                        <th scope="col">Nomor KTP</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $totalData = count($data['kasir']);
                    $totalPages = ceil($totalData / 10);

                    $currentPage = 1;
                    if (isset($_GET['url'])) {
                        $url = rtrim($_GET['url'], '/');
                        $url = filter_var($url, FILTER_SANITIZE_URL);
                        $url = explode('/', $url);
                        $currentPage = isset($url[2]) ? (int) $url[2] : 1;
                    }

                    $startIndex = ($currentPage - 1) * 10;
                    $endIndex = min($startIndex + 10, $totalData);

                    $kasirToShow = array_slice($data['kasir'], $startIndex, 10);

                    $i = $startIndex + 1;
                    foreach ($kasirToShow as $kasir) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= htmlspecialchars($kasir['id_kasir']); ?></td>
                            <td><?= htmlspecialchars($kasir['username']); ?></td>
                            <td><?= htmlspecialchars($kasir['nama_kasir']); ?></td>
                            <td><?= htmlspecialchars($kasir['alamat']); ?></td>
                            <td><?= htmlspecialchars($kasir['nomor_hp']); ?></td>
                            <td><?= htmlspecialchars($kasir['nomor_ktp']); ?></td>
                            <td>
                                <button type="button" class="btn btn-warning"
                                    data-bs-toggle="modal"
                                    data-bs-target="#UpdateKasirModal<?= $kasir['id_kasir']; ?>">
                                    Update
                                </button>
                                <a href="<?= BASEURL; ?>/kasir/delete/<?= $kasir['id_kasir']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>

                        <div class="modal fade" id="UpdateKasirModal<?= $kasir['id_kasir']; ?>" tabindex="-1" aria-labelledby="UpdateUserModalLabel<?= $kasir['id_kasir']; ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="UpdateUserModalLabel<?= $kasir['id_kasir']; ?>">Update User</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="<?= BASEURL; ?>/kasir/update" method="post">
                                            <div class="mb-3">
                                                <label for="id_kasir" class="form-label">ID Kasir</label>
                                                <input type="number" class="form-control" id="id_kasir" name="id_kasir" value="<?= htmlspecialchars($kasir['id_kasir']); ?>" />
                                            </div>
                                            <div class="mb-3">
                                                <label for="Username" class="form-label">Username</label>
                                                <input type="text" class="form-control" id="Username" name="username" value="<?= htmlspecialchars($kasir['username']); ?>" />
                                            </div>
                                            <div class="mb-3">
                                                <label for="Password" class="form-label">Password</label>
                                                <input type="password" class="form-control" id="Password" name="password" placeholder="Enter new password" value="<?= htmlspecialchars($kasir['password']); ?>"/>
                                            </div>
                                            <div class="mb-3">
                                                <label for="nama_kasir" class="form-label">Nama Kasir</label>
                                                <input type="text" class="form-control" id="nama_kasir" name="nama_kasir" value="<?= htmlspecialchars($kasir['nama_kasir']); ?>" />
                                            </div>
                                            <div class="mb-3">
                                                <label for="alamat" class="form-label">Alamat</label>
                                                <input type="text" class="form-control" id="alamat" name="alamat" value="<?= htmlspecialchars($kasir['alamat']); ?>" />
                                            </div>
                                            <div class="mb-3">
                                                <label for="nomor_hp" class="form-label">Nomor HP</label>
                                                <input type="text" class="form-control" id="nomor_hp" name="nomor_hp" value="<?= htmlspecialchars($kasir['nomor_hp']); ?>" />
                                            </div>
                                            <div class="mb-3">
                                                <label for="nomor_ktp" class="form-label">Nomor KTP</label>
                                                <input type="text" class="form-control" id="nomor_ktp" name="nomor_ktp" value="<?= htmlspecialchars($kasir['nomor_ktp']); ?>" />
                                            </div>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </tbody>
            </table>

            <nav aria-label="...">
                <ul class="pagination">
                    <li class="page-item <?= $currentPage <= 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="<?= BASEURL; ?>/kasir/index/<?= max(1, $currentPage - 1); ?>">Previous</a>
                    </li>

                    <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                        <li class="page-item <?= $i == $currentPage ? 'active' : '' ?>">
                            <a class="page-link" href="<?= BASEURL; ?>/kasir/index/<?= $i; ?>"><?= $i; ?></a>
                        </li>
                    <?php endfor; ?>

                    <li class="page-item <?= $currentPage >= $totalPages ? 'disabled' : '' ?>">
                        <a class="page-link" href="<?= BASEURL; ?>/kasir/index/<?= min($currentPage + 1, $totalPages); ?>">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="modal fade" id="CreateKasirModal" tabindex="-1" aria-labelledby="CreateUserModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="CreateUserModalLabel">Create User</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="<?= BASEURL; ?>/kasir/create" method="post">
                                        <div class="mb-3">
                                                <label for="id_kasir" class="form-label">ID Kasir</label>
                                                <input type="number" class="form-control" id="id_kasir" name="id_kasir" />
                                            </div>
                                            <div class="mb-3">
                                                <label for="Username" class="form-label">Username</label>
                                                <input type="text" class="form-control" id="Username" name="username" />
                                            </div>
                                            <div class="mb-3">
                                                <label for="Password" class="form-label">Password</label>
                                                <input type="password" class="form-control" id="Password" name="password" placeholder="Enter new password" />
                                            </div>
                                            <div class="mb-3">
                                                <label for="nama_kasir" class="form-label">Nama Kasir</label>
                                                <input type="text" class="form-control" id="nama_kasir" name="nama_kasir" />
                                            </div>
                                            <div class="mb-3">
                                                <label for="alamat" class="form-label">Alamat</label>
                                                <input type="text" class="form-control" id="alamat" name="alamat" />
                                            </div>
                                            <div class="mb-3">
                                                <label for="nomor_hp" class="form-label">Nomor HP</label>
                                                <input type="text" class="form-control" id="nomor_hp" name="nomor_hp" />
                                            </div>
                                            <div class="mb-3">
                                                <label for="nomor_ktp" class="form-label">Nomor KTP</label>
                                                <input type="text" class="form-control" id="nomor_ktp" name="nomor_ktp"  />
                                            </div>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
</div>