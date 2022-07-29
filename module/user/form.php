<?php

    $user_id = isset($_GET['user_id']) ? $_GET['user_id'] : "";

	$button = "Update";
	$queryUser = mysqli_query($connection, "SELECT * FROM user WHERE user_id='$user_id'");

	$row = mysqli_fetch_assoc($queryUser);

	$nama = $row["nama"];
	$email = $row["email"];
	$phone = $row["phone"];
	$alamat = $row["alamat"];
	$status = $row["status"];
	$level = $row["level"];
?>

<div id="container_form">
    <form action="<?php echo BASE_URL."module/user/action.php?user_id=$user_id"?>" method="POST">

        <div class="element_form">
            <label>Nama Lengkap</label>	
            <span><input type="text" name="nama" value="<?php echo $nama; ?>" /></span>
        </div>	

        <div class="element_form">
            <label>Email</label>	
            <span><input type="text" name="email" value="<?php echo $email; ?>" /></span>
        </div>		

        <div class="element_form">
            <label>Phone</label>	
            <span><input type="text" name="phone" value="<?php echo $phone; ?>" /></span>
        </div>	

        <div class="element_form">
            <label>Alamat</label>	
            <span><input type="text" name="alamat" value="<?php echo $alamat; ?>" /></span>
        </div>		

        <div class="element_form">
            <label>Level</label>	
            <span>
                <input type="radio" value="superadmin" name="level" <?php if($level == "superadmin"){ echo "checked"; } ?> /> Superadmin
                <input type="radio" value="customer" name="level" <?php if($level == "customer"){ echo "checked"; } ?> /> Customer			
            </span>
        </div>	

        <div class="element_form">
            <label>Status</label>	
            <span>
                <input type="radio" value="on" name="status" <?php if($status == "on"){ echo "checked"; } ?> /> on
                <input type="radio" value="off" name="status" <?php if($status == "off"){ echo "checked"; } ?> /> off		
            </span>
        </div>		

        <div class="element_form">
            <span><input type="submit" name="button" value="<?php echo $button; ?>" class="submit-my-profile" /></span>
        </div>	
    </form>
</div>