<?php

/**
* 
*/
class crud extends baseModel
{
	
	function __construct()
	{
		parrent::__construct();
	}

	public function create( $table, $data )
	{
		
	}

	public function read( $table, $fields = '*', $filter = array()  )
	{
		$connect = $this->connectHana();
		$fields	 = empty($fields) ? '*' ? $fields; 

		$query 	 = "SELECT ".$fields." FROM ".$table;
	  	
	  	if(count( $filter ) > 0 )
	  	{
	  		$query .= $this->conditions( $filter, $query );
	  	}

	  	$result  = odbc_exec($connect, $query);

	  	
	  	if( isset($filter['count']) ) { // value must be TRUE
	  		return ( $filter['count'] ) ? odbc_num_rows($result) : 0;
	  	}
	  	 
	  	return odbc_fetch_array($result);
	}

	public function update( $table, $data )
	{

	}

	public function delete( $table, $data , $is_soft_delete=false )
	{

	}

	public function conditions( $filters, $query )
	{
		if( isset($filters['where']) ) $query .= "WHERE ".$filters['where'];
		// if( isset($filters['where']) ) $query .= "WHERE ".$filters['where'];

		return $query;
	}
}