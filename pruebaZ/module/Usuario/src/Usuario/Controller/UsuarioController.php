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

use Zend\Mail\Message;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Transport\SmtpOptions;

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

    public function sonyAction()
    {
        return new ViewModel(array('hola'=>'hola warra de mrd'));
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
            $identi=$auth->getStorage()->read();
            if($identi->estado==0){
                $auth->getStorage()->write(false);
                $this->flashMessenger()->addMessage("Usuario bloqueado consulte con su administrador");
                return $this->redirect()->toUrl($this->getRequest()->getBaseUrl().'/usuario/usuario/login');
            }

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
            $sesion=new Container('usuario');
            $sesion->id = $datos->id;
            //$this->sesion=$datos;
            $form=new FormularioUsuario("form");
	$form->setAttributes(array(
	'action'=>$this->getRequest()->getBaseUrl().'/usuario/usuario/envio',
	'method'=>'POST'
	));
         }else{
            $datos="No estas identificado";
         }
         return new ViewModel(
                array("datos"=>$datos,'sesion'=>$sesion,'form'=>$form)
                );
    }
    public function cerrarAction(){
        //Cerramos la sesión borrando los datos de la sesión.
        $this->auth->clearIdentity();
        $sesion=new Container('usuario');
        $sesion->id=null;
        $sesion->email=null;
        return $this->redirect()->toUrl($this->getRequest()->getBaseUrl().'/usuario/usuario/login');
    }
    public function envioAction(){
    	$emisor = 'jsilvap22@gmail.com';
    	$destinatario = 'soporteurbania@clicksandbrics.pe';

    	$mensaje = new Message();
    	$mensaje->addTo($destinatario)
    			->addFrom($emisor)
    			->addEncoding("UTF-8")
    			->setSubject('Probando Zend Framework 2')
    			->setBody('Estamos probando zf2');
    	$transport = new SmtpTransport();
    	$options = new SmtpOptions(array(
    			'name'	=>	'smtp.gmail.com',
    			'host'	=>	'smtp.gmail.com',
    			'port'	=>	587,
    			'connection_class' => 'login',
    			'connection_config' => array(
    					'username' => 'jsilvap22@gmail.com',
    					'password' => 'junior943797547'
    				),
    		));
    	$transport->setOptions($options);
    	$transport->send($mensaje);
    	return $this->redirect()->toUrl($this->getRequest()->getBaseUrl().'/usuario/usuario/dentro');
    }
    public function perfilAction(){
        $sesion=new Container('usuario');
        if(!is_null($sesion->id)){
            $data=array('id'=>$sesion->id);
        }
        else{
            $data=array('error'=>'loguese como usuario');
        }
        return new ViewModel($data);
    }
}