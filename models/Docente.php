<?php
/**
 * Created by PhpStorm.
 * User: romane
 * Date: 03/06/2018
 * Time: 10:48 PM
 */

namespace app\models;

use Yii;
use yii\data\SqlDataProvider;

/**
 * This is the model class for table "docente".
 *
 * @property integer $iddocente
 * @property string $nombre_doc
 * @property string $paterno_doc
 * @property string $materno_doc
 * @property string $correo_doc
 * @property string $titulo_doc
 * @property string $carga_horaria_doc
 * @property string $nombre_cuenta_doc
 * @property integer $telefono_doc
 * @property string $direccion_tra_doc
 * @property string $perfil_doc
 * @property integer $ci_doc
 * @property integer $cod_sis_doc
 * @property integer $es_tutor
 * @property integer $es_tribunal
 * @property integer $cant_estu_tri
 */
class Docente extends \yii\db\ActiveRecord
{
  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return 'docente';
  }

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
      [['nombre_doc', 'paterno_doc', 'materno_doc', 'correo_doc', 'nombre_cuenta_doc', 'ci_doc'], 'required'],
      [['telefono_doc', 'ci_doc', 'cod_sis_doc', 'es_tutor', 'es_tribunal', 'cant_estu_tri'], 'integer'],
      [['nombre_doc', 'paterno_doc', 'materno_doc', 'titulo_doc', 'carga_horaria_doc', 'direccion_tra_doc', 'perfil_doc', 'correo_doc'], 'string', 'max' => 55],
      //validando correo electronico
      ['correo_doc', 'match', 'pattern' => "/^.{5,80}$/", 'message' => 'Mínimo 5 y máximo 80 caracteres'],
      ['correo_doc', 'email', 'message' => 'Formato no válido'],
    ];
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
      'iddocente' => 'IdDocente',
      'nombre_doc' => 'Nombre',
      'paterno_doc' => 'Apellido Paterno ',
      'materno_doc' => 'Apellido Materno ',
      'correo_doc' => 'Correo',
      'titulo_doc' => 'Titulo',
      'carga_horaria_doc' => 'Carga Horaria',
      'nombre_cuenta_doc' => 'Nombre Cuenta',
      'telefono_doc' => 'Telefono',
      'direccion_tra_doc' => 'Direccion',
      'perfil_doc' => 'Perfil',
      'ci_doc' => 'CI',
      'cod_sis_doc' => 'Codigo Sis',
      'es_tutor' => 'Tutor',
      'es_tribunal' => 'Tribunal',
      'cant_estu_tri' => 'Cantidad Tribunal',
    ];
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getDocArea()
  {
    return $this->hasMany(DocArea::className(), ['docente_iddocente' => 'iddocente']);
  }


  public function getCorreoDocenteById($id_docente)
  {
    $docente = Yii::$app->db->createCommand('
        SELECT correo_doc
        FROM docente 
        WHERE iddocente = :id_docente
        ')
      ->bindValue(':id_docente', $id_docente)
      ->queryScalar();
    return $docente;
  }

  /*
   * funcion para insertar en usuario
   */
  public function docente_insertar($model)
  {
    $params = ':iddocente,:nombre_doc, :paterno_doc, :materno_doc, :correo_doc, :titulo_doc, :carga_horaria_doc, :nombre_cuenta_doc,:telefono_doc, :direccion_tra_doc, :perfil_doc, :ci_doc, :cod_sis_doc, :es_tutor, :es_tribunal, :cant_estu_tri';
    Yii::$app->db->createCommand('call docente_insertar(' . $params . ')')
      ->bindValue(':iddocente', $model->iddocente)
      ->bindValue(':nombre_doc', $model->nombre_doc)
      ->bindValue(':paterno_doc', $model->paterno_doc)
      ->bindValue(':materno_doc', $model->materno_doc)
      ->bindValue(':correo_doc', $model->correo_doc)
      ->bindValue(':titulo_doc', $model->titulo_doc)
      ->bindValue(':carga_horaria_doc', $model->carga_horaria_doc)
      ->bindValue(':nombre_cuenta_doc', $model->nombre_cuenta_doc)
      ->bindValue(':telefono_doc', $model->telefono_doc)
      ->bindValue(':direccion_tra_doc', $model->direccion_tra_doc)
      ->bindValue(':perfil_doc', $model->perfil_doc)
      ->bindValue(':ci_doc', $model->ci_doc)
      ->bindValue(':cod_sis_doc', $model->cod_sis_doc)
      ->bindValue(':es_tutor', $model->es_tutor)
      ->bindValue(':es_tribunal', $model->es_tribunal)
      ->bindValue(':cant_estu_tri', $model->cant_estu_tri)
      ->execute();
  }

  /*funcion para eliminar datos*/
  public function docente_eliminar($model)
  {
    $params = ':iddocente';
    $sql = Yii::$app->db->createCommand('call docente_eliminar(' . $params . ')')
      ->bindValue(':iddocente', $model->iddocente)
      ->execute();
    return $sql;
  }

  /*
 * function to list all the profesionals existents
 */
  public function lista_docente()
  {
    $db = Yii::$app->db;
    $count = $db->createCommand('select 
	 COUNT(*)
	 from docente d order by iddocente DESC 
	 ')->queryScalar();
    $provider = new SqlDataProvider([
      'sql' => 'select d.*
        from docente d 
        order by iddocente desc',
      'totalCount' => $count,
      'pagination' => [
        'pageSize' => 5,
      ],
      'sort' => [
        'attributes' => [
          'nombre',
        ],
      ],
    ]);
    return $provider;
  }
}
