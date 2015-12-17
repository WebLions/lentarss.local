
<!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            <!--overview start-->
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><i class="fa fa-laptop"></i> Главная страница</h3>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="/user/profile">Административная панель</a></li>
                        <li><i class="fa fa-laptop"></i><a href="/rss">Ленты RSS</a></li>
                        <li><i class="fa"></i>Ошибки лент</li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-8" >
                                            <table id="donors" width = "100%">
                                                <tr>
                                                    <th style = "width: 5%">№</th>
                                                    <th style = "width: 20%">Название</th>
                                                    <th style = "width: 60%">Ссылка</th>
                                                    <th style = "width: 15%">Дата</th>
                                                </tr>
                                                <?php foreach($errors as $row){ ?>
                                                <tr>
                                                    <td><?=$row['id']?></td>
                                                    <td><?=$row['text']?></td>
                                                    <td><a href="<?=$row['link']?>"><?=$row['link']?></a></td>
                                                    <td><?=$row['date']?></td>
                                                </tr>
                                                <?php } ?>
                                             </table>
                                        </div>
                                    </div>
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
