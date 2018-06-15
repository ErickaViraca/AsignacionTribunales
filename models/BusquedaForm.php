<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\SqlDataProvider;

/**
 * Description of BusquedaForm
 *
 * @author MIS DOCUMENTOS
 */
class BusquedaForm extends Model
{
  //put your code here
  public $palabraBuscar;

  public function rules()
  {
    return [
//            [['palabraBuscar'], 'required' , 'message' => 'no puede ser en blanco '],
//            ['palabraBuscar', 'match', 'pattern' => '/^[a-záéíóúñ\s]+$/i', 'message' => 'Sólo se aceptan letras '],
      [['palabraBuscar'], 'filter', 'filter' => 'strtoupper'],
      [['palabraBuscar'], 'string', 'max' => 250],
    ];

  }

  /*
   * definir los label con el que aparezca
   */
  public function attributeLabels()
  {
    return [
      'palabraBuscar' => 'BUSQUEDAS',
    ];
  }

  /*
   * obtener resultado para la busqueda
   */

  public function usuario_busqueda($model)
  {
    $count = Yii::$app->db->createCommand('
        select 
	COUNT(*)
        from 
	usuario u 
	INNER JOIN usr_rol ur on ur.usuario_idusuario = u.idusuario 
	INNER JOIN rol r on ur.rol_idrol = r.idrol
        where nombre_usr like :palabra_buscar or apellido_paterno_usr like :palabra_buscar
        ')
      ->bindValue(':palabra_buscar', $model->palabraBuscar)
//                ->execute();
      ->queryScalar();

    $provider = new SqlDataProvider([
      'sql' => 'select 
	*
        from 
	usuario u 
	INNER JOIN usr_rol ur on ur.usuario_idusuario = u.idusuario 
	INNER JOIN rol r on ur.rol_idrol = r.idrol
        where nombre_usr like :palabra_buscar or apellido_paterno_usr like :palabra_buscar
        ',
      'params' => [':palabra_buscar' => $model->palabraBuscar],
      'totalCount' => $count,
      'pagination' => [
        'pageSize' => 5,
      ],
    ]);
    return $provider;
  }

  public function docente_busqueda($model)
  {
    $count = Yii::$app->db->createCommand('
        select COUNT(*)
        from docente d 
        where nombre_doc like :palabra_buscar or paterno_doc like :palabra_buscar
        ')
      ->bindValue(':palabra_buscar', $model->palabraBuscar)
      ->queryScalar();

    $provider = new SqlDataProvider([
      'sql' => 'select *
        from docente d
        where nombre_doc like :palabra_buscar or paterno_doc like :palabra_buscar',
      'params' => [':palabra_buscar' => $model->palabraBuscar],
      'totalCount' => $count,
      'pagination' => ['pageSize' => 5],
    ]);
    return $provider;
  }

  public function area_busqueda($model)
  {
    $count = Yii::$app->db->createCommand('
        select COUNT(*)
        from area a 
        where nombre_area like :palabra_buscar
        ')
      ->bindValue(':palabra_buscar', $model->palabraBuscar)
      ->queryScalar();

    $provider = new SqlDataProvider([
      'sql' => 'select *
        from area a
        where nombre_area like :palabra_buscar',
      'params' => [':palabra_buscar' => $model->palabraBuscar],
      'totalCount' => $count,
      'pagination' => ['pageSize' => 5],
    ]);
    return $provider;
  }

  /*
   * obtener resultado para la busqueda de registro de proyecto
   */
  public function obtenerRegProy($palabra_buscada)
  {
    $db = Yii::$app->db;
    $registro_proy = $db->createCommand('
select * 
from registro_proy inner join pro_estu on registro_proy.pro_estu_idpro_estu = pro_estu.idpro_estu
inner join proyecto on pro_estu.proyecto_idproyecto = proyecto.idproyecto
inner join estudiante on pro_estu.estudiante_idestudiante = estudiante.idestudiante
inner join doc_area on registro_proy.doc_area_iddoc_area = doc_area.iddoc_area
inner join docente on docente.iddocente = doc_area.docente_iddocente
inner join area on area.idarea = doc_area.area_idarea
inner join carrera_mod on carrera_mod.idcarrera_mod = registro_proy.carrera_mod_idcarrera_mod
inner join carrera on carrera.idcarrera = carrera_mod.carrera_idcarrera
inner join modalidad on modalidad.idmodalidad = carrera_mod.modalidad_idmodalidad        
where idproyecto like :palabra_buscar
')
      ->bindValue(':palabra_buscar', $palabra_buscada)
      ->queryAll();
    return $registro_proy;

  }

  /*lista de titulos para pasar aprobados
   * con la asignacion de tribunales
   */
  public function lista_para_aprobar_titulo()
  {
    $db = Yii::$app->db;
    $register_proy = $db->createCommand('
        select  distinct titulo_proy, asig_tribunal_listo, idproyecto
        from registro_proy inner join pro_estu on registro_proy.pro_estu_idpro_estu = pro_estu.idpro_estu
        inner join proyecto on pro_estu.proyecto_idproyecto = proyecto.idproyecto
        inner join estudiante on pro_estu.estudiante_idestudiante = estudiante.idestudiante
        inner join doc_area on registro_proy.doc_area_iddoc_area = doc_area.iddoc_area
        inner join docente on docente.iddocente = doc_area.docente_iddocente
        inner join area on area.idarea = doc_area.area_idarea
        inner join carrera_mod on carrera_mod.idcarrera_mod = registro_proy.carrera_mod_idcarrera_mod
        inner join carrera on carrera.idcarrera = carrera_mod.carrera_idcarrera
        inner join modalidad on modalidad.idmodalidad = carrera_mod.modalidad_idmodalidad
         order by titulo_proy DESC
            ')
      ->queryAll();
    return $register_proy;
  }

  /*
   * para enviar titulos a asignar tribunales
   */
  public function enviar_tribunales($id, $opcion)
  {
    //echo"en contruccion";
    //die();
    $params = ':id_proyecto, :listo_tribunales';
    $sql = Yii::$app->db->createCommand('select  enviar_tribunales(' . $params . ')')
      ->bindValue(':id_proyecto', $id)
      ->bindValue(':listo_tribunales', $opcion)
      ->execute();
    return $sql;
  }

  /*
   * para rescatar los nombres
   */
  public function nombre_estudiante($id)
  {
    $sql = Yii::$app->db->createCommand('select *
                from proyecto inner join pro_estu on proyecto.idproyecto = pro_estu.proyecto_idproyecto
                inner join estudiante on pro_estu.estudiante_idestudiante = estudiante.idestudiante
                where idproyecto =:id_proyecto')
      ->bindValue(':id_proyecto', $id)
      ->queryAll();
    return $sql;
  }

  public function busqueda_proyecto()
  {
    $db = Yii::$app->db;
    $register_proy = $db->createCommand('
            select distinct titulo_proy, idproyecto
            from registro_proy inner join pro_estu on registro_proy.pro_estu_idpro_estu = pro_estu.idpro_estu
            inner join proyecto on pro_estu.proyecto_idproyecto = proyecto.idproyecto
            inner join estudiante on pro_estu.estudiante_idestudiante = estudiante.idestudiante
            inner join doc_area on registro_proy.doc_area_iddoc_area = doc_area.iddoc_area
            inner join docente on docente.iddocente = doc_area.docente_iddocente
            inner join area on area.idarea = doc_area.area_idarea
            inner join carrera_mod on carrera_mod.idcarrera_mod = registro_proy.carrera_mod_idcarrera_mod
            inner join carrera on carrera.idcarrera = carrera_mod.carrera_idcarrera
            inner join modalidad on modalidad.idmodalidad = carrera_mod.modalidad_idmodalidad
            ')
      ->queryAll();
    return $register_proy;

  }

  public function busqueda_estu_proy($id_titulo)
  {
    $db = Yii::$app->db;
    $register_proy = $db->createCommand('
            select *
                from proyecto inner join pro_estu on proyecto.idproyecto = pro_estu.proyecto_idproyecto
                inner join estudiante on pro_estu.estudiante_idestudiante = estudiante.idestudiante
                where idproyecto =:id_titulo
            ')
      ->bindValue(':id_titulo', $id_titulo)
      ->queryAll();
    return $register_proy;

  }

  public function datos_estu_proy($id_estudiante)
  {
    $db = Yii::$app->db;
    $register_proy = $db->createCommand('
            select *
                from proyecto inner join pro_estu on proyecto.idproyecto = pro_estu.proyecto_idproyecto
                inner join estudiante on pro_estu.estudiante_idestudiante = estudiante.idestudiante
                where idestudiante =:id_estudiante
            ')
      ->bindValue(':id_estudiante', $id_estudiante)
      ->queryAll();
    return $register_proy;

  }

  public function rescate_datos_estu($id_estudiante)
  {

    $db = Yii::$app->db;
    $register_proy = $db->createCommand('
            select distinct nombre_doc, paterno_doc, materno_doc, iddocente, nombre_carrera, nombre_mod
            from registro_proy inner join pro_estu on registro_proy.pro_estu_idpro_estu = pro_estu.idpro_estu
            inner join proyecto on pro_estu.proyecto_idproyecto = proyecto.idproyecto
            inner join estudiante on pro_estu.estudiante_idestudiante = estudiante.idestudiante
            inner join doc_area on registro_proy.doc_area_iddoc_area = doc_area.iddoc_area
            inner join docente on docente.iddocente = doc_area.docente_iddocente
            inner join area on area.idarea = doc_area.area_idarea
            inner join carrera_mod on carrera_mod.idcarrera_mod = registro_proy.carrera_mod_idcarrera_mod
            inner join carrera on carrera.idcarrera = carrera_mod.carrera_idcarrera
            inner join modalidad on modalidad.idmodalidad = carrera_mod.modalidad_idmodalidad
            where idestudiante =:id_estudiante
            ')
      ->bindValue(':id_estudiante', $id_estudiante)
      ->queryAll();
    return $register_proy;

  }

  public function datos_area($id_estudiante)
  {
    $db = Yii::$app->db;
    $register_proy = $db->createCommand('
            select *
            from registro_proy inner join pro_estu on registro_proy.pro_estu_idpro_estu = pro_estu.idpro_estu
            inner join proyecto on pro_estu.proyecto_idproyecto = proyecto.idproyecto
            inner join estudiante on pro_estu.estudiante_idestudiante = estudiante.idestudiante
            inner join doc_area on registro_proy.doc_area_iddoc_area = doc_area.iddoc_area
            inner join docente on docente.iddocente = doc_area.docente_iddocente
            inner join area on area.idarea = doc_area.area_idarea
            inner join carrera_mod on carrera_mod.idcarrera_mod = registro_proy.carrera_mod_idcarrera_mod
            inner join carrera on carrera.idcarrera = carrera_mod.carrera_idcarrera
            inner join modalidad on modalidad.idmodalidad = carrera_mod.modalidad_idmodalidad
            where idestudiante =:id_estudiante
            ')
      ->bindValue(':id_estudiante', $id_estudiante)
      ->queryAll();
    return $register_proy;

  }

  public function busqueda_titulo($nombre_titulo)
  {
    $db = Yii::$app->db;
    $register_proy = $db->createCommand('
            select distinct titulo_proy, idproyecto
            from registro_proy inner join pro_estu on registro_proy.pro_estu_idpro_estu = pro_estu.idpro_estu
            inner join proyecto on pro_estu.proyecto_idproyecto = proyecto.idproyecto
            inner join estudiante on pro_estu.estudiante_idestudiante = estudiante.idestudiante
            inner join doc_area on registro_proy.doc_area_iddoc_area = doc_area.iddoc_area
            inner join docente on docente.iddocente = doc_area.docente_iddocente
            inner join area on area.idarea = doc_area.area_idarea
            inner join carrera_mod on carrera_mod.idcarrera_mod = registro_proy.carrera_mod_idcarrera_mod
            inner join carrera on carrera.idcarrera = carrera_mod.carrera_idcarrera
            inner join modalidad on modalidad.idmodalidad = carrera_mod.modalidad_idmodalidad
            where titulo_proy like :id_proyecto
            ')
      ->bindValue(':id_proyecto', '%' . $nombre_titulo . '%')
      ->queryAll();
    return $register_proy;

  }

  /* busqueda de titulos por designar tribunales
   *
   */
  public function designar_tribunales($titulo)
  {
    //echo $titulo;
    //echo 'hola';
    //die();
    $db = Yii::$app->db;
    $register_proy = $db->createCommand('
        select  distinct titulo_proy, asig_tribunal_listo, idproyecto
        from registro_proy inner join pro_estu on registro_proy.pro_estu_idpro_estu = pro_estu.idpro_estu
        inner join proyecto on pro_estu.proyecto_idproyecto = proyecto.idproyecto
        inner join estudiante on pro_estu.estudiante_idestudiante = estudiante.idestudiante
        inner join doc_area on registro_proy.doc_area_iddoc_area = doc_area.iddoc_area
        inner join docente on docente.iddocente = doc_area.docente_iddocente
        inner join area on area.idarea = doc_area.area_idarea
        inner join carrera_mod on carrera_mod.idcarrera_mod = registro_proy.carrera_mod_idcarrera_mod
        inner join carrera on carrera.idcarrera = carrera_mod.carrera_idcarrera
        inner join modalidad on modalidad.idmodalidad = carrera_mod.modalidad_idmodalidad
        where titulo_proy like :titulo order by titulo_proy DESC
            ')
      ->bindValue(':titulo', '%' . $titulo . '%')
      ->queryAll();
    return $register_proy;
  }
}
