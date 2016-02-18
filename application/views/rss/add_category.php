    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            <!--overview start-->
            <div class="row">
                <div class="col-lg-12">

                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="/user/profile">Административная панель</a></li>
                        <li><i class="fa fa-laptop"></i><a href="/rss">Категории</a></li>
                        <li><i class="fa"></i>Добавления категории</li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Добавление новой категории
                        </header>
                        <div class="panel-body">
                            <form role="form" id="create_rss" method="post">
                                <div class="form-group">
                                    <label for="title">Название</label>
                                    <input type="text" name="title" value="<?php echo set_value('title'); ?>" class="form-control" id="title" placeholder="Имя ленты">
                                </div>
                                <div class="form-group">
                                    <label for="link">Ссылка</label>
                                    <input type="text" name="link" value="<?php echo set_value('link'); ?>" class="form-control" id="link" placeholder="Ссылка на ленту">
                                    <p><?=$error['link']?></p>
                                </div>
                                <div class="form-group">
                                    <label for="description">Краткое описание</label>
                                    <input type="text" name="description" value="<?php echo set_value('description'); ?>" class="form-control" id="description" placeholder="Описание">
                                </div>

                                <button type="submit" class="btn btn-primary">Создать</button>
                            </form>


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