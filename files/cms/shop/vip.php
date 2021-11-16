<?php
require_once('../../../global.php');

$Hotel::Manutention($user['rank']);
$Functions::Session('disconnected');

$Template->SetParam('page_id', 'vip');
$Template->SetParam('page_name', 'VIP');
$Template->SetParam('page_title', 'VIP - ' . HOTELNAME);
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
                        <div class="title">Atenção</div>
					</div>
<div id="content-box" class="profile" style="height:152px;padding:0px;margin-top:-20px;font-size:13px">       
<div style="padding:16px">
Aqui você encontra todos os métodos oficiais para a aquisição de produtos do Lella. Adquirir qualquer produto do Lella através de meios não oficiais ocasionará o banimento permanente de todas as contas envolvidas.  
<p>
Em caso de dúvidas ou problema com alguma compra, entre em contato com o suporte pelo <b>whatsapp</b> ou <b>discord</b>.
</div>                                 
</div>
</div>
</div>

  <div class="col-6">
				<div id="content-box">
					<div class="title-box png20">
                        <div class="title">Confirmar pagamento</div>
                        
					</div>

                    <div id="content-box" class="profile" style="height:152px;padding:0px;margin-top:-20px;font-size:13px">       
<div style="padding:16px">
No fim de realizar o seu pagamento, lembre-se de <b>entrar em contato com o suporte para validar
    o seu registo de pagamento</b><br> e assim receber o seu produto.<br><br>

        <button onclick="window.open('https://api.whatsapp.com/send?phone=89981326247&text=Ol%C3%A1%2C%20gostaria%20de%20confirmar%20o%20meu%20pagamento%20na%20loja%20do%20Lella%20Hotel', '_blank')" class="btn green" class="button" style="position:absolute;height:45px;border-radius:3px;">
        <i class="fab fa-whatsapp"></i>  Confirmar pagamento no whatsapp
								</button>
</div>   
</div>
</div>
</div>
</div>
<div class="row">
			<div class="col-3">
				<div id="content-box">
					<div class="title-box png20" style="background-color:#bb85c7;border-radius:4px;color:#fff;">
                        <div class="title">VIP ROSA <small>(15 dias)</small></div>
					</div>


                                <div id="content-box" class="profile" style="height:82px;margin-bottom:4px">
                <div class="bg" style="height:82px"></div>
                <div class="overlay">
                    <div class="username" style="font-size:14px;top:30px">
                                    Pacote de R$10,00.
                    </div>
                    
                                </div>
                                </div>

                                <div class="margin-top-min">
								<button id="vip15" data-modal="vip15" class="btn purple big next-register" class="button" name="send_form" style="width: 100%; height: 45px;">
                                Benificios
								</button>

            <div class="modal-container" id="vip15" data-modal="vip15">
				<div id="modal-content">
					<div id="news-modal">
						<div class="col-12">
							<div id="content-box" style="height:100%;">
								<div class="title-box png20">
									<div class="title"> Benificios VIP ROSA <small>(15 dias)</small></div>
									<button type="ok" class="close close-modal" style="position:relative;top:-20px;float:right;right:14px"></button>

									<div style="padding:16px">
                                    <h5>Atualmente, o Plano Rosa apresenta as seguintes vantagens listadas abaixo:</h5>
<ul style="font-family: sans-serif;">
<li><i class="fas fa-arrow-right"></i> Capacidade de entrar em quartos lotados.</li>
<li><i class="fas fa-arrow-right"></i> Menor tempo de mute por flood.</li>
<li><i class="fas fa-arrow-right"></i> Adicionar até 5.000 de amigos.</li>
<li><i class="fas fa-arrow-right"></i> Emblema exclusivo de identificação VIP.</li>
<li><i class="fas fa-arrow-right"></i> Loja de Mobis exclusiva.</li>
<li><i class="fas fa-arrow-right"></i> Loja de Raros exclusiva.</li>
<li><i class="fas fa-arrow-right"></i> Loja de Emblemas exclusiva.</li>
<li><i class="fas fa-arrow-right"></i> Balão de fala exclusivo.</li>
<li><i class="fas fa-arrow-right"></i> Emblema de identificação de cada plano comprado.</li>
<li><i class="fas fa-arrow-right"></i> Efeito com emblema VIP (em breve)</li>
<li><i class="fas fa-arrow-right"></i> Mais balões de falas exclusivos (em breve)</li>
<br>
<li><i class="fas fa-arrow-right"></i> Comando <b>:tele</b> (Ativa o teletransporte).</li>
<li><i class="fas fa-arrow-right"></i> Comando <b>:fastwalk</b> (Andar rápido).</li>
<li><i class="fas fa-arrow-right"></i> Comando <b>:tp</b> (Teletransporte um usuário).</li>
<li><i class="fas fa-arrow-right"></i> Comando <b>:poll</b> (Crie enquetes).</li>
<li><i class="fas fa-arrow-right"></i> Comando <b>:spull</b> (Puxe um usuário).</li>
<li><i class="fas fa-arrow-right"></i> Comando <b>:flagme</b> (Troque seu nome de usuário).</li>
<li><i class="fas fa-arrow-right"></i> Comando <b>:gotroom</b> (Vá a um quarto digitando o ID).</li>
<br>
<li> Além de todos os benefícios citados acima, todos os usuários VIP ganham <b>40 diamantes</b> à cada 30 minutos online!</li>
<br>
<b style="font-size: 13px; color: white"><i class="fas fa-clipboard-check"></i> Contrate o Plano Rosa e adquira:</b>
<li><i class="fas fa-arrow-right"></i> 15 dias de VIP</li>
<li><i class="fas fa-arrow-right"></i> Serpa Rosa</li>
<li><i class="fas fa-arrow-right"></i> 500 diamantes</li>
<li><i class="fas fa-arrow-right"></i> 500 conquistas</li>
<li><i class="fas fa-arrow-right"></i> 30 duckets</li>
<li><i class="fas fa-arrow-right"></i> Emblema VIP</li>
</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
</br>
                                <button onclick="window.open('https://picpay.me/paulo.oliveira.silva49/10.0', '_blank')" class="btn green big next-register" class="button" style="width: 100%; height: 45px;border-radius:0px">
                                Picpay
								</button>

                                <button onclick="window.open('https://nubank.com.br/pagar/8wpi7/BWA02dyhQs', '_blank')" class="btn blue big next-register" class="button" style="width: 100%; height: 45px;background-color: #62818a;border-radius:0px">
                                Pix
                                <span style="position: absolute; color: transparent;">90224bbc-cac5-4b47-84db-ea6fdf15d5e3</span>
								</button>

                                <button onclick="window.open('https://api.whatsapp.com/send?phone=89981326247&text=Ol%C3%A1%2C%20gostaria%20de%20gerar%20um%20boleto%20para%20efetuar%20a%20compra%20do%20VIP%20no%20Lella', '_blank')" class="btn gray big next-register" class="button" style="width: 100%; height: 45px;background-color: #898989;border-radius:0px ">
                                Boleto
								</button>
                               
                                <button onclick="window.open('https://mpago.la/1VvKqiL', '_blank')" class="btn gray big next-register" class="button" style="width: 100%; height: 45px;background-color: #49aae3;border-radius:0px ">
                                MercadoPago
								</button>
<ul>                
                            </ul>
							</div>        
            </div>
            </div>

			<div class="col-3">
				<div id="content-box">
					<div class="title-box png20" style="background-color:#debc5f;border-radius:4px;color:#fff;">
                        <div class="title">VIP AMARELO <small>(1 mês)</small></div>
					</div>
<div id="content-box" class="profile" style="height:82px;margin-bottom:4px">
                <div class="bg" style="height:82px"></div>
                <div class="overlay">
                    <div class="username" style="font-size:14px;top:30px">
                                    Pacote de R$20,00.
                    </div>
                    
                                </div>
                                </div>

                                <div class="margin-top-min">
								<button id="vip30" data-modal="vip30" class="btn purple big next-register" class="button" name="send_form" style="width: 100%; height: 45px;">
                                Benificios
								</button>

            <div class="modal-container" id="vip30" data-modal="vip30">
				<div id="modal-content">
					<div id="news-modal">
						<div class="col-12">
							<div id="content-box" style="height:100%;">
								<div class="title-box png20">
									<div class="title"> Benificios VIP AMARELO <small>(1 mês)</small></div>
									<button type="ok" class="close close-modal" style="position:relative;top:-20px;float:right;right:14px"></button>

									<div style="padding:16px">
                                    <h5>Atualmente, o Plano Amerelo apresenta as seguintes vantagens listadas abaixo:</h5>
<ul style="font-family: sans-serif;">
<li><i class="fas fa-arrow-right"></i> Capacidade de entrar em quartos lotados.</li>
<li><i class="fas fa-arrow-right"></i> Menor tempo de mute por flood.</li>
<li><i class="fas fa-arrow-right"></i> Adicionar até 5.000 de amigos.</li>
<li><i class="fas fa-arrow-right"></i> Emblema exclusivo de identificação VIP.</li>
<li><i class="fas fa-arrow-right"></i> Loja de Mobis exclusiva.</li>
<li><i class="fas fa-arrow-right"></i> Loja de Raros exclusiva.</li>
<li><i class="fas fa-arrow-right"></i> Loja de Emblemas exclusiva.</li>
<li><i class="fas fa-arrow-right"></i> Balão de fala exclusivo.</li>
<li><i class="fas fa-arrow-right"></i> Emblema de identificação de cada plano comprado.</li>
<li><i class="fas fa-arrow-right"></i> Efeito com emblema VIP (em breve)</li>
<li><i class="fas fa-arrow-right"></i> Mais balões de falas exclusivos (em breve)</li>
<br>
<li><i class="fas fa-arrow-right"></i> Comando <b>:tele</b> (Ativa o teletransporte).</li>
<li><i class="fas fa-arrow-right"></i> Comando <b>:fastwalk</b> (Andar rápido).</li>
<li><i class="fas fa-arrow-right"></i> Comando <b>:tp</b> (Teletransporte um usuário).</li>
<li><i class="fas fa-arrow-right"></i> Comando <b>:poll</b> (Crie enquetes).</li>
<li><i class="fas fa-arrow-right"></i> Comando <b>:spull</b> (Puxe um usuário).</li>
<li><i class="fas fa-arrow-right"></i> Comando <b>:flagme</b> (Troque seu nome de usuário).</li>
<li><i class="fas fa-arrow-right"></i> Comando <b>:gotroom</b> (Vá a um quarto digitando o ID).</li>
<br>
<li> Além de todos os benefícios citados acima, todos os usuários VIP ganham <b>40 diamantes</b> à cada 30 minutos online!</li>
<br>
<b style="font-size: 13px; color: white"><i class="fas fa-clipboard-check"></i> Contrate o Plano Amarelo e adquira:</b>
<li><i class="fas fa-arrow-right"></i> 30 dias de VIP</li>
<li><i class="fas fa-arrow-right"></i> Serpa Amarela</li>
<li><i class="fas fa-arrow-right"></i> 1000 diamantes</li>
<li><i class="fas fa-arrow-right"></i> 1000 conquistas</li>
<li><i class="fas fa-arrow-right"></i> 60 duckets</li>
<li><i class="fas fa-arrow-right"></i> Emblema VIP</li>
</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
</br>
                                <button onclick="window.open('https://picpay.me/paulo.oliveira.silva49/20.0', '_blank')" class="btn green big next-register" class="button" style="width: 100%; height: 45px;border-radius:0px">
                                Picpay
								</button>

                                <button onclick="window.open('https://nubank.com.br/pagar/8wpi7/cBlUpWca3k', '_blank')" class="btn blue big next-register" class="button" style="width: 100%; height: 45px;background-color: #62818a;border-radius:0px">
                                Pix
                                <span style="position: absolute; color: transparent;">90224bbc-cac5-4b47-84db-ea6fdf15d5e3</span>
								</button>

                                <button onclick="window.open('https://api.whatsapp.com/send?phone=89981326247&text=Ol%C3%A1%2C%20gostaria%20de%20gerar%20um%20boleto%20para%20efetuar%20a%20compra%20do%20VIP%20no%20Lella', '_blank')" class="btn gray big next-register" class="button" style="width: 100%; height: 45px;background-color: #898989;border-radius:0px ">
                                Boleto
								</button>
                               
                                <button onclick="window.open('https://mpago.la/2NeD2nz', '_blank')" class="btn gray big next-register" class="button" style="width: 100%; height: 45px;background-color: #49aae3;border-radius:0px ">
                                MercadoPago
								</button>
<ul>                
                            </ul>
							</div>        
            </div>
            </div>
           
            <div class="col-3">
				<div id="content-box">
					<div class="title-box png20" style="background-color:#447ac2;border-radius:4px;color:#fff;">
                        <div class="title">VIP AZUL <small>(2 meses)</small></div>
					</div>
<div id="content-box" class="profile" style="height:82px;margin-bottom:4px">
                <div class="bg" style="height:82px"></div>
                <div class="overlay">
                    <div class="username" style="font-size:14px;top:30px">
                                    Pacote de R$30,00.
                    </div>
                    
                                </div>
                                </div>

                                <div class="margin-top-min">
								<button id="vip60" data-modal="vip60" class="btn purple big next-register" class="button" name="send_form" style="width: 100%; height: 45px;">
                                Benificios
								</button>

            <div class="modal-container" id="vip60" data-modal="vip60">
				<div id="modal-content">
					<div id="news-modal">
						<div class="col-12">
							<div id="content-box" style="height:100%;">
								<div class="title-box png20">
									<div class="title"> Benificios VIP AZUL <small>(2 meses)</small></div>
									<button type="ok" class="close close-modal" style="position:relative;top:-20px;float:right;right:14px"></button>

									<div style="padding:16px">
                                    <h5>Atualmente, o Plano Azul apresenta as seguintes vantagens listadas abaixo:</h5>
<ul style="font-family: sans-serif;">
<li><i class="fas fa-arrow-right"></i> Capacidade de entrar em quartos lotados.</li>
<li><i class="fas fa-arrow-right"></i> Menor tempo de mute por flood.</li>
<li><i class="fas fa-arrow-right"></i> Adicionar até 5.000 de amigos.</li>
<li><i class="fas fa-arrow-right"></i> Emblema exclusivo de identificação VIP.</li>
<li><i class="fas fa-arrow-right"></i> Loja de Mobis exclusiva.</li>
<li><i class="fas fa-arrow-right"></i> Loja de Raros exclusiva.</li>
<li><i class="fas fa-arrow-right"></i> Loja de Emblemas exclusiva.</li>
<li><i class="fas fa-arrow-right"></i> Balão de fala exclusivo.</li>
<li><i class="fas fa-arrow-right"></i> Emblema de identificação de cada plano comprado.</li>
<li><i class="fas fa-arrow-right"></i> Efeito com emblema VIP (em breve)</li>
<li><i class="fas fa-arrow-right"></i> Mais balões de falas exclusivos (em breve)</li>
<br>
<li><i class="fas fa-arrow-right"></i> Comando <b>:tele</b> (Ativa o teletransporte).</li>
<li><i class="fas fa-arrow-right"></i> Comando <b>:fastwalk</b> (Andar rápido).</li>
<li><i class="fas fa-arrow-right"></i> Comando <b>:tp</b> (Teletransporte um usuário).</li>
<li><i class="fas fa-arrow-right"></i> Comando <b>:poll</b> (Crie enquetes).</li>
<li><i class="fas fa-arrow-right"></i> Comando <b>:spull</b> (Puxe um usuário).</li>
<li><i class="fas fa-arrow-right"></i> Comando <b>:flagme</b> (Troque seu nome de usuário).</li>
<li><i class="fas fa-arrow-right"></i> Comando <b>:gotroom</b> (Vá a um quarto digitando o ID).</li>
<br>
<li> Além de todos os benefícios citados acima, todos os usuários VIP ganham <b>40 diamantes</b> à cada 30 minutos online!</li>
<br>
<b style="font-size: 13px; color: white"><i class="fas fa-clipboard-check"></i> Contrate o Plano Azul e adquira:</b>
<li><i class="fas fa-arrow-right"></i> 60 dias de VIP</li>
<li><i class="fas fa-arrow-right"></i> Serpa Azul</li>
<li><i class="fas fa-arrow-right"></i> 2000 diamantes</li>
<li><i class="fas fa-arrow-right"></i> 2000 conquistas</li>
<li><i class="fas fa-arrow-right"></i> 120 duckets</li>
<li><i class="fas fa-arrow-right"></i> Emblema VIP</li>
<li><i class="fas fa-arrow-right"></i> Emblema de Rosto</li>
</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
</br>
                                <button onclick="window.open('https://picpay.me/paulo.oliveira.silva49/30.0', '_blank')" class="btn green big next-register" class="button" style="width: 100%; height: 45px;border-radius:0px">
                                Picpay
								</button>

                                <button onclick="window.open('https://nubank.com.br/pagar/8wpi7/vjb9LsNrso', '_blank')" class="btn blue big next-register" class="button" style="width: 100%; height: 45px;background-color: #62818a;border-radius:0px">
                                Pix
                                <span style="position: absolute; color: transparent;">90224bbc-cac5-4b47-84db-ea6fdf15d5e3</span>
								</button>

                                <button onclick="window.open('https://api.whatsapp.com/send?phone=89981326247&text=Ol%C3%A1%2C%20gostaria%20de%20gerar%20um%20boleto%20para%20efetuar%20a%20compra%20do%20VIP%20no%20Lella', '_blank')" class="btn gray big next-register" class="button" style="width: 100%; height: 45px;background-color: #898989;border-radius:0px ">
                                Boleto
								</button>
                               
                                <button onclick="window.open('https://mpago.la/2h8wWwY', '_blank')" class="btn gray big next-register" class="button" style="width: 100%; height: 45px;background-color: #49aae3;border-radius:0px ">
                                MercadoPago
								</button>
<ul>                
                            </ul>
							</div>        
            </div>
            </div>
            
           
			<div class="col-3">
				<div id="content-box">
					<div class="title-box png20" style="background-color:#ad3b3b;border-radius:4px;color:#fff;">
                        <div class="title">VIP VERMELHO <small>(4 meses)</small></div>
					</div>
<div id="content-box" class="profile" style="height:82px;margin-bottom:4px">
                <div class="bg" style="height:82px"></div>
                <div class="overlay">
                    <div class="username" style="font-size:14px;top:30px">
                                    Pacote de R$40,00.
                    </div>
                    
                                </div>
                                </div>

                                <div class="margin-top-min">
								<button id="vip90" data-modal="vip90" class="btn purple big next-register" class="button" name="send_form" style="width: 100%; height: 45px;">
                                Benificios
								</button>

            <div class="modal-container" id="vip90" data-modal="vip90">
				<div id="modal-content">
					<div id="news-modal">
						<div class="col-12">
							<div id="content-box" style="height:100%;">
								<div class="title-box png20">
									<div class="title"> Benificios VIP VERMELHO <small>(4 meses)</small></div>
									<button type="ok" class="close close-modal" style="position:relative;top:-20px;float:right;right:14px"></button>

									<div style="padding:16px">
                                    <h5>Atualmente, o Plano Vermelho apresenta as seguintes vantagens listadas abaixo:</h5>
<ul style="font-family: sans-serif;">
<li><i class="fas fa-arrow-right"></i> Capacidade de entrar em quartos lotados.</li>
<li><i class="fas fa-arrow-right"></i> Menor tempo de mute por flood.</li>
<li><i class="fas fa-arrow-right"></i> Adicionar até 5.000 de amigos.</li>
<li><i class="fas fa-arrow-right"></i> Emblema exclusivo de identificação VIP.</li>
<li><i class="fas fa-arrow-right"></i> Loja de Mobis exclusiva.</li>
<li><i class="fas fa-arrow-right"></i> Loja de Raros exclusiva.</li>
<li><i class="fas fa-arrow-right"></i> Loja de Emblemas exclusiva.</li>
<li><i class="fas fa-arrow-right"></i> Balão de fala exclusivo.</li>
<li><i class="fas fa-arrow-right"></i> Emblema de identificação de cada plano comprado.</li>
<li><i class="fas fa-arrow-right"></i> Efeito com emblema VIP (em breve)</li>
<li><i class="fas fa-arrow-right"></i> Mais balões de falas exclusivos (em breve)</li>
<br>
<li><i class="fas fa-arrow-right"></i> Comando <b>:tele</b> (Ativa o teletransporte).</li>
<li><i class="fas fa-arrow-right"></i> Comando <b>:fastwalk</b> (Andar rápido).</li>
<li><i class="fas fa-arrow-right"></i> Comando <b>:tp</b> (Teletransporte um usuário).</li>
<li><i class="fas fa-arrow-right"></i> Comando <b>:poll</b> (Crie enquetes).</li>
<li><i class="fas fa-arrow-right"></i> Comando <b>:spull</b> (Puxe um usuário).</li>
<li><i class="fas fa-arrow-right"></i> Comando <b>:flagme</b> (Troque seu nome de usuário).</li>
<li><i class="fas fa-arrow-right"></i> Comando <b>:gotroom</b> (Vá a um quarto digitando o ID).</li>
<br>
<li> Além de todos os benefícios citados acima, todos os usuários VIP ganham <b>40 diamantes</b> à cada 30 minutos online!</li>
<br>
<b style="font-size: 13px; color: white"><i class="fas fa-clipboard-check"></i> Contrate o Plano Vermelho e adquira:</b>
<li><i class="fas fa-arrow-right"></i> 90 dias de VIP</li>
<li><i class="fas fa-arrow-right"></i> Serpa Vermelha</li>
<li><i class="fas fa-arrow-right"></i> 5000 diamantes</li>
<li><i class="fas fa-arrow-right"></i> 5000 conquistas</li>
<li><i class="fas fa-arrow-right"></i> 200 duckets</li>
<li><i class="fas fa-arrow-right"></i> Emblema VIP</li>
<li><i class="fas fa-arrow-right"></i> Emblema de Rosto</li>
</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
</br>
                                <button onclick="window.open('https://picpay.me/paulo.oliveira.silva49/40.0', '_blank')" class="btn green big next-register" class="button" style="width: 100%; height: 45px;border-radius:0px">
                                Picpay
								</button>

                                <button onclick="window.open('https://nubank.com.br/pagar/8wpi7/UbGcSZuFd5', '_blank')" class="btn blue big next-register" class="button" style="width: 100%; height: 45px;background-color: #62818a;border-radius:0px">
                                Pix
                                <span style="position: absolute; color: transparent;">90224bbc-cac5-4b47-84db-ea6fdf15d5e3</span>
								</button>

                                <button onclick="window.open('https://api.whatsapp.com/send?phone=89981326247&text=Ol%C3%A1%2C%20gostaria%20de%20gerar%20um%20boleto%20para%20efetuar%20a%20compra%20do%20VIP%20no%20Lella', '_blank')" class="btn gray big next-register" class="button" style="width: 100%; height: 45px;background-color: #898989;border-radius:0px ">
                                Boleto
								</button>
                               
                                <button onclick="window.open('https://mpago.la/18ccew5', '_blank')" class="btn gray big next-register" class="button" style="width: 100%; height: 45px;background-color: #49aae3;border-radius:0px ">
                                MercadoPago
								</button>
<ul>                
                            </ul>
							</div>        
            </div>
            </div>

          
            <style>
    ul {
        list-style-type: none;
    }
</style>
            <script type="text/javascript" src="<?= CDN; ?>/assets/js/jquery.js?<?= TIME; ?>"></script>
			<script type="text/javascript" src="<?= CDN; ?>/assets/js/main.js?<?= TIME; ?>"></script>
			<script type="text/javascript" src="<?= CDN; ?>/assets/js/ajax.js?<?= TIME; ?>"></script>
            <?php
            $Template->AddTemplate('others', 'bottom');
            ?>
