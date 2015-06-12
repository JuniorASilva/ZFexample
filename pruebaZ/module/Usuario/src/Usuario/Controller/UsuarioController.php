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

use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\GraphObject;
use Facebook\FacebookRequestException;
use Facebook\FacebookRedirectLoginHelper;
 
//Incluir formularios
use Usuario\Form\FormularioUsuario;


use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class UsuarioController extends AbstractActionController
{
    protected $apikey = '1380406485591995';
    protected $secretkey = 'dd0ae4b7ce72a5cad1a61b8a5f25ee16';

    public function indexAction()
    {
        $form=new FormularioUsuario("form");
        $url = $this->getRequest()->getBaseUrl();
    	$data= array("holamundo"=>"Hola junior desde Zend2",'form'=>$form,'url'=>$url);
        return new ViewModel($data);
    }

    public function __construct(){
    	$this->auth = new AuthenticationService();
    }

    public function facebookAction(){
        session_start();
        $url = $this->getRequest()->getBaseUrl().'/usuario/usuario/facebook';
        try{
            FacebookSession::setDefaultApplication($this->apikey, $this->secretkey);
            $helper = new FacebookRedirectLoginHelper('http://local.prueba/usuario/usuario/facebook');
            try {
              $session = $helper->getSessionFromRedirect();
            } catch(FacebookRequestException $ex) {
              // When Facebook returns an error
                $data['error'] = json_encode($ex);
            } catch(\Exception $ex) {
              // When validation fails or other local issues
                $data['error'] = json_encode($ex);
            }
            if($session){
            //$session = $this->HelperFacebook()->getSessionFromRedirect();
                $token = $session->getAccessToken();
                $session = new FacebookSession($token);
                $request = new FacebookRequest($session, 'GET', '/me');
                $response = $request->execute();
                $graphObjectClass = $response->getGraphObject(GraphUser::className());
                $data['id'] = $graphObjectClass->getProperty('id');
                $data['apodo'] = $graphObjectClass->getProperty('bio');
                $data['nombre'] = $graphObjectClass->getProperty('first_name');
                $data['apepat'] = $graphObjectClass->getProperty('last_name');
                $genero = $graphObjectClass->getProperty('gender');
                $data['genero'] = ($genero == 'male' ? 2 : 1);
                $data['email'] = $graphObjectClass->getProperty('email');
            }else {
                $loginUrl = $helper->getLoginUrl();
                return $this->redirect()->toUrl($loginUrl);
            }
            //else { $data['error'] = 'error';}
        }catch(FacebookRequestException $e){
            $data = $e;
        }
        return new ViewModel(array('error'=>$data));
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
                array("form"=>$form,'url'=>$uri)
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
    			//->addEncoding("utf-8")
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