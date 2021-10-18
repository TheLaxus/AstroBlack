<?php 
	require_once('../global.php');

	header('Content-Type: application/json');

	if (extract($_POST)) {
		$order = (isset($_POST['order'])) ? $_POST['order'] : '';

		# Ranks
		$developer = '11';
		$ceo = '10';
		$manager = '9';
		$administrator = '8';
		$moderator = '6';

		if ($order == 'login') {
			$pin = (isset($_POST['pin'])) ? $_POST['pin'] : '';

			$consult_pin = $db->prepare("SELECT * FROM players WHERE id = ? AND pin_panel = ?");
			$consult_pin->bindValue(1, $user['id']);
			$consult_pin->bindValue(2, $pin);
			$consult_pin->execute();

			if (empty($pin)) {
				echo json_encode([
					"response" => 'error',
					"append" => 'Você precisar <b>informar seu pin</b> para poder logar no painel!'
				]);
			} else if (strlen($pin) > 4 || strlen($pin) < 4) {
				echo json_encode([
					"response" => 'error',
					"append" => 'Você precisa fornecer um <b>pin válido</b> para logar no painel!'
				]);
			} else {
				if ($user['pin_panel'] == NULL || $user['pin_panel'] == '' || $user['pin_panel'] == '0') {
					echo json_encode([
						"response" => 'error',
						"append" => 'Parece que você não ainda não tem acesso ao painel! Contate a um membro <b>desenvolvedor</b> para conceder acesso.'
					]);
				} else if ($user['pin_panel'] != $pin) {
					echo json_encode([
						"response" => 'error',
						"append" => 'Seu pin esta <b>incorreto</b>! Caso o tenha esquecido contate a um membro <b>fundador</b> ou <b>desenvolvedor</b> da equipe.'
					]);
				} else {
					if ($consult_pin->rowCount() > 0) {
						$result_pin = $consult_pin->fetch(PDO::FETCH_ASSOC);
						$_SESSION['pin_panel'] = $pin;

						$insert_panel_log = $db->prepare("INSERT INTO cms_panel_logs (label) VALUES (?)");
						$insert_panel_log->bindValue(1, 'login;' . $user['username'] . ';' . TIME . ';' . IP . ';success');
						$insert_panel_log->execute();

						echo json_encode([
							"response" => 'success'
						]);
					} else {
						echo json_encode([
							"response" => 'error',
							"append" => 'Houve um erro durante o seu login ao painel! Contate a um membro <b>densevolvedor</b> para verificar seu acesso.'
						]);
					}
				}
			}
		} else if ($order == 'article/create') {
			$title = (isset($_POST['title'])) ? $_POST['title'] : '';
			$subtitle = (isset($_POST['subtitle'])) ? $_POST['subtitle'] : '';
			$thumbnail = (isset($_POST['thumbnail'])) ? $_POST['thumbnail'] : '';
			$category = (isset($_POST['category'])) ? $_POST['category'] : '';
			$body = (isset($_POST['body'])) ? $_POST['body'] : '';
			$draft = (isset($_POST['draft'])) ? $_POST['draft'] : '';

			if (empty($title)) {
				echo json_encode([
					"response" => 'error',
					"input" => 'input[name="title"]',
					"error" => [
						"class" => 'div.col-input-separator:nth-child(2) > .error-input-warn',
						"text" => 'Você não pode deixar o titulo da sua noticia vázio.'
					]
				]);
			} else if (empty($thumbnail)) {
				echo json_encode([
					"response" => 'error',
					"input" => 'input[name="thumbnail"]',
					"error" => [
						"class" => 'div.col-input-separator:nth-child(4) > .error-input-warn',
						"text" => 'Você precisa inserir o <b>URL de uma imagem</b> para ficar como a thumbnail da sua noticia.'
					]
				]);
			} else if (empty($category)) {
				echo json_encode([
					"response" => 'error',
					"input" => 'select[name="category"]',
					"error" => [
						"class" => 'div.col-input-separator:nth-child(5) > .error-input-warn',
						"text" => 'Você precisar escolher a categoria que mais de adequa com a sua noticia.'
					]
				]);
			} else if (empty($body)) {
				echo json_encode([
					"response" => 'error',
					"input" => '.article-create-textarea',
					"error" => [
						"class" => 'div.col-input-separator:nth-child(6) > .error-input-warn',
						"text" => 'Você precisa escrever algo para que os usuário possam ter o que ler na sua noticia.'
					]
				]);
			} else {
				$date_expire = (isset($_POST['date_expire'])) ? $_POST['date_expire'] : '';
				$hour_expire = (isset($_POST['hour_expire'])) ? $_POST['hour_expire'] : '';
				$use_badge = (isset($_POST['use_badge'])) ? $_POST['use_badge'] : '';
				


				if ($category == 'Promoções' && empty($date_expire) && empty($hour_expire)) {
					echo json_encode([
						"response" => 'error',
						"input" => 'input.expiretime',
						"error" => [
							"class" => 'div.another-options .promotions-date-expire > .error-input-warn',
							"text" => 'Você precisa informar a <b>data e a hora</b> que a sua promoção vai expirar, assim o formulário será desativado automaticamente.'
						]
					]);
				} else {

					if ($category == 'Promoções') {
						$date = explode('/', $date_expire);
						$hour = explode(':', $hour_expire);

						$date_hour = $date[0] . $date[1] . $date[2] . $hour[0] . $hour[1];

						if ($category == 'Promoções' && is_numeric($date_hour) && strlen($date[0]) == 2 && strlen($date[1]) == 2 && strlen($date[2]) == 4 && strlen($hour[0]) == 2 && strlen($hour[1]) == 2 && $date[0] <= 31 && $date[1] <= 12 && $hour[0] <= 24 && $hour[1] <= 59) {

							$timestamp_expire = strtotime($date[0] . '-' . $date[1] . '-' . $date[2] . ' ' . $hour[0] . ':' . $hour[1]);

							if ($use_badge == '1') {
								$badgecode = (isset($_POST['badge_code'])) ? $_POST['badge_code'] : '';
							}

							if ($timestamp_expire <= TIME) {
								echo json_encode([
									"response" => 'error',
									"input" => 'input.expiretime',
									"error" => [
										"class" => 'div.another-options .promotions-date-expire > .error-input-warn',
										"text" => 'Você precisa escolher <b>uma data maior</b> que a de agora.'
									]
								]);
							} else if ($use_badge == 1) {
								$badgecode = (isset($_POST['badge_code'])) ? $_POST['badge_code'] : '';
								
								$insert_promo = $db->prepare("INSERT INTO cms_news (title, category, image, timestamp, timestamp_expire, subtitle, body, author, is_draft, use_badge, badge) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
								$insert_promo->bindValue(1, Functions::Filter('article', $title));
								$insert_promo->bindValue(2, $category);
								$insert_promo->bindValue(3, $thumbnail);
								$insert_promo->bindValue(4, TIME);
								$insert_promo->bindValue(5, $timestamp_expire);
								$insert_promo->bindValue(6, Functions::Filter('article', $subtitle));
								$insert_promo->bindValue(7, Functions::Filter('article', $body));
								$insert_promo->bindValue(8, $user['id']);
								$insert_promo->bindValue(9, $draft);
								$insert_promo->bindValue(10, $use_badge);
								$insert_promo->bindValue(11, $badgecode);
								$insert_promo->execute();

								
								$insert_panel_log = $db->prepare("INSERT INTO cms_panel_logs (label) VALUES (?)");
								$insert_panel_log->bindValue(1, 'create-article;' . $user['username'] . '/' . $user['id'] . ';' . TIME . ';' . IP . ';success');
								$insert_panel_log->execute();

								echo json_encode([
									"response" => 'success',
									"append" => '<div class="form-warn success mr-bottom-1"><label class="flex-column"><h4 class="bold uppercase">Sucesso!</h4><h5>Você publicou com sucesso esta noticia!</h5></label></div>'
								]);
							} else {
								$insert_promo = $db->prepare("INSERT INTO cms_news (title, category, image, timestamp, timestamp_expire, subtitle, body, author, is_draft, use_badge) VALUES (?,?,?,?,?,?,?,?,?,?)");
								$insert_promo->bindValue(1, Functions::Filter('article', $title));
								$insert_promo->bindValue(2, $category);
								$insert_promo->bindValue(3, $thumbnail);
								$insert_promo->bindValue(4, TIME);
								$insert_promo->bindValue(5, $timestamp_expire);
								$insert_promo->bindValue(6, Functions::Filter('article', $subtitle));
								$insert_promo->bindValue(7, Functions::Filter('article', $body));
								$insert_promo->bindValue(8, $user['id']);
								$insert_promo->bindValue(9, $draft);
								$insert_promo->bindValue(10, '0');
								$insert_promo->execute();

								$insert_panel_log = $db->prepare("INSERT INTO cms_panel_logs (label) VALUES (?)");
								$insert_panel_log->bindValue(1, 'create-article;' . $user['username'] . '/' . $user['id'] . ';' . TIME . ';' . IP . ';success');
								$insert_panel_log->execute();

								echo json_encode([
									"response" => 'success',
									"append" => '<div class="form-warn success mr-bottom-1"><label class="flex-column"><h4 class="bold uppercase">Sucesso!</h4><h5>Você publicou com sucesso esta noticia!</h5></label></div>'
								]);
							}
						} else {
							echo json_encode([
								"response" => 'error',
								"input" => 'input.expiretime',
								"error" => [
									"class" => 'div.another-options .promotions-date-expire > .error-input-warn',
									"text" => 'Você precisa inserir a data e hora nos formatos corretos para que nada saia nada do controle.'
								]
							]);
						}
					} else if ($category == 'Campanhas') {

						$insert_campaign = $db->prepare("INSERT INTO cms_news (title, category, image, timestamp, subtitle, body, author, is_draft) VALUES (?,?,?,?,?,?,?,?)");
						$insert_campaign->bindValue(1, Functions::Filter('article', $title));
						$insert_campaign->bindValue(2, $category);
						$insert_campaign->bindValue(3, $thumbnail);
						$insert_campaign->bindValue(4, TIME);
						$insert_campaign->bindValue(5, Functions::Filter('article', $subtitle));
						$insert_campaign->bindValue(6, Functions::Filter('article', $body));
						$insert_campaign->bindValue(7, $user['id']);
						$insert_campaign->bindValue(8, $draft);
						$insert_campaign->execute();

						$insert_panel_log = $db->prepare("INSERT INTO cms_panel_logs (label) VALUES (?)");
						$insert_panel_log->bindValue(1, 'create-campaign;' . $user['username'] . '/' . $user['id'] . ';' . TIME . ';' . IP . ';success');
						$insert_panel_log->execute();

						echo json_encode([
							"response" => 'success',
							"append" => '<div class="form-warn success mr-bottom-1"><label class="flex-column"><h4 class="bold uppercase">Sucesso!</h4><h5>Você publicou com sucesso esta campanha! Finalize-a clicando <a href="/panel/create-campaign/' . $user['username'] . '" target="_blank" style="text-decoration: none;color: #FFF;"><b>AQUI</b></a></h5></label></div>'
						]);
					} else {
						$insert_article = $db->prepare("INSERT INTO cms_news (title, category, image, timestamp, subtitle, body, author, is_draft) VALUES (?,?,?,?,?,?,?,?)");
						$insert_article->bindValue(1, Functions::Filter('article', $title));
						$insert_article->bindValue(2, $category);
						$insert_article->bindValue(3, $thumbnail);
						$insert_article->bindValue(4, TIME);
						$insert_article->bindValue(5, Functions::Filter('article', $subtitle));
						$insert_article->bindValue(6, Functions::Filter('article', $body));
						$insert_article->bindValue(7, $user['id']);
						$insert_article->bindValue(8, $draft);
						$insert_article->execute();

						$insert_panel_log = $db->prepare("INSERT INTO cms_panel_logs (label) VALUES (?)");
						$insert_panel_log->bindValue(1, 'create-article;' . $user['username'] . '/' . $user['id'] . ';' . TIME . ';' . IP . ';success');
						$insert_panel_log->execute();

						echo json_encode([
							"response" => 'success',
							"append" => '<div class="form-warn success mr-bottom-1"><label class="flex-column"><h4 class="bold uppercase">Sucesso!</h4><h5>Você publicou com sucesso esta noticia!</h5></label></div>'
						]);
					}
				}
			}
		} else if ($order == 'host-badge') {
			$badge_title = (isset($_POST['badge-title'])) ? $_POST['badge-title'] : '';
			$badge_description = (isset($_POST['badge-description'])) ? $_POST['badge-description'] : '';
			$badge_file = (isset($_FILES['badge-file'])) ? $_FILES['badge-file'] : '';

			if (empty($badge_title)) {
				echo json_encode([
					"response" => 'error',
					"input" => 'input[name="badge-title"]',
					"error" => [
						"class" => 'div.col-input-separator:nth-child(3) > .error-input-warn',
						"text" => 'O título do seu emblema é essencial, então não o deixe vazio.'
					]
				]);
			} else if (empty($badge_description)) {
				echo json_encode([
					"response" => 'error',
					"input" => 'input[name="badge-description"]',
					"error" => [
						"class" => 'div.col-input-separator:nth-child(4) > .error-input-warn',
						"text" => 'A descrição do seu emblema é essencial, então não a deixe vazia.'
					]
				]);
			} else if (!isset($badge_file['tmp_name']) || empty($badge_file['tmp_name'])) {
				echo json_encode([
					"response" => 'error',
					"input" => 'input[name="badge-file"]',
					"error" => [
						"class" => 'div.col-input-separator:nth-child(5) > .error-input-warn',
						"text" => 'Você precisa enviar um emblema para ser hospedado.'
					]
				]);
			} else {
				$path_badge = DIR . SEPARATOR . 'swf/c_images/album1584/' . $badge_file['name'];
				$path_text = DIR . SEPARATOR . 'swf/gamedata/external_flash_texts.txt';

				$badge_name = str_replace('.gif', '', $badge_file['name']);

				$badge_size = getimagesize($badge_file['tmp_name']);
				$badge_width = $badge_size[0];
				$badge_height = $badge_size[1];

				$badge_format = pathinfo($badge_file['name'], PATHINFO_EXTENSION);

				if (strlen($badge_title) > 20) {
					echo json_encode([
						"response" => 'error',
						"input" => 'input[name="badge-title"]',
						"error" => [
							"class" => 'div.col-input-separator:nth-child(3) > .error-input-warn',
							"text" => 'Para o conforto de todos, o título do seu emblema não deve conter mais que 20 caracteres.'
						]
					]);
				} else if (strlen($badge_description) > 100) {
					echo json_encode([
						"response" => 'error',
						"input" => 'input[name="badge-description"]',
						"error" => [
							"class" => 'div.col-input-separator:nth-child(4) > .error-input-warn',
							"text" => 'Para o conforto de todos, a descrição do seu emblema não deve conter mais que 100 caracteres.'
						]
					]);
				} else if ($badge_format != 'gif') {
					echo json_encode([
						"response" => 'error',
						"input" => 'input[name="badge-file"]',
						"error" => [
							"class" => 'div.col-input-separator:nth-child(5) > .error-input-warn',
							"text" => 'O emblema que você esta tentando hospedar não esta no formato <b>.gif</b>.'
						]
					]);
				} else if ($badge_width < 40 || $badge_height < 40) {
					echo json_encode([
						"response" => 'error',
						"input" => 'input[name="badge-file"]',
						"error" => [
							"class" => 'div.col-input-separator:nth-child(5) > .error-input-warn',
							"text" => 'As dimensões mínimas para hospedar um emblema devem ser 10×10.'
						]
					]);
				} else if ($badge_width > 40 || $badge_height > 40) {
					echo json_encode([
						"response" => 'error',
						"input" => 'input[name="badge-file"]',
						"error" => [
							"class" => 'div.col-input-separator:nth-child(5) > .error-input-warn',
							"text" => 'O emblema que você quer hospedar tem as dimensões maiores que 40×40.'
						]
					]);
				} else if (strlen($badge_name) < 5 || strlen($badge_name) > 5 || preg_match('/[^a-zA-Z0-9]+/', $badge_name) == true) {
					echo json_encode([
						"response" => 'error',
						"input" => 'input[name="badge-file"]',
						"error" => [
							"class" => 'div.col-input-separator:nth-child(5) > .error-input-warn',
							"text" => 'Para ficar fácil de lembrar, o nome do seu emblema deve conter <b>5 letras</b> ou <b>números</b>.'
						]
					]);
				} else if (file_exists($path_badge)) {
					echo json_encode([
						"response" => 'error',
						"input" => 'input[name="badge-file"]',
						"error" => [
							"class" => 'div.col-input-separator:nth-child(5) > .error-input-warn',
							"text" => 'O emblema de código <b>' . $badge_name . '</b> já esta hospedado na galeria de emblemas, tente usar outro código.'
						]
					]);
				} else {
					move_uploaded_file($badge_file['tmp_name'], $path_badge);

					$path_text_content = fopen($path_text, 'a');
					fwrite($path_text_content, "badge_name_" . $badge_name . "=" . $badge_title . "\nbadge_desc_" . $badge_name . "=" . $badge_description . "\n");
					fclose($path_text_content);

					$insert_panel_log = $db->prepare("INSERT INTO cms_panel_logs (label) VALUES (?)");
					$insert_panel_log->bindValue(1, 'host-badge;' . $badge_name . ';' . $user['username'] . '/' . $user['id'] . ';' . TIME . ';' . IP . ';success');
					$insert_panel_log->execute();

					echo json_encode([
						"response" => 'success',
						"append" => '<div class="form-warn success"><label class="flex-column"><h4 class="bold uppercase">Successo!</h4><h5>O emblema de código <b>' . $badge_name . '</b> foi hospedado com sucesso!</h5></label></div>'
					]);
				}
			}
		} else if ($order == 'article/edit') {
			$article_id = (isset($_POST['article_id'])) ? $_POST['article_id'] : '';

			$consult_if_exists_article = $db->prepare("SELECT * FROM cms_news WHERE id = ?");
			$consult_if_exists_article->bindValue(1, $article_id);
			$consult_if_exists_article->execute();

			if ($consult_if_exists_article->rowCount() == 0 || !is_numeric($article_id)) {
				echo json_encode([
					"response" => 'warn',
					"append" => '<div class="form-warn error mr-bottom-1"><label class="flex-column"><h4 class="bold uppercase">Opps!</h4><h5>Houve um erro ao editar esta noticia, parece <b>não existir no banco de dados<b>.</h5></label></div>'
				]);
			} else {
				$result_if_exists_article = $consult_if_exists_article->fetch(PDO::FETCH_ASSOC);

				if ($user['rank'] < $administrator || $result_if_exists_article['author'] != $user['id']) {
					echo json_encode([
						"response" => 'warn',
						"append" => '<div class="form-warn error mr-bottom-1"><label class="flex-column"><h4 class="bold uppercase">Opps!</h4><h5>Parece que você não tem as permissões necessárias para editar estar noticia.</h5></label></div>'
					]);
				} else {
					$title = (isset($_POST['title'])) ? $_POST['title'] : '';
					$subtitle = (isset($_POST['subtitle'])) ? $_POST['subtitle'] : '';
					$thumbnail = (isset($_POST['thumbnail'])) ? $_POST['thumbnail'] : '';
					$category = (isset($_POST['category'])) ? $_POST['category'] : '';
					$body = (isset($_POST['body'])) ? $_POST['body'] : '';
					$draft = (isset($_POST['draft'])) ? $_POST['draft'] : '';

					if (empty($title)) {
						echo json_encode([
							"response" => 'error',
							"input" => 'input[name="title"]',
							"error" => [
								"class" => 'div.col-input-separator:nth-child(2) > .error-input-warn',
								"text" => 'Você não pode deixar o titulo da noticia vázio.'
							]
						]);
					} else if (empty($thumbnail)) {
						echo json_encode([
							"response" => 'error',
							"input" => 'input[name="thumbnail"]',
							"error" => [
								"class" => 'div.col-input-separator:nth-child(4) > .error-input-warn',
								"text" => 'Você precisa inserir o <b>URL de uma imagem</b> para ficar como a thumbnail da noticia.'
							]
						]);
					} else if (empty($category)) {
						echo json_encode([
							"response" => 'error',
							"input" => 'select[name="category"]',
							"error" => [
								"class" => 'div.col-input-separator:nth-child(5) > .error-input-warn',
								"text" => 'Você precisar escolher a categoria que mais de adequa com a noticia.'
							]
						]);
					} else if (empty($body)) {
						echo json_encode([
							"response" => 'error',
							"input" => '.article-create-textarea',
							"error" => [
								"class" => 'div.col-input-separator:nth-child(6) > .error-input-warn',
								"text" => 'Você precisa escrever algo para que os usuário possam ter o que ler na noticia.'
							]
						]);
					} else {
						$date_expire = (isset($_POST['date_expire'])) ? $_POST['date_expire'] : '';
						$hour_expire = (isset($_POST['hour_expire'])) ? $_POST['hour_expire'] : '';

						if ($category == 'Promoções' && empty($date_expire) && empty($hour_expire)) {
							echo json_encode([
								"response" => 'error',
								"input" => 'input.expiretime',
								"error" => [
									"class" => 'div.another-options .promotions-date-expire > .error-input-warn',
									"text" => 'Você precisa informar a <b>data e a hora</b> que a sua promoção vai expirar, assim o formulário será desativado automaticamente.'
								]
							]);
						}  else {
							if ($category == 'Promoções') {
								$date = explode('/', $date_expire);
								$hour = explode(':', $hour_expire);

								@$date_hour = $date[0] . $date[1] . $date[2] . $hour[0] . $hour[1];

								if ($category == 'Promoções' && is_numeric($date_hour) && strlen($date[0]) == 2 && strlen($date[1]) == 2 && strlen($date[2]) == 4 && strlen($hour[0]) == 2 && strlen($hour[1]) == 2 && $date[0] <= 31 && $date[1] <= 12 && $hour[0] <= 24 && $hour[1] <= 59) {

									$timestamp_expire = strtotime($date[0] . '-' . $date[1] . '-' . $date[2] . ' ' . $hour[0] . ':' . $hour[1]);

									if ($timestamp_expire < TIME) {
										echo json_encode([
											"response" => 'error',
											"input" => 'input.expiretime',
											"error" => [
												"class" => 'div.another-options .promotions-date-expire > .error-input-warn',
												"text" => 'A data de expiração da promoção tem der ser maior que a de hoje.'
											]
										]);
									} else {
										$update_promo = $db->prepare("UPDATE cms_news SET title = ?, category = ?, image = ?, timestamp_expire = ?, subtitle = ?, body = ?, is_draft = ? WHERE id = ?");
										$update_promo->bindValue(1, Functions::Filter('article', $title));
										$update_promo->bindValue(2, $category);
										$update_promo->bindValue(3, $thumbnail);
										$update_promo->bindValue(4, $timestamp_expire);
										$update_promo->bindValue(5, Functions::Filter('article', $subtitle));
										$update_promo->bindValue(6, Functions::Filter('article', $body));
										$update_promo->bindValue(7, $draft);
										$update_promo->bindValue(8, $article_id);
										$update_promo->execute();

										if ($result_if_exists_article['author'] != $user['id']) {
											$consult_author_name = $db->prepare("SELECT id,username FROM players WHERE id = ?");
											$consult_author_name->bindValue($result_if_exists_article['author']);
											$consult_author_name->execute();
											$result_author_name = $consult_author_name->fetch(PDO::FETCH_ASSOC);

											$insert_panel_log = $db->prepare("INSERT INTO cms_panel_logs (label) VALUES (?)");
											$insert_panel_log->bindValue(1, 'article/edit;no-belong;' . $user['username'] . '/' . $user['id'] . ';' . $article_id . ';' . $result_author_name['username'] . '/' . $result_author_name['id'] . ';' . TIME . ';' . IP . ';success');
											$insert_panel_log->execute();
										} else {
											$insert_panel_log = $db->prepare("INSERT INTO cms_panel_logs (label) VALUES (?)");
											$insert_panel_log->bindValue(1, 'article/edit;belong;' . $user['username'] . '/' . $user['id'] . ';' . $article_id . ';' . TIME . ';' . IP . ';success');
											$insert_panel_log->execute();
										}

										echo json_encode([
											"response" => 'warn',
											"append" => '<div class="form-warn success mr-bottom-1"><label class="flex-column"><h4 class="bold uppercase">Sucesso!</h4><h5>Você editou com sucesso esta promoção!</h5></label></div>',
											"updates" => [
												"title" => Functions::Filter('xss', $title)
											]
										]);
									}
								} else {
									echo json_encode([
										"response" => 'error',
										"input" => 'input.expiretime',
										"error" => [
											"class" => 'div.another-options .promotions-date-expire > .error-input-warn',
											"text" => 'Você precisa inserir a data e hora nos formatos corretos para que nada saia nada do controle.'
										]
									]);
								}
							} else {
								$update_article = $db->prepare("UPDATE cms_news SET title = ?, category = ?, image = ?, subtitle = ?, body = ?, is_draft = ? WHERE id = ?");
								$update_article->bindValue(1, Functions::Filter('article', $title));
								$update_article->bindValue(2, $category);
								$update_article->bindValue(3, $thumbnail);
								$update_article->bindValue(4, Functions::Filter('article', $subtitle));
								$update_article->bindValue(5, Functions::Filter('article', $body));
								$update_article->bindValue(6, $draft);
								$update_article->bindValue(7, $article_id);
								$update_article->execute();

								if ($result_if_exists_article['author'] != $user['id']) {
									$consult_author_name = $db->prepare("SELECT id,username FROM players WHERE id = ?");
									$consult_author_name->bindValue($result_if_exists_article['author']);
									$consult_author_name->execute();
									$result_author_name = $consult_author_name->fetch(PDO::FETCH_ASSOC);

									$insert_panel_log = $db->prepare("INSERT INTO cms_panel_logs (label) VALUES (?)");
									$insert_panel_log->bindValue(1, 'article/edit;no-belong;' . $user['username'] . '/' . $user['id'] . ';' . $article_id . ';' . $result_author_name['username'] . '/' . $result_author_name['id'] . ';' . TIME . ';' . IP . ';success');
									$insert_panel_log->execute();
								} else {
									$insert_panel_log = $db->prepare("INSERT INTO cms_panel_logs (label) VALUES (?)");
									$insert_panel_log->bindValue(1, 'article/edit;belong;' . $user['username'] . '/' . $user['id'] . ';' . $article_id . ';' . TIME . ';' . IP . ';success');
									$insert_panel_log->execute();
								}

								echo json_encode([
									"response" => 'warn',
									"append" => '<div class="form-warn success mr-bottom-1"><label class="flex-column"><h4 class="bold uppercase">Sucesso!</h4><h5>Você editou com sucesso esta noticia!</h5></label></div>',
									"updates" => [
										"title" => Functions::Filter('xss', $title)
									]
								]);
							}
						}
					}
				}
			}
		} else if ($order == 'article/delete') {
			$article_id = (isset($_POST['article_id'])) ? $_POST['article_id'] : '';

			if (is_numeric($article_id)) {
				$consult_if_exists_article = $db->prepare("SELECT * FROM cms_news WHERE id = ?");
				$consult_if_exists_article->bindValue(1, $article_id);
				$consult_if_exists_article->execute();

				if ($consult_if_exists_article->rowCount() > 0) {
					$result_if_exists_article = $consult_if_exists_article->fetch(PDO::FETCH_ASSOC);

					if ($user['rank'] > $administrator || $user['id'] == $result_if_exists_article['author']) {
						$delete_article = $db->prepare("DELETE FROM cms_news WHERE id = ?");
						$delete_article->bindValue(1, $result_if_exists_article['id']);
						$delete_article->execute();

						$delete_article_reactions = $db->prepare("DELETE FROM cms_post_reaction WHERE type = ? AND post_id = ?");
						$delete_article_reactions->bindValue(1, 'article');
						$delete_article_reactions->bindValue(2, $result_if_exists_article['id']);
						$delete_article_reactions->execute();


						#--------------------------------------------------------------------------------------------------------#

						echo json_encode([
							"response" => 'success'
						]);
					} else {
						echo json_encode([
							"response" => 'error'
						]);
					}
				} else {
					echo json_encode([
						"response" => 'error'
					]);
				}
			} else {
				echo json_encode([
					"response" => 'error'
				]);
			}
		} else if ($order == 'campaign/edit') {

			$article_id = (isset($_POST['article_id'])) ? $_POST['article_id'] : '';

			$campaignTitle = (isset($_POST['titleCampaign'])) ? $_POST['titleCampaign'] : '';
			$descriptionCampaign = (isset($_POST['descriptionCampaign'])) ? $_POST['descriptionCampaign'] : '';
			$thumbnailCampaign = (isset($_POST['thumbnailCampaign'])) ? $_POST['thumbnailCampaign'] : '';
			$idCampaign = (isset($_POST['idCampaign'])) ? $_POST['idCampaign'] : '';
			$activeCampaign = (isset($_POST['activeCampaign'])) ? $_POST['activeCampaign'] : '';

			if (empty($campaignTitle)) {
				echo json_encode([
					"response" => 'error',
					"input" => 'input[name="title-campaign"]',
					"error" => [
						"class" => 'div.col-input-separator:nth-child(2) > .error-input-warn',
						"text" => 'Você não pode deixar o titulo da campanha vázio.'
					]
				]);
			} else if (empty($descriptionCampaign)) {
				echo json_encode([
					"response" => 'error',
					"input" => 'input[name="description-campaign"]',
					"error" => [
						"class" => 'div.col-input-separator:nth-child(3) > .error-input-warn',
						"text" => 'Você não pode deixar a descrição da campanha vázia.'
					]
				]);
			} else if (empty($thumbnailCampaign)) {
				echo json_encode([
					"response" => 'error',
					"input" => 'input[name="thumbnail-campaign"]',
					"error" => [
						"class" => 'div.col-input-separator:nth-child(4) > .error-input-warn',
						"text" => 'Você não pode deixar a thumbnail da campanha vázia.'
					]
				]);
			} else if (empty($idCampaign)) {
				echo json_encode([
					"response" => 'error',
					"input" => 'input[name="id-campaign"]',
					"error" => [
						"class" => 'div.col-input-separator:nth-child(5) > .error-input-warn',
						"text" => 'Você não pode deixar id da campanha vázio.'
					]
				]);
			} else if (!is_numeric($idCampaign)) {
				echo json_encode([
					"response" => 'error',
					"input" => 'input[name="id-campaign"]',
					"error" => [
						"class" => 'div.col-input-separator:nth-child(5) > .error-input-warn',
						"text" => 'O id da notícia não pode conter caracteres.'
					]
				]);
			} else {
				$verifyHasExists = $db->prepare("SELECT * FROM cms_weekly_columns WHERE news_id = ?");
				$verifyHasExists->bindValue(1, $idCampaign);
				$verifyHasExists->execute();

				if ($verifyHasExists->rowCount() > 0) {

					$updateCampaign = $db->prepare("UPDATE cms_weekly_columns SET image = ?, title = ?, description = ?, news_id = ? WHERE news_id = ?");
					$updateCampaign->bindValue(1, $thumbnailCampaign);
					$updateCampaign->bindValue(2, $campaignTitle);
					$updateCampaign->bindValue(3, $descriptionCampaign);
					$updateCampaign->bindValue(4, $idCampaign);
					$updateCampaign->bindValue(5, $article_id);
					$updateCampaign->execute();

					$updateStatusCampaign = $db->prepare("UPDATE cms_news SET active_campaign = ? WHERE id = ? AND author = ?");
					$updateStatusCampaign->bindValue(1, $activeCampaign);
					$updateStatusCampaign->bindValue(2, $idCampaign);
					$updateStatusCampaign->bindValue(3, $user['id']);
					$updateStatusCampaign->execute();

					$insertLog = $db->prepare("INSERT INTO cms_panel_logs (label) VALUES(?)");
					$insertLog->bindValue(1, 'edited-campaign;' . $user['username'] . ';' . TIME . ';' . IP . ';success');
					$insertLog->execute();

					#--------------------------------------------------------------------------------------------------------#

					echo json_encode([
						"response" => 'success',
						"append" => '<div class="form-warn success mr-bottom-1"><label class="flex-column"><h4 class="bold uppercase">Sucesso!</h4><h5>Você editou sua campanha com êxito.</h5></label></div>'
					]);

				} else {

					$insertCampaign = $db->prepare("INSERT INTO cms_weekly_columns (image, title, description, news_id) VALUES (?,?,?,?)");
					$insertCampaign->bindValue(1, $thumbnailCampaign);
					$insertCampaign->bindValue(2, $campaignTitle);
					$insertCampaign->bindValue(3, $descriptionCampaign);
					$insertCampaign->bindValue(4, $idCampaign);
					$insertCampaign->execute();

					$updateStatusCampaign = $db->prepare("UPDATE cms_news SET active_campaign = ? WHERE id = ? AND author = ?");
					$updateStatusCampaign->bindValue(1, $activeCampaign);
					$updateStatusCampaign->bindValue(2, $idCampaign);
					$updateStatusCampaign->bindValue(3, $user['id']);
					$updateStatusCampaign->execute();

					$insertLog = $db->prepare("INSERT INTO cms_panel_logs (label) VALUES(?)");
					$insertLog->bindValue(1, 'insert-campaign;' . $user['username'] . ';' . TIME . ';' . IP . ';success');
					$insertLog->execute();

					#--------------------------------------------------------------------------------------------------------#

					echo json_encode([
						"response" => 'success',
						"append" => '<div class="form-warn success mr-bottom-1"><label class="flex-column"><h4 class="bold uppercase">Sucesso!</h4><h5>Você inseriu sua campanha com êxito.</h5></label></div>'
					]);
				}
			}


		} else if ($order == 'hall-points') {
			$username = (isset($_POST['username'])) ? $_POST['username'] : '';
			$points_type = (isset($_POST['points_type'])) ? $_POST['points_type'] : '';
			$points_amount = (isset($_POST['points_amount'])) ? $_POST['points_amount'] : '';
			$points_action = (isset($_POST['points_action'])) ? $_POST['points_action'] : '';

			$consult_if_user_exists = $db->prepare("SELECT * FROM players WHERE username = ?");
			$consult_if_user_exists->bindValue(1, $username);
			$consult_if_user_exists->execute();

			if ($points_type == 'events') {
				$points_type_name = 'Eventos';
			} else if ($points_type == 'promotions') {
				$points_type_name = 'Promoções';
			} else {
				$points_type_name = 'Entretenimento';
			}

			if ($points_action == 'add-points') {
				$points_action_name = 'Adicionar';
			} else if ($points_action == 'remove-points') {
				$points_action_name = 'Remover';
			} else {
				$points_action_name = 'Manusear';
			}

			if (empty($username)) {
				echo json_encode([
					"response" => 'error',
					"input" => 'input[name="username"]',
					"error" => [
						"class" => 'div.col-input-separator:nth-child(2) > .error-input-warn',
						"text" => 'Você precisa fornecer um nome de usuário para <span class="lowercase">' . $points_action_name . '</span> os pontos de <span class="lowercase">' . $points_type_name . '</span>.' 
					]
				]);
			} else if (empty($points_type)) {
				echo json_encode([
					"response" => 'error',
					"input" => 'select[name="points-type"]',
					"error" => [
						"class" => 'div.col-input-separator:nth-child(3) > .error-input-warn',
						"text" => 'Você precisa escolher o tipo dos pontos que você quer manusear.' 
					]
				]);
			} else if (!is_numeric($points_amount)) {
				echo json_encode([
					"response" => 'error',
					"input" => 'input[name="points-amount"]',
					"error" => [
						"class" => 'div.col-input-separator:nth-child(4) > .error-input-warn',
						"text" => 'Você precisa fornecer uma quantia de pontos de <span class="lowercase">' . $points_type_name . '</span> válidos.' 
					]
				]);
			} else if (empty($points_action)) {
				echo json_encode([
					"response" => 'error',
					"input" => 'select[name="points-action"]',
					"error" => [
						"class" => 'div.col-input-separator:nth-child(5) > .error-input-warn',
						"text" => 'Você precisa escolher se quer remover ou adicionar pontos de <span class="lowercase">' . $points_type_name . '</span> de certo usuário.'
					]
				]);
			} else {
				if ($consult_if_user_exists->rowCount() == 0) {
					echo json_encode([
						"response" => 'error',
						"input" => 'input[name="username"]',
						"error" => [
							"class" => 'div.col-input-separator:nth-child(2) > .error-input-warn',
							"text" => 'Não foi possível encontrar nenhum usuário com o nome fornecido no nosso banco de dados.' 
						]
					]);
				} else {
					$result_if_user_exists = $consult_if_user_exists->fetch(PDO::FETCH_ASSOC);

					if ($points_type == 'events') {
						if ($points_action == 'add-points') {

							if ($points_amount > 10) {
								echo json_encode([
									"response" => 'error',
									"input" => 'input[name="points-amount"]',
									"error" => [
										"class" => 'div.col-input-separator:nth-child(5) > .error-input-warn',
										"text" => 'Você não pode adicionar uma quantia maior que 10 pontos de eventos.' 
									]
								]);
							} else if ($username == $user['username']) {
								echo json_encode([
									"response" => 'error',
									"input" => 'select[name="points-action"]',
									"error" => [
										"class" => 'div.col-input-separator:nth-child(6) > .error-input-warn',
										"text" => 'Você não pode adicionar pontos de eventos para você mesmo.' 
									]
								]);
							} else {
								$add_point = $db->prepare("UPDATE players SET event_points = event_points+? WHERE username = ?");
								$add_point->bindValue(1, $points_amount);
								$add_point->bindValue(2, $username);
								$add_point->execute();
								
								$insertLog = $db->prepare("INSERT INTO cms_panel_logs (label) VALUES(?)");
								$insertLog->bindValue(1, 'add-event-points;' . $user['username'] . ';' . TIME . ';' . IP . ';success');
								$insertLog->execute();

								#--------------------------------------------------------------------------------------------------------#

								echo json_encode([
									"response" => 'success',
									"append" => '<div class="form-warn success mr-bottom-1"><label class="flex-column"><h4 class="bold uppercase">Sucesso!</h4><h5>Você adicionou ' . $points_amount . ' pontos de eventos para o usuário <b>' . $username . '</b></h5></label></div>'
								]);
							}



						} else if ($points_action == 'remove-points') {
							if ($result_if_user_exists['event_points'] == '0') {
								echo json_encode([
									"response" => 'error',
									"input" => 'input[name="points-amount"]',
									"error" => [
										"class" => 'div.col-input-separator:nth-child(4) > .error-input-warn',
										"text" => 'O usuário fornecido não contém pontos de eventos para a remoção.'
									]
								]);
							} else if ($points_amount > 20) {
								echo json_encode([
									"response" => 'error',
									"input" => 'input[name="points-amount"]',
									"error" => [
										"class" => 'div.col-input-separator:nth-child(4) > .error-input-warn',
										"text" => 'Você não pode remover uma quantia maior que 20 pontos de eventos.' 
									]
								]);
							} else if ($points_amount > $result_if_user_exists['event_points']) {
								echo json_encode([
									"response" => 'error',
									"input" => 'input[name="points-amount"]',
									"error" => [
										"class" => 'div.col-input-separator:nth-child(5) > .error-input-warn',
										"text" => 'Não foi possível remover a quantia de pontos de eventos fornecida por conta do usuário ter a quantia maior que fornecida para remoção.' 
									]
								]);
							} else {
								$remove_points = $db->prepare("UPDATE players SET event_points = event_points-? WHERE username = ?");
								$remove_points->bindValue(1, $points_amount);
								$remove_points->bindValue(2, $username);
								$remove_points->execute();

								$insertLog = $db->prepare("INSERT INTO cms_panel_logs (label) VALUES(?)");
								$insertLog->bindValue(1, 'remove-event-points;' . $user['username'] . ';' . TIME . ';' . IP . ';success');
								$insertLog->execute();

								echo json_encode([
									"response" => 'success',
									"append" => '<div class="form-warn error mr-bottom-1"><label class="flex-column"><h4 class="bold uppercase">Sucesso!</h4><h5>Você removeu ' . $points_amount . ' pontos de eventos de ' . $result_if_user_exists['username'] . '.</h5></label></div>'
								]);
							}
						}
					} else if ($points_type == 'promotions') {
						if ($points_action == 'add-points') {
							if ($points_amount > 5) {
								echo json_encode([
									"response" => 'error',
									"input" => 'input[name="points-amount"]',
									"error" => [
										"class" => 'div.col-input-separator:nth-child(5) > .error-input-warn',
										"text" => 'Você não pode adicionar uma quantia maior que 5 pontos de promoções.' 
									]
								]);
							} else if ($username == $user['username']) {
								echo json_encode([
									"response" => 'error',
									"input" => 'select[name="points-action"]',
									"error" => [
										"class" => 'div.col-input-separator:nth-child(6) > .error-input-warn',
										"text" => 'Você não pode adicionar pontos de promoções para você mesmo.' 
									]
								]);
							} else {
								$add_point_promo = $db->prepare("UPDATE players SET promo_points = promo_points+? WHERE username = ?");
								$add_point_promo->bindValue(1, $points_amount);
								$add_point_promo->bindValue(2, $username);
								$add_point_promo->execute();
								
								$insertLog = $db->prepare("INSERT INTO cms_panel_logs (label) VALUES(?)");
								$insertLog->bindValue(1, 'add-promo-points;' . $user['username'] . ';' . TIME . ';' . IP . ';success');
								$insertLog->execute();

								#--------------------------------------------------------------------------------------------------------#

								echo json_encode([
									"response" => 'success',
									"append" => '<div class="form-warn success mr-bottom-1"><label class="flex-column"><h4 class="bold uppercase">Sucesso!</h4><h5>Você adicionou ' . $points_amount . ' pontos de promoçoes para o usuário <b>' . $username . '</b></h5></label></div>'
								]);
							}
						} else if ($points_action == 'remove-points') {
							if ($points_amount > 20) {
								echo json_encode([
									"response" => 'error',
									"input" => 'input[name="points-amount"]',
									"error" => [
										"class" => 'div.col-input-separator:nth-child(4) > .error-input-warn',
										"text" => 'Você não pode remover uma quantia maior que 20 pontos de eventos.' 
									]
								]);
							} else 	if ($result_if_user_exists['promo_points'] == '0') {
								echo json_encode([
									"response" => 'error',
									"input" => 'input[name="points-amount"]',
									"error" => [
										"class" => 'div.col-input-separator:nth-child(4) > .error-input-warn',
										"text" => 'O usuário fornecido não contém pontos de promoção para a remoção.'
									]
								]);
							} else if ($points_amount > $result_if_user_exists['promo_points']) {
								echo json_encode([
									"response" => 'error',
									"input" => 'input[name="points-amount"]',
									"error" => [
										"class" => 'div.col-input-separator:nth-child(5) > .error-input-warn',
										"text" => 'Não foi possível remover a quantia de pontos de promoçoes fornecida por conta do usuário ter a quantia maior que fornecida para remoção.' 
									]
								]);
							} else {
								$remove_points_promo = $db->prepare("UPDATE players SET promo_points = promo_points-? WHERE username = ?");
								$remove_points_promo->bindValue(1, $points_amount);
								$remove_points_promo->bindValue(2, $username);
								$remove_points_promo->execute();

								$insertLog = $db->prepare("INSERT INTO cms_panel_logs (label) VALUES(?)");
								$insertLog->bindValue(1, 'remove-promo-points;' . $user['username'] . ';' . TIME . ';' . IP . ';success');
								$insertLog->execute();

								echo json_encode([
									"response" => 'success',
									"append" => '<div class="form-warn error mr-bottom-1"><label class="flex-column"><h4 class="bold uppercase">Sucesso!</h4><h5>Você removeu ' . $points_amount . ' pontos de promoções de ' . $result_if_user_exists['username'] . '.</h5></label></div>'
								]);
							}
						}
					}
				}
			}
		} else if ($order == 'add-pin') {

			$username = (isset($_POST['username'])) ? $_POST['username'] : '';
			$pin = (isset($_POST['pin'])) ? $_POST['pin'] : '';

			$verifyUsername = $db->prepare("SELECT username FROM players WHERE username = ?");
			$verifyUsername->bindValue(1, $username);
			$verifyUsername->execute();

			if (empty($username)) {
				echo json_encode([
					"response" => 'error',
					"input" => 'input[name="user-give-pin"]',
					"error" => [
						"class" => 'div.col-input-separator:nth-child(4) > .error-input-warn',
						"text" => 'Você precisa fornecer um nome de usuário para adicionar o pin a conta.' 
					]
				]);
			} else if (empty($pin)) {
				echo json_encode([
					"response" => 'error',
					"input" => 'input[name="user-pin"]',
					"error" => [
						"class" => 'div.col-input-separator:nth-child(4) > .error-input-warn',
						"text" => 'Você precisa fornecer um pin para o staff.' 
					]
				]);
			} else if (strlen($pin) < 4) {
				echo json_encode([
					"response" => 'error',
					"input" => 'input[name="user-pin"]',
					"error" => [
						"class" => 'div.col-input-separator:nth-child(4) > .error-input-warn',
						"text" => 'O pin tem que conter pelo menos 4 digitos.' 
					]
				]);
			} else if (!is_numeric($pin)) {
				echo json_encode([
					"response" => 'error',
					"input" => 'input[name="user-pin"]',
					"error" => [
						"class" => 'div.col-input-separator:nth-child(4) > .error-input-warn',
						"text" => 'O pin tem que conter apenas numeros.' 
					]
				]);
			} else if ($verifyUsername->rowCount() == 0) {
				echo json_encode([
					"response" => 'error',
					"input" => 'input[name="user-give-pin"]',
					"error" => [
						"class" => 'div.col-input-separator:nth-child(4) > .error-input-warn',
						"text" => 'O usuário digitado não existe.' 
					]
				]);
			} else {

				$updateUserPin = $db->prepare("UPDATE players SET pin_panel = ? WHERE username = ?");
				$updateUserPin->bindValue(1, $pin);
				$updateUserPin->bindValue(2, $username);
				$updateUserPin->execute();

				#--------------------------------------------------------------------------------------------------------#

				$insertLog = $db->prepare("INSERT INTO cms_panel_logs (label) VALUES(?)");
				$insertLog->bindValue(1, 'pin-created;' . $user['id'] . ';' . TIME . ';' . IP . ';success');
				$insertLog->execute();

				echo json_encode([
					"response" => 'success',
					"append" => '<div class="form-warn success mr-bottom-1"><label class="flex-column"><h4 class="bold uppercase">Sucesso!</h4><h5>Você adicionou o pin para o usuário <b>' . $username . '</b></h5></label></div>'
				]);
			}
		} else if ($order == 'give-rank') {
			$username = (isset($_POST['username'])) ? $_POST['username'] : '';
			$rank = (isset($_POST['rank'])) ? $_POST['rank'] : '';

			$consultUsername = $db->prepare("SELECT * FROM players WHERE username = ?");
			$consultUsername->bindValue(1, $username);
			$consultUsername->execute();
			$resultUsername = $consultUsername->fetch(PDO::FETCH_ASSOC);

			$consultRanks = $db->prepare("SELECT * FROM ranks WHERE id = ?");
			$consultRanks->bindValue(1, $rank);
			$consultRanks->execute();
			$resultRanks = $consultRanks->fetch(PDO::FETCH_ASSOC);

			if ($username != '' && $consultUsername->rowCount() == 0) {
				echo json_encode([
					"response" => 'error',
					"input" => 'input[name="user-give-rank"]',
					"error" => [
						"class" => 'div.col-input-separator:nth-child(3) > .error-input-warn',
						"text" => 'Não foi possivel encontrar o usuário <b>' . $username . '</b> no nosso banco de dados.' 
					]
				]);
			} else if (empty($username) || $username == '') {
				echo json_encode([
					"response" => 'error',
					"input" => 'input[name="user-give-rank"]',
					"error" => [
						"class" => 'div.col-input-separator:nth-child(3) > .error-input-warn',
						"text" => 'Você precisa fornecer um usuário para atualizar o cargo do(a) mesmo(a).' 
					]
				]);
			} else if (empty($rank) || $rank == '' || $rank == "Nenhum") {
				echo json_encode([
					"response" => 'error',
					"input" => 'select[name="user-rank"]',
					"error" => [
						"class" => 'div.col-input-separator:nth-child(4) > .error-input-warn',
						"text" => 'Você precisa escolher um cargo para atualizar.' 
					]
				]);
			} else if ($rank == $user['rank'] && $username == $user['username']) {
				echo json_encode([
					"response" => 'error',
					"input" => 'select[name="user-rank"]',
					"error" => [
						"class" => 'div.col-input-separator:nth-child(4) > .error-input-warn',
						"text" => 'Você já possui este cargo.' 
					]
				]);
			} else if ($rank > $user['rank'] && $username == $user['username']) {
				echo json_encode([
					"response" => 'error',
					"input" => 'select[name="user-rank"]',
					"error" => [
						"class" => 'div.col-input-separator:nth-child(4) > .error-input-warn',
						"text" => 'O cargo que você quer atualizar a sí mesmo é maior que o seu!' 
					]
				]);
			} else if ($rank > $user['rank']) {
				echo json_encode([
					"response" => 'error',
					"input" => 'select[name="user-rank"]',
					"error" => [
						"class" => 'div.col-input-separator:nth-child(4) > .error-input-warn',
						"text" => 'O cargo que você quer atualizar é maior que o seu!' 
					]
				]);
			} else if ($rank == $resultUsername['rank'] && $username != '') {
				echo json_encode([
					"response" => 'error',
					"input" => 'select[name="user-rank"]',
					"error" => [
						"class" => 'div.col-input-separator:nth-child(4) > .error-input-warn',
						"text" => 'Parece que ' . $username . ' já possui este cargo' 
					]
				]);
			} else if ($user['username'] == $username) {

				$updateRankUser = $db->prepare("UPDATE players SET rank = ? WHERE username = ?");
				$updateRankUser->bindValue(1, $rank);
				$updateRankUser->bindValue(2, $user['username']);
				$updateRankUser->execute();

				#--------------------------------------------------------------------------------------------------------#

				$insertLog = $db->prepare("INSERT INTO cms_panel_logs (label) VALUES(?)");
				$insertLog->bindValue(1, 'update-own-rank;' . $user['username'] . ';' . TIME . ';' . IP . ';success');
				$insertLog->execute();

				echo json_encode([
					"response" => 'success',
					"append" => '<div class="form-warn success mr-bottom-1"><label class="flex-column"><h4 class="bold uppercase">Sucesso!</h4><h5>Você atualizou seu cargo!</h5></label></div>'
				]);
			} else if ($username != $user['username']) {

				$updateRankUser = $db->prepare("UPDATE players SET rank = ? WHERE username = ?");
				$updateRankUser->bindValue(1, $rank);
				$updateRankUser->bindValue(2, $username);
				$updateRankUser->execute();

				#--------------------------------------------------------------------------------------------------------#
				$insertLog = $db->prepare("INSERT INTO cms_panel_logs (label) VALUES(?)");
				$insertLog->bindValue(1, 'update-rank-user;by' . $user['username'] . ';' . 'to:' . $username . ';' . TIME . ';' . IP . ';success');
				$insertLog->execute();
				

				echo json_encode([
					"response" => 'success',
					"append" => '<div class="form-warn success mr-bottom-1"><label class="flex-column"><h4 class="bold uppercase">Sucesso!</h4><h5>Você atualizou o cargo para o usuário: <b>' . $username . '</b></h5></label></div>'
				]);
			} else {
				echo json_encode([
					"response" => 'success',
					"append" => '<div class="form-warn error mr-bottom-1"><label class="flex-column"><h4 class="bold uppercase">Erro!</h4><h5>Algo inesperado aconteceu, contate algum desenvolvedor e informe-o.</h5></label></div>'
				]);
			}
		} else if ($order == 'create-page') {
			$caption = (isset($_POST['pageTitle'])) ? $_POST['pageTitle'] : '';
			$link = (isset($_POST['pageLink'])) ? $_POST['pageLink'] : '';

			$linkfilter = trim(mb_strtolower($link));
            $linkfilter = str_replace(' ', '-', $link);
            $linkfilter = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"), $link);
            $linkfilter = str_replace('&', 'e', $link);
            $linkfilter = str_replace('\'', '', $link);
            $linkfilter = str_replace(':', '', $link);
            $linkfilter = str_replace('ç', 'c', $link);
            $linkfilter = str_replace('[', '', $link);
            $linkfilter = str_replace(']', '', $link);

			
            $select = $db->prepare('SELECT id FROM catalog_pages WHERE caption = ? AND parent_id = ?');
            $select->bindValue(1, $caption);
            $select->bindValue(2, 423423581);
            $select->execute();

			$selectLink = $db->prepare('SELECT id FROM catalog_pages WHERE link = ?');
            $selectLink->bindValue(1, $link);
            $selectLink->execute();

			if (strlen($caption) < 2 || strlen($caption) > 50) {
				echo json_encode([
					"response" => 'error',
					"input" => 'input[name="titlePage"]',
					"error" => [
						"class" => 'div.col-input-separator:nth-child(3) > .error-input-warn',
						"text" => 'O título da página deve ter no mínimo 2 e no máximo 50 caracteres.!' 
					]
				]);
			} else if (empty($link)) {
				echo json_encode([
					"response" => 'error',
					"input" => 'input[name="linkPage"]',
					"error" => [
						"class" => 'div.col-input-separator:nth-child(4) > .error-input-warn',
						"text" => 'Você deve inserir um link para a página!' 
					]
				]);
			} else if ($selectLink->rowCount() > 0) {
				echo json_encode([
					"response" => 'error',
					"input" => 'input[name="linkPage"]',
					"error" => [
						"class" => 'div.col-input-separator:nth-child(4) > .error-input-warn',
						"text" => 'Já existe um link com este nome.' 
					]
				]);
			} else if ($select->rowCount() > 0) {
				echo json_encode([
					"response" => 'error',
					"input" => 'input[name="titlePage"]',
					"error" => [
						"class" => 'div.col-input-separator:nth-child(3) > .error-input-warn',
						"text" => 'Já existe uma página com este titulo.' 
					]
				]);
			} else {
				$insert = $db->prepare('INSERT INTO catalog_pages(parent_id, caption, icon_image, min_rank, order_num, page_layout, page_images, page_texts, link) 
				VALUES(:parentId, :caption, :iconImage, :minRank, :orderNum, :pageLayout, :pageImages, :pageTexts, :link)');
				$insert->bindValue(':parentId', 423423581);
				$insert->bindParam(':caption', $caption);
				$insert->bindValue(':iconImage', 289481);
				$insert->bindValue(':minRank', 7);
				$insert->bindValue(':orderNum', 1);
				$insert->bindValue(':pageLayout', 'default_3x3');
				$insert->bindValue(':pageImages', '');
				$insert->bindValue(':pageTexts', '');
				$insert->bindParam(':link', $linkfilter);
				$insert->execute();

				echo json_encode([
				"response" => 'success',
				"append" => '<div class="form-warn success mr-bottom-1"><label class="flex-column"><h4 class="bold uppercase">Sucesso!</h4><h5>Você criou a página: <b>' . $caption . '</b> com êxito.</h5></label></div>'
				]);
			}

			
		} else if ($order == 'add-furni') {
			date_default_timezone_set("America/Sao_Paulo");

			// Pasta onde o arquivo vai ser salvo
			$_UP['pasta1'] = '../swf/hof_furni/';
			$_UP['pasta2'] = '../swf/hof_furni/icons/';

			// Tamanho máximo do arquivo (em Bytes)
			$_UP['tamanho1'] = 1024 * 1024 * 40; // 40 MB
			$_UP['tamanho2'] = 1024 * 1024 * 10; // 10 MB

			$page = (isset($_POST['page'])) ? $_POST['page'] : '';
			$catalogName = (isset($_POST['catalogName'])) ? $_POST['catalogName'] : '';
			$costDiamonds = (isset($_POST['costDiamonds'])) ? $_POST['costDiamonds'] : '';
			$costCredits = (isset($_POST['costCredits'])) ? $_POST['costCredits'] : '';
			$costDuckets = (isset($_POST['costDuckets'])) ? $_POST['costDuckets'] : '';
			$costCrazzys = (isset($_POST['costCrazzys'])) ? $_POST['costCrazzys'] : '';
			$amount = (isset($_POST['amount'])) ? $_POST['amount'] : '';
			$limitedStack = (isset($_POST['limitedStack'])) ? $_POST['limitedStack'] : '';
			$badgeId = (isset($_POST['badgeId'])) ? $_POST['badgeId'] : '';
			$downloadFrom = (isset($_POST['downloadFrom'])) ? $_POST['downloadFrom'] : '';
			$itemName = (isset($_POST['itemName'])) ? $_POST['itemName'] : '';
			$publicName = (isset($_POST['publicName'])) ? $_POST['publicName'] : '';
			$typeMobi = (isset($_POST['typeMobi'])) ? $_POST['typeMobi'] : '';
			$width = (isset($_POST['width'])) ? $_POST['width'] : '';
			$length = (isset($_POST['length'])) ? $_POST['length'] : '';
			$stackHeight = (isset($_POST['stackHeight'])) ? $_POST['stackHeight'] : '';
			$canStack = (isset($_POST['canStack'])) ? $_POST['canStack'] : '';
			$canSit = (isset($_POST['canSit'])) ? $_POST['canSit'] : '';
			$isWalkable = (isset($_POST['isWalkable'])) ? $_POST['isWalkable'] : '';
			$allowRecycle = (isset($_POST['allowRecycle'])) ? $_POST['allowRecycle'] : '';
			$allowTrade = (isset($_POST['allowTrade'])) ? $_POST['allowTrade'] : '';
			$allowMarketplace = (isset($_POST['allowMarketplace'])) ? $_POST['allowMarketplace'] : '';
			$allowGift = (isset($_POST['allowGift'])) ? $_POST['allowGift'] : '';
			$allowInvStack = (isset($_POST['allowInvStack'])) ? $_POST['allowInvStack'] : '';
			$interactionType = (isset($_POST['interactionType'])) ? $_POST['interactionType'] : '';
			$interactionCount = (isset($_POST['interactionCount'])) ? $_POST['interactionCount'] : '';
			$vendingsId = (isset($_POST['vendingsId'])) ? $_POST['vendingsId'] : '';
			$variableHeight = (isset($_POST['variableHeight'])) ? $_POST['variableHeight'] : '';
			$effectId = (isset($_POST['effect_id'])) ? $_POST['effect_id'] : '';
			$description = (isset($_POST['description'])) ? $_POST['description'] : '';
			$canLayon = (isset($_POST['canLayon'])) ? $_POST['canLayon'] : '';
			$requireRights = (isset($_POST['requireRights'])) ? $_POST['requireRights'] : '';
			$idSound = (isset($_POST['idSound'])) ? $_POST['idSound'] : '';


			$time = time();
			$revision = 50000;
			$xml = '<furnitype id="' . $time . '" classname="' . $itemName . '">
			<revision>' . $revision . '</revision>
			<defaultdir>0</defaultdir>
			<xdim>1</xdim>
			<ydim>1</ydim>
			<partcolors/>
			<name>' . $publicName . '</name>
			<description>' . $description . '</description>
			<adurl/>
			<offerid>-1</offerid>
			<buyout>1</buyout>
			<rentofferid>-1</rentofferid>
			<rentbuyout>0</rentbuyout>
			<bc>1</bc>
			<excludeddynamic>0</excludeddynamic>
			<customparams/>
			<specialtype>1</specialtype>
			<canstandon>0</canstandon>
			<cansiton>0</cansiton>
			<canlayon>0</canlayon>
			<furniline>' . $itemName . '</furniline>
		</furnitype>';

		$furnitureExists = $db->prepare('SELECT id FROM furniture WHERE item_name = ?');
		$furnitureExists->bindValue(1, $itemName);
		$furnitureExists->execute();

		if($furnitureExists->rowCount() > 0) {
			echo json_encode([
				"response" => 'error',
				"input" => 'input[name="item_name"]',
				"error" => [
					"class" => 'div.col-input-separator:nth-child(13) > .error-input-warn',
					"text" => 'Já existe um mobi com este item_name (' . $itemName . ') cadastrado no banco.' 
				]
			]);
			return;
		} else if (file_exists($_UP['pasta1'] . $itemName . '.swf')) {
			echo json_encode([
				"response" => 'error',
				"input" => 'input[name="item_name"]',
				"error" => [
					"class" => 'div.col-input-separator:nth-child(13) > .error-input-warn',
					"text" => 'Este arquivo já existe no servidor (swf).' 
				]
			]);
			return;
		} else if (file_exists($_UP['pasta2'] . $itemName . '_icon.png')) {
			echo json_encode([
				"response" => 'error',
				"input" => 'input[name="item_name"]',
				"error" => [
					"class" => 'div.col-input-separator:nth-child(13) > .error-input-warn',
					"text" => 'Este arquivo já existe no servidor (icon).' 
				]
			]);
			return;
		}
		
		if ($downloadFrom == 'habbocity') {
			$urlMobi = 'https://swf.habbocity.me/dcr/hof_furni/' . $itemName . '.swf';
			$urlIcon = 'https://swf.habbocity.me/dcr/hof_furni/icons2/' . $itemName . '_icon.png';
		} else if ($downloadFrom == 'habblet') {
			$urlMobi = 'https://images.habblet.in/library/hof_furni/' . $itemName . '.swf';
			$urlIcon = 'https://images.habblet.in/library/hof_furni/icons/' . $itemName . '_icon.png';
		} else if ($downloadFrom == 'iron') {
			$urlMobi = 'https://cdn.ironhotel.biz/static_global/furniture/' . $itemName . '.swf';
			$urlIcon = 'https://cdn.ironhotel.biz/static_global/furniture/icons/' . $itemName . '_icon.png';
		}

		$destinoMobi = '../swf/hof_furni/' . basename($urlMobi);
		$destinoIcon = '../swf/hof_furni/icons/' . basename($urlIcon);

		ini_set('user_agent', 'Mozilla/4.0 (compatible; MSIE 6.0)');

		// tenta baixar e hospedar a swf no servidor do nosso hotel
		try {
			$content = file_get_contents($urlMobi);
			file_put_contents($destinoMobi, $content);

		} catch (Exception $e) {
			$msg = 'falha no download da swf: ' . $itemName . '.swf (' . $e->getMessage() . ')';
			Functions::insertRowInArchive($msg, '../files/painel/logs/furnidata_erros.txt');
			return;
		}

		// tenta baixar e hospedar oi icon no servidor do nosso hotel
		try {
			$content = file_get_contents($urlIcon);
			file_put_contents($destinoIcon, $content);
		} catch (Exception $e) {
			$msg = 'falha no download do ícone: ' . $itemName . '_icon.png (' . $e->getMessage() . ')';
			Functions::insertRowInArchive($msg, '../files/painel/logs/furnidata_erros.txt');
			return;
		}

		// insere em furniture
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

		$insertFurniture = $db->prepare('INSERT INTO furniture(item_name, public_name, type, width, length, stack_height, can_stack, can_sit, is_walkable, sprite_id, allow_recycle, allow_trade, 
																			allow_marketplace_sell, allow_gift, allow_inventory_stack, interaction_type, interaction_modes_count, vending_ids, effect_id, is_arrow, 
																			foot_figure, stack_multiplier, subscriber, variable_heights, flat_id, revision, description, specialtype, canlayon, requires_rights, song_id) 
						VALUES (:item_name, :public_name, :type, :width, :length, :stack_height, :can_stack, :can_sit, :is_walkable, :sprite_id, :allow_recycle, :allow_trade, 
								:allow_marketplace_sell, :allow_gift, :allow_inventory_stack, :interaction_type, :interaction_modes_count, :vending_ids, :effect_id, :is_arrow, 
								:foot_figure, :stack_multiplier, :subscriber, :variable_heights, :flat_id, :revision, :description, :specialtype, :canlayon, :requires_rights, :song_id)');

		$insertFurniture->bindParam(':item_name', $itemName);
		$insertFurniture->bindParam(':public_name', $publicName);
		$insertFurniture->bindParam(':type', $typeMobi);
		$insertFurniture->bindParam(':width', $width);
		$insertFurniture->bindParam(':length', $length);
		$insertFurniture->bindParam(':stack_height', $stackHeight);
		$insertFurniture->bindParam(':can_stack', $canStack);
		$insertFurniture->bindParam(':can_sit', $canSit);
		$insertFurniture->bindParam(':is_walkable', $isWalkable);
		$insertFurniture->bindParam(':sprite_id', $time); // new
		$insertFurniture->bindParam(':allow_recycle', $allowRecycle);
		$insertFurniture->bindParam(':allow_trade', $allowTrade);
		$insertFurniture->bindParam(':allow_marketplace_sell', $allowMarketplace);
		$insertFurniture->bindParam(':allow_gift', $allowGift);
		$insertFurniture->bindParam(':allow_inventory_stack', $allowInvStack);
		$insertFurniture->bindParam(':interaction_type', $interactionType);
		$insertFurniture->bindParam(':interaction_modes_count', $interactionCount);
		$insertFurniture->bindParam(':vending_ids', $vendingsId);
		$insertFurniture->bindParam(':effect_id', $effectId);
		$insertFurniture->bindValue(':is_arrow', 1);
		$insertFurniture->bindValue(':foot_figure', 0);
		$insertFurniture->bindValue(':stack_multiplier', 0);
		$insertFurniture->bindValue(':subscriber', 0);
		$insertFurniture->bindParam(':variable_heights', $variableHeight);
		$insertFurniture->bindValue(':flat_id', -1);
		$insertFurniture->bindParam(':revision', $revision); // new
		$insertFurniture->bindParam(':description', $description);
		$insertFurniture->bindValue(':specialtype', 1);
		$insertFurniture->bindParam(':canlayon', $canLayon);
		$insertFurniture->bindParam(':requires_rights', $requireRights);
		$insertFurniture->bindParam(':song_id', $idSound);

        $insertFurniture->execute();

		$findFurniture = $db->prepare('SELECT id FROM furniture WHERE item_name = :itemName');
		$findFurniture->bindParam(':itemName', $itemName);
		$findFurniture->execute();
		$findFurniture = $findFurniture->fetch();

		// insere em catalog_items
		$insertCatalogItem = $db->prepare('INSERT INTO catalog_items(page_id, item_ids, catalog_name, cost_credits, cost_pixels, cost_diamonds, cost_seasonal, amount, limited_stack, extradata, badge_id) 
																		VALUES (:pageId, :itemIds, :catalogName, :costCredits, :costPixels, :costDiamonds, :costSeasonal, :amount, :limitedStack, :extraData, :badgeId)');
		$insertCatalogItem->bindParam(':pageId', $page);
		$insertCatalogItem->bindParam(':itemIds', $findFurniture['id']);
		$insertCatalogItem->bindParam(':catalogName', $catalogName);
		$insertCatalogItem->bindParam(':costCredits', $costCredits);
		$insertCatalogItem->bindParam(':costPixels', $costDuckets);
		$insertCatalogItem->bindParam(':costDiamonds', $costDiamonds);
		$insertCatalogItem->bindParam(':costSeasonal', $costCrazzys);
		$insertCatalogItem->bindParam(':amount', $amount);
		$insertCatalogItem->bindParam(':limitedStack', $limitedStack);
		$insertCatalogItem->bindValue(':extraData', '');
		$insertCatalogItem->bindParam(':badgeId', $badgeId);
		$insertCatalogItem->execute();
		
		Functions::insertRowInArchive($xml, '../swf/gamedata/furnidata_temp.xml');

		echo json_encode([
			"response" => 'success',
			"append" => '<div class="form-warn success mr-bottom-1"><label class="flex-column"><h4 class="bold uppercase">Sucesso!</h4><h5>Você hospedou o mobi <b>' . $publicName . '</b> com êxito! Digite ":reload items" e ":reload catalog" (nessa ordem) no Hotel para atualizar (apenas membros superiores).</h5></label></div>'
		]);
		
		} else if ($order == 'edit-user') {
			$username = (isset($_POST['username'])) ? $_POST['username'] : '';
			
			$findUsername = $db->prepare("SELECT id, username, rank FROM players WHERE username = ?");
			$findUsername->bindValue(1, $username);
			$findUsername->execute();

			if (empty($username)) {
				echo json_encode([
					"response" => 'error',
					"input" => 'input[name="username"]',
					"error" => [
						"class" => 'div.col-input-separator:nth-child(3) > .error-input-warn',
						"text" => 'Você deve informar um usuário que deseja editar-lo.' 
					]
				]);
			} else if ($findUsername->rowCount() == 1) {
				$resultUsername = $findUsername->fetch(PDO::FETCH_ASSOC);

				if ($resultUsername['rank'] >= $user['rank']) {
					echo json_encode([
						"response" => 'error',
						"input" => 'input[name="username"]',
						"error" => [
							"class" => 'div.col-input-separator:nth-child(3) > .error-input-warn',
							"text" => 'Você não pode editar um usuário com rank maior ou igual ao seu.' 
						]
					]);
				} else {
					echo json_encode([
						"response" => 'success',
						"append" => '<div class="form-warn success mr-bottom-1"><label class="flex-column"><h4 class="bold uppercase">Encontrado!</h4><h5>Clique <a href="/panel/user/' . $username . '" style="text-decoration:none;color:#FFF;">AQUI</a> para editar a conta.</h5></label></div>'
					]);
				}
			} else {
				echo json_encode([
					"response" => 'error',
					"input" => 'input[name="username"]',
					"error" => [
						"class" => 'div.col-input-separator:nth-child(3) > .error-input-warn',
						"text" => 'O usuário <b>' . $username . '</b> não foi encontrado no nosso banco de dados.' 
					]
				]);
			}

		} else if ($order == 'info-user') {
			$id = (isset($_POST['id'])) ? $_POST['id'] : '';
			$username = (isset($_POST['username'])) ? $_POST['username'] : '';
			$email = (isset($_POST['email'])) ? $_POST['email'] : '';
			$motto = (isset($_POST['motto'])) ? $_POST['motto'] : '';
			$rank = (isset($_POST['rank'])) ? $_POST['rank'] : '';

			$userExistente = $db->prepare("SELECT username, rank FROM players WHERE id = ?");
			$userExistente->bindValue(1, $id);
			$userExistente->execute();
			$userExistente = $userExistente->rowCount() > 0 ? $userExistente->fetch() : null;

			if (empty($username)) {
				echo json_encode([
					"response" => 'error',
					"input" => 'input[name="info-username"]',
					"error" => [
						"class" => 'div.col-input-separator:nth-child(4) > .error-input-warn',
						"text" => 'O nome do usuário não pode ficar em branco.' 
					]
				]);
			} else if (empty($email)) {
				echo json_encode([
					"response" => 'error',
					"input" => 'input[name="info-email"]',
					"error" => [
						"class" => 'div.col-input-separator:nth-child(5) > .error-input-warn',
						"text" => 'O email não pode ficar em branco.' 
					]
				]);
			} else if (empty($rank)) {
				echo json_encode([
					"response" => 'error',
					"input" => 'select[name="info-rank"]',
					"error" => [
						"class" => 'div.col-input-separator:nth-child(7) > .error-input-warn',
						"text" => 'O rank não pode ficar em branco.' 
					]
				]);
			} else if ($rank >= $user['rank'] && $userExistente != null && $rank != $userExistente['rank']) {
				echo json_encode([
					"response" => 'error',
					"input" => 'select[name="info-rank"]',
					"error" => [
						"class" => 'div.col-input-separator:nth-child(7) > .error-input-warn',
						"text" => 'O cargo que você está dando é maior ou igual ao seu.' 
					]
				]);
			} else if ($username == $user['username'] && $rank > $user['rank']) {
				echo json_encode([
					"response" => 'error',
					"input" => 'select[name="info-rank"]',
					"error" => [
						"class" => 'div.col-input-separator:nth-child(7) > .error-input-warn',
						"text" => 'Você não pode aumentar o seu próprio rank.' 
					]
				]);
			} else if ($userExistente != null && strtolower($userExistente['username']) != strtolower($_POST['username']) && User::usertaken($_POST['username'])) {
				echo json_encode([
					"response" => 'error',
					"input" => 'input[name="info-username"]',
					"error" => [
						"class" => 'div.col-input-separator:nth-child(4) > .error-input-warn',
						"text" => 'O nome do usuário já está em uso.' 
					]
				]);
			} else {
				
				$ranks = $db->prepare("SELECT id, name FROM ranks");
				$ranks->execute();

				while ($result_rank = $ranks->fetch(PDO::FETCH_ASSOC)) {
					if ($rank == $result_rank['id']) {

						$updateUser = $db->prepare("UPDATE players SET username = ?, email = ?, motto = ?, rank = ? WHERE id = ?");
						$updateUser->bindValue(1, $username);
						$updateUser->bindValue(2, $email);
						$updateUser->bindValue(3, Functions::Filter('xss', $motto));
						$updateUser->bindValue(4, $rank);
						$updateUser->bindValue(5, $id);
						$updateUser->execute();

						$updateRoom = $db->prepare('UPDATE rooms SET owner = ? WHERE owner_id = ?');
                        $updateRoom->bindValue(1, $username);
                        $updateRoom->bindValue(2, $id);
                        $updateRoom->execute();

						if ($updateUser->rowCount() > 0) {
							echo json_encode([
								"response" => 'success',
								"append" => '<div class="form-warn success mr-bottom-1"><label class="flex-column"><h4 class="bold uppercase">Sucesso!</h4><h5>Você editou o usuário <b>' . $username . '</b> com sucesso!</h5></label></div>'
							]);
						} else {
							echo json_encode([
								"response" => 'success',
								"append" => '<div class="form-warn error mr-bottom-1"><label class="flex-column"><h4 class="bold uppercase">Hmm..</h4><h5>Você não fez nenhuma alteração para salvar.</h5></label></div>'
							]);
						}
					}
				}

			}
		} else if ($order == 'send-vip') {
			$username = (isset($_POST['username'])) ? $_POST['username'] : '';
			$plans = (isset($_POST['plans'])) ? $_POST['plans'] : '';

            $searchUser = $db->prepare("SELECT id,vip_expire,vip_points,vip,achievement_points,activity_points FROM players WHERE username = ?");
            $searchUser->bindValue(1, $username);
            $searchUser->execute();

			
			if (empty($username)) {
				echo json_encode([
					"response" => 'error',
					"input" => 'input[name="username"]',
					"error" => [
						"class" => 'div.col-input-separator:nth-child(3) > .error-input-warn',
						"text" => 'O nome do usuário não pode ficar em branco.' 
					]
				]);
				return;
			}

			if ($searchUser->rowCount() == 1) {

				$result = $searchUser->fetch();

				$isVip = $result['vip'];
				$vipExpire = $result['vip_expire'];
				$vipPoints = $result['vip_points'];
				$duckets = $result['activity_points'];
				$achievementsPoints = $result['achievement_points'];

				$configsVips = $db->prepare("SELECT * FROM cms_clubvip");
				$configsVips->execute();
				$configsVips = $configsVips->rowCount() == 1 ? $configsVips->fetch() : null;

				//15 DIAS PREMIOS
				$diamonds15Days = $configsVips != null ? $configsVips['fiveteen_diamonds_amount'] : 500;
				$duckets15Days = $configsVips != null ? $configsVips['fiveteen_duckets_amount'] : 30;
				$achievements15Days = $configsVips != null ? $configsVips['fiveteen_achievements_amount'] : 500;

				//1 MES PREMIOS
				$diamondsOneMonth = $configsVips != null ? $configsVips['one_month_diamonds_amount'] : 1000;
				$ducketsOneMonth = $configsVips != null ? $configsVips['one_month_duckets_amount']: 60;
				$achievementOneMonth = $configsVips != null ? $configsVips['one_month_achievements_amount'] : 1000;

				//2 MESES
				$diamondsTwoMonth = $configsVips != null ? $configsVips['two_month_diamonds_amount'] : 2000;
				$ducketsTwoMonth = $configsVips != null ? $configsVips['two_month_duckets_amount'] : 120;
				$achievementsTwoMonth = $configsVips != null ? $configsVips['two_month_achievements_amount'] : 2000;

				//3 MESES
				$diamondsThreeMonth = $configsVips != null ? $configsVips['three_month_diamonds_amount']: 5000;
				$ducketsThreeMonth = $configsVips != null ? $configsVips['three_month_duckets_amount'] : 200;
				$achievementsThreeMonth = $configsVips != null ? $configsVips['three_month_achievements_amount'] : 5000;

				//Verificar se já possui o emblema
				$verifyHasExistBadgeVip = $db->prepare("SELECT id FROM player_badges WHERE badge_code = ? AND player_id = ?");
				$verifyHasExistBadgeVip->bindValue(1, 'VIP2021'); // NOME EMBLEMA)
				$verifyHasExistBadgeVip->bindValue(2, $result['id']);
				$verifyHasExistBadgeVip->execute();                

				$allResults = $verifyHasExistBadgeVip->rowCount();

				if ($plans == 15) {

					if ($isVip == 1 && $vipExpire != null) {
						$date = date('Y-m-d', strtotime($vipExpire));
						$time = date('Y-m-d H:i:s', strtotime("$date +2 week +1 day"));
					} else {
						$time = date('Y-m-d H:i:s', strtotime("+2 week +1 day"));  
					}

					$vipPoints += $diamonds15Days;
                    $duckets += $duckets15Days;
                    $achievementsPoints += $achievements15Days;

					//ENVIAR DADOS
					$sendPlan15 = $db->prepare("UPDATE players SET achievement_points = ?, rank = ?, vip = ?, vip_expire = ?, vip_points = ?, activity_points = ? WHERE username = ?");
					$sendPlan15->bindValue(1, $achievementsPoints);
					$sendPlan15->bindValue(2, '2');
					$sendPlan15->bindValue(3, '1');
					$sendPlan15->bindValue(4, $time);
					$sendPlan15->bindValue(5, $vipPoints);
					$sendPlan15->bindValue(6, $duckets);
					$sendPlan15->bindValue(7, $username);
					$sendPlan15->execute();

					//ENVIANDO EMBLEMA
				if ($allResults <= 0) {
					$sendPlan15Badge = $db->prepare("INSERT INTO player_badges (badge_code, player_id) VALUES (?,?)");
					$sendPlan15Badge->bindValue(1, "VIP2021"); //NOME EMBLEMA
					$sendPlan15Badge->bindValue(2, $result['id']);
					$sendPlan15Badge->execute();
	
				}
	
					$verifyHasExistBadgeRarePink = $db->prepare("SELECT id FROM player_badges WHERE badge_code = ? AND player_id = ?");
					$verifyHasExistBadgeRarePink->bindValue(1, 'VIPROS'); // NOME EMBLEMA)
					$verifyHasExistBadgeRarePink->bindValue(2, $result['id']);
					$verifyHasExistBadgeRarePink->execute();
					$resultPink = $verifyHasExistBadgeRarePink->rowCount();
		
				if($resultPink <= 0) {
					$sendPlan15Badge2 = $db->prepare("INSERT INTO player_badges (badge_code, player_id) VALUES (?,?)");
					$sendPlan15Badge2->bindValue(1, "VIPROS"); //NOME EMBLEMA
					$sendPlan15Badge2->bindValue(2, $result['id']); 
					$sendPlan15Badge2->execute();
				}
		
				//ENVIANDO RARO
				$sendPlan15Rare = $db->prepare("INSERT INTO items (user_id, room_id, base_item, extra_data, wall_pos) VALUES (?,?,?,?,?)");
				$sendPlan15Rare->bindValue(1, $result['id']);
				$sendPlan15Rare->bindValue(2, '0'); // 0 envia pro inventário
				$sendPlan15Rare->bindValue(3, '1356474394'); // id do mobi no catalogo
				$sendPlan15Rare->bindValue(4, '0');
				$sendPlan15Rare->bindValue(5, ' '); 
				$sendPlan15Rare->execute();

				echo json_encode([
					"response" => 'success',
					"append" => '<div class="form-warn vipink mr-bottom-1"><label class="flex-column"><h4 class="bold uppercase">Sucesso!</h4><h5>Você enviou o plano de <b>' . $plans . ' dias</b> para <b>' . $username . '</b> com sucesso!</h5></label></div>'
				]);
			
				} else if ($plans == 30) {

					$date = date('Y-m-d', strtotime($vipExpire));

					if ($isVip == 1 && $vipExpire != null) {
                        $time = date('Y-m-d H:i:s', strtotime("$date +1 month"));
					} else {
                        $time = date('Y-m-d H:i:s', strtotime("+1 month"));                    
					}

					$vipPoints += $diamondsOneMonth;
                    $duckets += $ducketsOneMonth;
                    $achievementsPoints += $achievementOneMonth;

					//ENVIAR DADOS
					$sendPlan1Month = $db->prepare("UPDATE players SET achievement_points = ?, rank = ?, vip = ?, vip_expire = ?, vip_points = ?, activity_points = ? WHERE username = ?");
					$sendPlan1Month->bindValue(1, $achievementsPoints);
					$sendPlan1Month->bindValue(2, '2');
					$sendPlan1Month->bindValue(3, '1');
					$sendPlan1Month->bindValue(4, $time);
					$sendPlan1Month->bindValue(5, $vipPoints);
					$sendPlan1Month->bindValue(6, $duckets);
					$sendPlan1Month->bindValue(7, $username);
					$sendPlan1Month->execute();
		
					//ENVIANDO EMBLEMA
					if($allResults <= 0) {
						$sendPlan1MonthBadge = $db->prepare("INSERT INTO player_badges (badge_code, player_id) VALUES (?,?)");
						$sendPlan1MonthBadge->bindValue(1, "VIP2021"); //NOME EMBLEMA
						$sendPlan1MonthBadge->bindValue(2, $result['id']);
						$sendPlan1MonthBadge->execute();
		
					}
		
		
					$verifyHasExistBadgeRareYellow = $db->prepare("SELECT id FROM player_badges WHERE badge_code = ? AND player_id = ?");
					$verifyHasExistBadgeRareYellow->bindValue(1, 'VIPAMA'); // NOME EMBLEMA
					$verifyHasExistBadgeRareYellow->bindValue(2, $result['id']);
					$verifyHasExistBadgeRareYellow->execute();
					$reusltYellow = $verifyHasExistBadgeRareYellow->rowCount();
		
					if($reusltYellow <= 0) {
						$sendPlan1MonthBadge2 = $db->prepare("INSERT INTO player_badges (badge_code, player_id) VALUES (?,?)");
						$sendPlan1MonthBadge2->bindValue(1, "VIPAMA"); //NOME EMBLEMA
						$sendPlan1MonthBadge2->bindValue(2, $result['id']);
						$sendPlan1MonthBadge2->execute();
					}
		
					//ENVIANDO RARO
					$sendPlan1MonthRare = $db->prepare("INSERT INTO items (user_id, room_id, base_item, extra_data, wall_pos) VALUES (?,?,?,?,?)");
					$sendPlan1MonthRare->bindValue(1, $result['id']);
					$sendPlan1MonthRare->bindValue(2, '0'); // 0 envia pro inventário
					$sendPlan1MonthRare->bindValue(3, '1356474392'); // id do mobi no catalogo
					$sendPlan1MonthRare->bindValue(4, '0');
					$sendPlan1MonthRare->bindValue(5, ' ');
					$sendPlan1MonthRare->execute();

					echo json_encode([
						"response" => 'success',
						"append" => '<div class="form-warn vipyellow mr-bottom-1"><label class="flex-column"><h4 class="bold uppercase">Sucesso!</h4><h5>Você enviou o plano de <b>' . $plans . ' dias</b> para <b>' . $username . '</b> com sucesso!</h5></label></div>'
					]);
				
				} else if ($plans == 60) {
					
					$date = date('Y-m-d', strtotime($vipExpire));

					if ($isVip == 1 && $vipExpire != null) {
                        $time = date('Y-m-d H:i:s', strtotime("$date +2 month"));
					} else {
                        $time = date('Y-m-d H:i:s', strtotime("+2 month"));                 
					}

					$vipPoints += $diamondsTwoMonth;
					$duckets += $ducketsTwoMonth;
					$achievementsPoints += $achievementsTwoMonth;

					//ENVIAR DADOS
					$sendPlan2Month = $db->prepare("UPDATE players SET achievement_points = ?, rank = ?, vip = ?, vip_expire = ?, vip_points = ?, activity_points = ? WHERE username = ?");
					$sendPlan2Month->bindValue(1, $achievementsPoints);
					$sendPlan2Month->bindValue(2, '2');
					$sendPlan2Month->bindValue(3, '1');
					$sendPlan2Month->bindValue(4, $time);
					$sendPlan2Month->bindValue(5, $vipPoints);
					$sendPlan2Month->bindValue(6, $duckets);
					$sendPlan2Month->bindValue(7, $username);
		
					$sendPlan2Month->execute();
		
					//ENVIANDO EMBLEMA
					if($allResults <= 0) {
					$sendPlanTwoBadge = $db->prepare("INSERT INTO player_badges (badge_code, player_id) VALUES (?,?)");
					$sendPlanTwoBadge->bindValue(1, "VIP2021"); //NOME EMBLEMA
					$sendPlanTwoBadge->bindValue(2, $result['id']);
					$sendPlanTwoBadge->execute();
					}
		
		
					$verifyHasExistBadgeRareBlue = $db->prepare("SELECT id FROM player_badges WHERE badge_code = ? AND player_id = ?");
					$verifyHasExistBadgeRareBlue->bindValue(1, 'VIPAZU'); // NOME EMBLEMA)
					$verifyHasExistBadgeRareBlue->bindValue(2, $result['id']);
					$verifyHasExistBadgeRareBlue->execute();
					$resultBlue = $verifyHasExistBadgeRareBlue->rowCount();
		
					if($resultBlue <= 0) {
					$sendPlanTwoBadge2 = $db->prepare("INSERT INTO player_badges (badge_code, player_id) VALUES (?,?)");
					$sendPlanTwoBadge2->bindValue(1, "VIPAZU"); //NOME EMBLEMA
					$sendPlanTwoBadge2->bindValue(2, $result['id']);
					$sendPlanTwoBadge2->execute();
					}
		
					//ENVIANDO RARO
					$sendPlanTwoRare = $db->prepare("INSERT INTO items (user_id, room_id, base_item, extra_data, wall_pos) VALUES (?,?,?,?,?)");
					$sendPlanTwoRare->bindValue(1, $result['id']);
					$sendPlanTwoRare->bindValue(2, '0'); // 0 envia pro inventário
					$sendPlanTwoRare->bindValue(3, '1356474389'); // id do mobi no catalogo
					$sendPlanTwoRare->bindValue(4, '0');
					$sendPlanTwoRare->bindValue(5, ' ');
					$sendPlanTwoRare->execute();

					echo json_encode([
						"response" => 'success',
						"append" => '<div class="form-warn vipblue mr-bottom-1"><label class="flex-column"><h4 class="bold uppercase">Sucesso!</h4><h5>Você enviou o plano de <b>' . $plans . ' dias</b> para <b>' . $username . '</b> com sucesso!</h5></label></div>'
					]);
				
				} else if ($plans == 90) {
					$date = date('Y-m-d', strtotime($vipExpire));

					if ($isVip == 1 && $vipExpire != null) {
						$time = date('Y-m-d H:i:s', strtotime("$date +3 month"));
					} else {
						$time = date('Y-m-d H:i:s', strtotime("+3 month"));                 
					}

					$vipPoints += $diamondsThreeMonth;
					$duckets += $ducketsThreeMonth;
					$achievementsPoints += $achievementsThreeMonth;

					//ENVIAR DADOS
					$sendPlan3Month = $db->prepare("UPDATE players SET achievement_points = ?, rank = ?, vip = ?, vip_expire = ?, vip_points = ?, activity_points = ? WHERE username = ?");
					$sendPlan3Month->bindValue(1, $achievementsPoints);
					$sendPlan3Month->bindValue(2, '2');
					$sendPlan3Month->bindValue(3, '1');
					$sendPlan3Month->bindValue(4, $time);
					$sendPlan3Month->bindValue(5, $vipPoints);
					$sendPlan3Month->bindValue(6, $duckets);
					$sendPlan3Month->bindValue(7, $username);
	
					$sendPlan3Month->execute();
	
					//ENVIANDO EMBLEMA
					if($allResults <= 0) {
					$sendPlanThreeBadge = $db->prepare("INSERT INTO player_badges (badge_code, player_id) VALUES (?,?)");
					$sendPlanThreeBadge->bindValue(1, "VIP2021"); //NOME EMBLEMA
					$sendPlanThreeBadge->bindValue(2, $result['id']);
					$sendPlanThreeBadge->execute();
					}
	
					$verifyHasExistBadgeRareRed = $db->prepare("SELECT id FROM player_badges WHERE badge_code = ? AND player_id = ?");
					$verifyHasExistBadgeRareRed->bindValue(1, 'VIPVER'); // NOME EMBLEMA)
					$verifyHasExistBadgeRareRed->bindValue(2, $result['id']);
					$verifyHasExistBadgeRareRed->execute();
					$resultBlue = $verifyHasExistBadgeRareRed->rowCount();
	
					if($resultBlue <= 0) {
					$sendPlanThreeBadge2 = $db->prepare("INSERT INTO player_badges (badge_code, player_id) VALUES (?,?)");
					$sendPlanThreeBadge2->bindValue(1, "VIPVER"); //NOME EMBLEMA
					$sendPlanThreeBadge2->bindValue(2, $result['id']);
					$sendPlanThreeBadge2->execute();
					}
	
					//ENVIANDO RARO
					$sendPlanThreeRare = $db->prepare("INSERT INTO items (user_id, room_id, base_item, extra_data, wall_pos) VALUES (?,?,?,?,?)");
					$sendPlanThreeRare->bindValue(1, $result['id']);
					$sendPlanThreeRare->bindValue(2, '0'); // 0 envia pro inventário
					$sendPlanThreeRare->bindValue(3, '1356474395'); // id do mobi no catalogo
					$sendPlanThreeRare->bindValue(4, '0');
					$sendPlanThreeRare->bindValue(5, ' ');
					$sendPlanThreeRare->execute();

					echo json_encode([
						"response" => 'success',
						"append" => '<div class="form-warn vipred mr-bottom-1"><label class="flex-column"><h4 class="bold uppercase">Sucesso!</h4><h5>Você enviou o plano de <b>' . $plans . ' dias</b> para <b>' . $username . '</b> com sucesso!</h5></label></div>'
					]);
				}

			} else {
				echo json_encode([
					"response" => 'error',
					"input" => 'input[name="username"]',
					"error" => [
						"class" => 'div.col-input-separator:nth-child(3) > .error-input-warn',
						"text" => 'O nome do usuário não foi encontrado no nosso banco de dados.' 
					]
				]);
			}
		}
	} else {
		echo 'Cannot get ' . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) . '.';
	}
?>