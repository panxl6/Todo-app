<?php

namespace Model;

use PDO;

class Model
{
	private $conn = null;
	private $tableName = '';

	use ModelTrait;

	public function __construct($table) {
		$this->tableName = $table;
		if (empty($this->conn)) {
			$this->conn = new PDO('mysql:host=127.0.0.1:3306;dbname=todo;charset=utf8', 'root', 'root');
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
	}

	public function read($condition) {
		$conditionString = '';
		foreach ($condition as $field => $value) {
			$conditionString .= $field . '=' . $value . ' AND ';
		}

		$sql = 'select * from' . $this->tableName;

		if (!empty($conditionString)) {
			$conditionString = substr($conditionString, 0, strlen($conditionString) - 4);
			$sql .= $conditionString;
		}

		try {
			$container = array();
			$ret = $this->conn->query($sql);
			foreach ($ret as $row) {
				$container[] = $row;
			}

			$container = $this->escapeFields($container);

			return $container;
		} catch (PDOException $e) {
			return false;
		}
	}

	public function writeToTable($data) {
		$data = $this->encapsulateFields($data);

		$field = '';
		$value = '';
		foreach ($data as $key => $item) {
			$field .= '`' . $key . '`,';
			$value .= '\'' . $item . '\',';
		}

		$field = substr($field, 0, -1);
		$value = substr($value, 0, -1);

		$sql = 'INSERT INTO ' . $this->tableName . '(' .
			$field . ') VALUES(' . $value . ');';

		try {
			$this->conn->query($sql, PDO::FETCH_ASSOC);
			return true;
		} catch (PDOException $e) {
			return false;
		}
	}

	public function update() {

	}
}