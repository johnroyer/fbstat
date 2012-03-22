<html>
<head>
   <meta http-equiv="content-type" content="text/html; charset=utf-8">

   <title><?php echo $title; ?></title>
   
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
   
<div style="clear: both; height:0px; border-bottom: 1px solid black;"></div>

<p> &nbsp; </p>
