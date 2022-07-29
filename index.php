<?php
    session_start();

    include_once("function/helper.php");
    include_once("function/koneksi.php");

    $page = isset($_GET['page']) ? $_GET['page'] : false;
    $kategori_id = isset($_GET['kategori_id']) ? $_GET['kategori_id'] : false;

    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;
    $nama = isset($_SESSION['nama']) ? $_SESSION['nama'] : false;
    $level = isset($_SESSION['level']) ? $_SESSION['level'] : false;
    $preview = isset($_SESSION['preview']) ? $_SESSION['preview'] : array();
    $totalBarang = count($preview);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulasi Rakit PC</title>
    <link rel="icon" href="<?php echo BASE_URL."images/favicon-32x32.png"; ?>" type="image/x-icon">
    <link href="<?php echo BASE_URL."css/style.css"; ?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo BASE_URL."vendor/fontawesome/css/all.min.css"; ?>" rel="stylesheet" />
    <script src="<?php echo BASE_URL."js/jquery-3.5.1.min.js"; ?>"></script>
    <script src="<?php echo BASE_URL."js/script.js"; ?>"></script>
</head>
<body>
    <header>
        <nav>
            <button class="btn_menu" onclick="openMenu()">
                <img src="<?php echo BASE_URL."images/menu.svg"; ?>" />
            </button>

            <a href="<?php echo BASE_URL."index.php"; ?>" id="logo">
                <img class="svg_logo" src="<?php echo BASE_URL."images/logo.svg"; ?>" />
                <img class="svg_logo_sub" src="<?php echo BASE_URL."images/logo_sub.svg"; ?>" />
                <img class="svg_fan" src="<?php echo BASE_URL."images/fan.svg"; ?>" />
            </a>
            

            <div id="nav_menu">
                <div id="nav_menu_user">
                    <?php
                        if($user_id) {
                            echo "
                                <a href='".BASE_URL."index.php?page=my_profile&module=simpan&action=list'>
                                    <i class='fa-solid fa-circle-user'></i>
                                </a>
                            ";
                        } else {
                            echo "<a class='btn_login' href='".BASE_URL."login.html'>
                                    <i class='fa-solid fa-right-to-bracket'></i>Login
                                </a>";
                        }
                    ?>
                </div>
                    
                <a href="<?php echo BASE_URL."preview.html"; ?>" id="button_preview">
                    <i class="fa-solid fa-file-circle-plus"></i>
                    <?php
                        if($totalBarang !== 0) {
                            echo "<span class='total_barang'>$totalBarang</span>";
                        }
                    ?>
                </a>
            </div>
        </nav>
    </header>
    <main>
        <div id="content">
            <?php
                $filename = "$page.php";
                
                if(file_exists($filename)) {
                    include_once($filename);
                } else {
                    include_once("main.php");
                }
            ?>
        </div>
    </main>
</body>
</html>