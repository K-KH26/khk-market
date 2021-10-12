<?php

/**
 * 빠른검색
 * 세부검색
 * 테이블 view를 생성한다
 * 
*/

// <th scope="col">#</th>
// <th scope="col">이름</th>
// <th scope="col">가격</th>
// <th scope="col">Level</th>
// <th scope="col">힘</th>
// <th scope="col">인트</th>
// <th scope="col">방어력</th>
// <th scope="col">공격력</th>
// <th scope="col">마력</th>
// <th scope="col">HP</th>
// <th scope="col">MP</th>

class ViewSearch
{
    function makeSearchTable(array $quickSearchList)
    {
        foreach($quickSearchList as $row) : ?>
            <tr class="selling-item-list auction-ing-item" data-auction="<?php echo $row['auc_id'] ;?>" data-usr="<?php echo $row['usr_id']; ?>">
                <td><img src="../image-items/<?php echo $row['name'].".png"; ?>" ></td>
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
        <?php endforeach;
    }

    function makeHistoryTable(array $historySearchList)
    {
        foreach($historySearchList as $row) : ?>
            <tr class="selling-item-list">
                <td><img src="../image-items/<?php echo $row['name'].".png"; ?>" ></td>
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
        <?php endforeach;
    }

    function emptyAnnounceDiv(){ ?>
        <div id="emptyAnnounceDiv">
            <p>경매장에 등록된 아이템이 없습니다!</p>
        </div>
    <?php }
} 

// items.name, items.level, items.str, items.int, items.def, items.atk, items.mtk, items.hp, items.mp
// onclick="javascript:alert('test')"