<!-- 데이터 가공 -->

<?php if($list) : ?>
<table>
    <th>이름</th>
    <th>레벨</th>
    <th>HP</th>
    <th>MP</th>
<?php foreach($list as $row) : ?>
<tr>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['level'];?></td>
<td><?php echo $row['hp'];?></td>
<td><?php echo $row['mp'];?></td>
</tr>
   <?php endforeach;?>
</table>
<?php endif; ?>
