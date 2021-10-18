<?php 
	require_once('../../../global.php');

	$Hotel::Manutention($user['rank']);
	$Functions::Session('disconnected');

	$Template->SetParam('page_id', 'error');
	$Template->SetParam('page_name', 'Erro');
	$Template->SetParam('page_title', 'Erro - ' . HOTELNAME);
	$Template->SetParam('page_description', '');
	$Template->SetParam('page_image', URL . '/image.png');

	$Template->AddTemplate('others', 'head');
?>
<div class="container">
		<div class="row">
			<div class="col-8">
            <div id="content-box" class="profile">
                <div class="bg"></div>
                <div class="overlay">
                    
                    <div class="username">Página não encontrada!</div>
                    <div class="motto">Desculpe, mas a página que você estava procurando não foi encontrada.</p> 
                    <img class="error-image" src="https://www.hablush.com/skins/lush-light/images/placeholders/404_frank.png" />
<p class="error-text">Use o botão <b>'Voltar ao inicio'</b> para voltar a página inicial do site.</p>

                <a href="/" class="btn purple error">Voltar ao inicio⠀⠀<img src="https://2.bp.blogspot.com/-a9e2N1_yJ8I/XK0oYoYMACI/AAAAAAABOsg/WSNqdOUb7cIwMAfKnQ-UT6HhidIEHT7RwCKgBGAs/s1600/Image%2B1846.png" style="position:absolute;margin-top:-3px;margin-left:0px;z-index:1"></a><br><br></p>

            </div>
         </div>
    </div>
</div>
</div>



<?php 
	$Template->AddTemplate('others', 'bottom'); 
?>
