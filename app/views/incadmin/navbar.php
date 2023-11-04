<nav class="navbar navbar-expand-md navbar-dark bg-dark  mb-3">
    <div class="container">
        <a class="navbar-brand" href="<?= URLROOT ?>"><?php echo SITENAME; ?></a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="<?= URLROOT ?>admin/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= URLROOT ?>admin/rugs">Rugs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= URLROOT ?>admin/orders">Orders</a>
                </li>
                <?php if ($_SESSION['role'] == 'admin') { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= URLROOT ?>admin/settings">Settings</a>
                    </li>
                <?php } ?>
            </ul>
            <ul class="navbar-nav ms-auto">
                <?php if (isset($_SESSION['user_id'])) : ?> <li class="nav-item active">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Welcome <?= $_SESSION['user_name']; ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= URLROOT ?>users/logout">Logout</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= URLROOT ?>users/login">Login</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>