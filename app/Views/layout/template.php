<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>TransHub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/sticky-footer-navbar/">
    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- BOX ICONS CSS-->
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css" rel="stylesheet">
    
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="<?= base_url('css/style.css')?>" rel="stylesheet">
    <link href="<?= base_url('css/footer.css')?>" rel="stylesheet">
</head>
<body class="d-flex flex-column dashboard" id="body-pd">
    <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        <div class="header_username">
            <p><?= session()->get('Username') ?></p>
        </div>
    </div>
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div> 
                <p class="nav_logo"> <i class='bx bxs-data nav_logo-icon'></i> <span class="nav_logo-name">TransHub</span> </p>
                <div class="nav_list"> 
                    <a href="<?= base_url('/') ?>" class="nav_link"> <i class='bx bxs-dashboard nav_icon'></i> <span class="nav_name">Dashboard</span> </a> 
                    <a href="<?= base_url("/cars"); ?>" class="nav_link"> <i class='bx bxs-folder-plus nav_icon'></i></i> <span class="nav_name">Cars List</span> </a>     
                    <a href="<?= base_url("report"); ?>" class="nav_link"> <i class='bx bxs-envelope nav_icon'></i> <span class="nav_name">Report</span> </a>
                </div>
            </div>    
            <div>
                <a href="<?= base_url("Auth/logout"); ?>" class="nav_link"> <i class="bx bx-log-out nav_icon"></i> <span class="nav_name">Log Out</span> </a>      
            </div>
        </nav>
    </div>
    <!--Container Main start-->
    <div class="bg-light">
    <main role="main" class="flex-shrink-0">
        <?= $this->renderSection('content') ?>
    </main>
    </div>
</body>
<footer class="footer mt-auto py-3 shadow">
    <div class="container">
        <div class="container"><br>
            Made with <span style="color: #e25555;">&#9829;</span></div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://getbootstrap.com/docs/4.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/f1d526e100.js" crossorigin="anonymous"></script>
<script src="<?= base_url("js/custom.js")?>"></script>
</html>