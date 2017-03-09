<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include 'autoload.php';
$controller = new \clientogram\controller\Controller();

$controller->mesageFrame();
?>

<?php
$messages = \clientogram\base\RequestRegistry::getRequest()->getParams('messages');
?>
<?php foreach ($messages as $message) { ?>
    <div class="message">
        <div class="ava message_flex">
            <img src="/clientogram/images/<?= $message->getPhoto()->getFileName() ? $message->getPhoto()->getFileName() : 'user.png'; ?>">
        </div>
        <div class="text_message message_flex"><?= $message->getTextMessage(); ?></div>
        <div class="message_send_date message_flex"><?= $message->getDateSend('H:i'); ?></div>
    </div>
<?php } ?>
