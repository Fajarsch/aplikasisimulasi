<?php
    if($user_id) {
        $module = isset($_GET['module']) ? $_GET['module'] : false;
        $action = isset($_GET['action']) ? $_GET['action'] : false;
        $mode = isset($_GET['mode']) ? $_GET['mode'] : false;
    } else {
        header("location: ".BASE_URL."login.html");
    }

    if($level != "superadmin") {
        $admin_pages = array("kategori", "barang", "user");

        if(in_array($module, $admin_pages)) {
            header("location :".BASE_URL);
        }
    }
?>

<div id="bg_page_profile">
    <div class="submenu_profile" id="menu_profile">

        <?php
            if($level == "superadmin") {
        ?>
            <a <?php if($module == "kategori") { echo "class='menu_kategori active'"; } ?> href="<?php echo BASE_URL."index.php?page=my_profile&module=kategori&action=list"; ?>">Kategori</a>

            <a <?php if($module == "barang") { echo "class='active'"; } ?> href="<?php echo BASE_URL."index.php?page=my_profile&module=barang&action=list"; ?>">Barang</a>

            <a <?php if($module == "user") { echo "class='active'"; } ?> href="<?php echo BASE_URL."index.php?page=my_profile&module=user&action=list"; ?>">User</a>
        <?php
            }
        ?>
        
            <a <?php if($module == "profile") { echo "class='active'"; } ?> href="<?php echo BASE_URL."index.php?page=my_profile&module=profile&action=profil"; ?>">Profile</a>

            <a <?php if($module == "simpan") { echo "class='active'"; } ?> href="<?php echo BASE_URL."index.php?page=my_profile&module=simpan&action=list"; ?>">Simpan</a>

            <a href="<?php echo BASE_URL."index.php?page=logout"; ?>" class="link_logout">Keluar</a>

            <a href="javascript:void(0);" class="menu_sub" onclick="menuSub()">
                <img src="<?php echo BASE_URL."images/menu_sub.svg"; ?>">
            </a>
    </div>

    <div id="profile_content">
        <?php
            $file = "module/$module/$action.php";
            if(file_exists($file)) {
                include_once($file);
            } else {
                echo "<h3>Maaf, Halaman belum tersedia</h3>";
            }
        ?>
    </div>
</div>