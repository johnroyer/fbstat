<html>
<head>
   <meta http-equiv="content-type" content="text/html; charset=utf-8">

   <title>Facebook Stat</title>
   
</head>

<body>
   
   <?php if( $isLogin == 'false' ): ?>

   <h2>Not Logged in</h2>
   <blockquote>Please <a href="<?php echo $loginUrl; ?>">login</a> first.</blockquote>

   <?php else: ?>

   <h2>Welcome</h2>
   <blockquote>Hello, ______ 
      
      <p></p>
      <p>
         <a href="index.php/feed/update/">Update database</a> ...... 
         <a href="<?php echo $logoutUrl; ?>">Logout</a>
      </p>

      <hr>

      <div class="navbar" style="width:500px;">
         <div style="float:left;  width:50px;">
            <a href="?act=prev">&lt; Prev</a>
         </div>
         <div style="float:right; width:50px;">
            <a href="?act=next">Next &gt;</a>
         </div>
      </div>
      <div style="clear: both;"></div>

      <div class="feeddata">
      <pre><?php echo print_r($json); ?></pre>
      </div>

   <?php endif; ?>

</body>
</html>
