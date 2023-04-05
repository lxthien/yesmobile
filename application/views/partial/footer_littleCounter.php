<?php

// MySQL Dump:
/*

  CREATE TABLE `counter` (
  `ID` int(8) NOT NULL auto_increment,
  `timestamp` varchar(14) default NULL,
  `ip` varchar(15) NOT NULL default '',
  KEY `ID` (`ID`)
  ) TYPE=MyISAM ;
  ////////////////////
 */
class littleCounter {

    var $onlinetime;
    var $dbhost;
    var $dbuser;
    var $dbpwd;
    var $dbdatabase;
    var $dbtable;

    function connect_to_db() {
        @mysql_connect($this->dbhost, $this->dbuser, $this->dbpwd)
                or die("Error: Could not connect to MySQL Server");
        @mysql_select_db($this->dbdatabase)
                or die("Error: Could not select MySQL Database");
    }

    function insert_new_hit() {
        $ip = getenv("REMOTE_ADDR");
        $timestamp = time();
        $insert_query = "INSERT INTO $this->dbtable (ip, timestamp) VALUES ('$ip', '$timestamp')";
        $query = @mysql_query($insert_query);
        if ($query)
            return TRUE;
        else
            return FALSE;
    }

    function show_counter($mode) {
        switch ($mode) {
            // Total Hits:
            case "hits": $select_query = "SELECT ip 
											FROM $this->dbtable";
                break;

            // Total Visitors:
            case "total": $select_query = "SELECT DISTINCT ip 
											FROM $this->dbtable";
                break;

            // Visitors online:
            case "online": $select_query = "SELECT ip, timestamp 
											FROM $this->dbtable 
											WHERE timestamp>=UNIX_TIMESTAMP()-$this->onlinetime 
											AND timestamp<=UNIX_TIMESTAMP() GROUP BY ip";
                break;

            // Hits of one IP during the last 24 hours:
            case "hits_of_user":
                $ip = getenv("REMOTE_ADDR");
                $select_query = "SELECT ip, timestamp 
											 FROM $this->dbtable 
											 WHERE timestamp>=UNIX_TIMESTAMP()-84600 
											 AND timestamp<=UNIX_TIMESTAMP() 
											 AND ip='$ip'";
                break;
        }
        $query = @mysql_query($select_query) or die("Error: Could not execute SQL command");
        if ($query)
            $result = @mysql_num_rows($query);
        else
            $result = 0;
        return $result;
    }

    function close_mysql_connection() {
        @mysql_close() or die("Error: Could not close MySQL connection");
    }

}

?>