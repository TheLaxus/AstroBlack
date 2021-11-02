<?php
require_once('../../../global.php');

//$Hotel::Manutention($user['rank']);
//$Functions::Session('disconnected');
if (isset($_GET['reset_key']) && !empty($_GET['reset_key'])) {
	$sql = $db->prepare('SELECT cms_reset_password.id, cms_reset_password.player_id, players.username, cms_reset_password.enabled FROM cms_reset_password 
					  INNER JOIN players ON cms_reset_password.player_id=players.id
					  WHERE reset_key = :reset_key
					  ORDER BY id DESC LIMIT 1');
	$sql->bindParam(':reset_key', $_GET['reset_key']);
	$sql->execute();

	$valido = $sql->rowCount() > 0;

	if ($valido) {
		$sql = $sql->fetch();
		$valido = $sql['enabled'] == '1' ? true : false;
	}
}

$Template->SetParam('page_id', 'reset-password');
$Template->SetParam('page_name', 'Recuperar senha');
$Template->SetParam('page_title', 'Recuperar senha - ' . HOTELNAME);
$Template->SetParam('page_description', '');
$Template->SetParam('page_image', URL . '/image.png');

$Template->AddTemplate('others', 'head');
?>
<div class="container">
		<div class="row">
        <link type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" rel="stylesheet">
        <link type="text/css" href="css/settings.css" rel="stylesheet">

        
        <div class="col-8">
        <form method="post" class="form-reset-password">
		<div class="form-warns"></div>

		<input type="hidden" id="reset_key" name="reset_key" value="<?= $_GET['reset_key'] ?>">


            <div id="content-box" style="height:390px">
                <div class="title-box png20">
                    <div class="title">RECUPERE SUA CONTA!</div>
                </div>

                <div class="png20">
                    <label for="old-mail">Digite sua nova senha</label>
                <div class="col-input-separator flex-column mr-top-none flex margin-bottom-minm">
                    <input type="password" name="newpassword_reset" id="currentpassword" class="currentpassword " placeholder="********"/>
                    <div class="error-input-warn"></div>
                    <div class="desc" style="margin: 0 0 20px 0">Utilize uma senha grande e segura, nunca passe ela a niguém! Minímo 6 caracteres.</div>
                </div>
                    <div class="line"></div>

                <label for="new-mail">Confirme sua senha nova</label>
                <div class="col-input-separator flex-column mr-top-none flex margin-bottom-minm">
                    <input type="password" name="repeatnewpassword" id="password" placeholder="********"/>
                    <div class="error-input-warn"></div>
                    <div class="desc">Confirma a senha digitada no primeiro campo.</div>
                </div>
			</div>
                
                <button type="submit" class="btn purple save" style="padding:10px">Salvar</button>                                        
                    </form>
                </div>
            </div>
        </div>


        <?php
        $Template->AddTemplate('others', 'bottom');
        ?>