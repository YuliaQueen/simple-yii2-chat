<?php
namespace frontend\models;

use backend\modules\rbac\models\enums\Permission;
use common\models\enums\UserType;
use Yii;
use yii\base\Exception;
use yii\base\Model;
use common\models\domains\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $name;
    public $email;
    public $password;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['name', 'trim'],
            ['name', 'required'],
            ['name', 'unique', 'targetClass' => '\common\models\domains\User', 'message' => 'This name has already been taken.'],
            ['name', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\domains\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     * @throws Exception
     */
    public function signup(): ?bool
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->type = UserType::USER;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        if ($user->save()) {
            $rbacService = Yii::$app->rbacService;
            $roleUser = $rbacService->findRole(Permission::SIMPLE_USER);
            $rbacService->assign($roleUser, $user->id);
            return true;
        }

        return false;
    }
}
