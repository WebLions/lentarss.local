
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            <!--overview start-->
            <div class="row">
                <div class="col-lg-12">

                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="/user/profile">Административная панель</a></li>
                        <li><i class="fa fa-laptop"></i>Ленты RSS</li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <form action="?" method="get">
                    <table width = "100%">
                        <tr>
                             <td style = "width: 5%"><a class="btn btn-success" href="rss/create" title="Добавить RSS">Добавить RSS</a></td>
                             <td style = "width: 5%"><a class="btn btn-success" href="rss/check" title="Проверить RSS">Проверить RSS</a></td>
                             <td style = "width: 75%"><input type="text" name="tag" class="form-control" id="search" placeholder="Поиск по лентам"></td>

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
                                <th><i class="icon_header"></i> Название</th>
                                <th><i class="icon_calendar"></i> Краткое описание</th>
                                <th><i class="icon_calendar"></i> Rss</th>
                                <th><i class="icon_calendar"></i> Дата</th>
                                <th><i class="icon_cogs"></i> Действие</th>

                            </tr>
                            <? foreach($rss as $row){ ?>
                            <tr>
                                <td><a href="/rss/view/<?=$row['id']?>"><?=$row['title']?></a></td>
                                <td><?=$row['description']?></td>
                                <td><a href="/<?=$row['link']?>.rss" target="_blank"><?=$row['link']?></a></td>
                                <td><?=$row['date']?></td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-success" href="/rss/edit/<?=$row['id']?>"><i class="icon_cog"></i></a>
                                        <a class="btn btn-danger" id="delete" href="/rss/delete/<?=$row['id']?>"><i class="icon_trash_alt"></i></a>
                                        <a class="btn btn-primary" id="clear" href="/rss/clear/<?=$row['id']?>"><i class="icon_tags_alt"></i></a>
                                       <!-- <a class="btn btn-info" href=""><i class="icon_search_alt"></i></a> -->
                                    </div>
                                </td>
                            </tr>
                            <? } ?>
                            </tbody>
                        </table>
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