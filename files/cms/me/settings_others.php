<?php
require_once('../../../global.php');

$Hotel::Manutention($user['rank']);
$Functions::Session('disconnected');

$Template->SetParam('page_id', 'preferencias');
$Template->SetParam('page_name', 'Configurações');
$Template->SetParam('page_title', 'Configurações - ' . HOTELNAME);
$Template->SetParam('page_description', '');
$Template->SetParam('page_image', URL . '/image.png');

$Template->AddTemplate('others', 'head');
?>


<div class="container">
		<div class="row">
        <link type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" rel="stylesheet">
        <link type="text/css" href="css/settings.css" rel="stylesheet">

        <style> 
        .desc {
  font: 500 12px "Poppins", "Roboto", sans-serif;
  color: rgba(202, 202, 202, 0.6);
  margin: 0 0 40px 0;
  display: inline-block;
}
</style>

        <div class="col-8">
        <form method="post" class="form-others-settings">
        <div class="form-warns"></div>

            <div id="content-box" style="height:890px">
                <div class="title-box png20">
                    <div class="title">CONFIGURAÇÕES DE PRIVACIDADE</div>
                </div>

                <div class="png20">
                <?php


                            $usersettings = $db->prepare('SELECT allow_friend_requests, hide_online, hide_last_online, allow_mimic, allow_follow, allow_trade, disable_whisper, allow_sex FROM player_settings WHERE player_id = ?');
                            $usersettings->bindValue(1, User::userData('id'));
                            $usersettings->execute();
                            $usersetting = $usersettings->fetch();

                             
                             $clientFPS = $db->prepare("SELECT * FROM cms_clients WHERE user_id = ?");
                             $clientFPS->bindValue(1, User::userData('id'));
                             $clientFPS->execute();
                             $showFPS = $clientFPS->fetch(PDO::FETCH_ASSOC);
                            ?>

                    <label for="old-mail">Missão</label>
                    <div class="col-input-separator flex-column mr-top-none flex margin-bottom-minm">
                        <input type="text" name="motto" size="40" maxlength="40" value="<?= Functions::Filter('XSS', User::userData('motto')); ?>" id="avatarmotto">
                        <div class="error-input-warn"></div>
                        <div class="desc" style="margin: 0 0 20px 0">Sua missão atual que aparecerá no seu perfil.</div>
                    </div>

                    <div class="line"></div>

                <label>Veersão da client</label>
                        <div class="desc">Escolha conforme a sua performance do PC</div>
                        <div class="btnset">
                <select class="form-control" name="version">
                                        <option value="24" <?= $showFPS['version'] == '24' ? 'selected' : '' ?>>24 FPS (NORMAL)</option>
                                        <option value="60" <?= $showFPS['version'] == '60' ? 'selected' : '' ?>>60 FPS (MELHORADA)</option>
                                    </select>
                                    </div>

                        <label>Estado online?</label>
                        <div class="desc">Permitir que outros usuários vejam quando você estiver online? </div>
                        <div class="optionset">
                        <input type="checkbox" name="online" <?= $usersetting['hide_online'] == '0' ? 'checked' : '' ?> data-toggle="toggle" data-size="sm">
                       </div>

                        <label>Último login</label>
                        <div class="desc">Permitir que outros usuários vejam a última vez que você entrou no hotel?</div>
                        <div class="optionset">
                        <input type="checkbox" name="last_online" <?= $usersetting['hide_last_online'] == '0' ? 'checked' : '' ?> value="<?= $usersetting['hide_last_online']?>" data-toggle="toggle" data-size="sm">
                        </div>


                        <label>Opção de seguir</label>
                        <div class="desc">Todos podem seguir?</div>
                        <div class="optionset">
                        <input type="checkbox" name="seguir" <?= $usersetting['allow_follow'] == '1' ? 'checked' : '' ?> data-toggle="toggle" data-size="sm">
                        </div>

                        <label>Copiar visual</label>
                        <div class="desc">Permitir que outros usuários possam copiar o seu visual? (comando <i>:copy</i>)</div>
                        <div class="optionset">
                        <input type="checkbox" name="copy" <?= $usersetting['allow_mimic'] == '1' ? 'checked' : '' ?> data-toggle="toggle" data-size="sm">
                        </div>

                        <label>Negociações</label>
                        <div class="desc">Permitir que outros usuários possam negociar com você?</div>
                        <div class="optionset">
                        <input type="checkbox" name="trade" <?= $usersetting['allow_trade'] == '1' ? 'checked' : '' ?> data-toggle="toggle" data-size="sm">
                        </div>

                        <label>Sussurros</label>
                        <div class="desc">Permitir que outros usuários sussurrem com você?</div>
                        <div class="optionset">
                        <input type="checkbox" name="sussurros" <?= $usersetting['disable_whisper'] == '0' ? 'checked' : '' ?> data-toggle="toggle" data-size="sm">
                        </div>

                        <label>Sexo</label>
                        <div class="desc">Permitir que outros usuários usem o comando <i>:sexo</i> com você?</div>
                        <div class="optionset">
                        <input type="checkbox" name="allow_sex" <?= $usersetting['allow_sex'] == '1' ? 'checked' : '' ?> data-toggle="toggle" data-size="sm">
                                
                        </div>
                        <button type="submit" class="btn purple save" style="padding:10px">Salvar prefências</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-4">
            <a href="/settings" id="settings-navigation-box" class="selected">
                <div class="png20">
                    <i class="far fa-cog icon"></i>
                    <div class="settings-title">CONFIGURAÇÕES DE PRIVACIDADE</div>
                    <div class="settings-desc">Tudo relacionado a sua privacidade</div>
                </div>
                <div class="clear"></div>
            </a>
            <a href="/settings/email" id="settings-navigation-box">
                <div class="png20">
                    <i class="far fa-envelope icon"></i>
                    <div class="settings-title">CONFIGURAÇÕES DE E-MAIL</div>
                    <div class="settings-desc">Altere todos os dados relativos ao email</div>
                </div>
                <div class="clear"></div>
            </a>
            <a href="/settings/password" id="settings-navigation-box">
                <div class="png20">
                    <i class="far fa-lock-open-alt icon"></i>
                    <div class="settings-title">CONFIGURAÇÕES DE SENHA</div>
                    <div class="settings-desc">Altere ou reforçe a sua senha</div>
                </div>
                <div class="clear"></div>
            </a>
            <a href="settings/security" id="settings-navigation-box">
                <div class="png20">
                    <i class="far fa-user-lock icon"></i>
                    <div class="settings-title">PROTEÇÃO DA CONTA</div>
                    <div class="settings-desc">Coloque a sua conta mais segura</div>
                </div>
                <div class="clear"></div>
            </a>
        </div>



        <script type="text/javascript" src="<?= CDN; ?>/assets/js/block_reform.js?<?= TIME; ?>"></script>

                <?php
                $Template->AddTemplate('others', 'bottom');
                ?>