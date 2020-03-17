<?php

    namespace Academy;
    use PDO;

    Class connect{
    public $host = "localhost";
    public $user = "root";
    public $password = "";

    public $db = "test";
    public $charset = "utf8";

    public $pdo = "";

    public function __construct() {

        $dsn = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";
        $opt = array(
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );
        $this->pdo = new PDO($dsn, $this->user, $this->password, $opt);
    }
}

Class db extends connect{

    public $table_name = '';

    /**
     * добавление записи в таблицу
     * @param array $data массив данных для сохранения
     * @return Boolen
     */
    public function insert($data)
    {
    $data['create_at'] = Date('Y-m-d H:i:s');
    $fields = $this->set_fields($data);
    $sql = "INSERT INTO `{$this->table_name}` SET ".$fields;
    $stmt = $this->pdo->prepare( $sql );

    return $stmt->execute($data);
    }

    //not used
    public function update($data)
    {
    $fields = $this->set_fields($data);
    $sql = "UPDATE `{$this->table_name}` SET ".$fields.' WHERE id=:id';
    $stmt = $this->pdo->prepare( $sql );

    return $stmt->execute($data);
    }

    public function is_registered($field, $data, $order = "id asc")
    {
        $sql = "SELECT * FROM `{$this->table_name}` WHERE $field='".$data."' ORDER BY $order";
        $where = [$field => $data];
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($where);
        $result = $stmt->fetch();

        return $result;
    }

    public function set_fields( $items, $delimiter = "," ) {
        $str = array();
        if(empty($items)) return "";
        foreach ($items as $key=>$item){
            $str[] = "`".$key."`=:".$key;
        }

    return implode($delimiter, $str );
    }
}