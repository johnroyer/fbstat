<?php
   $this->load->helper('url');
?>

<html>
<head>
   <meta http-equiv="content-type" content="text/html; charset=utf-8">

   <title><?php echo $title; ?></title>
   
<link rel=stylesheet type="text/css" href="<?php echo base_url('css/DatePicker.css'); ?>">
<style type="text/css">
table {
   border-collapse:collapse;
}

table, td, th {
   border:1px solid black;
}

td {
   padding: 5px 15px 5px 15px;
}

.nav {
   float: left;
   width: 150px;
   height: 30px;
   font-size: 16px;
}
</style>

<script type="text/javascript" src="<?php echo base_url('js/mootools.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/DatePicker.js'); ?>"></script>

<script type="text/javascript">
window.addEvent('domready', function(){
   $$('input.DatePicker').each( function(el){
      new DatePicker(el);
   });
});
</script>

</head>

<body>

<?php $this->load->helper('url'); ?>

<div class="nav">
   <?php echo anchor('stat/', '社團概況'); ?>
</div>

<div class="nav">
   <?php echo anchor('stat/artlike', '熱門文章 (讚)'); ?>
</div>

<div class="nav">
   <?php echo anchor('stat/artcomment', '熱門文章 (回覆)'); ?>
</div>
   
<div class="nav">
   <?php echo anchor('stat/commentmost', '回覆踴躍'); ?>
</div>

<div style="clear: both; height:0px; border-bottom: 1px solid black;"></div>

<?php $this->load->view('date_selector'); ?>

<p> &nbsp; </p>

