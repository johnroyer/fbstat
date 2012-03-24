<?php $this->load->helper('url'); ?>

<form action="<?php echo current_url(); ?>" method="post" accept-charset="utf-8">

   <p>

   <label>從</label>
   <input type="text" name="from" class="DatePicker" value="<?php echo $from; ?>">

   <label>到</label>
   <input type="text" name="to" class="DatePicker" value="<?php echo $to; ?>">

   <input type="submit" value="確定">

   </p>

</form>
