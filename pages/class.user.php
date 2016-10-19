<?php
require_once('dbconfig.php');

class USER
{	

	private $conn;
	
	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }

    public function __destruct()
    {
        $this->db = null;
    }
	
	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
	
	//Funcion para ingresar un nuevo docente, por defecto es tipo 2 (docente)
	public function register_docente($cc,$nombre,$prim_apellido,$seg_apellido,$email,$pass)
	{

		$id_tipo="2";

		try
		{
			$new_password = password_hash($pass, PASSWORD_DEFAULT);
			
			$stmt = $this->conn->prepare("INSERT INTO docente(id_docente,nombres,prim_apellido,seg_apellido,email,pass,id_tipo) 
		                                  VALUES(:cc,:nombre,:prim_ape,:seg_ape,:email,:pass,:id_tipo)");
												  
			$stmt->bindparam(":cc", $cc);
			$stmt->bindparam(":nombre", $nombre);
			$stmt->bindparam(":prim_ape", $prim_apellido);
			$stmt->bindparam(":seg_ape", $seg_apellido);
			$stmt->bindparam(":email", $email);
			$stmt->bindparam(":pass", $new_password);
			$stmt->bindparam(":id_tipo", $id_tipo);										  
				
			$stmt->execute();	
			
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}


	//Funcion para ingresar un nuevo alumno
	public function register_alumno($ti,$nombre,$prim_apellido,$seg_apellido,$email,$pass)
	{
		try
		{
			
			$stmt = $this->conn->prepare("INSERT INTO alumno(id_alumno,nombres,prim_apellido,seg_apellido,id_acudiente,id_grado,id_grupo) 
		                                  VALUES(:ti,:nombre,:prim_ape,:seg_ape,:id_acudiente,:id_grado,:id_grupo)");
												  
			$stmt->bindparam(":ti", $ti);
			$stmt->bindparam(":nombre", $nombre);
			$stmt->bindparam(":prim_ape", $prim_apellido);
			$stmt->bindparam(":seg_ape", $seg_apellido);
			$stmt->bindparam(":id_acudiente", $id_acudiente);
			$stmt->bindparam(":id_grado", $id_grado);
			$stmt->bindparam(":id_grupo", $id_grupo);										  
				
			$stmt->execute();	
			
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}

	//Funcion para ingresar un nuevo acudiente
	public function register_acudiente($cc,$nombre,$prim_apellido,$seg_apellido,$phone)
	{

		try
		{	
			$stmt = $this->conn->prepare("INSERT INTO acudiente(id_acudiente,nombres,prim_apellido,seg_apellido,telefono) 
		                                  VALUES(:cc,:nombre,:prim_ape,:seg_ape,:phone)");
												  
			$stmt->bindparam(":cc", $cc);
			$stmt->bindparam(":nombre", $nombre);
			$stmt->bindparam(":prim_ape", $prim_apellido);
			$stmt->bindparam(":seg_ape", $seg_apellido);
			$stmt->bindparam(":phone", $phone);								  
				
			$stmt->execute();	
			
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}
	
	
	//funcion loguear usuario
	public function doLogin($u_id,$u_pass)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT id_docente, pass FROM docente WHERE id_docente=:u_id");
			$stmt->execute(array(':u_id'=>$u_id));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount() == 1)
			{
				if(password_verify($u_pass, $userRow['pass']))
				{
					$_SESSION['user_session'] = $userRow['id_docente'];
					return true;
				}
				else
				{
					return false;
				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	//funcion saber si esta logueado
	public function is_loggedin()
	{
		if(isset($_SESSION['user_session']))
		{
			return true;
		}
	}
	

	/*
     * -------------F U N C I O N E S  A L U M N O ----------
     * Read all records
     *
     * @return $mixed
     * */
    public function Read_alumno()
    {
        $query = $this->conn->prepare("SELECT * FROM alumno");
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }
 
    /*
     * Delete Record
     *
     * @param $user_id
     * */
    public function Delete_alumno($alumno_id)
    {
        $query = $this->conn->prepare("DELETE FROM alumno WHERE id_alumno = :id");

        $query->bindParam("id", $alumno_id, PDO::PARAM_STR);

        $query->execute();
    }
 
    /*
     * Update Record
     *
     * @param $first_name
     * @param $last_name
     * @param $email
     * @return $mixed
     * */
    public function Update_alumno($first_name, $last_name, $email, $user_id)
    {
        $query = $this->conn->prepare("UPDATE users SET first_name = :first_name, last_name = :last_name, email = :email  WHERE id = :id");

        $query->bindParam("first_name", $first_name, PDO::PARAM_STR);
        $query->bindParam("last_name", $last_name, PDO::PARAM_STR);
        $query->bindParam("email", $email, PDO::PARAM_STR);
        $query->bindParam("id", $user_id, PDO::PARAM_STR);

        $query->execute();
    }
 
    /*
     * Get Details
     *
     * @param $user_id
     * */
    public function Details_alumno($user_id)
    {
        $query = $this->conn->prepare("SELECT * FROM users WHERE id = :id");
        $query->bindParam("id", $user_id, PDO::PARAM_STR);
        $query->execute();
        return json_encode($query->fetch(PDO::FETCH_ASSOC));
    }


    /*
     * -------------F U N C I O N E S  D O C E N T E ----------
     * Read all records
     *
     * @return $mixed
     * */
    public function Read_docente()
    {
        $query = $this->conn->prepare("SELECT * FROM docente");
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }
 
    /*
     * Delete Record
     *
     * @param $user_id
     * */
    public function Delete_docente($docente_id)
    {
        $query = $this->conn->prepare("DELETE FROM docente WHERE id_docente = :id");

        $query->bindParam("id", $alumno_id, PDO::PARAM_STR);

        $query->execute();
    }
 
    /*
     * Update Record
     *
     * @param $first_name
     * @param $last_name
     * @param $email
     * @return $mixed
     * */
    public function Update_docente($first_name, $last_name, $email, $user_id)
    {
        $query = $this->conn->prepare("UPDATE users SET first_name = :first_name, last_name = :last_name, email = :email  WHERE id = :id");

        $query->bindParam("first_name", $first_name, PDO::PARAM_STR);
        $query->bindParam("last_name", $last_name, PDO::PARAM_STR);
        $query->bindParam("email", $email, PDO::PARAM_STR);
        $query->bindParam("id", $user_id, PDO::PARAM_STR);

        $query->execute();
    }
 
    /*
     * Get Details
     *
     * @param $user_id
     * */
    public function Details_docente($user_id)
    {
        $query = $this->conn->prepare("SELECT * FROM users WHERE id = :id");
        $query->bindParam("id", $user_id, PDO::PARAM_STR);
        $query->execute();
        return json_encode($query->fetch(PDO::FETCH_ASSOC));
    }


    /*
     * -------------F U N C I O N E S  A C U D I E N T E ----------
     * Read all records
     *
     * @return $mixed
     * */
    public function Read_acudiente()
    {
        $query = $this->conn->prepare("SELECT * FROM acudiente");
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }
 
    /*
     * Delete Record
     *
     * @param $user_id
     * */
    public function Delete_acudiente($docente_id)
    {
        $query = $this->conn->prepare("DELETE FROM acudiente WHERE id_acudiente = :id");

        $query->bindParam("id", $alumno_id, PDO::PARAM_STR);

        $query->execute();
    }
 
    /*
     * Update Record
     *
     * @param $first_name
     * @param $last_name
     * @param $email
     * @return $mixed
     * */
    public function Update_acudiente($first_name, $last_name, $email, $user_id)
    {
        $query = $this->conn->prepare("UPDATE users SET first_name = :first_name, last_name = :last_name, email = :email  WHERE id = :id");

        $query->bindParam("first_name", $first_name, PDO::PARAM_STR);
        $query->bindParam("last_name", $last_name, PDO::PARAM_STR);
        $query->bindParam("email", $email, PDO::PARAM_STR);
        $query->bindParam("id", $user_id, PDO::PARAM_STR);

        $query->execute();
    }
 
    /*
     * Get Details
     *
     * @param $user_id
     * */
    public function Details_acudiente($user_id)
    {
        $query = $this->conn->prepare("SELECT * FROM users WHERE id = :id");
        $query->bindParam("id", $user_id, PDO::PARAM_STR);
        $query->execute();
        return json_encode($query->fetch(PDO::FETCH_ASSOC));
    }


	//funcion redireccionar
	public function redirect($url)
	{
		header("Location: $url");
	}
	
	//funcion desloguarse
	public function doLogout()
	{
		session_destroy();
		unset($_SESSION['user_session']);
		return true;
	}

}
?>