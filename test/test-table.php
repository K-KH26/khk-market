<?php
//리스트로 테이블을 만든다

if($list) : ?>
    <table class="table align-middle table-bordered border-primary">
<?php   for($i = 0; $i < 4 ; $i++) : ?>
        <tr>
            <?php for($j = $i*5 ; $j < $i*5 + 5 ; $j ++ ) : ?>
            <td class="itemlist">
                <?php if($list[$j]) : ?>
                    <img src="../image-items/<?php echo $list[$j]['name'].".png"; ?>">
                 <?php endif; ?>
            </td>
            <?php endfor ; ?>
        </tr>
        <?php endfor ; ?>
    </table>
    <?php endif ; ?>
