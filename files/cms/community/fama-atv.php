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
<div class="container">
    <div class="column">
        <div class="row">
            <div class="col-6">
                <a href="hall/economy" id="settings-navigation-box">
                    <div class="png20">
                        <i class="far fa-coins icon"></i>
                        <div class="settings-title">HALL DE ECONOMIA</div>
                        <div class="settings-desc">Os mais ricos de todo o hotel se encontram aqui</div>
                    </div>
                    <div class="clear"></div>
                </a>
            </div>

            <div class="col-6">
                <a id="settings-navigation-box" class="selected">
                    <div class="png20">
                        <i class="far fa-crown icon"></i>
                        <div class="settings-title">HALL DE ATIVIDADES</div>
                        <div class="settings-desc">Destacando os mais habilidosos e merecedores do hotel</div>
                    </div>
                    <div class="clear"></div>
                </a>
            </div>
        </div>
    </div>
  <div class="column">
  <div class="row">
            <div class="col-4">
				<div id="content-box">
					<div class="title-box png20">
                        <div class="title">Top eventos</div>
					</div>

                    <?php
                        $consult_hall_currency = $db->prepare("SELECT username,figure,event_points FROM players WHERE rank < 6 AND fame_occult = ? ORDER BY event_points + 0 DESC LIMIT 10");
                        $consult_hall_currency->bindValue(1, '0');
                        $consult_hall_currency->execute();

                        if ($consult_hall_currency->rowCount() > 0) {
                            while ($result_hall_currency = $consult_hall_currency->fetch(PDO::FETCH_ASSOC)) {
                    ?>
<div id="content-box" class="profile" style="height:82px;margin-bottom:4px">
                <div class="bg" style="height:82px"></div>
                <div class="overlay">
                <div style="background:url(<?= AVATARIMAGE . $result_hall_currency['figure'];?>&action=sml&direction=2&head_direction=2&gesture=sml&size=1&img_format=gif);margin:-10px 0px 0px 0px;float:left;height:91px;width:64px"></div>            
                <font style="font-size:15px;top:16px;left:1px" class="username"><?= $result_hall_currency['username'];?></font>
                                        </b>
                                        <div class="motto" style="font-size:11px;top:17px;left:1px">
                                        <b><?= number_format($result_hall_currency['event_points']);?></b> eventos<br />
                                        </div>
</div>
</div>
            
<?php } } else { ?>


                <div id="content-box" class="profile" style="height:82px;margin-bottom:4px">
                <div class="bg" style="height:82px"></div>
                <div class="overlay">
                    <div class="username" style="font-size:14px;top:30px">
                                    Esta categoria encontra-se sem membros.
                    </div>
                                </div>
                                </div>
                <?php } ?>              
            </div>
            </div>

            <div class="col-4">
				<div id="content-box">
					<div class="title-box png20">
                        <div class="title">Top promoções</div>
					</div>
                    <?php
                        $consult_hall_currency = $db->prepare("SELECT username,figure,promo_points FROM players WHERE rank < 6 AND fame_occult = ? ORDER BY promo_points + 0 DESC LIMIT 10");
                        $consult_hall_currency->bindValue(1, '0');
                        $consult_hall_currency->execute();

                        if ($consult_hall_currency->rowCount() > 0) {

                            while ($result_hall_currency = $consult_hall_currency->fetch(PDO::FETCH_ASSOC)) {
                    ?>
<div id="content-box" class="profile" style="height:82px;margin-bottom:4px">
                <div class="bg" style="height:82px"></div>
                <div class="overlay">
                <div style="background:url(<?= AVATARIMAGE . $result_hall_currency['figure'];?>&action=sml&direction=2&head_direction=2&gesture=sml&size=1&img_format=gif);margin:-10px 0px 0px 0px;float:left;height:91px;width:64px"></div>            
                <font style="font-size:15px;top:16px;left:1px" class="username"><?= $result_hall_currency['username'];?></font>
                                        </b>
                                        <div class="motto" style="font-size:11px;top:17px;left:1px">
                                        <b><?= number_format($result_hall_currency['promo_points']);?></b> promoções<br />
                                        </div>
</div>
</div>
       
<?php } } else { ?>
                <div id="content-box" class="profile" style="height:82px;margin-bottom:4px">
                <div class="bg" style="height:82px"></div>
                <div class="overlay">
                    <div class="username" style="font-size:14px;top:30px">
                                    Esta categoria encontra-se sem membros.
                    </div>
                                </div>
                                </div>
                <?php } ?>    
            </div>
            </div>

<?php
$Template->AddTemplate('others', 'bottom');
?>
