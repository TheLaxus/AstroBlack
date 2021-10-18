<?php
require_once('../../../global.php');

$Hotel::Manutention($user['rank']);
$Functions::Session('disconnected');

$Template->SetParam('page_id', 'settings');
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

        
        <div class="col-8">
        <div class="alert success">Configurações salvas com sucesso!</div>

            <div id="content-box" style="height:390px">
                <div class="title-box png20">
                    <div class="title">CONFIGURAÇÕES DE E-MAIL</div>
                </div>

                <div class="png20">
                <?php User::editSettingsAccount() ?>
                    <form action="" method="post">
                    <label for="old-mail">E-mail atual</label>
                    <input type="email" size="32" maxlength="32" name="currentemail" value="<?= User::userData('email'); ?>" class="currentemail " required/>
                <div class="desc" style="margin: 0 0 20px 0">Escreva o e-mail que esta atualmente em uso na sua conta</div>
                <div class="line"></div>

                <label for="new-mail">Novo E-mail</label>
                <input type="email" name="email" id="email" size="32" maxlength="48" required/>
                <div class="desc">Utilize um e-mail que você use verdadeiramente!</div>

                <input type="submit" class="btn purple save" name="saveEmail" value="Salvar configurações" id="add-tag-button"></input>
                                        
                    </form>
                </div>
            </div>
        </div>

        <div class="col-4">
            <a href="/preferencias" id="settings-navigation-box">
                <div class="png20">
                    <i class="far fa-cog icon"></i>
                    <div class="settings-title">CONFIGURAÇÕES DE PRIVACIDADE</div>
                    <div class="settings-desc">Tudo relacionado a sua privacidade</div>
                </div>
                <div class="clear"></div>
            </a>
            <a href="/preferencias/email" id="settings-navigation-box" class="selected">
                <div class="png20">
                    <i class="far fa-envelope icon"></i>
                    <div class="settings-title">CONFIGURAÇÕES DE E-MAIL</div>
                    <div class="settings-desc">Altere todos os dados relativos ao email</div>
                </div>
                <div class="clear"></div>
            </a>
            <a href="/preferencias/password" id="settings-navigation-box">
                <div class="png20">
                    <i class="far fa-lock-open-alt icon"></i>
                    <div class="settings-title">CONFIGURAÇÕES DE SENHA</div>
                    <div class="settings-desc">Altere ou reforçe a sua senha</div>
                </div>
                <div class="clear"></div>
            </a>
            <a href="settings_security" id="settings-navigation-box">
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