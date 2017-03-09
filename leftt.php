<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include 'autoload.php';
$controller = new \clientogram\controller\Controller();
$controller->init();
?>

<?php $data = \clientogram\base\RequestRegistry::getRequest()->getParams('data');
?>
<?php foreach ($data as $chat) { ?>
    <div <?= $chat->getActive() ? 'id="active"' : ""; ?> data-chat_id="<?= $chat->getChatId(); ?>"  class="left">
        <div class="ava left_flex">
            <img  src='/clientogram/images/<?= $chat->getPhoto()->getFileName(); ?>'>
        </div>
        <div class="chat_info left_flex b_bt">
            <div class="left_one left_flex">
                <div class="chat_name in_left_one  left_flex">
                    <?= $chat->getFirstName() . " " . $chat->getLastName(); ?>
                    <span  class="star <?php echo $chat->getElect() ? "elect" : ""; ?>">
                        <i class="fa fa-star fa-fw"></i>
                    </span>
                </div>

                <div class="last_date in_left_one  left_flex">
                    <?= $chat->getLastMessage()->getDateSend("H:i"); ?>
                </div>
            </div>
            <div class="left_two left_flex">
                <div class="last_message in_left_two left_flex">
                    <?= $chat->getLastMessage()->getTextMessage(true); ?>
                </div>
                <div class="new_message in_left_two left_flex">
                    <span class="new_message <?php echo $chat->getMarkNew() ? "mark" : ""; ?>">
                        <i class="fa fa-circle" aria-hidden="false">

                        </i>
                    </span>
                </div>

            </div>
        </div>
    </div>
<?php } ?>

<script>


</script>
