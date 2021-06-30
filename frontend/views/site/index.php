<?php

use backend\modules\rbac\helpers\RbacHelper;
use backend\modules\rbac\models\enums\Permission;
use common\models\domains\Message;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model  Message */
/* @var $messages  Message[] */

$this->title = 'Test Chat';
?>
    <h3 class=" text-center">Simple Yii2 Chat</h3>
    <div class="messaging">
        <div class="inbox_msg">
            <div class="mesgs">
                <?php if (!empty($messages)): ?>
                    <div class="msg_history">
                        <?php foreach ($messages as $message): ?>
                            <div class="user_msg" style="<?= (!$message->is_correct && (RbacHelper::checkAccess(
                                        Permission::SIMPLE_USER
                                    ) || Yii::$app->user->isGuest)) ? 'display:none' : '' ?>">
                                <div class="message">
                                    <span class="author_name"><?= $message->createdBy->name ?></span>
                                    <div class="<?= ($message->is_admin_create) ? 'admin_msg' : 'msg' ?>">
                                        <p style="<?= !$message->is_correct ? 'color:red' : '' ?>"><?= Html::encode($message->text) ?></p>
                                        <span class="time_date"><?= date(
                                                'd M Y | h:i:s',
                                                $message->updated_at
                                            ) ?></span></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p>Чат пока пуст</p>
                <?php endif; ?>
                <?php if (Yii::$app->user->isGuest) : ?>
                    <p>Войдите, чтобы отправлять сообщения</p>
                <?php else: ?>
                    <?php $form = ActiveForm::begin(['options' => ['style' => 'margin: 0 25px']]); ?>

                    <?= $form->field($model, 'text')->label('Создать сообщение') ?>

                    <div class="form-group">
                        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php
$style = <<<CSS

.container{max-width:1170px; margin:auto;}

.inbox_msg {
  border: 1px solid #c4c4c4;
  clear: both;
  overflow: hidden;
}

.message {
  margin: 20px auto;
  padding: 0 0 0 10px;
  vertical-align: top;
  width: 80%;
 }
 .msg p {
  background: #ebebeb none repeat scroll 0 0;
  border-radius: 3px;
  color: #646464;
  font-size: 14px;
  margin: 0;
  padding: 5px 10px 5px 12px;
  width: 100%;
}
.time_date {
  color: #747474;
  display: block;
  font-size: 12px;
  margin: 8px 0 0;
}

 .admin_msg p {
  background: #05728f none repeat scroll 0 0;
  border-radius: 3px;
  font-size: 14px;
  margin: 0; color:#fff;
  padding: 5px 10px 5px 12px;
}

.messaging { padding: 0 0 50px 0;}
.msg_history {
  height: 516px;
  overflow-y: auto;
}
CSS;

$this->registerCSS($style);
