<?php 
require_once("other/header.php");
require_once("other/classess/VideoDetailsFormProvider.php");
 ?>


<div class="column">
    <?php
        $formprovider = new VideoDetailsFormProvider($con);
        echo $formprovider->createUploadForm();    

    ?>
</div>

<script>
$("form").submit(function() {
    $("#loadingModal").modal("show");
});
</script>

<div class="modal fade" id="loadingModal" tabindex="-1" role="dialog" aria-labelledby="loadingModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      
      <div class="modal-body">
       Please wait. This might take a while.<br>
       <img src="images/loading.gif">
      </div>
      
    </div>
  </div>
</div>

<?php require_once("other/footer.php"); ?>
