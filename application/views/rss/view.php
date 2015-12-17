    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            <!--overview start-->
            <div class="row">
                <div class="col-lg-12">

                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="/user/profile">Административная панель</a></li>
                        <li><i class="fa fa-laptop"></i><a href="/rss">Ленты RSS</a></li>
                        <li><i class="fa"></i>Создание RSS</li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            <?php echo $rss[0]['title'];?>
                        </header>
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

            </div>


        </section>
    </section>
    <!--main content end-->
</section>
<!-- container section start -->

<!-- javascripts -->