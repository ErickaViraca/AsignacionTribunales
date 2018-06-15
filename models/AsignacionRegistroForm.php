<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace app\models;
use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use app\models\Docente;
use yii\data\SqlDataProvider;
use yii\filters\VerbFilter;
class AsignacionRegistroForm extends Model {
    #put your code here
    public $id_titulo; 
    public $fecha_registro;
    public $id_docente =array();
    //public $id_docente;
    //public $mischecks;
     public function rules()
    {
         return [
           [['id_titulo', 'fecha_registro', 'id_docente'], 'required' , 'message' => 'no puede ser en blanco '],
           [['fecha_registro'], 'safe'], 
          // [['fecha_registro'], 'verificarFecha'],

//            ['lista_titulo', 'match', 'pattern' => '/^[a-záéíóúñ\s]+$/i', 'message' => 'Sólo se aceptan letras '],
            // [['palabraBuscar'], 'filter',  'filter'=>'strtoupper'],
             //[['palabraBuscar'], 'string', 'max' => 250],
             ];
        
    }
    /*
     * definir los label con el que aparezca
     */
     public function attributeLabels()
    {
        return [
            'id_titulo' => 'TITULO DEL PROYECTO',
            'fecha_registro' => 'Fecha', 
            'id_docente' => 'docentes', 
        ];
    }
    /*para cambiar el formato de la fecha*/
    /* public function verificarFecha() {
        $aux_inicio = new \DateTime();
        $inicio = $aux_inicio->createFromFormat('d/m/Y', $this->fecha_registro);
        $fecha_registro = $inicio->format('Y-m-d');
        $fecha_registro = new \DateTime($fecha_registro);
    }*/
     /*
     *  obtener areas bajo el titulo 
     * con el idproyecto
     */
    public function obtener_lista_titulo($id_proyecto){
//        echo $id_proyecto;
//        die();
        $db = Yii::$app->db;
        $register_proy = $db->createCommand('
       select  distinct titulo_proy, idarea, nombre_area
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
     * lista de docente posibles  
     * para la asignacion de tribunales
     */
    public function lista_docentes_asignar($id_pro){
        $db = Yii::$app->db;
        $register_proy = $db->createCommand('
        select*
        from docente inner join doc_area on  docente.iddocente= doc_area.docente_iddocente
             inner join area on doc_area.area_idarea= area.idarea
        where   idarea =:id_area
            ')
        ->bindValue(':id_area',$id_pro)
        ->queryAll();
        return $register_proy;
    }
    /*
     * lista de docente posibles  
     * para el check
     */
    public  function getListaDocente($id_pro) {
       
         $docente = AsignacionRegistroForm::lista_docentes_asignar($id_pro);
         
         $array_resultante= array_merge($docente);   
        return ArrayHelper::map($array_resultante, 'iddocente', 'nombre_doc');
         
    }
   /*
     * lista de de estudiantes y sus respectivos proyecto  
     * para el check
     */
    public  function getListaTitu_estu($id) {
       $sql = Yii::$app->db->createCommand('select *
                from proyecto inner join pro_estu on proyecto.idproyecto = pro_estu.proyecto_idproyecto
                inner join estudiante on pro_estu.estudiante_idestudiante = estudiante.idestudiante
                where idproyecto =:id_proyecto')
                ->bindValue(':id_proyecto', $id)
                ->queryAll();
        return $sql;  
    }
    /*
     * lista de registron con tribunales 
     * 
     */
    public  function lista_profe_asignados($id) {
       $sql = Yii::$app->db->createCommand('select distinct nombre_doc, paterno_doc, materno_doc, iddocente
        from proyecto 
             inner join pro_estu on proyecto.idproyecto = pro_estu.proyecto_idproyecto
             inner join estudiante on pro_estu.estudiante_idestudiante = estudiante.idestudiante
             inner join reg_asig_tri on pro_estu.idpro_estu = reg_asig_tri.pro_estu_idpro_estu
             inner join docente on reg_asig_tri.docente_iddocente = docente.iddocente 
        where idproyecto =:id_proyecto')
                ->bindValue(':id_proyecto', $id)
                ->queryAll();
        return $sql;  
    }
    /*
     * lista de registron con tribunal
     * 
     */
    public  function lista_estu_asignados($id) {
       $sql = Yii::$app->db->createCommand('select distinct nombre_estu, paterno_estu, materno_estu, idestudiante
        from proyecto 
             inner join pro_estu on proyecto.idproyecto = pro_estu.proyecto_idproyecto
             inner join estudiante on pro_estu.estudiante_idestudiante = estudiante.idestudiante
             inner join reg_asig_tri on pro_estu.idpro_estu = reg_asig_tri.pro_estu_idpro_estu
             inner join docente on reg_asig_tri.docente_iddocente = docente.iddocente 
        where idproyecto =:id_proyecto')
                ->bindValue(':id_proyecto', $id)
                ->queryAll();
        return $sql;  
    }
    /*
     * lista de registron con tribunales 
     * 
     */
    public  function lista_titulo_asignados($id) {
       $sql = Yii::$app->db->createCommand('select distinct titulo_proy
        from proyecto 
             inner join pro_estu on proyecto.idproyecto = pro_estu.proyecto_idproyecto
             inner join estudiante on pro_estu.estudiante_idestudiante = estudiante.idestudiante
             inner join reg_asig_tri on pro_estu.idpro_estu = reg_asig_tri.pro_estu_idpro_estu
             inner join docente on reg_asig_tri.docente_iddocente = docente.iddocente 
        where idproyecto =:id_proyecto')
                ->bindValue(':id_proyecto', $id)
                ->queryAll();
        return $sql;  
    }
    //asignar catidad de tribunales
    public function asignarCantidad($cantidad){
        //print_r($cantidad);
         //$docentes = AsignacionRegistroForm::listaDocenteCantida();
        foreach ($cantidad as $id_doc){
             $docentes = AsignacionRegistroForm::obtenerListaDocente($id_doc);
            // echo $id_doc;
             foreach ($docentes as $datosDoc){
                 $contador=1;
                 
                 if(($id_doc == $datosDoc['iddocente']) && ($datosDoc['cant_estu_tri'] == 0)){
                     
                   //echo $contador = $contador;
                  AsignacionRegistroForm::cambiarDocenteCantidaE($id_doc, $contador);
                  // echo $contador++;
                   
                 }else  if(($id_doc == $datosDoc['iddocente']) && ($datosDoc['cant_estu_tri'] >= 1)){
                     $contador= $datosDoc['cant_estu_tri'] + 1; 
                 AsignacionRegistroForm::cambiarDocenteCantidaE($id_doc, $contador);
                 }
                 
             }
            // echo "<pre>";
             //print_r($docentes);
             //echo "</pre>";
        }
    }
    
    public  function cambiarDocenteCantidaE($id_doc,$conatador) {
        
       $sql = Yii::$app->db->createCommand('Update docente Set cant_estu_tri =:cantidad_et Where iddocente =:id_docente')
                ->bindValue(':id_docente', $id_doc)
                ->bindValue(':cantidad_et', $conatador)
                ->execute();
        return $sql;  
    }
    public function obtenerlistaDocente($id_doc){
        $sql = Yii::$app->db->createCommand('select * from docente where iddocente=:id_docente')
            ->bindValue(':id_docente', $id_doc)
            ->queryAll();
        return $sql;
    }
    /*Selecionar a los profesionales con */
    public  function listaDocenteCantidad() {
        $db = Yii::$app->db;
        $count = $db->createCommand('select 
	COUNT(*)
        from docente
        order by 
	iddocente desc
        ')->queryScalar();
        $provider = new SqlDataProvider([
            'sql' => 'select *
            from docente
        order by 
	iddocente desc',
            'totalCount' => $count,
            'pagination' => [
                'pageSize' => 8,
            ],
                'sort' => [
                'attributes' => [ 
                    //'nombre',
                    //'apellido_ps',
                    //'apellido_m'
                ],
            ],
        ]);
        return $provider;  
    }
    /*Selecionar a las areas
     *
     */
    public  function listaArea() {
        
        $db = Yii::$app->db;
        $count = $db->createCommand('select 
	COUNT(*)
        from area
        order by 
	idarea desc
        ')->queryScalar();
        $provider = new SqlDataProvider([
            'sql' => 'select *
            from area 
        order by 
	idarea desc',
            'totalCount' => $count,
            'pagination' => [
                'pageSize' => 8,
            ],
                'sort' => [
                'attributes' => [ 
                   // 'nombre',
                    //'apellido_ps',
                    //'apellido_m'
                ],
            ],
        ]);
        return $provider;
  
    }
    /*Selecionar a las con profesionales areas */
    public  function profesional_lista_area($id) {
       $sql = Yii::$app->db->createCommand('select*
from docente inner join doc_area on  docente.iddocente= doc_area.docente_iddocente
                     inner join area on doc_area.area_idarea= area.idarea
	where  idarea =:id_proyecto')
               ->bindValue(':id_proyecto', $id)
                ->queryAll();
        return $sql;  
    }
    /*cambiar estado del proyecto*/
    public function estadoTituloConcluido($id_proyecto){
         $sql = Yii::$app->db->createCommand('Update proyecto Set tiene_tribunal =1 Where idproyecto =:id_proyecto')
                ->bindValue(':id_proyecto', $id_proyecto)
                ->execute();
        return $sql;  
    }
   
     
    
    
}