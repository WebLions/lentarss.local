
<div class="col-lg-6">
    <section class="panel">
        <div class="panel-body">
            <div class="list-group">
                <?php foreach($rss_item as $row){?>
                    <a class="list-group-item " href="<?php echo $row['link']?>" target="_blank">
                        <img src="<?php echo $row['img']?>" height="52" width="96"/>
                        <h4 class="list-group-item-heading"><?php echo $row['title']?></h4>
                        <p class="list-group-item-text"><?php echo $row['description']?></p>
                    </a>
                <?php } ?>
            </div>
        </div>
    </section>
</div>
<div class="col-lg-6">
    <iframe id="frame" scrolling="no" src="<?=$rss_item[0]['link'];?>" style="width: 375px; height: 667px; display: inline-block; background-image: none;"></iframe>
</div>