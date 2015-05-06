<?php
namespace Usuario\Form;

 
use Zend\Form\Element;
use Zend\Form\Form;
use Zend\Form\Factory;

class FormularioUsuario extends Form
{
    public function __construct($name = null)
     {
        parent::__construct($name);
      // $this->setInputFilter(new \Modulo\Form\AddUsuarioValidator());
       $this->setAttributes(array(
            //'action' => $this->url.'/modulo/recibirformulario',
            'action'=>"",
            'method' => 'post'
        ));
        $this->add(array(
            'name' => 'email',
            'attributes' => array(
                'type' => 'email',
                'class' => 'input form-control',
                'required'=>'required'
            )
        ));
        $this->add(array(
            'name' => 'pasword',
            'attributes' => array(
                'type' => 'password',
                'class' => 'input form-control',
                'required'=>'required'
            )
        ));
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(    
                'type' => 'submit',
                'value' => 'Entrar',
                'title' => 'Entrar',
                'class' => 'btn btn-success'
            ),
        ));        
        $this->add(array(
            'name' => 'facebook',
            'attributes' => array(    
                'type' => 'button',
                'value' => 'Login con Facebook',
                'title' => 'Entrar',
                'class' => 'btn btn-primary',
            ),
        ));     
        $this->add(array(
            'name' => 'login2',
            'attributes' => array(    
                'type' => 'button',
                'value' => 'Login',
                'title' => 'Entrar',
                'class' => 'btn btn-primary',
            ),
        ));
        $this->add(array(
        'type' => 'url',
        'name' => 'login',
        'options' => array(
                'label' => 'Login'
            )
        ));
    }
}
?>