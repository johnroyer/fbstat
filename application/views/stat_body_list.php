<p>
   文章數：<?php echo $article; ?> &nbsp;&nbsp;&nbsp;&nbsp;
   回覆數：<?php echo $comment; ?> &nbsp;&nbsp;&nbsp;&nbsp;
   讚：<?php echo $like;?>
</p>

<table>
<tr>
   <td>ID</td>
   <td>暱稱</td>
   <td>文章數</td>
   <td>回覆數</td>
   <td>讚</td>
</tr>

<?php foreach( $list as $user ){  ?>

<tr>
   <td><?php echo $user['id']; ?></td>
   <td><?php echo $user['name']; ?></td>
   <td><?php echo $user['article']; ?> </td>
   <td><?php echo $user['comment']; ?> </td>
   <td><?php echo $user['like']; ?> </td>
</tr>

<?php }  ?>

</table>
