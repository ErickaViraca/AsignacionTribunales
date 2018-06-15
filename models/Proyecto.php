<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "proyecto".
 *
 * @property integer $idproyecto
 * @property string $titulo_proy
 * @property string $objetivo_gral_proy
 * @property string $objetivo_espe_proy
 * @property string $decrip_proy
 * @property integer $asig_tribunal_listo
 * @property integer $tiene_tribunal
 *
 * @property ProEstu[] $proEstus
 */
class Proyecto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proyecto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['titulo_proy', 'asig_tribunal_listo', 'tiene_tribunal'], 'required'],
            [['titulo_proy', 'objetivo_gral_proy', 'objetivo_espe_proy', 'decrip_proy'], 'string'],
            [['asig_tribunal_listo', 'tiene_tribunal'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idproyecto' => 'Idproyecto',
            'titulo_proy' => 'Titulo Proy',
            'objetivo_gral_proy' => 'Objetivo Gral Proy',
            'objetivo_espe_proy' => 'Objetivo Espe Proy',
            'decrip_proy' => 'Decrip Proy',
            'asig_tribunal_listo' => 'Asig Tribunal Listo',
            'tiene_tribunal' => 'Tiene Tribunal',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProEstus()
    {
        return $this->hasMany(ProEstu::className(), ['proyecto_idproyecto' => 'idproyecto']);
    }
}
