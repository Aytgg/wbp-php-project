<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WBP Project</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/b56d62460a.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-secondary">
        <!-- Container wrapper -->
        <div class="container-fluid">
            <!-- Toggle button -->
            <button data-mdb-collapse-init class="navbar-toggler" type="button"
                data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Collapsible wrapper -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Navbar brand -->
                <a class="navbar-brand mt-2 mt-lg-0" href="<?= $_ENV['BASE_PATH'] ?>">
                    <img src="data:image/jpeg;base64,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" height="15"
                        alt="MDB Logo" loading="lazy" />
                </a>
                <!-- Left links -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $_ENV['BASE_PATH'] ?>"> Ana Sayfa </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./users"> Üyeler </a>
                    </li>
                </ul>
                <!-- Left links -->
            </div>
            <!-- Collapsible wrapper -->

            <!-- Right elements -->
            <div class="d-flex align-items-center">
                
                <!-- Avatar -->
                <a href="/">
                    <img src="data:image/jpeg;base64,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"
                    class="rounded-circle" height="25" />
                </a>
                
                <!-- Icon -->
                <a class="text-reset me-3" href="./logout">
                    <label></label>
                    <i class="fas fa-sign-out"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
                    <li>
                        <a class="dropdown-item" href="#">My profile</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">Settings</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Right elements -->
        </div>
        <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->