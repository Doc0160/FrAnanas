<?php

/**
 * DB Class
 * 
 * $users = $db->select('*')->from('users')->where('id>1')->limit(100)->orderby('username')->fetchAll();
 */
class DB {

    /** @ignore */
    private $PDOInstance = null;
    /** @ignore */
    private $dsn         = null;
    /** @ignore */
    private $username    = null;
    /** @ignore */
    private $password    = null;
    /** @ignore */
    private $options     = array(
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );
    /** @ignore */
    private $req = [];

    /** @ignore */
    public function __construct() {        
    }

    /**
     * Set config
     */
    public function setConfig(string $dsn,
                              string $username, string $password,
                              array $options = []):void {
                                  $this->dsn      = $dsn;
                                  $this->username = $username;
                                  $this->password = $password;
                                  $this->options += $options;
                              }

    /**
     * Get raw PDO instance
     */
    public function getPDO(): PDO {
        if(is_null($this->PDOInstance)){
            if(!empty($this->dsn)){
                $this->PDOInstance = new PDO($this->dsn,
                                             $this->username,
                                             $this->password,
                                             $this->options);
            } else {
                throw new Exception(__CLASS__." : no config !");
            }
        }
        return $this->PDOInstance;
    }

    public function quote(string $q): string {
        return $this->getPDO()->quote($q);
    }

    /**
     * Set SQL Query
     */
    public function query(string $query) {
        $this->req = [];
        $this->req['query'] = $query;
    }

    /**
     * $users = $db->select('*')->from('users')->where('id>1')->limit(100)->orderby('username')->fetchAll();
     */
    public function select(string $what = '*') {
        $this->req = [];
        $this->req['select'] = $what;
        return $this;
    }

    /**
     * $users = $db->select('*')->from('users')->where('id>1')->limit(100)->orderby('username')->fetchAll();
     */
    public function from(string $what) {
        $this->req['from'] = $what;
        return $this;
    }

    /**
     * $users = $db->select('*')->from('users')->where('id>1')->limit(100)->orderby('username')->fetchAll();
     */
    public function where(string $what = '1=1') {
        $this->req['where'] = $what;
        return $this;
    }

    /**
     * $users = $db->select('*')->from('users')->where('id>1')->limit(100)->orderby('username')->fetchAll();
     */
    public function limit(string $what = '100') {
        $this->req['limit'] = $what;
        return $this;
    }

    /**
     * $users = $db->select('*')->from('users')->where('id>1')->limit(100)->orderby('username')->fetchAll();
     */
    public function orderby(string $what = 'id') {
        $this->req['orderby'] = $what;
        return $this;
    }
    
    //
    public function insert(string $what, array $values) {
        $this->req = [];
        $this->req['insert'] = $what;
        $this->req['values'] = $values;
        return $this;
    }

    /**
     * Get SQL Query
     */
    public function req() : string {
        $req = '';
        if(!empty($this->req['query'])) {
            $req = $this->req['query'];

        } else if(
            !empty($this->req['insert']) &&
            !empty($this->req['values'])
        ) {
            $fields = implode(',', array_keys($this->req['values']));
            $values = implode(',', array_map(array($this, 'quote'),
                                             array_values($this->req['values'])));
            $req .= ' INSRET INTO '.$this->req['insert'];
            $req .= ' ('.$fields.')';
            $req .= ' VALUES '.$values;
            
        } else if(
            !empty($this->req['select']) &&
            !empty($this->req['from'])
        ) {
            $req .= ' SELECT '. $this->req['select'];
            $req .= ' FROM ' . $this->req['from'];
            $req .= (isset($this->req['where'])) ?
                    ' WHERE '. $this->req['where'] : "";
            $req .= (isset($this->req['orderby'])) ?
                    ' ORDER BY '. $this->req['orderby'] : "";
            $req .= (isset($this->req['limit'])) ?
                    ' LIMIT '. $this->req['limit'] : "";
        }
        return $req;
    }
    
    public function fetchAll() {
        $req = $this->req();
        $req = $this->getPDO()->query($req)->fetchAll();
        $this->req = [];
        
        return $req;
    }

    public function fetch() {
        $req = $this->req();
        $req = $this->getPDO()->query($req)->fetch();
        $this->req = [];
        
        return $req;
    }
    
}
