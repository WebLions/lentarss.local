
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">            
              <!--overview start-->
              <div class="row">
                <div class="col-lg-12">

                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="/user/profile">Административная панель</a></li>
                        <li><i class="fa fa-laptop"></i>Главная</li>                          
                    </ol>
                </div>
            </div>

              <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <div class="form-group">
                              <div class="row">
                                  <div class="col-lg-12" >
                                      <table id="donors" width = "100%">
                                          <tr>
                                              <th style = "width: 5%;padding-left: 15px">№</th>
                                              <th style = "width: 40%">Название</th>
                                              <th style = "width: 30%">Ссылка</th>
                                              <th style = "width: 15%">Дата</th>
                                              <!--<th class="icon_cog" style = "width: 2%; text-align: center"></th>-->
                                          </tr>
                                          <?php $i=1; foreach($errors as $row){ ?>
                                              <tr>
                                                  <td style = "padding-left: 15px"><?=$i?></td>
                                                  <td><?=$row['text']?></td>
                                                  <td><a href="<?=$row['link']?>"><?=$row['link']?></a></td>
                                                  <td><?=$row['date']?></td>
                                                  <!--
                                                  <td>
                                                      <div class="btn-group">
                                                      <a class="btn btn-danger btn-xs" href="/rss/detele_log"><i class="icon_trash_alt"></i></a>
                                                      </div>
                                                  </td>
                                                  -->
                                              </tr>
                                              <?php $i++;} ?>
                                      </table>
                                  </div>
                              </div>
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
