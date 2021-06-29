<?php

namespace common\models\domains;

use common\models\queries\MessageQuery;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "message".
 *
 * @property int $id
 * @property string $text
 * @property bool|null $is_correct
 * @property bool|null $is_admin_create
 * @property int $deleted_at
 * @property int|null $created_by_id
 * @property int|null $updated_by_id
 * @property int $created_at
 * @property int $updated_at
 * @property User $createdBy
 * @property User $updatedBy
 */
class Message extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'message';
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
    public function rules()
    {
        return [
            [['text'], 'required'],
            [['text'], 'string'],
            [['is_correct', 'is_admin_create'], 'boolean'],
            [[ 'is_admin_create'], 'default', 'value' => false],
            [[ 'deleted_at'], 'default', 'value' => 0],
            [['created_by_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by_id' => 'id']],
            [['updated_by_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updated_by_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Текст',
            'is_correct' => 'Корректное',
            'is_admin_create' => 'Создано администратором',
            'deleted_at' => 'Удалено',
            'created_by_id' => 'Создано пользователем',
            'updated_by_id' => 'Изменено пользователем',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата изменения',
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return ActiveQuery
     */
    public function getCreatedBy(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'created_by_id']);
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return ActiveQuery
     */
    public function getUpdatedBy(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'updated_by_id']);
    }

    /**
     * {@inheritdoc}
     * @return MessageQuery the active query used by this AR class.
     */
    public static function find(): MessageQuery
    {
        return new MessageQuery(static::class);
    }
}
