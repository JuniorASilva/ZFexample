<?php

namespace Lector\Model\Table;

use Zend\Db\Adapter\Adapter;

use Zend\Db\Sql\Sql;
use Urb\Db\Table\AbstractTable;

class ConexionTable extends TableGateway{
	private $dbAdapter;
	public function __construct(Adapter $adapter = null, $database = null, ResultSet $selectResult = null){
		$this->dbAdapter = $adapter;
		return parent::__construct('Usuario',$this->dbAdapter,$database,$selectResult);
	}

}