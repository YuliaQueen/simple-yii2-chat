<?php

namespace common\models\domains;

use common\models\queries\UserQuery;
use Yii;
use yii\base\Exception;
use yii\base\NotSupportedException;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property int|null $type
 * @property string|null $name
 * @property string|null $email
 * @property string|null $password_hash
 * @property string|null $auth_key
 * @property int $deleted_at
 * @property int|null $created_by_id
 * @property int|null $updated_by_id
 * @property int $created_at
 * @property int $updated_at
 * @property User $createdBy
 * @property User $updatedBy
 * @property AuthAssignment[] $authAssignments
 * @property string $username [varchar(255)]
 * @property string $password_reset_token [varchar(255)]
 * @property int $status [smallint]
 * @property string $verification_token [varchar(255)]
 */
class User extends ActiveRecord implements IdentityInterface
{
    /**
     * @var int идентификатор пользователя "Система".
     */
    public const SYSTEM_ID = 1;

       /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'user';
    }

    public function behaviors(): array
    {
        return [
            TimestampBehavior::class => [
                'class' => TimestampBehavior::class,
            ],
            SoftDeleteBehavior::class => [
                'class' => SoftDeleteBehavior::class,
                'softDeleteAttributeValues' => [
                    'deleted_at' => time(),
                    'updated_at' => time(),
                ],
                'replaceRegularDelete' => true,
            ],
            BlameableBehavior::class => [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'created_by_id',
                'updatedByAttribute' => 'updated_by_id',
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['deleted_at'], 'default', 'value' => 0],
            [['email', 'name'], 'required'],
            [['email'], 'filter', 'filter' => 'strtolower'],
            [['email'], 'email'],
            [
                ['email'],
                'unique',
                'targetAttribute' => ['email', 'deleted_at'],
                'message' => 'Email используется другим пользователем.',
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'type' => 'Тип пользователя',
            'name' => 'ФИО',
            'email' => 'Email',
            'password_hash' => 'Пароль',
            'deleted_at' => 'Deleted At',
            'created_by_id' => 'Created By ID',
            'updated_by_id' => 'Updated By ID',
            'created_at' => 'Создан',
            'updated_at' => 'Изменен',
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return ActiveQuery|UserQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by_id']);
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return ActiveQuery|UserQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by_id']);
    }

    /**
     * Gets query for [[AuthAssignments]].
     *
     * @return ActiveQuery
     */
    public function getAuthAssignments(): ActiveQuery
    {
        return $this->hasMany(AuthAssignment::class, ['user_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return UserQuery the active query used by this AR class.
     */
    public static function find(): UserQuery
    {
        return new UserQuery(static::class);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     * @throws Exception
     */
    public function setPassword(string $password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword(string $password): bool
    {
        return Yii::$app->getSecurity()->validatePassword($password, $this->password_hash);
    }

    /**
     * @param int|string $id
     * @return IdentityInterface|null
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @param mixed $token
     * @param mixed|null $type
     * @return IdentityInterface|null
     * @throws NotSupportedException
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * @param $email
     *
     * @return array|User|ActiveRecord
     */
    public static function findByEmail($email)
    {
        return static::find()->whereEmail($email)->notDeleted()->one();
    }

    /**
     * @return int|string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @param string $authKey
     * @return bool
     */
    public function validateAuthKey($authKey): bool
    {
        return $this->auth_key === $authKey;
    }

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
}
