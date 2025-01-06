<h1>افزودن کاربر</h1>
<form action=""  id="userRegister">
    <input type="text" placeholder="نام" id="userName">
    <input type="text" placeholder="نام خانوادگی" id="userFamily">
    <input type="submit" name="submit" value="افزودن کاربر">
    <?php wp_nonce_field('add_user_nonce','add_users_nonce') ?>
</form>
