<?php
require_once('../../../global.php');

$Hotel::Manutention($user['rank']);
$Functions::Session('disconnected');

$Template->SetParam('page_id', 'colab');
$Template->SetParam('page_name', 'Colaboração');
$Template->SetParam('page_title', 'Colaboração - ' . HOTELNAME);
$Template->SetParam('page_description', '');
$Template->SetParam('page_image', URL . '/image.png');

$Template->AddTemplate('others', 'head');
?>
<div class="container">
    <div class="column">
        <div class="row">
            <div class="col-6">
                <div id="content-box">
                    <div class="title-box png20">
                        <div class="title">Embaixadores</div>
                    </div>
                    <?php
                    $consult_staff_role = $db->prepare("SELECT id,username,figure,online,motto,staff_function,last_online FROM players WHERE rank = ? AND staff_occult = ?");
                    $consult_staff_role->bindValue(1, '3');
                    $consult_staff_role->bindValue(2, '0');
                    $consult_staff_role->execute();

                    if ($consult_staff_role->rowCount() > 0) {
                        while ($result_staff_role = $consult_staff_role->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                            <div id="content-box" class="profile" style="height:82px;margin-bottom:4px">
                                <div class="bg" style="height:82px"></div>
                                <div class="overlay">
                                    <div style="background:url('<?= AVATARIMAGE . $result_staff_role['figure']; ?>&action=sml&direction=2&head_direction=2&gesture=sml&size=1&img_format=gif');margin:-10px 0px 0px 0px;float:left;height:91px;width:64px"></div>

                                    <font style="font-size:15px;top:16px;left:1px" class="username"><?= $result_staff_role['username'] ?></font>
                                    </b>
                                    <?php if ($result_staff_role['online'] == 1) { ?>
                                        <img style="float: right;padding:14px;" src='<?= CDN; ?>/assets/img/online.gif'><br><br>
                                    <?php } else { ?>
                                        <img style="float: right;padding:14px;" src='<?= CDN; ?>/assets/img/offline.gif'><br><br>
                                    <?php } ?>
                                    <div style="width:100%;max-width:76%;overflow: hidden;white-space: nowrap;font-size:11px;top:-2px;left:1px;">
                                    <?php if (!empty($result_staff_role['staff_function'])) { ?>
                                        <b>Função:</b> <?= $result_staff_role['staff_function'] ?><br />
                                    <?php } else { ?>
                                        <b>Função:</b> Dar suporte aos usuários.<br />
                                    <?php } ?>                                        
                                    <b>Última conexão:</b> <?= Functions::userSettingsById('hide_last_online', $result_staff_role['id']) == '0' ? date("d/m/Y H:i", $result_staff_role['last_online']) : '--/--/----' ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                    } else { ?>
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
            <div class="col-6">
                <div id="content-box">
                    <img src="https://images.habbo.com/c_images/album1584/AMB.png" style="position:absolute;margin-top:13px;margin-left:480px;z-index:0">
                    <div class="title-box png20">
                        <div class="title">Quem somos?</div>
                    </div>
                    <div style="padding:16px">
                        A Colaboração está sempre à sua disposição em prol de ajudar o máximo de usuários possíveis, e em quaisquer tipo de desafio acontecido dentro da comunidade.
                        <br><br>Os membros da colaboração possuem um Emblema especial como identificação. Ele pode ser visualizado acima, então caso alguém se passe por staff, tome bastante cuidado!
                        <br>
                    </div>
                </div>
            </div>

            <?php
            $Template->AddTemplate('others', 'bottom');
            ?>
