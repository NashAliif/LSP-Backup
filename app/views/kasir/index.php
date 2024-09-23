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
        </div>

        <div class="d-flex flex-column">
            <table class="table">
                <thead>
                    <tr>
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
                                <button type="button" class="btn btn-primary"
                                    data-bs-toggle="modal"
                                    data-bs-target="#UpdateUserModal<?= $user['id']; ?>">
                                    Update
                                </button>
                                <a href="<?= BASEURL; ?>/user/delete/<?= $user['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>

                        <!-- Modal for Updating User -->
                        <div class="modal fade" id="UpdateUserModal<?= $user['id']; ?>" tabindex="-1" aria-labelledby="UpdateUserModalLabel<?= $user['id']; ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="UpdateUserModalLabel<?= $user['id']; ?>">Update User</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="<?= BASEURL; ?>/user/update" method="post">
                                            <div class="mb-3">
                                                <label for="Username" class="form-label">Username</label>
                                                <input type="text" class="form-control" id="Username" name="username" value="<?= htmlspecialchars($user['username']); ?>" />
                                            </div>
                                            <div class="mb-3">
                                                <label for="Role" class="form-label">Role</label>
                                                <select class="form-select" id="Role" name="role">
                                                    <?php
                                                    if ($user['role'] == 'admin') {
                                                        echo '<option value="admin" selected>Admin</option>';
                                                        echo '<option value="user">User</option>';
                                                    } else {
                                                        echo '<option value="admin">Admin</option>';
                                                        echo '<option value="user" selected>User</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="Password" class="form-label">Password</label>
                                                <input type="password" class="form-control" id="Password" name="password" placeholder="Enter new password" />
                                            </div>
                                            <div class="mb-3 d-none">
                                                <input type="id" class="form-control" id="Id" name="id" value="<?= htmlspecialchars($user['id']); ?>" />
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
                        <a class="page-link" href="<?= BASEURL; ?>/user/index/<?= max(1, $currentPage - 1); ?>">Previous</a>
                    </li>

                    <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                        <li class="page-item <?= $i == $currentPage ? 'active' : '' ?>">
                            <a class="page-link" href="<?= BASEURL; ?>/user/index/<?= $i; ?>"><?= $i; ?></a>
                        </li>
                    <?php endfor; ?>

                    <li class="page-item <?= $currentPage >= $totalPages ? 'disabled' : '' ?>">
                        <a class="page-link" href="<?= BASEURL; ?>/user/index/<?= min($currentPage + 1, $totalPages); ?>">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>