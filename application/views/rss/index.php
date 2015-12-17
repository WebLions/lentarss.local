
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            <!--overview start-->
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><i class="fa fa-laptop"></i> Главная страница</h3>
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
                             <td style = "width: 95%"><input type="text" name="tag" class="form-control" id="search" placeholder="Поиск по лентам"></td>
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
                                        <a class="btn btn-success" href="#"><i class="icon_check_alt2"></i></a>
                                        <a class="btn btn-danger" href="#"><i class="icon_close_alt2"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <? } ?>
                            </tbody>
                        </table>
                    </section>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <a class="btn btn-success" href="rss/create" title="Добавить RSS">Добавить RSS +</a>
                </div>
            </div>


        </section>
        <div class="row">
            <div class="col-lg-12">
                <div style = "text-align: center;">
                <ul class="pagination pagination-ms">
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                </ul>
                </div>
            </div>
        </div>
    </section>

    <!--main content end-->
</section>
<!-- container section start -->

<!-- javascripts -->