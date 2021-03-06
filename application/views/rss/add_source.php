<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!--overview start-->
        <div class="row">
            <div class="col-lg-12">

                <ol class="breadcrumb">
                    <li><i class="fa fa-home"></i><a href="/rss">Административная панель</a></li>
                    <li><i class="fa fa-laptop"></i>Добавление источников</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Добавление источника
                    </header>
                    <form action="/rss/add_source" method="post">
                    <div class="panel-body">
                        <form action="/rss/add_source" method="post">
                        <div class="form-group">
                            <label for="title">Название </label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="Имя ленты">
                        </div>

                        <div class="form-group">
                            <label for="link">Ссылка на ленту</label>
                            <input type="text" name="link" class="form-control" id="link" placeholder="Ссылка на ленту">
                        </div>

                        <div class="form-group">
                            <label for="period">Период обновления</label>
                            <input type="text" name="period" class="form-control" id="period" placeholder="Описание">
                        </div>

                        <div class="form-group">
                            <label for="mob_version">Мобильная версия</label>
                            <input type="text" name="mob_version" class="form-control" id="mob_version" placeholder="">
                        </div>

                        <div class="form-group">
                            <table id="category_block">
                                <tr>
                                    <td><label for="period">Категория</label></td>
                                    <td>
                                        <select id="category" name="category[]">
                                            <?foreach($category as $item){?>
                                                <option value="<?=$item['id']?>"><?=$item['title']?></option>
                                            <?}?>
                                        </select>
                                    </td>
                                    <td><button id="add_category" class="glyphicon glyphicon-plus btn btn-primary"></button></td>
                                </tr>
                            </table>


                        </div>

                        <div class="form-group">
                            <label for="key_words">Ключевые слова</label>
                            <input type="text" name="key_words" class="form-control" id="key_words" placeholder="В минутах">
                        </div>


                        <button type="submit" class="btn btn-primary">Добавить</button>
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