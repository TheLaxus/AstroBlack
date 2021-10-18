<?php 
	require_once('../others/core.php');

	$Panel::Session('disconnected', $result_panel_user['rank']);

	$page_id = 'baniments';
	$page_name = 'Bans';
	$page_title = 'Painel: Banimentos - ' . HOTELNAME;

	include('../others/head.php');
?>
<?php 
	include('../others/sidebar.php');
?>
<style>
table, th, td {
  border: 1px solid #c3c3c3;
  border-collapse: collapse;
}
td, th {
  padding:4px;
}
th {
  text-align: left;
}

</style>
			<div class="content flex-column">
				<div class="header-content flex">
					<div class="sideBar-controller">
						<span></span>
						<span></span>
						<span></span>
					</div>
					<label class="mr-auto-top-bottom">
						<h2 class="bold">Respostas de Formulário</h2>
					</label>
        </div>
				<div class="content-container">
					<div class="general-white-container host-badge mr-auto-left-right" style="max-width: 1000px;">
                    <table style="width:100%">
                      <tr>
                        <th>ID Notícia</th>
                        <th>Mensagem</th>
                        <th>Enviado por</th>
                        <th>Data e Hora</th>

                      </tr>
                      <!-- linha tabela -->

                      <tr>
                        <td>1</td>
                        <td>asdasd</td>
                        <td>Laxus</td>
                        <td>23:00</td>
                      </tr>
                    </table>
					</div>
				</div>
			</div>
<?php 
	include('../others/bottom.php');
?>