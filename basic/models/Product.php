<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property string $title
 * @property int $cost
 * @property string $category
 * @property int|null $rating
 * @property int $user_id
 *
 * @property \app\models\User $user
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    public function behaviors()
    {
        return [
            [
                'class'=>BlameableBehavior::class,
                'createdByAttribute' => 'user_id',
                'updatedByAttribute'=>false,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_VALIDATE => ['user_id']
                ]
            ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'cost', 'category', 'user_id'], 'required'],
            [['cost', 'rating', 'user_id'], 'integer'],
            [['title', 'category'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'cost' => 'Cost',
            'category' => 'Category',
            'rating' => 'Rating',
            'user_id' => 'User ID',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
