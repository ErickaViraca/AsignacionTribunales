<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;
use Yii;
use yii\base\Model;

/**
 * Description of tribunalForm
 *
 * @author MIS DOCUMENTOS
 */
class tribunalForm extends Model {
    #put your code here
    public $lista_titulo;   
     public function rules()
    {
         return [
            [['lista_titulo'], 'required' , 'message' => 'no puede ser en blanco '],
//            ['lista_titulo', 'match', 'pattern' => '/^[a-záéíóúñ\s]+$/i', 'message' => 'Sólo se aceptan letras '],
             [['palabraBuscar'], 'filter',  'filter'=>'strtoupper'],
             [['palabraBuscar'], 'string', 'max' => 250],
             ];
        
    }
    /*
     * definir los label con el que aparezca
     */
     public function attributeLabels()
    {
        return [
            'lista_titulo' => 'TITULO DEL PROYECTO',            
        ];
    }
    /*
     * lista de titulos para pasar aprobados 
     * con la asignacion de tribunales
     */
    public function lista_titulo_aprobados(){
        $db = Yii::$app->db;
        $register_proy = $db->createCommand('
        select distinct titulo_proy, asig_tribunal_listo, idproyecto, tiene_tribunal
        from proyecto inner join pro_estu on proyecto.idproyecto = pro_estu.proyecto_idproyecto
             inner join estudiante on pro_estu.estudiante_idestudiante = estudiante.idestudiante
        where asig_tribunal_listo = 1 and tiene_tribunal = 0  order by titulo_proy DESC
            ')
        ->queryAll();
        return $register_proy;
    }
    /*
     * lista de titulos para pasar aprobados 
     * con la asignacion de tribunales
     */
    public function lista_tutor($id_proyecto){
        $db = Yii::$app->db;
        $register_proy = $db->createCommand('
        select distinct nombre_doc, iddocente ,paterno_doc, materno_doc
        from registro_proy inner join pro_estu on registro_proy.pro_estu_idpro_estu = pro_estu.idpro_estu
        inner join proyecto on pro_estu.proyecto_idproyecto = proyecto.idproyecto
        inner join estudiante on pro_estu.estudiante_idestudiante = estudiante.idestudiante
        inner join doc_area on registro_proy.doc_area_iddoc_area = doc_area.iddoc_area
        inner join docente on docente.iddocente = doc_area.docente_iddocente
        inner join area on area.idarea = doc_area.area_idarea
        inner join carrera_mod on carrera_mod.idcarrera_mod = registro_proy.carrera_mod_idcarrera_mod
        inner join carrera on carrera.idcarrera = carrera_mod.carrera_idcarrera
        inner join modalidad on modalidad.idmodalidad = carrera_mod.modalidad_idmodalidad
        where idproyecto =:id_proyecto
            ')
        ->bindValue(':id_proyecto',$id_proyecto)
        ->queryAll();
        return $register_proy;
    }
    public function lista_estudiante($id_proyecto){
        $db = Yii::$app->db;
        $register_proy = $db->createCommand('
        select distinct nombre_estu, idestudiante ,paterno_estu, materno_estu
        from registro_proy inner join pro_estu on registro_proy.pro_estu_idpro_estu = pro_estu.idpro_estu
        inner join proyecto on pro_estu.proyecto_idproyecto = proyecto.idproyecto
        inner join estudiante on pro_estu.estudiante_idestudiante = estudiante.idestudiante
        inner join doc_area on registro_proy.doc_area_iddoc_area = doc_area.iddoc_area
        inner join docente on docente.iddocente = doc_area.docente_iddocente
        inner join area on area.idarea = doc_area.area_idarea
        inner join carrera_mod on carrera_mod.idcarrera_mod = registro_proy.carrera_mod_idcarrera_mod
        inner join carrera on carrera.idcarrera = carrera_mod.carrera_idcarrera
        inner join modalidad on modalidad.idmodalidad = carrera_mod.modalidad_idmodalidad
        where idproyecto =:id_proyecto
            ')
        ->bindValue(':id_proyecto',$id_proyecto)
        ->queryAll();
        return $register_proy;
    }
    /*
     * mostrar a todos los docentes que
     * segun su area figuren como tutor 
     */
    public function lista_area($id_docente){
        $db = Yii::$app->db;
        $register_proy = $db->createCommand('
        select distinct nombre_area, idarea, iddocente
        from registro_proy inner join pro_estu on registro_proy.pro_estu_idpro_estu = pro_estu.idpro_estu
        inner join proyecto on pro_estu.proyecto_idproyecto = proyecto.idproyecto
        inner join estudiante on pro_estu.estudiante_idestudiante = estudiante.idestudiante
        inner join doc_area on registro_proy.doc_area_iddoc_area = doc_area.iddoc_area
        inner join docente on docente.iddocente = doc_area.docente_iddocente
        inner join area on area.idarea = doc_area.area_idarea
        inner join carrera_mod on carrera_mod.idcarrera_mod = registro_proy.carrera_mod_idcarrera_mod
        inner join carrera on carrera.idcarrera = carrera_mod.carrera_idcarrera
        inner join modalidad on modalidad.idmodalidad = carrera_mod.modalidad_idmodalidad
        where iddocente =:id_docente
            ')
        ->bindValue(':id_docente',$id_docente)
        ->queryAll();
        return $register_proy;
    }
    /*
     * mostrar a todos los docentes con area comun
     */
    public function buscar_lista_area($id_area, $id_docente){
        $db = Yii::$app->db;
        $register_proy = $db->createCommand('
            select*
                from docente inner join doc_area on  docente.iddocente= doc_area.docente_iddocente
                     inner join area on doc_area.area_idarea= area.idarea
                where iddocente != :id_docente and idarea = :id_area
            ')
        ->bindValue(':id_docente',$id_docente)
        ->bindValue(':id_area',$id_area)
        ->queryAll();
        return $register_proy;

    }
    
}
