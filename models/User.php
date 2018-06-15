<?php

namespace app\models;

use app\models\Usuario;

class User extends \yii\base\Object implements \yii\web\IdentityInterface
{
  /*public $idusuario;
  public $username;
  public $password;
  public $authKey;
  public $accessToken;*/
  public $idusuario;
  public $nombre_usr;
  public $apellido_paterno_usr;
  public $apellido_materno_usr;
  public $celular_usr;
  public $correo_usr;
  public $usuario;
  public $email;
  public $contrasenia;
  public $conf_contrasenia;
  public $accessToken;
  public $activate;

  public static function findIdentity($idusuario)
  {

    $user = Usuario::find()
      ->where("activate=:activate", [":activate" => 1])
      ->andWhere("idusuario=:idusuario", ["idusuario" => $idusuario])
      ->one();

    return isset($user) ? new static($user) : null;
  }

  /**
   * @inheritdoc
   */

  /* Busca la identidad del usuario a través de su token de acceso */
  public static function findIdentityByAccessToken($accessToken, $type = null)
  {

    $users = Usuario::find()
      ->where("activate=:activate", [":activate" => 1])
      ->andWhere("accessToken=:accessToken", [":accessToken" => $accessToken])
      ->all();

    foreach ($users as $user) {
      if ($user->accessToken === $accessToken) {
        return new static($user);
      }
    }

    return null;
  }

  /**
   * Finds user by username
   *
   * @param  string $username
   * @return static|null
   */

  /* Busca la identidad del usuario a través del username */
  public static function findByUsername($usuario)
  {
    $users = Usuario::find()
      ->where("activate=:activate", ["activate" => 1])
      ->andWhere("usuario=:usuario", [":usuario" => $usuario])
      ->all();

    foreach ($users as $user) {

      if (strcasecmp($user->usuario, $usuario) === 0) {
//                echo "<pre>";
//                 print_r($user);
//                  echo "</pre>";
        //die();
        return new static($user);

      }
    }

    return null;
  }

  /**
   * @inheritdoc
   */

  /* Regresa el id del usuario */
  public function getId()
  {
    return $this->idusuario;
  }

  /**
   * @inheritdoc
   */

  /* Regresa la clave de autenticación */
  public function getAuthKey()
  {
    return $this->conf_contrasenia;
  }

  /**
   * @inheritdoc
   */

  /* Valida la clave de autenticación */
  public function validateAuthKey($conf_contrasenia)
  {
    return $this->conf_contrasenia === $conf_contrasenia;
  }

  /**
   * Validates password
   *
   * @param  string $password password to validate
   * @return boolean if password provided is valid for current user
   */
  public function validatePassword($contrasenia)
  {
    /* Valida el password */
    if (crypt($contrasenia, $this->contrasenia) == $this->contrasenia) {
      return $contrasenia === $contrasenia;
    }
  }

}
