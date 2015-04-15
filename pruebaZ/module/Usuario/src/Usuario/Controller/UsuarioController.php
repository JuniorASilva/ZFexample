<?php

namespace Usuario\Controller;

use Zend\Validator;
use Zend\I18n\Validator as I18nValidator;
use Zend\Db\Adapter\Adapter;
use Zend\Crypt\Password\Bcrypt;
use Zend\Authentication\Adapter\DbTable as AuthAdapter;

//Componentes de autenticación
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\Session as SessionStorage;
use Zend\Session\Container;

//Incluir modelos
//use Modulo\Model\Entity\UsuariosModel;
 
//Incluir formularios
use Usuario\Form\FormularioUsuario;


use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class UsuarioController extends AbstractActionController
{
    public function indexAction()
    {
    	$data= array("holamundo"=>"Hola junior desde Zend2");
        return new ViewModel($data);
    }

    public function __construct(){
    	$this->auth = new AuthenticationService();
    }

    public function loginAction(){
    	$auth = $this->auth;
        $identi=$auth->getStorage()->read();
        if($identi!=false && $identi!=null){
           return $this->redirect()->toUrl($this->getRequest()->getBaseUrl().'/usuario/usuario/dentro');
        }

        //DbAdapter
        $this->dbAdapter=$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        //Creamos el formulario de login
        $form=new FormularioUsuario("form");

        if($this->getRequest()->isPost()){
        	$authAdapter = new AuthAdapter($this->dbAdapter,
                                           'Usuario',
                                           'email',
                                           'pasword'
                                           );
        	$authAdapter->setIdentity($this->getRequest()->getPost("email"))
                        ->setCredential($this->getRequest()->getPost("pasword"));
            $auth->setAdapter($authAdapter);
            $result=$auth->authenticate();
            if($authAdapter->getResultRowObject()==false){
               //Crea un mensaje flash y redirige
               $this->flashMessenger()->addMessage("Credenciales incorrectas, intentalo de nuevo");
               return $this->redirect()->toUrl($this->getRequest()->getBaseUrl().'/usuario/usuario/login');
            }else{
            // Le decimos al servicio que guarde en una sesión
            // el resultado del login cuando es correcto
            $auth->getStorage()->write($authAdapter->getResultRowObject());

            //Nos redirige a una pagina interior
            return $this->redirect()->toUrl($this->getRequest()->getBaseUrl().'/usuario/usuario/dentro');
           }
        }
        $view = new ViewModel(
                array("form"=>$form)
                );
        return $view;
    }
    public function dentroAction(){
    //Leemos el contenido de la sesión
         $identi=$this->auth->getStorage()->read();
         if($identi!=false && $identi!=null){
            $datos=$identi;
            $sesion=new Container('sesion');
            $sesion->id = $datos->id;
         }else{
             $datos="No estas identificado";
         }
         return new ViewModel(
                array("datos"=>$datos,'sesion'=>$sesion)
                );
    }
    public function cerrarAction(){
        //Cerramos la sesión borrando los datos de la sesión.
        $this->auth->clearIdentity();
        return $this->redirect()->toUrl($this->getRequest()->getBaseUrl().'/usuario/usuario/login');
    }
}