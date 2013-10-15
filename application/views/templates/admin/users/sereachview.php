<?php defined('SYSPATH') or die('No direct script access.');
?>
<form class="Login"  action="<?php echo URL::site('admin/users/search') ?>" method="post">
<input type="text" class="TextBox" id="search" name="search"/> <input type="submit"  id="submit" value="OK" style="width:35px; height:25px" name="submmit">
</form>