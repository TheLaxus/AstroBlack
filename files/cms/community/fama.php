<?php
require_once('../../../global.php');

$Hotel::Manutention($user['rank']);
$Functions::Session('disconnected');

$Template->SetParam('page_id', 'hall');
$Template->SetParam('page_name', 'Hall');
$Template->SetParam('page_title', 'Comunidade - ' . HOTELNAME);
$Template->SetParam('page_description', '');
$Template->SetParam('page_image', URL . '/image.png');

$Template->AddTemplate('others', 'head');
?>

<style type="text/css">
                        #aviso-cont,
                        #emblemas {
                            width: 61px;
                            height: 61px
                        }

                        #emblemas {
                            margin-right: 5px;
                            margin-top: 5px;
                            line-height: 60px;
                            float: left;
                            cursor: default;
                            text-align: center;
                            background-position: center center;
                            background-repeat: no-repeat;
                            background-color: rgba(0, 0, 0, .1);
                            border-radius: 3px;
                            transition: all .3s ease-in-out;
                            -webkit-box-shadow: inset 0 0 0 1px rgba(0, 0, 0, .1), inset 0 2px 8px 0 rgba(0, 0, 0, .1);
                            box-shadow: inset 0 0 0 1px rgba(0, 0, 0, .1), inset 0 2px 8px 0 rgba(0, 0, 0, .1)
                        }

                        #emblemas,
                        .aviso {
                            -webkit-transition: all .3s ease-in-out;
                            -moz-transition: all .3s ease-in-out;
                            -ms-transition: all .3s ease-in-out;
                            -o-transition: all .3s ease-in-out;
                            -webkit-border-radius: 3px
                        }

                        #emblemas:hover {
                            background-color: rgba(0, 0, 0, .3)
                        }

                        #emblemas:hover .aviso {
                            opacity: .9;
                            visibility: visible;
                            bottom: 15px;
                            z-index: 9999999999999999999999999999999999999999999999999999999999999
                        }

                        #aviso-cont {
                            position: relative
                        }

                        .aviso {
                            line-height: 15px;
                            margin: 0 0 40px -16px;
                            color: rgba(255, 255, 255, 1);
                            font-size: 12px;
                            background: rgba(0, 0, 0, 1);
                            opacity: 0;
                            visibility: hidden;
                            position: absolute;
                            bottom: 5px;
                            left: 50%;
                            z-index: 99;
                            transition: all .3s ease-in-out;
                            border-radius: 3px
                        }

                        .aviso-dentro {
                            font-family: Verdana;
                            font-size: 11px;
                            padding: 10px;
                            letter-spacing: 0;
                            position: relative;
                            z-index: 999
                        }

                        .error>h3,
                        div.goodmsg>h3 {
                            font-weight: 700;
                            font-size: 13px
                        }

                        .aviso-dentro-seta {
                            width: 10px;
                            height: 10px;
                            bottom: 2px;
                            margin-bottom: -5px;
                            background: rgba(0, 0, 0, 1);
                            position: absolute;
                            margin-left: 10px;
                            -webkit-transform: rotate(-45deg);
                            -moz-transform: rotate(-45deg);
                            -ms-transform: rotate(-45deg);
                            -o-transform: rotate(-45deg);
                            filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3)
                        }

                        .error {
                            padding: 7px;
                            background-color: #fff4f2;
                            border: 1px solid #a63c29;
                            color: #E2001A;
                            margin-top: 5px
                        }

                        .error>h3 {
                            margin: 0;
                            padding: 0
                        }

                        div.goodmsg {
                            padding: 7px;
                            background-color: #d8f3d8;
                            border: 1px solid #4da04d;
                            color: #205220;
                            margin-top: 5px
                        }

                        #eventos,
                        #promocoes {
                            border-right: 1px solid #CCC
                        }

                        div.goodmsg>h3 {
                            margin: 0;
                            padding: 0
                        }

                        div.display_none {
                            display: none
                        }

                        #promocoes {
                            float: left;
                            margin: -8px 0 0 -10px;
                            padding: 0 1px 0 0;
                            width: 249px
                        }

                        #eventos,
                        #presencas {
                            float: left;
                            margin: -8px 0 0 1px;
                            padding: 0 1px 0 0
                        }

                        #headerprom {
                            background-image: url(http://i.imgur.com/W1B9OGq.png);
                            height: 129px;
                            width: 249px;
                            position:absolute;
                        }

                        #eventos {
                            width: 248px
                        }

                        #eventos .header {
                            background-image: url(http://i.imgur.com/4XfQYbP.png);
                            height: 129px;
                            width: 248px
                        }

                        #presencas {
                            width: 248px
                        }

                        #presencas .header {
                            background-image: url(http://i.imgur.com/a3FyccX.png);
                            height: 129px;
                            width: 248px
                        }

                        .icon-bronze,
                        .icon-gold,
                        .icon-silver {
                            position: relative;
                            height: 28px;
                            width: 17px;
                            left:130px;
                            top:-36px
                        }

                        .icon-gold {
                            background: url(http://i.imgur.com/2p8pOJI.png) -18px -30px
                        }

                        .icon-silver {
                            background: url(http://i.imgur.com/2p8pOJI.png) -63px 0
                        }

                        .icon-bronze {
                            background: url(http://i.imgur.com/2p8pOJI.png) -19px -1px
                        }

                        .icon-arrow {
                            background: url(http://i.imgur.com/2p8pOJI.png) -40px -19px;
                            height: 15px;
                            margin: 0 0 0 2px;
                            width: 15px
                        }

                        .ranking-list table {
                            border-bottom: 1px dashed #CCC;
                            width: 100%
                        }

                        .item-ranking-last table {
                            border-bottom: 1px solid #CCC;
                            width: 101%
                        }

                        .ranking-list u {
                            font-weight: 700
                        }

                        .points-value {
                            color: #fff;
                            margin: 3px 0 0
                        }

                        .item-ranking-main .boneco {
                            margin: -60px 0 0 -6px
                        }

                        .item-even {
                            background-color: #292929
                        }

                        .supertext {
                            background-color: #FFF;
                            height: 13px;
                            overflow: hidden;
                            padding: 10px 10px 5px 1px;
                            position: relative;
                            z-index: 9
                        }

                        #searchbox {
                            color: #000;
                            float: right
                        }

                        #top-box #text {
                            float: left
                        }

                        #searchbox input {
                            float: right;
                            margin: -2px 0 0 5px
                        }

                        #main-info u {
                            color: #000;
                            font-weight: 700
                        }

                        #main-info .clearfix {
                            padding: 1px
                        }

                        #main-info {
                            float: left;
                            margin: -15px 0 0 -15px
                        }

                        #promocoes-ganhas {
                            color: #000;
                            font-size: 12px;
                            float: left;
                            margin: 14px 0 0;
                            width: 270px
                        }

                        #promocoes-ganhas table {
                            border-top: 1px dashed #CCC;
                            color: #7F7F7F;
                            font-size: 11px;
                            margin: 14px 0 0;
                            width: 100%
                        }

                        #promocoes-ganhas table td {
                            border-bottom: 1px dashed #CCC;
                            height: 17px;
                            padding: 4px 0 2px
                        }

                        .icon-go {
                            background: url(http://i.imgur.com/2p8pOJI.png) -40px -1px;
                            float: right;
                            height: 16px;
                            width: 17px
                        }

                        #emblemas-perfil {
                            color: #000;
                            font-size: 12px;
                            margin: 4px 0 0 20px
                        }

                        #emblemas-listagem {
                            width: 462px
                        }

                        #paginacao-emblemas {
                            float: right;
                            font-size: 11px;
                            margin: 0 5px 0 0
                        }
                    </style>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
                    <script type="text/javascript">
                        var $a = jQuery.noConflict();

                        function toggleMenu(id) {
                            if ($a('#' + id).height() != 138) {
                                $a('#' + id).animate({
                                    marginTop: -138
                                }, {
                                    duration: 1000,
                                    queue: false
                                });
                                $a('#' + id).animate({
                                    height: 138
                                }, 1000);
                            } else {
                                $a('#' + id).animate({
                                    marginTop: 0
                                }, {
                                    duration: 1000,
                                    queue: false
                                });
                                $a('#' + id).animate({
                                    height: 13
                                }, 1000);
                            }
                        }
                    </script>



<div class="container">
      <div class="row">
        <div class="col-3">
          <div id="content-box">
          <div id="headerprom"></div>
                                
            <div class="title-box png20">
              <div class="title" style="position:relative;top:88px;left:140px">Promoções</div>
              <div class="content" style="position:relative;top:90px">
              

              <div class="png20">
                  <div class="Avatar" style="background-image: url(https://habbo.com/habbo-imaging/avatarimage?figure=hr-170-61.fa-3474-0.sh-290-92.he-3740-0.ch-255-110.ha-3710-0.hd-180-17.ca-3702-110-1408.lg-280-110.&head_direction=2&gesture=sml&headonly=0);"></div>
                  <div style="position:relative;left:40px">
                  <div class="username">Lucas</div>
                  <div class="desc"><strong>29</strong> kills</div>

                  <div class="icon-gold"></div>
                  </div>
                </div>

                <div class="png20">
                  <div class="headAvatar" style="background-image: url(https://habbo.com/habbo-imaging/avatarimage?figure=hr-170-61.fa-3474-0.sh-290-92.he-3740-0.ch-255-110.ha-3710-0.hd-180-17.ca-3702-110-1408.lg-280-110.&head_direction=2&gesture=sml&headonly=1);"></div>
                  <div style="position:relative;left:0px">
                  <div class="username">Lucas</div>
                  <div class="desc"><strong>29</strong> kills</div>

                  <div class="icon-silver"></div>
                  </div>
                </div>

              
              
              <table class="png20">
                                                <tr>
                                                    <td style="width:63px">
                                                        <div class="boneco">
                                                        <div class="headAvatar" style="background-image: url(https://habbo.com/habbo-imaging/avatarimage?figure=hr-170-61.fa-3474-0.sh-290-92.he-3740-0.ch-255-110.ha-3710-0.hd-180-17.ca-3702-110-1408.lg-280-110.&head_direction=2&gesture=sml&headonly=1);"></div>
                                                        </div>
                                                    </td>
                                                    <td style="position:relative;witdh:145px;left:-15px;padding:6px">
                                                        <div class="username">wdwd</div>
                                                        <div class="desc">7 pontos de eventos</div>
                                                    </td><td>
                                                        <div class="icon-silver"></div>
                                                    </td>
                                                </tr>
              </table>

              <table class="png20">
                                                <tr>
                                                    <td style="width:63px">
                                                        <div class="boneco">
                                                        <div class="headAvatar" style="background-image: url(https://habbo.com/habbo-imaging/avatarimage?figure=hr-170-61.fa-3474-0.sh-290-92.he-3740-0.ch-255-110.ha-3710-0.hd-180-17.ca-3702-110-1408.lg-280-110.&head_direction=2&gesture=sml&headonly=1);"></div>
                                                        </div>
                                                    </td>
                                                    <td style="position:relative;witdh:145px;left:-15px;padding:6px">
                                                        <div class="username">wdwd</div>
                                                        <div class="desc">7 pontos de eventos</div>
                                                    </td><td>
                                                        <div class="icon-bronze"></div>
                                                    </td>
                                                </tr>
              </table>

              <table class="png20">
                                                <tr>
                                                    <td style="width:63px">
                                                        <div class="boneco">
                                                        <div class="headAvatar" style="background-image: url(https://habbo.com/habbo-imaging/avatarimage?figure=hr-170-61.fa-3474-0.sh-290-92.he-3740-0.ch-255-110.ha-3710-0.hd-180-17.ca-3702-110-1408.lg-280-110.&head_direction=2&gesture=sml&headonly=1);"></div>
                                                        </div>
                                                    </td>
                                                    <td style="position:relative;witdh:145px;left:-15px;padding:6px">
                                                        <div class="username">wdwd</div>
                                                        <div class="desc">7 pontos de eventos</div>
                                                    </td><td>
                                                        <div class="icon-arrow"></div>
                                                    </td>
                                                </tr>
              </table>

                              
                              </div>
            </div>
          </div>
        </div>
          </div>
       

        
<div class="container">
<div class="column">
  <div class="row">
  <div id="content-box">
					

                    
                            <div id="promocoes">
                                <div class="header">
                                    <div style="float:left;margin:109px 0px 0px 165px"><a href="/news/1" target="_blank">Promo&ccedil;&otilde;es</a></div>
                                </div>
                                <div class="ranking-list">
                                    <div class="item-ranking-main ">
                                        <?php
                                        $consult_hall_currency = $db->prepare("SELECT username,figure,promo_points FROM players WHERE rank < 6 AND fame_occult = ? ORDER BY promo_points + 0 DESC LIMIT 0,1");
                                        $consult_hall_currency->bindValue(1, '0');
                                        $consult_hall_currency->execute();

                                        while ($result_hall_currency = $consult_hall_currency->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                            <table>
                                                <tr>
                                                    <td style="width:63px">
                                                        <div class="boneco">
                                                            <img alt="<?= $result_hall_currency['username']; ?>" src="<?= AVATARIMAGE; ?>figure=<?= $result_hall_currency['figure']; ?>&action=wav&direction=2&head_direction=3&gesture=std&size=n&img_format=png&frame=0&headonly=0">
                                                        </div>
                                                    </td>
                                                    <td style="width:145px">
                                                        <u><?= $result_hall_currency['username']; ?></u>
                                                        <div class="points-value"><?= number_format($result_hall_currency['promo_points']); ?> pontos de promo&ccedil;&otilde;es</div>
                                                    </td>
                                                    <td>
                                                        <div class="icon-gold"></div>
                                                    </td>
                                                </tr>
                                            </table>
                                <?php } ?>
                                </div>
                                <div class="item-ranking item-even">
                                    <?php
                                    $consult_hall_currency = $db->prepare("SELECT username,figure,promo_points FROM players WHERE rank < 6 AND fame_occult = ? ORDER BY promo_points + 0 DESC LIMIT 1,1");
                                    $consult_hall_currency->bindValue(1, '0');
                                    $consult_hall_currency->execute();

                                    while ($result_hall_currency = $consult_hall_currency->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                        <table>

                                            <tr>
                                                <td style="width:63px">
                                                    <div class="boneco">
                                                        <img alt="<?= $result_hall_currency['username']; ?>" src="<?= AVATARIMAGE; ?>figure=<?= $result_hall_currency['figure']; ?>&action=wav&direction=2&head_direction=2&gesture=std&size=n&img_format=png&frame=0&headonly=1">
                                                    </div>
                                                </td>
                                                <td style="width:145px">
                                                    <u><?= $result_hall_currency['username']; ?></u>
                                                    <div class="points-value"><?= number_format($result_hall_currency['promo_points']); ?> pontos de promo&ccedil;&otilde;es</div>
                                                </td>
                                                <td>
                                                    <div class="icon-silver"></div>
                                                </td>
                                            </tr>
                                        </table>
                            <?php } ?>
                            </div>
                            <div class="item-ranking item-odd">
                                <?php
                                $consult_hall_currency = $db->prepare("SELECT username,figure,promo_points FROM players WHERE rank < 6 AND fame_occult = ? ORDER BY promo_points + 0 DESC LIMIT 2,1");
                                $consult_hall_currency->bindValue(1, '0');
                                $consult_hall_currency->execute();

                                while ($result_hall_currency = $consult_hall_currency->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                    <table>
                                        <tr>
                                            <td style="width:63px">
                                                <div class="boneco">
                                                    <img alt="<?= $result_hall_currency['username']; ?>" src="<?= AVATARIMAGE; ?>figure=<?= $result_hall_currency['figure']; ?>&action=wav&direction=2&head_direction=2&gesture=std&size=n&img_format=png&frame=0&headonly=1">
                                                </div>
                                            </td>
                                            <td style="width:145px">
                                                <u><?= $result_hall_currency['username']; ?></u>
                                                <div class="points-value"><?= number_format($result_hall_currency['promo_points']); ?> pontos de promo&ccedil;&otilde;es</div>
                                            </td>
                                            <td>
                                                <div class="icon-bronze"></div>
                                            </td>
                                        </tr>
                                    </table>
                        <?php } ?>
                        </div>
                        <div class="item-ranking item-even">
                            <?php
                            $consult_hall_currency = $db->prepare("SELECT username,figure,promo_points FROM players WHERE rank < 6 AND fame_occult = ? ORDER BY promo_points + 0 DESC LIMIT 3,3");
                            $consult_hall_currency->bindValue(1, '0');
                            $consult_hall_currency->execute();

                            while ($result_hall_currency = $consult_hall_currency->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                <table>
                                    <tr>
                                        <td style="width:63px">
                                            <div class="boneco">
                                                <img alt="<?= $result_hall_currency['username']; ?>" src="<?= AVATARIMAGE; ?>figure=<?= $result_hall_currency['figure']; ?>&action=wav&direction=2&head_direction=2&gesture=std&size=n&img_format=png&frame=0&headonly=1">
                                            </div>
                                        </td>
                                        <td style="width:145px">
                                            <u><?= $result_hall_currency['username']; ?></u>
                                            <div class="points-value"><?= number_format($result_hall_currency['promo_points']); ?> pontos de promo&ccedil;&otilde;es</div>
                                        </td>
                                        <td>
                                            <div class="icon-arrow"></div>
                                        </td>
                                    </tr>
                                </table>
                    <?php } ?>
                    </div>
                    <div class="supertext" id="fPromocoes">
                        <center><a href="javascript:void();" onclick="toggleMenu('fPromocoes')">Como ganhar pontos de promo&ccedil;&atilde;o?</a></center>
                        <br />
                        Para adquirir estes pontos &eacute; necess&aacute;rio vencer uma promo&ccedil;&atilde;o elaborada pelo Lella.
                        <br />
                        <br />
                        Para saber se uma promo&ccedil;&atilde;o vale ou n&atilde;o para este sistemas, basta conferir se ela pertence a uma destas categorias: Competi&ccedil;&otilde;es, Promo&ccedil;&otilde;es ou Campanhas tem&aacute;ticas.
                    </div>
                    </div>
                            </div>

                            <div id="eventos">
                                <div class="header">
                                    <div style="float:left;margin:109px 0px 0px 174px"><a href="/news/1" target="_blank">Eventos</a></div>
                                </div>
                                <div class="ranking-list">
                                    <div class="item-ranking-main ">
                                        <?php
                                        $consult_hall_currency = $db->prepare("SELECT username,figure,event_points FROM players WHERE rank < 6 AND fame_occult = ? ORDER BY event_points + 0 DESC LIMIT 0,1");
                                        $consult_hall_currency->bindValue(1, '0');
                                        $consult_hall_currency->execute();

                                        while ($result_hall_currency = $consult_hall_currency->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                            <table>
                                                <tr>
                                                    <td style="width:63px">
                                                        <div class="boneco">
                                                            <img alt="<?= $result_hall_currency['username']; ?>" src="<?= AVATARIMAGE; ?>figure=<?= $result_hall_currency['figure']; ?>&action=wav&direction=2&head_direction=3&gesture=std&size=n&img_format=png&frame=0&headonly=0">
                                                        </div>
                                                    </td>
                                                    <td style="width:145px">
                                                        <u><?= $result_hall_currency['username']; ?></u>
                                                        <div class="points-value"><?= number_format($result_hall_currency['event_points']); ?> pontos de eventos</div>
                                                    </td>
                                                    <td>
                                                        <div class="icon-gold"></div>
                                                    </td>
                                                </tr>
                                            </table>
                                        <?php } ?>
                                    </div>
                                    <div class="item-ranking item-even">
                                        <?php
                                        $consult_hall_currency = $db->prepare("SELECT username,figure,event_points FROM players WHERE rank < 6 AND fame_occult = ? ORDER BY event_points + 0 DESC LIMIT 1,1");
                                        $consult_hall_currency->bindValue(1, '0');
                                        $consult_hall_currency->execute();

                                        while ($result_hall_currency = $consult_hall_currency->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                            <table>

                                                <tr>
                                                    <td style="width:63px">
                                                        <div class="boneco">
                                                            <img alt="<?= $result_hall_currency['username']; ?>" src="<?= AVATARIMAGE; ?>figure=<?= $result_hall_currency['figure']; ?>&action=wav&direction=2&head_direction=2&gesture=std&size=n&img_format=png&frame=0&headonly=1">
                                                        </div>
                                                    </td>
                                                    <td style="width:145px">
                                                        <u><?= $result_hall_currency['username']; ?></u>
                                                        <div class="points-value"><?= number_format($result_hall_currency['event_points']); ?> pontos de eventos</div>
                                                    </td>
                                                    <td>
                                                        <div class="icon-silver"></div>
                                                    </td>
                                                </tr>
                                            </table>
                                        <?php } ?>
                                    </div>
                                    <div class="item-ranking item-odd">
                                        <?php
                                        $consult_hall_currency = $db->prepare("SELECT username,figure,event_points FROM players WHERE rank < 6 AND fame_occult = ? ORDER BY event_points + 0 DESC LIMIT 2,1");
                                        $consult_hall_currency->bindValue(1, '0');
                                        $consult_hall_currency->execute();

                                        while ($result_hall_currency = $consult_hall_currency->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                            <table>
                                                <tr>
                                                    <td style="width:63px">
                                                        <div class="boneco">
                                                            <img alt="<?= $result_hall_currency['username']; ?>" src="<?= AVATARIMAGE; ?>figure=<?= $result_hall_currency['figure']; ?>&action=wav&direction=2&head_direction=2&gesture=std&size=n&img_format=png&frame=0&headonly=1">
                                                        </div>
                                                    </td>
                                                    <td style="width:145px">
                                                        <u><?= $result_hall_currency['username']; ?></u>
                                                        <div class="points-value"><?= number_format($result_hall_currency['event_points']); ?> pontos de eventos</div>
                                                    </td>
                                                    <td>
                                                        <div class="icon-bronze"></div>
                                                    </td>
                                                </tr>
                                            </table>
                                        <?php } ?>
                                    </div>
                                    <div class="item-ranking item-even">
                                        <?php
                                        $consult_hall_currency = $db->prepare("SELECT username,figure,event_points FROM players WHERE rank < 6 AND fame_occult = ? ORDER BY event_points + 0 DESC LIMIT 3,3");
                                        $consult_hall_currency->bindValue(1, '0');
                                        $consult_hall_currency->execute();

                                        while ($result_hall_currency = $consult_hall_currency->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                            <table>
                                                <tr>
                                                    <td style="width:63px">
                                                        <div class="boneco">
                                                            <img alt="<?= $result_hall_currency['username']; ?>" src="<?= AVATARIMAGE; ?>figure=<?= $result_hall_currency['figure']; ?>&action=wav&direction=2&head_direction=2&gesture=std&size=n&img_format=png&frame=0&headonly=1">
                                                        </div>
                                                    </td>
                                                    <td style="width:145px">
                                                        <u><?= $result_hall_currency['username']; ?></u>
                                                        <div class="points-value"><?= number_format($result_hall_currency['event_points']); ?> pontos de eventos</div>
                                                    </td>
                                                    <td>
                                                        <div class="icon-arrow"></div>
                                                    </td>
                                                </tr>
                                            </table>
                                    
                                <?php } ?>
                                </div>
                                </div>
                                <div class="supertext" id="fEventos">
                                    <center><a href="javascript:void();" onclick="toggleMenu('fEventos')">Como ganhar pontos de eventos?</a></center>
                                    <br />
                                    Para adquirir estes pontos &eacute; necess&aacute;rio vencer um evento proporcionado pela equipe, ap&oacute;s ter obtido todos os cem n&iacute;veis de emblemas GAMES.
                                    <br />
                                    <br />
                                    Lembrando que os pontos de eventos servem como moedas de trocas por Raros no Cat&aacute;logo!
                                </div>
                            </div>
                            <div id="presencas">
                                <div class="header">
                                    <div style="float:left;margin:109px 0px 0px 170px"><a href="/radio/equipe" target="_blank">Presen&ccedil;as</a></div>
                                </div>
                                <div class="ranking-list">
                                    <div class="item-ranking-main ">
                                        <?php
                                        $consult_hall_currency = $db->prepare("SELECT username,figure,vip_points FROM players WHERE rank < 6 AND fame_occult = ? ORDER BY vip_points + 0 DESC LIMIT 0,1");
                                        $consult_hall_currency->bindValue(1, '0');
                                        $consult_hall_currency->execute();

                                        while ($result_hall_currency = $consult_hall_currency->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                            <table>

                                                <tr>
                                                    <td style="width:63px">
                                                        <div class="boneco">
                                                            <img alt="<?= $result_hall_currency['username']; ?>" src="<?= AVATARIMAGE; ?>figure=<?= $result_hall_currency['figure']; ?>&action=wav&direction=2&head_direction=3&gesture=std&size=n&img_format=png&frame=0&headonly=0">
                                                        </div>
                                                    </td>
                                                    <td style="width:145px">
                                                        <u><?= $result_hall_currency['username']; ?></u>
                                                        <div class="points-value"><?= number_format($result_hall_currency['vip_points']); ?> diamantes</div>
                                                    </td>
                                                    <td>
                                                        <div class="icon-gold"></div>
                                                    </td>
                                                </tr>
                                            </table>
                                    </div>
                                <?php } ?>
                                <div class="item-ranking item-even">
                                    <?php
                                    $consult_hall_currency = $db->prepare("SELECT username,figure,vip_points FROM players WHERE rank < 6 AND fame_occult = ? ORDER BY vip_points + 0 DESC LIMIT 1,1");
                                    $consult_hall_currency->bindValue(1, '0');
                                    $consult_hall_currency->execute();

                                    while ($result_hall_currency = $consult_hall_currency->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                        <table>

                                            <tr>
                                                <td style="width:63px">
                                                    <div class="boneco">
                                                        <img alt="<?= $result_hall_currency['username']; ?>" src="<?= AVATARIMAGE; ?>figure=<?= $result_hall_currency['figure']; ?>&action=wav&direction=2&head_direction=2&gesture=std&size=n&img_format=png&frame=0&headonly=1">
                                                    </div>
                                                </td>
                                                <td style="width:145px">
                                                    <u><?= $result_hall_currency['username']; ?></u>
                                                    <div class="points-value"><?= number_format($result_hall_currency['vip_points']); ?> diamantes</div>
                                                </td>
                                                <td>
                                                    <div class="icon-silver"></div>
                                                </td>
                                            </tr>
                                        </table>
                                </div>
                            <?php } ?>
                            <div class="item-ranking item-odd">
                                <?php
                                $consult_hall_currency = $db->prepare("SELECT username,figure,vip_points FROM players WHERE rank < 6 AND fame_occult = ? ORDER BY vip_points + 0 DESC LIMIT 2,1");
                                $consult_hall_currency->bindValue(1, '0');
                                $consult_hall_currency->execute();

                                while ($result_hall_currency = $consult_hall_currency->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                    <table>
                                        <tr>
                                            <td style="width:63px">
                                                <div class="boneco">
                                                    <img alt="<?= $result_hall_currency['username']; ?>" src="<?= AVATARIMAGE; ?>figure=<?= $result_hall_currency['figure']; ?>&action=wav&direction=2&head_direction=2&gesture=std&size=n&img_format=png&frame=0&headonly=1">
                                                </div>
                                            </td>
                                            <td style="width:145px">
                                                <u><?= $result_hall_currency['username']; ?></u>
                                                <div class="points-value"><?= number_format($result_hall_currency['vip_points']); ?> diamantes</div>
                                            </td>
                                            <td>
                                                <div class="icon-bronze"></div>
                                            </td>
                                        </tr>
                                    </table>
                            </div>
                        <?php } ?>
                        <?php
                        $consult_hall_currency = $db->prepare("SELECT username,figure,vip_points FROM players WHERE rank < 6 AND fame_occult = ? ORDER BY vip_points + 0 DESC LIMIT 3,3");
                        $consult_hall_currency->bindValue(1, '0');
                        $consult_hall_currency->execute();

                        while ($result_hall_currency = $consult_hall_currency->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                            <div class="item-ranking item-even">

                                <table>
                                    <tr>
                                        <td style="width:63px">
                                            <div class="boneco">
                                                <img alt="<?= $result_hall_currency['username']; ?>" src="<?= AVATARIMAGE; ?>figure=<?= $result_hall_currency['figure']; ?>&action=wav&direction=2&head_direction=2&gesture=std&size=n&img_format=png&frame=0&headonly=1">
                                            </div>
                                        </td>
                                        <td style="width:145px">
                                            <u><?= $result_hall_currency['username']; ?></u>
                                            <div class="points-value"><?= number_format($result_hall_currency['vip_points']); ?> diamantes</div>
                                        </td>
                                        <td>
                                            <div class="icon-arrow"></div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        <?php } ?>
                                </div>
                                <div class="supertext" id="fPresencas">
                                    <center><a href="javascript:void();" onclick="toggleMenu('fPresencas')">Como ganhar pontos de presen&ccedil;as?</a></center>
                                    <br />
                                    Para adquirir estes pontos, basta ficar antenado Ã s programa&ccedil;&otilde;es da R&aacute;dio Lella e inserir o c&oacute;digo gerado pelo locutor no Bot&atilde;o de Marcar Presen&ccedil;a, liberado no menu do site durante cada programa&ccedil;&atilde;o.
                                    <br />
                                    <br />
                                    Por&eacute;m fique atento, o bot&atilde;o s&oacute; ficar&aacute; ativo por 5 minutos.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script type="text/javascript">
        document.observe('dom:loaded', function() {
            CurrentRoomEvents.init();
        });
    </script>
</div>
<script type="text/javascript">
    if (!$(document.body).hasClassName('process-template')) {
        Rounder.init();
    }
</script>
<script type="text/javascript">
    HabboView.run();
</script>

<!--[if lt IE 7]>
            <script type="text/javascript">
                Pngfix.doPngImageFix();
            </script>
        <![endif]-->
<?php
$Template->AddTemplate('others', 'bottom');
?>
