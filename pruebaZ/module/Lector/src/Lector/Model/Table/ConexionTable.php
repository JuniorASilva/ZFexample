<?php

namespace Lector\Model\Table;

use Zend\Db\Adapter\Adapter;

use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;
use Urb\Db\Table\AbstractTable;
use Zend\Db\ResultSet\ResultSet;

use Zend\Db\TableGateway\TableGateway;

class ConexionTable extends TableGateway{
	private $dbAdapter;
	public function __construct(Adapter $adapter = null, $database = null, ResultSet $selectResult = null){
		$this->dbAdapter = $adapter;
		return parent::__construct('Usuario',$this->dbAdapter,$database,$selectResult);
	}

	public function getUsuario(){
		$sql = new Sql($this->dbAdapter);
		$select = $sql->select();
		$select->columns(array('id','nombre', 'email','estado'))
               ->from('Usuario');
		$selectString = $sql->getSqlStringForSqlObject($select);
		$execute = $this->dbAdapter->query($selectString, Adapter::QUERY_MODE_EXECUTE);
		$result=$execute->toArray();
		return $result;
	}

	public function getUnUsuario($id){
		$sql = new Sql($this->dbAdapter);
		$select = $sql->select();
		$select->columns(array('nombre', 'email'))
               ->from('Usuario')
               ->where(array('id'=>$id));
		$selectString = $sql->getSqlStringForSqlObject($select);
		$execute = $this->dbAdapter->query($selectString, Adapter::QUERY_MODE_EXECUTE);
		$result=$execute->toArray();
		return $result;
	}

	public function setUsuario($nombre,$email){
		$sql = new Sql($this->dbAdapter);
		$insert = $sql->insert('Usuario');
		$registro = array(
			'nombre'=>$nombre,
			'email'=>$email
			);
		$insert->values($registro);
		$selectString = $sql->getSqlStringForSqlObject($insert);
		$this->dbAdapter->query($selectString, Adapter::QUERY_MODE_EXECUTE);
	}

	public function eliminar($id){
		$sql = new Sql($this->dbAdapter);
		$update = $sql->update('Usuario');
		$update->set(array('estado'=>0))->where(array('id'=>$id));
		$updateString = $sql->getSqlStringForSqlObject($update);
		$this->dbAdapter->query($updateString, Adapter::QUERY_MODE_EXECUTE);
	}

	public function modificar($nombre,$email,$id){
		$sql = new Sql($this->dbAdapter);
		$update = $sql->update('Usuario');
		$update->set(array('nombre'=>$nombre,'email'=>$email))->where(array('id'=>$id));
		$updateString = $sql->getSqlStringForSqlObject($update);
		$this->dbAdapter->query($updateString, Adapter::QUERY_MODE_EXECUTE);
	}

}