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
		$select->columns(array('id','nombre', 'email'))
               ->from('Usuario');
		$selectString = $sql->getSqlStringForSqlObject($select);
		$execute = $this->dbAdapter->query($selectString, Adapter::QUERY_MODE_EXECUTE);
		$result=$execute->toArray();
		return $result[0];
	}

	public function setUsuario($nombre,$email){
		$sql = new Sql($this->dbAdapter);
		$insert = $sql->insert('Usuario');
		$registro=array(
			'id'=>3,
			'nombre'=>$nombre,
			'email'=>$email
			);
		$insert->values($registro);
		$selectString = $sql->getSqlStringForSqlObject($insert);
		$this->dbAdapter->query($selectString, Adapter::QUERY_MODE_EXECUTE);
	}

}