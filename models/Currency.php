<?php
/**
 * Currency
 *
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010-2014 SkeekS (Sx)
 * @date 25.01.2015
 * @since 1.0.0
 */

namespace skeeks\modules\cms\money\models;

use skeeks\cms\base\db\ActiveRecord;
use skeeks\cms\models\behaviors\HasDescriptionsBehavior;
use skeeks\cms\models\behaviors\HasStatus;
use skeeks\cms\models\behaviors\HasStatusBoolean;

/**
 * Class Currency
 * @package skeeks\modules\cms\money\models
 */
class Currency extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%money_currency}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return array_merge(parent::behaviors(), []);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['code'], 'required'],
            [['code'], 'unique'],
            [['code'], 'validateCode'],
            [['priority'], 'integer'],
            [['active'], 'string'],
            [['course', 'name', 'name_full'], 'safe'],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return  array_merge(parent::attributeLabels(), [
            'id'            => \Yii::t('app', 'ID'),
            'code'          => "Валюта",
            'active'        => \Yii::t('app', 'Active'),
            'course'        => "Курс",
            'name'          => "Название",
            'name_full'     => "Полное название",
            'priority'      => \Yii::t('app', 'Priority'),
        ]);
    }


    public function validateCode($attribute)
    {
        if(!preg_match('/^[A-Z]{3}$/', $this->$attribute))
        {
            $this->addError($attribute, 'Используйте только буквы в верхнем регистре. Пример RUB (3 символа)');
        }
    }

}