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
    <script type="text/javascript" src="<?= CDN; ?>/assets/js/main.js?<?= TIME; ?>"></script>

    <script type="text/javascript" src="<?= CDN; ?>/assets/js/ajax.js?<?= TIME; ?>"></script>

<div class="container">
		<div class="row">
        <link type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" rel="stylesheet">
        <link type="text/css" href="css/settings.css" rel="stylesheet">

        
        <div class="col-8">
        <form method="post" class="form-change-email">
        <div class="form-warns"></div>
            <div id="content-box" style="height:390px">
                <div class="title-box png20">
                    <div class="title">CONFIGURAÇÕES DE E-MAIL</div>
                </div>

                <div class="png20">
                        
                    <label for="old-mail">Senha atual</label>
                    <div class="col-input-separator flex-column mr-top-none flex margin-bottom-minm">
                        <input type="password" name="currentPassword" class="currentpassword" autocomplete="off" required/>
                        <div class="error-input-warn"></div>
                        <div class="desc" style="margin: 0 0 20px 0">Digite sua senha esta atualmente em uso na sua conta</div>
                    </div>
                
                    <div class="line"></div>

                <label for="new-mail">Novo e-mail</label>
                <div class="col-input-separator flex-column mr-top-none flex margin-bottom-minm">
                    <input type="email" name="email" id="email" size="32" maxlength="48" required autocomplete="off"/>
                    <div class="error-input-warn"></div>
                    <div class="desc">Utilize um e-mail que você use verdadeiramente!</div>
                </div>
                        <button type="submit" class="btn purple save" style="padding:10px">Salvar prefências</button>                                        
                    </form>
                </div>
            </div>
        </div>

        <div class="col-4">
            <a href="/settings" id="settings-navigation-box">
                <div class="png20">
                    <i class="far fa-cog icon"></i>
                    <div class="settings-title">CONFIGURAÇÕES DE PRIVACIDADE</div>
                    <div class="settings-desc">Tudo relacionado a sua privacidade</div>
                </div>
                <div class="clear"></div>
            </a>
            <a href="/settings/email" id="settings-navigation-box" class="selected">
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