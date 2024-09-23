<div class="vw-100 vh-100 d-flex flex-column justify-content-center align-items-center gap-5">
    <a href="<?= BASEURL; ?>" class="fs-5">
        <i class="bi bi-arrow-left-circle"></i>
        <span>Back</span>
    </a>    

    <div class="w-fit border border-2 shadow d-flex flex-column justify-content-center align-items-center p-5 gap-3 rounded-3">
        <h1>Login</h1>
        <form action="<?= BASEURL; ?>/auth/login" method="post">
            <div class="mb-3">
                <label for="Username" class="form-label">Username</label>
                <input type="username" class="form-control" id="Username" name="username" style="width: 300px;" />
            </div>
            <div class="mb-3">
                <label for="Password" class="form-label">Password</label>
                <input type="password" class="form-control" id="Password" name="password" style="width: 300px;" />
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </div>
        </form>
    </div>

</div>