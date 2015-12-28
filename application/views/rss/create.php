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
                            Добавление новой rss
                        </header>
                        <div class="panel-body">
                            <form role="form" id="create_rss" method="post">
                                <div class="form-group">
                                    <label for="title">Название ленты</label>
                                    <input type="text" name="title" class="form-control" id="title" placeholder="Имя ленты">
                                </div>
                                <div class="form-group">
                                    <label for="link">Ссылка</label>
                                    <input type="text" name="link" class="form-control" id="link" placeholder="Ссылка на ленту">
                                </div>
                                <div class="form-group">
                                    <label for="description">Краткое описание</label>
                                    <input type="text" name="description" class="form-control" id="description" placeholder="Описание">
                                </div>

                                <div class="form-group">
                                    <label for="period">Дата публикации</label>
                                    <input type="text" name="publication_date" class="form-control" id="period" placeholder="Минуты">
                                </div>

                                <div class="form-group">
                                    <label for="period">Период обновления ленты</label>
                                    <input type="text" name="period" class="form-control" id="period" placeholder="Минуты">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-8" >

                                            <table id="donors" width = "100%">
                                                <tr>
                                                    <th style = "width: 80%">Ленты доноры</th>
                                                    <th style = "width: 20%;text-align:right"></th>
                                                </tr>


                                             </table>


                                        </div>
                                    </div>
                                    <div id="add_donor" class="tagsinput-add"> Добавить донора</div>

                                </div>
                                <div class="form-group">
                                    <label for="keywords">Ключевые слова</label>
                                    <input type="text" name="keywords" class="form-control" id="keywords" placeholder="">
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