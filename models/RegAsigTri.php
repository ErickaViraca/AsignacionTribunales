<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reg_asig_tri".
 *
 * @property integer $idreg_asig_tri
 * @property string $fecha_registro_asig
 * @property integer $culminacion_proyecto
 * @property string $fecha_cambio_tribunal
 * @property integer $pro_estu_idpro_estu
 * @property integer $pro_estu_proyecto_idproyecto
 * @property integer $pro_estu_estudiante_idestudiante
 * @property integer $docente_iddocente
 *
 * @property ProEstu $proEstuIdproEstu
 * @property Docente $docenteIddocente
 */
class RegAsigTri extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reg_asig_tri';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha_registro_asig', 'fecha_cambio_tribunal'], 'safe'],
            [['culminacion_proyecto', 'pro_estu_idpro_estu', 'pro_estu_proyecto_idproyecto', 'pro_estu_estudiante_idestudiante', 'docente_iddocente'], 'integer'],
            [['pro_estu_idpro_estu', 'pro_estu_proyecto_idproyecto', 'pro_estu_estudiante_idestudiante', 'docente_iddocente'], 'required'],
           // [['pro_estu_idpro_estu', 'pro_estu_proyecto_idproyecto', 'pro_estu_estudiante_idestudiante'], 'exist', 'skipOnError' => true, 'targetClass' => ProEstu::className(), 'targetAttribute' => ['pro_estu_idpro_estu' => 'idpro_estu', 'pro_estu_proyecto_idproyecto' => 'proyecto_idproyecto', 'pro_estu_estudiante_idestudiante' => 'estudiante_idestudiante']],
           // [['docente_iddocente'], 'exist', 'skipOnError' => true, 'targetClass' => Docente::className(), 'targetAttribute' => ['docente_iddocente' => 'iddocente']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idreg_asig_tri' => 'Idreg Asig Tri',
            'fecha_registro_asig' => 'Fecha Registro Asig',
            'culminacion_proyecto' => 'Culminacion Proyecto',
            'fecha_cambio_tribunal' => 'Fecha Cambio Tribunal',
            'pro_estu_idpro_estu' => 'Pro Estu Idpro Estu',
            'pro_estu_proyecto_idproyecto' => 'Pro Estu Proyecto Idproyecto',
            'pro_estu_estudiante_idestudiante' => 'Pro Estu Estudiante Idestudiante',
            'docente_iddocente' => 'Docente Iddocente',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProEstuIdproEstu()
    {
        return $this->hasOne(ProEstu::className(), ['idpro_estu' => 'pro_estu_idpro_estu', 'proyecto_idproyecto' => 'pro_estu_proyecto_idproyecto', 'estudiante_idestudiante' => 'pro_estu_estudiante_idestudiante']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocenteIddocente()
    {
        return $this->hasOne(Docente::className(), ['iddocente' => 'docente_iddocente']);
    }
}
