<div class="col-sm-6 col-md-3">
    <div class="thumbnail">
        <img src="#">
        <div class="caption">
            <h3><?=$category->name?></h3>
            <?php if($category->postPrice != 0){?><p>Цена поста: <?=$category->postPrice?></p><?php } ?>
            <p>Подкатегорий: #</p>
            <p>Постов: #</p>
            <p>Новых постов: #</p>
            <p><a href="?parent=<?=$category->id?>" class="btn btn-primary btn-sm" role="button">Подкатегории</a> <a href="#" class="btn btn-sm btn-default" role="button">Редактировать</a></p>
        </div>
    </div>
</div>