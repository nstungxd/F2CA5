<div class="menus">
	<ul>
        <li class="<?php if ($index == 1) echo "active";?>">
        	<a href="<?php echo $baseDir?>/admin/shop/details?idx=<?php echo $shop->id?>">상점정보</a>
        </li>
        <li class="<?php if ($index == 2) echo "active";?>">
        	<a href="<?php echo $baseDir?>/admin/shop/goods?idx=<?php echo $shop->id?>">상품목록</a>
        </li>
        <li class="<?php if ($index == 3) echo "active";?>">
        	<a href="<?php echo $baseDir?>/admin/shop/comments?idx=<?php echo $shop->id?>">한줄평</a>
        </li>
        <li class="<?php if ($index == 4) echo "active";?> last">
        	<a href="<?php echo $baseDir?>/admin/shop/push?idx=<?php echo $shop->id?>">PUSH</a>
        </li>
    </ul>
<?php if ($index == 2 && isset($showreg) && $showreg): ?>
    <div class="headline first" style="float:right; margin-right: 10px">
        <button class="button-green" onclick="onAdd();">상품등록</button>
    </div>
<?php endif; ?>
</div>