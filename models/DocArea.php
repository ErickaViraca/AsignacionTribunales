<?php
/**
 * Created by PhpStorm.
 * User: romane
 * Date: 03/06/2018
 * Time: 11:47 PM
 */

namespace app\models;

use Yii;

/**
 * This is the model class for table "doc_area".
 *
 * @property integer $iddoc_area
 * @property integer $area_idarea
 * @property integer $docente_iddocente
 */
class DocArea extends \yii\db\ActiveRecord
{
  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return 'doc_area';
  }

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
      [['area_idarea', 'docente_iddocente'], 'required'],
      [['area_idarea', 'docente_iddocente'], 'integer'],
      [['area_idarea'], 'exist', 'skipOnError' => true, 'targetClass' => Area::className(), 'targetAttribute' => ['area_idarea' => 'idarea']],
      [['docente_iddocente'], 'exist', 'skipOnError' => true, 'targetClass' => Docente::className(), 'targetAttribute' => ['docente_iddocente' => 'iddocente']],
    ];
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
      'iddoc_area' => 'IdDoc Area',
      'area_idarea' => 'Area IdArea',
      'docente_iddocente' => 'Docente IdDocente',
    ];
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getAreaIdarea()
  {
    return $this->hasOne(Area::className(), ['idarea' => 'area_idarea']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getDocenteIddocente()
  {
    return $this->hasOne(Docente::className(), ['iddocente' => 'docente_iddocente']);
  }
}
