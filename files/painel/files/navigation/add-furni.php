<?php

    require_once('../others/core.php');

    $Panel::Session('disconnected', $result_panel_user['rank']);

    if ($result_panel_user['rank'] < $manager) {
		Redirect(URL_PANEL);
	}


    $categorias = $db->prepare('SELECT id, caption FROM catalog_pages WHERE parent_id = 423423581 AND enabled = \'1\'');
    $categorias->execute();

    $page_id = 'ceo';
    $page_name = 'AddFurni';
    $page_title = 'Painel: Adicionar Mobi - ' . HOTELNAME;
    include('../others/head.php');
?>
<?php 
	include('../others/sidebar.php');
?>
			<div class="content flex-column">
				<div class="header-content flex">
					<div class="sideBar-controller">
						<span></span>
						<span></span>
						<span></span>
					</div>
					<label class="mr-auto-top-bottom">
						<h2 class="bold">Adicionar mobi</h2>
					</label>
				</div>
				<div class="content-container">
					<div class="general-white-container add-furni mr-auto-left-right">
						<form method="POST" class="form-add-furni flex-column">
                        <input type="hidden" name="order" value="add-furni">

							<div class="form-warns"></div>
							<div class="col-input-separator flex-column mr-top-none">
								<label>
									<h5 class="fs-14">Página</h5>
								</label>
								<select class="form-control" name="page_id">
                                <?php
									while($cat = $categorias->fetch()) { ?>
										<option value="<?= $cat['id'] ?>"><?= $cat['caption'] ?></option>
								<?php } ?>
									</select>
								<div class="error-input-warn"></div>
							</div>
							<div class="col-input-separator flex-column">
								<label>
									<h5 class="fs-14">Nome no Catálogo</h5>
								</label>
								
                                <input type="text" name="catalog_name">
								<div class="error-input-warn"></div>
							</div>
                            <div class="col-input-separator flex-column">
								<label>
									<h5 class="fs-14">Custo de Diamantes</h5>
								</label>
								
                                <input type="number" name="cost_diamonds" class="form-control" value="0" required >
								<div class="error-input-warn"></div>
							</div>
                            <div class="col-input-separator flex-column">
								<label>
									<h5 class="fs-14">Custo de Moedas</h5>
								</label>
								
                                <input type="number" name="cost_credits" class="form-control" value="3" required >
								<div class="error-input-warn"></div>
							</div>
                            <div class="col-input-separator flex-column">
								<label>
									<h5 class="fs-14">Custo de Duckets</h5>
								</label>
								
                                <input type="number" name="cost_pixels" class="form-control" value="0" required >
								<div class="error-input-warn"></div>
							</div>
                            <div class="col-input-separator flex-column">
								<label>
									<h5 class="fs-14">Custo de Crazzies</h5>
								</label>
								
                                <input type="number" name="cost_seasonal" class="form-control" value="3" required >
								<div class="error-input-warn"></div>
							</div>
                            <div class="col-input-separator flex-column">
								<label>
									<h5 class="fs-14">Quantidade</h5>
								</label>
								
                                <input type="number" name="amount" class="form-control" value="1" required >
								<div class="error-input-warn"></div>
							</div>
                            <div class="col-input-separator flex-column">
								<label>
									<h5 class="fs-14">Quantidade de Limitados</h5>
								</label>
								
                                <input type="number" name="limited_stack" class="form-control" value="0" required >
								<div class="error-input-warn"></div>
							</div>
                            <div class="col-input-separator flex-column">
								<label>
									<h5 class="fs-14">Código do emblema</h5>
								</label>
								
                                <input type="text" name="badge_id" class="form-control">
								<div class="error-input-warn"></div>
							</div>
                            <div class="col-input-separator flex-column">
								<label>
									<h5 class="fs-14">Local de Download</h5>
								</label>
								
                                <select class="form-control" name="downloadFrom">
									<option value="habbocity" selected>HabboCity</option>
									<option value="habblet">Habblet</option>
									<option value="iron">Iron</option>
                                </select>
								<div class="error-input-warn"></div>
							</div>
                            <div class="col-input-separator flex-column">
								<label>
									<h5 class="fs-14">Nome do item</h5>
								</label>
								
                                <input type="text" name="item_name" class="form-control" placeholder="Ex.: val_c20_table" required >
								<div class="error-input-warn"></div>
							</div>
                            <div class="col-input-separator flex-column">
								<label>
									<h5 class="fs-14">Nome do mobi</h5>
								</label>
								
                                <input type="text" name="public_name" class="form-control" placeholder="Ex.: Chocolatier Table" required >
								<div class="error-input-warn"></div>
							</div>
                            <div class="col-input-separator flex-column">
								<label>
									<h5 class="fs-14">Tipo</h5>
								</label>
								
                                <select name="type" class="form-control" required >
										<option value="s">Chão</option>
										<option value="i">Parede</option>
										<option value="e">e</option>
										<option value="h">h</option>
										<option value="v">v</option>
										<option value="r">r</option>
										<option value="b">b</option>
										<option value="p">p</option>
									</select>
								<div class="error-input-warn"></div>
							</div>
                            <div class="col-input-separator flex-column">
								<label>
									<h5 class="fs-14">Largura</h5>
								</label>
								
								<input type="number" name="width" class="form-control" value="1" required >
								<div class="error-input-warn"></div>
							</div>
							<div class="col-input-separator flex-column">
								<label>
									<h5 class="fs-14">Comprimento</h5>
								</label>
								
								<input type="number" name="length" class="form-control" value="1" required >
								<div class="error-input-warn"></div>
							</div>		
							<div class="col-input-separator flex-column">
								<label>
									<h5 class="fs-14">Altura do mobi</h5>
								</label>
								
								<input type="number" name="stack_height" step="0.01" class="form-control" value="1" required >
								<div class="error-input-warn"></div>
							</div>
							<div class="col-input-separator flex-column">
								<label>
									<h5 class="fs-14">Pode empilhar?</h5>
								</label>
								
                                <select name="can_stack" class="form-control" required >
										<option value="0">Não</option>
										<option value="1" selected>Sim</option>
									</select>
								<div class="error-input-warn"></div>
							</div>
							<div class="col-input-separator flex-column">
								<label>
									<h5 class="fs-14">Pode sentar?</h5>
								</label>
								
                                <select name="can_sit" class="form-control" required >
										<option value="0" selected>Não</option>
										<option value="1">Sim</option>
									</select>
								<div class="error-input-warn"></div>
							</div>	
							<div class="col-input-separator flex-column">
								<label>
									<h5 class="fs-14">É andavel?</h5>
								</label>
								
                                <select name="is_walkable" class="form-control" required >
										<option value="0" selected>Não</option>
										<option value="1">Sim</option>
									</select>
								<div class="error-input-warn"></div>
							</div>		
							<div class="col-input-separator flex-column">
								<label>
									<h5 class="fs-14">Permitir reciclar</h5>
								</label>
								
                                <select name="allow_recycle" class="form-control" required >
										<option value="0">Não</option>
										<option value="1" selected>Sim</option>
									</select>
								<div class="error-input-warn"></div>
							</div>
							<div class="col-input-separator flex-column">
								<label>
									<h5 class="fs-14">Pode ser trocado?</h5>
								</label>
								
                                <select name="allow_trade" class="form-control" required >
										<option value="0">Não</option>
										<option value="1" selected>Sim</option>
									</select>
								<div class="error-input-warn"></div>
							</div>	
							<div class="col-input-separator flex-column">
								<label>
									<h5 class="fs-14">Pode vendido na Feira Livre?</h5>
								</label>
								
                                <select name="allow_marketplace_sell" class="form-control" required >
										<option value="0" selected>Não</option>
										<option value="1">Sim</option>
									</select>
								<div class="error-input-warn"></div>
							</div>
							<div class="col-input-separator flex-column">
								<label>
									<h5 class="fs-14">Pode ser presenteado?</h5>
								</label>
								
                                <select name="allow_gift" class="form-control" required >
										<option value="0">Não</option>
										<option value="1" selected>Sim</option>
									</select>
								<div class="error-input-warn"></div>
							</div>
							<div class="col-input-separator flex-column">
								<label>
									<h5 class="fs-14">Pode agrupar no inventário?</h5>
								</label>
								
                                <select name="allow_inventory_stack" class="form-control" required >
										<option value="0">Não</option>
										<option value="1" selected>Sim</option>
									</select>
								<div class="error-input-warn"></div>
							</div>
							<div class="col-input-separator flex-column">
								<label>
									<h5 class="fs-14">Tipo de interação</h5>
								</label>
								
								<input type="text" name="interaction_type" class="form-control" value="default" required >
								<div class="error-input-warn"></div>
							</div>
							<div class="col-input-separator flex-column">
								<label>
									<h5 class="fs-14">Quantidade de interação</h5>
								</label>
								
								<input type="number" name="interaction_modes_count" class="form-control" value="1" required >
								<div class="error-input-warn"></div>
							</div>
							<div class="col-input-separator flex-column">
								<label>
									<h5 class="fs-14">Quantidade de interação</h5>
								</label>
								
								<input type="number" name="interaction_modes_count" class="form-control" value="1" required >
								<div class="error-input-warn"></div>
							</div>
							<div class="col-input-separator flex-column">
								<label>
									<h5 class="fs-14">vending_ids</h5>
								</label>
								
								<input type="text" name="vending_ids" class="form-control" value="0" required >
								<div class="error-input-warn"></div>
							</div>
							<div class="col-input-separator flex-column">
								<label>
									<h5 class="fs-14">ID do efeito</h5>
								</label>
								
								<input type="text" name="effect_id" class="form-control" value="0" required >
								<div class="error-input-warn"></div>
							</div>
							<div class="col-input-separator flex-column">
								<label>
									<h5 class="fs-14">Alturas variáveis</h5>
								</label>
								
								<input type="text" name="variable_heights" class="form-control" value="0" required >
								<div class="error-input-warn"></div>
							</div>
							<div class="col-input-separator flex-column">
								<label>
									<h5 class="fs-14">Descrição</h5>
								</label>
								
								<input type="text" name="description" class="form-control" value="">
								<div class="error-input-warn"></div>
							</div>
							<div class="col-input-separator flex-column">
								<label>
									<h5 class="fs-14">Pode deitar?</h5>
								</label>
								
                                <select name="canlayon" class="form-control" required >
									<option value="0" selected>Não</option>
									<option value="1">Sim</option>
									</select>
								<div class="error-input-warn"></div>
							</div>
							<div class="col-input-separator flex-column">
								<label>
									<h5 class="fs-14">Requer direitos?</h5>
								</label>
								
								<select name="requires_rights" class="form-control" required >
									<option value="0">Não</option>
									<option value="1" selected>Sim</option>
									</select>
								<div class="error-input-warn"></div>
							</div>
							<div class="col-input-separator flex-column">
								<label>
									<h5 class="fs-14">ID do som</h5>
								</label>
								
								<input type="number" name="song_id" class="form-control" value="0" required >
								<div class="error-input-warn"></div>
							</div>
							<div class="col-input-separator flex-column mr-bottom-2">

							</div>
							<button class="green-button-1" type="submit" style="width: 100%;height: 50px">
								<label class="mr-auto color-1">
									<h5 class="fs-14">Pronto</h5>
								</label>
							</button>
						</form>
					</div>
				</div>
			</div>
            <?php 
	            include('../others/bottom.php');
            ?>