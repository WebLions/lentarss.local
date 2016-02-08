<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!--overview start-->
        <div class="row">
            <div class="col-lg-12">

                <ol class="breadcrumb">
                    <li><i class="fa fa-home"></i><a href="/user/profile">Административная панель</a></li>
                    <li><i class="fa fa-laptop"></i>Источники</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <form action="?" method="get">
                    <table width = "100%">
                        <tr>
                            <td style = "width: 5%"><a class="btn btn-success" href="rss/create" title="Добавить источник">Добавить источник</a></td>
                            <td style = "width: 5%"><a class="btn btn-success" href="rss/check" title="Проверить источник">Проверить источник</a></td>
                            <td style = "width: 75%"><input type="text" name="tag" class="form-control" id="search" placeholder="Поиск по источникам"></td>
                            <td style = "width: 5%"><button class="btn btn-primary" href="" title="Найти ">Найти</button></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Добавление источника
                    </header>

                    <div class="panel-body">
                        <div class="form-group">
                            <label for="title">Название новости</label>
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
                            <label for="datetime">Дата и время размещения</label>
                            <input type="text" name="datetime" class="form-control" id="datetimepicker" placeholder="">
                        </div>

                        <div class="form-group">
                            <label for="period">Период</label>
                            <input type="text" name="period" class="form-control" id="period" placeholder="В часах">
                        </div>

                        <div class="form-group">
                            <label for="update">Время закрепления</label>
                            <input type="text" name="update" class="form-control" id="update" placeholder="В минутах">
                        </div>

                        <div class="form-group">
                            <label for="description">Выберите изображение</label>
                            <input type="file" name="picture" multiple accept="image/*,image/jpeg">
                        </div>

                        <br>

                        <div id="add_donor" class="tagsinput-add"> Добавить спец.новость</div>
                        <br>

                        <button type="submit" class="btn btn-primary">Создать</button>
                        </form>



                    </div>
                </section>
            </div>


        </div>



    </section>
    <div class="row">
        <div class="col-lg-12">
            <div style = "text-align: center;">
                <ul class="pagination pagination-ms">
                    <li><a href="#">«</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li><a href="#">»</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!--main content end-->
</section>
<!-- container section start -->

<!-- javascripts -->