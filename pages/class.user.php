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
	
	
    /**
     * Funcion para devolver datos de usuario (menu)
     * @param  [type] $id_user [id usuario a buscar]
     * @return [type] $data    [description]
     */
    public function user_data($user_id)
    {
        try 
        {
            $stmt = $this->conn->prepare("SELECT id_tipo_usuario,nombres,prim_apellido,seg_apellido,email FROM docente WHERE id_docente=:user_id");
            $stmt->bindparam(":user_id", $user_id);
            $stmt->execute();


            if ($stmt->rowCount() > 0) 
            {

                return $stmt->fetch(PDO::FETCH_OBJ);
            }

        } 

        catch (PDOException $e) 
        {
            exit($e->getMessage());
        }
    }

    /**
     * [tipo_user description]
     * @param  [type] $id_user [description]
     * @return [type]          [description]
     */
    public function tipo_user($id_tipo)
    {
        try 
        {
            $stmt = $this->conn->prepare("SELECT id_tipo_usuario,des_tipo_usuario FROM tipo_usuario WHERE id_tipo_usuario=:id_tipo");
            $stmt->bindparam(":id_tipo", $id_tipo);
            $stmt->execute();


            if ($stmt->rowCount() > 0) 
            {

                return $stmt->fetch(PDO::FETCH_OBJ);
            }

        } 

        catch (PDOException $e) 
        {
            exit($e->getMessage());
        }

    }


    
     /* -------------F U N C I O N E S  D O C E N T E ----------*/
     
    /**
     * Leer lista de doncente desde Base de Datos
     */
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

    /**
     * Funcion para registrar a un nuevo docente
     * @param  [int] $id_tipo = 1            [Tipo Root]
     * @param  [int] $id_tipo = 2            [Tipo Administrador]
     * @param  [int] $id_tipo = 3            [Tipo Docente]
     */
	public function register_docente($cc,$nombre,$prim_apellido,$seg_apellido,$email,$pass,$id_sede)
	{
		$id_tipo="3";

		try
		{
			$new_password = password_hash($pass, PASSWORD_DEFAULT);

			$stmt = $this->conn->prepare("INSERT INTO docente(id_docente,id_tipo_usuario,nombres,prim_apellido,seg_apellido,email,pass,id_sede) 
		                                  VALUES(:cc,:id_tipo,:nombre,:prim_ape,:seg_ape,:email,:new_password,:id_sede)");
												  
			$stmt->bindparam(":cc", $cc);
            $stmt->bindparam(":id_tipo", $id_tipo);
			$stmt->bindparam(":nombre", $nombre);
			$stmt->bindparam(":prim_ape", $prim_apellido);
			$stmt->bindparam(":seg_ape", $seg_apellido);
			$stmt->bindparam(":email", $email);
			$stmt->bindparam(":new_password", $new_password);
            $stmt->bindparam(":id_sede", $id_sede);									  
				
			$stmt->execute();	
			
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}

    /**
     * Actualizar informacion docente
     * @param  [type] $id_docente [description]
     * @param  [type] $nombres    [description]
     * @param  [type] $p_apellido [description]
     * @param  [type] $s_apellido [description]
     * @param  [type] $email      [description]
     */
    public function update_docente($id_docente,$nombres,$p_apellido,$s_apellido,$email)
    {
        try
        {
            $stmt=$this->conn->prepare("UPDATE docente SET nombres=:nombres, prim_apellido=:p_apellido, seg_apellido=:s_apellido, email=:email WHERE id_docente=:id_docente");

            $stmt->bindparam(":nombres",$nombres);
            $stmt->bindparam(":p_apellido",$p_apellido);
            $stmt->bindparam(":s_apellido",$s_apellido);
            $stmt->bindparam(":email",$email);
            $stmt->bindparam(":id_docente",$id_docente);
            $stmt->execute();

            return true;            
        }

        catch(PDOException $e)
        {
            echo $e->getMessage();
            return false;
        }
    }


    public function cambiar_pass_docente($u_id,$old_pass,$new_pass)
    {
        $new_password = password_hash($new_pass, PASSWORD_DEFAULT);
        $res;

        try
        {
            $stmt = $this->conn->prepare("SELECT id_docente, pass FROM docente WHERE id_docente=:u_id");
            $stmt->execute(array(':u_id'=>$u_id));
            $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
            if($stmt->rowCount() == 1)
            {
                if(password_verify($old_pass, $userRow['pass']))
                {
                    $stmt=$this->conn->prepare("UPDATE docente SET pass=:new_password WHERE id_docente=:u_id");

                    $stmt->bindparam(":new_password",$new_password);
                    $stmt->bindparam(":u_id",$u_id);
                    $stmt->execute();

                    $res= true;
                }
                else
                {
                    $res= false;
                }
            }

            return $res;          
        }

        catch(PDOException $e)
        {
            echo $e->getMessage();
            return false;
        }
    }

/* -------------F U N C I O N E S  A L U M N O ----------*/
     
    /**
     * Leer lista de doncente desde Base de Datos
     */
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


    public function register_alumno($id_alumno,$id_sede,$id_grado,$nombres,$primer_apellido,$segundo_apellido,$desplazado,$repitente,$nombre_acudiente,$apellidos_acudiente,$telefono_acudiente,$fecha_matricula)
    {
        try
        {
            $stmt = $this->conn->prepare("INSERT INTO alumno(id_alumno,id_sede,id_grado,nombres,primer_apellido,segundo_apellido,desplazado,repitente,nombre_acudiente,apellidos_acudiente,telefono_acudiente,fecha_matricula) 
                                          VALUES(:id_alumno,:id_sede,:id_grado,:nombres,:primer_apellido,:segundo_apellido,:desplazado,:repitente,:nombre_acudiente,:apellidos_acudiente,:telefono_acudiente,:fecha_matricula)");
                                                  
            $stmt->bindparam(":id_alumno", $id_alumno);
            $stmt->bindparam(":id_sede", $id_sede);
            $stmt->bindparam(":id_grado", $id_grado);
            $stmt->bindparam(":nombres", $nombres);
            $stmt->bindparam(":primer_apellido", $primer_apellido);
            $stmt->bindparam(":segundo_apellido", $segundo_apellido);
            $stmt->bindparam(":desplazado", $desplazado);
            $stmt->bindparam(":repitente", $repitente);
            $stmt->bindparam(":nombre_acudiente", $nombre_acudiente);
            $stmt->bindparam(":apellidos_acudiente", $apellidos_acudiente);                                    
            $stmt->bindparam(":telefono_acudiente", $telefono_acudiente);
            $stmt->bindparam(":fecha_matricula", $fecha_matricula);
                
            $stmt->execute();   
            
            return $stmt;   
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }               
    }


    /**
     * Leer detalles de alumno por ID_ALUMNO
     */
    public function detalles_alumno($alumno_id)
    {
        $data_volean=false;
        try 
        {
            /*$stmt = $this->conn->prepare("SELECT id_alumno,id_grado,nombres,primer_apellido,segundo_apellido,desplazado,repitente,nombre_acudiente,apellidos_acudiente,telefono_acudiente,fecha_matricula FROM alumno WHERE id_alumno=:alumno_id");
            $stmt->bindparam(":alumno_id", $alumno_id);
            $stmt->execute();*/

            $query = $this->conn->prepare("SELECT * FROM alumno WHERE id_alumno=:alumno_id");
            $query->bindParam(":alumno_id",$alumno_id,PDO::PARAM_INT,1);
            $data = array();

            if ($query->execute()) 
            {
                $row = $query->fetch(PDO::FETCH_ASSOC);
                //<!-- Modal Detalles Alumno -->
                $data[] = "<div class='panel panel-info' id='DetallesAlumno' tabindex='-1' role='dialog'>
                            <div class='modal-dialog' role='document'>
                                <div class='modal-content'>
                                    <div class='modal-body'>
                                        <div class='panel panel-info'>
                                            <div class='panel-heading'>
                                              <h3 class='panel-title'>Sheena Shrestha</h3>
                                            </div>
                                            <div class='panel-body'>
                                              <div class='row'>
                                                <div class=' col-md-9 col-lg-9 '> 
                                                  <table class='table table-user-information'>
                                                    <tbody>

                                                  <tr>
                                                        <td>Codigo:</td>
                                                        <td>".$row['id_alumno']."</td>
                                                      </tr>
                                                      <tr>
                                                        <td>Nombres:</td>
                                                        <td>".$row['nombres']."</td>
                                                      </tr>
                                                      <tr>
                                                        <td>Primer Apellido:</td>
                                                        <td>".$row['primer_apellido']."</td>
                                                      </tr>
                                                        <td>Segundo Apellido</td>
                                                        <td>".$row['segundo_apellido']."</td>
                                                      </tr>
                                                        <td>Desplazado</td>
                                                        <td>".$row['desplazado']."</td>
                                                      </tr>
                                                      <tr>
                                                        <td>Repitente</td>
                                                        <td>".$row['repitente']."</td>
                                                      </tr>
                                                        <td>Nombes Acudiente</td>
                                                        <td>".$row['nombre_acudiente']."</td>
                                                      </tr>
                                                      </tr>
                                                        <td>Apellidos Acudiente</td>
                                                        <td>".$row['apellidos_acudiente']."</td>
                                                      </tr>
                                                      </tr>
                                                        <td>Telefono Acudiente</td>
                                                        <td>".$row['telefono_acudiente']."</td>
                                                      </tr>
                                                      </tr>
                                                        <td>Fecha Matricula</td>
                                                        <td>".$row['fecha_matricula']."</td>
                                                      </tr>
                                                     
                                                    </tbody>
                                                  </table>
                                                </div>
                                              </div>
                                            </div>            
                                        </div>
                                    </div>
                                    <div class='modal-footer'>
                                        <button type='button' class='btn btn-warning waves-effect' data-dismiss='modal'>Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>";

                        return $data;
                }

                return $data_volean;

        } 

        catch(PDOException $e)
        {
            echo $e->getMessage();
            return false;
        }
    }


    /**
     * Combobox para cargar SEDES
     */
    public function combobox_sede()
    {
        $query = $this->conn->prepare("SELECT id_sede,descripcion_sede FROM Sede");
        $query->execute();
        
        while($row=$query->fetch(PDO::FETCH_ASSOC))
        {
            echo "entro";
            echo '<option value="'.$row['id_sede'].'">'.$row['descripcion_sede'].'</option>'; 
        }

    }


    /**
     * Combobox para cargar GRADOS
     */
    public function combobox_grado()
    {
        $query = $this->conn->prepare("SELECT id_grado,descripcion_grado FROM Grado");
        $query->execute();
        
        while($row=$query->fetch(PDO::FETCH_ASSOC))
        {
            echo "entro";
            echo '<option value="'.$row['id_grado'].'">'.$row['descripcion_grado'].'</option>'; 
        }

    }


/**----------------------------------------------------------------**/

    /**
     * Loguear al ususario
     */
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
    
    /**
     * Saber si se ecuentra logueado
     */
    public function is_loggedin()
    {
        if(isset($_SESSION['user_session']))
        {
            return true;
        }
    }

/**
 * funcion para redireccionar
 */
	public function redirect($url)
	{
		header("Location: $url");
	}
	
	/**
     * Destruir sesssion
     * @return [type] [description]
     */
	public function doLogout()
	{
		session_destroy();
		unset($_SESSION['user_session']);
		return true;
	}
}
?>