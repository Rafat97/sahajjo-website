<?php
if (empty($_GET) || empty($_GET['page_type'])) {
    $url = base_url_route('profile-edit?page_type=see_profile');
    header("Location: $url");
    exit;
}
else {
    if ($_GET['page_type'] == 'see_profile') {
        //echo "see";
        //print_r( $_GET );
    }
    elseif ($_GET['page_type'] == 'edit_profile') {
        //echo "edit";
        //print_r( $_GET );
    }
}
?>
<form action="<?php echo base_url_route('signup-post'); ?>" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="exampleFormControlFile1">Example file input</label>
    <input type="file" class="form-control-file" name="files" id="exampleFormControlFile1" >
  </div>
  <input type="hidden" name="from_submit_base_url" value="<?php echo base_url(); ?>">
  <input type="hidden" name="from_type" value="<?php echo"edit_profile_form"; ?>">
  <button type="submit" class="btn btn-primary">Submit</button>
</form>