<?php
/**
 * Created by PhpStorm.
 * User: Lulus
 * Date: 16/11/2016
 * Time: 13:24
 */

namespace entity;

class users 
{

  protected $id;
  protected $login;
  protected $email;
  protected $password;

  public function getId()
  {
    return $this->id;
  }

  public function setId($id)
  {
    $this->id = $id;
  }

  public function getLogin()
  {
    return $this->login;
  }

  public function setLogin($login)
  {
    $this->login = $login;
  }

  public function getEmail()
  {
    return $this->email;
  }

  public function setEmail($email)
  {
    $this->email = $email;
  }

  public function getPassword()
  {
    return $this->password;
  }

  public function setPassword($password)
  {
    $this->password = $password;
  }

}
