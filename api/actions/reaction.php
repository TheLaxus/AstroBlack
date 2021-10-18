<?php 
	require_once('../../global.php');

	header('Content-Type: application/json');

	if (extract($_POST) && isset($user)) {
		$type = (isset($_POST['type'])) ? $_POST['type'] : '';
		
		if ($type == 'article') {
			$post_id = (isset($_POST['post_id'])) ? $_POST['post_id'] : '';
			$state = (isset($_POST['state'])) ? $_POST['state'] : '';

			$consult_if_article_exists = $db->prepare("SELECT * FROM cms_news WHERE id = ?");
			$consult_if_article_exists->bindValue(1, $post_id);
			$consult_if_article_exists->execute();

			if ($consult_if_article_exists->rowCount() > 0 && is_numeric($post_id) && $state == 'like' || $state == 'deslike') {
				$result_if_article_exists = $consult_if_article_exists->fetch(PDO::FETCH_ASSOC);

				$consult_if_reaction = $db->prepare("SELECT * FROM cms_post_reaction WHERE post_id = ? AND user_id = ?");
				$consult_if_reaction->bindValue(1, $post_id);
				$consult_if_reaction->bindValue(2, $user['id']);
				$consult_if_reaction->execute();

				if ($consult_if_reaction->rowCount() > 0) {
					$result_if_reaction = $consult_if_reaction->fetch(PDO::FETCH_ASSOC);

					if ($result_if_reaction['state'] == $state) {
						$update_article_reaction = $db->prepare("UPDATE cms_post_reaction SET state = ? WHERE post_id = ? AND user_id = ?");
						$update_article_reaction->bindValue(1, 'undefined');
						$update_article_reaction->bindValue(2, $post_id);
						$update_article_reaction->bindValue(3, $user['id']);
						$update_article_reaction->execute();

						echo json_encode([
							"response" => 'edit',
							"action" => 'delete',
							"label" => [
								"username" => $user['username']
							]
						]);
					} else {
						$update_article_reaction = $db->prepare("UPDATE cms_post_reaction SET state = ? WHERE post_id = ? AND user_id = ?");
						$update_article_reaction->bindValue(1, $state);
						$update_article_reaction->bindValue(2, $post_id);
						$update_article_reaction->bindValue(3, $user['id']);
						$update_article_reaction->execute();

						if ($result_if_reaction['state'] == 'undefined') {
							echo json_encode([
								"response" => 'success',
								"append" => '<div class="article-content-reaction" state="' . $state . '" title="' . $user['username'] . '"><div class="article-content-reaction-imager"><img alt="' . $user['username'] . '" src="' . AVATARIMAGE . $user['figure'] . '&head_direction=3&direction=3&gesture=sml"></div></div>'
							]);
						} else {
							echo json_encode([
								"response" => 'edit',
								"action" => 'change',
								"label" => [
									"username" => $user['username'],
									"state" => $state,
									"append" => '<div class="article-content-reaction" state="' . $state . '" title="' . $user['username'] . '"><div class="article-content-reaction-imager"><img alt="' . $user['username'] . '" src="' . AVATARIMAGE . $user['figure'] . '&head_direction=3&direction=3&gesture=sml"></div></div>'
								]
							]);
						}
					}
				} else {
					$insert_article_reaction = $db->prepare("INSERT INTO cms_post_reaction (type, state, post_id, user_id) VALUES (?,?,?,?)");
					$insert_article_reaction->bindValue(1, $type);
					$insert_article_reaction->bindValue(2, $state);
					$insert_article_reaction->bindValue(3, $post_id);
					$insert_article_reaction->bindValue(4, $user['id']);
					$insert_article_reaction->execute();

					echo json_encode([
						"response" => 'success',
						"append" => '<div class="article-content-reaction" state="' . $state . '" title="' . $user['username'] . '"><div class="article-content-reaction-imager"><img alt="' . $user['username'] . '" src="' . AVATARIMAGE . $user['look'] . '&head_direction=3&direction=3&gesture=sml"></div></div>'
					]);
				}
			} else {
				echo json_encode([
					"response" => 'error'
				]);
			}
		}
	} else {
		echo 'Cannot get ' . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	}
?>