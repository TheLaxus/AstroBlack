<?php
require_once('../../../global.php');

$Hotel::Manutention($user['rank']);
$Functions::Session('disconnected');

$Template->SetParam('page_id', 'password');
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
        <form method="post" class="form-change-password">
        <div class="form-warns"></div>


            <div id="content-box" style="height:390px">
                <div class="title-box png20">
                    <div class="title">CONFIGURAÇÕES DE SENHA</div>
                </div>

                <div class="png20">
                    <label for="old-mail">Senha atual</label>
                <div class="col-input-separator flex-column mr-top-none flex margin-bottom-minm">
                    <input type="password" name="currentpassword" id="currentpassword" class="currentpassword " placeholder="********"/>
                    <div class="error-input-warn"></div>
                    <div class="desc" style="margin: 0 0 20px 0">Escreva senha usada na conta atualmente</div>
                </div>
                    <div class="line"></div>

                <label for="new-mail">Nova senha</label>
                <div class="col-input-separator flex-column mr-top-none flex margin-bottom-minm">
                    <input type="password" name="password" id="password" placeholder="********"/>
                    <div class="error-input-warn"></div>
                    <div class="desc">Utilize uma senha grande e segura, nunca passe ela a niguém! Minímo 6 caracteres.</div>
                </div>

                
                <button type="submit" class="btn purple save" style="padding:10px">Salvar prefências</button>                                        
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
            <a href="/preferencias/email" id="settings-navigation-box">
                <div class="png20">
                    <i class="far fa-envelope icon"></i>
                    <div class="settings-title">CONFIGURAÇÕES DE E-MAIL</div>
                    <div class="settings-desc">Altere todos os dados relativos ao email</div>
                </div>
                <div class="clear"></div>
            </a>
            <a href="/preferencias/password" id="settings-navigation-box" class="selected">
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