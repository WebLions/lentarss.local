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
                            <td style = "width: 5%"><a class="btn btn-success" href="/rss/add_source" title="Добавить источник">Добавить источник</a></td>
                            <td style = "width: 5%"><a class="btn btn-success" href="/rss/check" title="Проверить источник">Проверить источник</a></td>
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

                    <table class="table table-striped table-advance table-hover">
                        <tbody>
                        <tr>
                            <th><i class=""></i> Название</th>
                            <th><i class=""></i> Ссылка на ленту</th>
                            <th><i class=""></i> Период обнволения</th>
                            <th><i class=""></i> Мобильная версия</th>
                            <th><i class=""></i> Ключевые слова</th>
                            <th><i class="icon_cogs"></i> Действие</th>

                        </tr>
                        <?foreach($source as $item){?>
                            <tr>
                                <td><?=$item['title']?></td>
                                <td><?=$item['link']?></td>
                                <td><?=$item['period']?></td>
                                <td><?=$item['mobile']?></td>
                                <td><?=$item['tag']?></td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-success" href="/rss/edit_source/<?=$item['id']?>"><i class="icon_cog"></i></a>
                                        <a class="btn btn-danger" href="/rss/delete_source/<?=$item['id']?>"><i class="icon_trash_alt"></i></a>
                                    </div>
                                </td>
                            </tr>
                        <?}?>
                        </tbody>
                    </table>
                </section>

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