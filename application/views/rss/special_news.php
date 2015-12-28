<section id="main-content">
    <section class="wrapper">
        <!--overview start-->
        <div class="row">
            <div class="col-lg-12">

                <ol class="breadcrumb">
                    <li><i class="fa fa-home"></i><a href="/user/profile">Административная панель</a></li>
                    <li><i class="fa fa-laptop"></i>Новости</li>
                </ol>
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
                            <th><i class=""></i> Краткое описание</th>
                            <th><i class=""></i> Новость</th>
                            <th><i class=""></i> Дата</th>
                            <th><i class=""></i> Опубликовано</th>
                            <th><i class="icon_cogs"></i> Действие</th>

                        </tr>
                        <? foreach($news as $row){ ?>
                            <tr>
                                <td><?=$row['title']?></td>
                                <td><?=$row['description']?></td>
                                <td><a href="<?=$row['link']?>"><?=$row['link']?></a></td>
                                <td><?=$row['date']?></td>
                                <td><input type="checkbox" class="state" value="<?=$row['id_spec']?>" <?=($row['now']==0)? '' : 'checked' ?> /></td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-success" href="/rss/edit_special/<?=$row['id_spec']?>"><i class="icon_cog"></i></a>
                                        <a class="btn btn-danger" href="/rss/delete_special/<?=$row['id_spec']?>"><i class="icon_trash_alt"></i></a>
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

</section>

<!--main content end-->
</section>
<!-- container section start -->

<!-- javascripts -->