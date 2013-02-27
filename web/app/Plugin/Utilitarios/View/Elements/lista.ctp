<?php
if(!isset($virtualFields)){
    $virtualFields = array();
}
?>
<?php echo $this->Session->flash(); ?>
<?php echo $this->PaginatorGen->listAdminGen($fields,$data,array(), $virtualFields); ?>