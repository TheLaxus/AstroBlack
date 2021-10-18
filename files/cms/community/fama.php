<?php
require_once('../../../global.php');

$Hotel::Manutention($user['rank']);
$Functions::Session('disconnected');

$Template->SetParam('page_id', 'hall');
$Template->SetParam('page_name', 'Hall');
$Template->SetParam('page_title', 'Comunidade - ' . HOTELNAME);
$Template->SetParam('page_description', '');
$Template->SetParam('page_image', URL . '/image.png');

$Template->AddTemplate('others', 'head');
?>

nada
<?php
$Template->AddTemplate('others', 'bottom');
?>
