<?php
/***
 * function inventoryTable : 유저 인벤토리 목록 view
 * function sellingTable : 유저 판매중 목록 view
 * 
*/

class ViewTable{

    function inventoryTable(array $list)
    {
        ?>
            <table class="table align-middle table-bordered border-primary" id="item-table">
             <?php for($i = 0; $i < 4 ; $i++) : ?>
                <tr>
                    <?php for($j = $i*5 ; $j < $i*5 + 5 ; $j ++ ) : ?>
                        <?php if($list[$j]){ ?>
                            <td class="itemlist" data-columns="<?php echo $list[$j]['inv_id']?>" data-itemname="<?php echo $list[$j]['name'] ;?>" >
                            <img src="../image-items/<?php echo $list[$j]['name'].".png"; ?>"  title="<?php echo $list[$j]['name']; ?>">
                        <?php }else{ ?>
                            <td>
                         <?php  echo "없음" ; 
                            } ?>
                    </td>
                    <?php endfor ; ?>
                </tr>
                <?php endfor ; ?>
            </table>
        <?php
    }

    function sellingTable(array $selling_list){
        ?>
        <tbody>
        <?php
         foreach($selling_list as $row) :
        ?>
            <tr class="selling-item-list">
                <td scope="row"><img src="../image-items/<?php echo $row['name'].".png"; ?>"></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['price']; ?></td>
                <td><?php echo $row['level']; ?></td>
                <td><?php echo $row['str']; ?></td>
                <td><?php echo $row['int']; ?></td>
                <td><?php echo $row['def']; ?></td>
                <td><?php echo $row['atk']; ?></td>
                <td><?php echo $row['mtk']; ?></td>
                <td><?php echo $row['hp']; ?></td>
                <td><?php echo $row['mp']; ?></td>
            </tr>
       <?php endforeach; ?>
        </tbody>
    <?php
    }
}




