/**
 * Created by PhpStorm.
 * User: Swarge
 * Date: 12/17/2015
 * Time: 12:30 AM
 */



<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!--overview start-->
        <div class="row">
            <div class="col-lg-12">

                <ol class="breadcrumb">
                    <li><i class="fa fa-home"></i><a href="/user/profile">Административная панель</a></li>
                    <li><i class="fa fa-laptop"></i><a href="/rss">Новости</a></li>
                    <li><i class="fa"></i>Создание специальной новости</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Добавление новой специальной новости
                    </header>
                    <div class="panel-body">
                        <form role="form" id="create_rss" method="post" enctype="multipart/form-data">
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
                                <label for="description">Период</label>
                                <input type="text" name="period" class="form-control" id="period" placeholder="В минутах">
                            </div>

                            <div class="form-group">
                                <label for="description">Выберите изображение</label>
                                <input type="file" name="picture" multiple accept="image/*,image/jpeg">
                            </div>

                            <div class="form-group">
                            <label for="id_rss">Лента для спей новости</label>

                            <table id="donors_spec" width = "100%">
                            <tr>
                                <td>
                                <select name="id_rss" class="form-control m-bot15">
                                     <?php foreach ($rss as $rs) {?>
                                            <option value="<?=$rs['id']?>"><?=$rs['title']?></option>
                                     <?php } ?>
                                 </select>
                                </td>
                                <td>
                                    <button class="delete icon_close_alt2 btn btn-danger"></button>
                                </td>
                            </tr>
                            </table>
                            </div>

                            <div id="add_donor_spec" class="tagsinput-add"> Добавить спец.новость</div>
                            <br>

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