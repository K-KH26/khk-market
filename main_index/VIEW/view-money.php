<?php

class ViewMoney
{
    function hasMoneyDiv($money){
        if($money) : ?>
            <div class="col-6" id="search-balance">
                <div class="input-group">
                    <input type="number" class="form-control" value="<?php echo $money ; ?>" readonly="readonly">
                    <span class="input-group-text">₩</span>
                </div>
            </div>
        <?php else : ?>
            <div class="col-6" id="search-balance">
                <div class="input-group">
                    <input type="number" class="form-control" value="0" readonly="readonly" >
                    <span class="input-group-text">₩</span>
                </div>
            </div>
        <?php endif ;
    
    }
}

