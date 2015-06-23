<?php

class MySQLDB
      {

      protected $forma = MYSQL_ASSOC;

      protected $link;

      protected $rs;

      protected $ret_query;

      protected $ret_object;

      protected $host = 'localhost';

      protected $login = 'root';
	  
      protected $password = '';

       function connect($host, $login, $password)
                {
                  if(!$this->link = mysqli_connect($host, $login, $password))
                  {
                   die ("Nуo foi possэvel conectar раbase de dados.");
                   return FALSE;
                  }
                  mysqli_set_charset($this->link, 'utf8');
                 }

       function select_db()
                {

                mysqli_select_db($this->link,'medstock') or die('Nуo foi encontrado a base de dados');
                }

       function close()
                {
                 if (!mysqli_close())
                     return FALSE;
                }

       function query($query) {

            try {
                $this -> ret_query = mysqli_query($this->link, $query);
                
            } catch (mysqli_sql_exception $e) {
               //$this -> error();
               echo $e->getMessage();
            }
           return $this -> ret_query;
       }
       function fetch_array($rs)
                {

                 if ( $this -> ret_query = mysqli_fetch_array($rs, $this -> forma) )
                    return $this -> ret_query;
                    else $this -> error();
                }
        function fetch_object($rs)
                {

                 if ( $this -> ret_object = mysqli_fetch_object($rs) )
                    return $this -> ret_object;
                    else $this -> error();
                }
       function num_rows($rs)
                {
                return mysqli_num_rows($rs);
                }

       function affected_rows()
                {
                 return mysqli_affected_rows($this->link);
                }
       function data_seek($rs, $position)
                {
                    return mysqli_data_seek($rs, $position);
                }
       function last_id()
                {
                    return mysqli_insert_id($this->link);
                }
       function error()
                {
                 echo mysqli_error($this->link);
                }
       function escape($string)
                {
                 return mysqli_escape_string($this->link, $string);
                }
       function __construct()
                {
                  mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); 
                 $this->connect($this->host, $this->login, $this->password);
                                            
                 $this->select_db();

                }
       function __destruct()
                {
                 mysqli_close($this->link);
                }

       }

?>