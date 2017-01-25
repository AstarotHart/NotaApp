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
     * Funcion para devolver las INICIALES de una cadena de caracteres
     */
    public function iniciales($nombre)
    {
        $notocar = array('del', 'de');
        $trozos = explode(' ', $nombre);
        $iniciales = '';

        for ($i=0; $i < count($trozos) ; $i++) 
        { 
            if (in_array($trozos[$i], $notocar))$iniciales .= $trozos." ";
            else $iniciales .= substr($trozos[$i], 0,1);
        }

        return $iniciales;
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

    /**
     * [desc_tipo_user description]
     * @param  [type] $id_tipo [description]
     * @return [type]          [description]
     */
    public function desc_tipo_user($id_tipo)
    {
        try 
        {
            $stmt = $this->conn->prepare("SELECT des_tipo_usuario FROM tipo_usuario WHERE id_tipo_usuario=:id_tipo");
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


    /* -------------F U N C I O N E S  A D M I N I S T R A D O R ----------*/

    /**
     * Combobox para cargar SEDES
     */
    public function combobox_sede()
    {
        $query = $this->conn->prepare("SELECT id_sede,descripcion_sede FROM Sede");
        $query->execute();
        
        while($row=$query->fetch(PDO::FETCH_ASSOC))
        {
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
            echo '<option value="'.$row['id_grado'].'">'.$row['descripcion_grado'].'</option>'; 
        }

    }

    /**
     * Combobox para cargar GRADOS
     */
    public function combobox_grupo()
    {
        $query = $this->conn->prepare("SELECT id_grupo,descripcion_grupo FROM grupo");
        $query->execute();
        
        while($row=$query->fetch(PDO::FETCH_ASSOC))
        {
            echo '<option value="'.$row['id_grupo'].'">'.$row['descripcion_grupo'].'</option>'; 
        }

    }

    /**
     * Combobox para cargar AREAS
     */
    public function combobox_areas()
    {
        $query = $this->conn->prepare("SELECT id_area,nombre_area FROM area");
        $query->execute();
        
        while($row=$query->fetch(PDO::FETCH_ASSOC))
        {
            echo '<option value="'.$row['id_area'].'">'.$row['nombre_area'].'</option>'; 
        }

    }

    /**
     * Combobox para cargar DOCENTES
     */
    public function combobox_docentes()
    {
        $query = $this->conn->prepare("SELECT id_docente,nombres, prim_apellido FROM docente  WHERE id_tipo_usuario = '3'");
        $query->execute();
        
        while($row=$query->fetch(PDO::FETCH_ASSOC))
        {
            echo '<option value="'.$row['id_docente'].'">'.$row['nombres'].' '.$row['prim_apellido'].'</option>'; 
        }

    }

    /**
     * [Read_sedes description]
     */
    public function Read_sedes()
    {
        $query = $this->conn->prepare("SELECT * FROM sede");
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    /**
     * [register_sedes description]
     * @param  [type] $descripcion_sede [description]
     * @return [type]                   [description]
     */
    public function register_sedes($descripcion_sede)
    {
        $iniciales_sede = $this->iniciales($descripcion_sede);

        $id_sede=$iniciales_sede;


        try
        {
            $stmt = $this->conn->prepare("INSERT INTO sede(id_sede,descripcion_sede) 
                                          VALUES(:id_sede,:descripcion_sede)");
                                                  
            $stmt->bindparam(":id_sede", $id_sede);
            $stmt->bindparam(":descripcion_sede", $descripcion_sede);                                  
                
            $stmt->execute();   
            
            return $stmt;   
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }               
    }


    /**
     * Listar Areas
     */
    public function Read_areas()
    {
        $query = $this->conn->prepare("SELECT * FROM area");
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    /**
     * Listar Areas por SEDE
     */
    public function Read_areas_sede($id_sede)
    {
        $query = $this->conn->prepare('SELECT * FROM area WHERE id_sede = :id_sede');
        $query->bindParam(":id_sede",$id_sede);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }    

    /**
     * [register_area description]
     * @param  [type] $id_area     [description]
     * @param  [type] $nombre_area [description]
     * @return [type]              [description]
     */
    public function register_area($id_sede,$nombre_area)
    {
        $anios = $this->Read_anio_lectivo();

        foreach ($anios as $anio) 
        {
            $id_area = $anio['id_anio_lectivo'];
        }

        $id_area.=$id_sede;

        $iniciales_area = $this->iniciales($nombre_area);

        $id_area.=$iniciales_area;


        try
        {
            $stmt = $this->conn->prepare("INSERT INTO area(id_area,id_sede,nombre_area) 
                                          VALUES(:id_area,:id_sede,:nombre_area)");
                                                  
            $stmt->bindparam(":id_area", $id_area);
            $stmt->bindparam(":id_sede", $id_sede);
            $stmt->bindparam(":nombre_area", $nombre_area);                                  
                
            $stmt->execute();   
            
            return $stmt;   
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }               
    }

    /**
     * [Read_asignaturas description]
     */
    public function Read_asignaturas()
    {
        $query = $this->conn->prepare("SELECT * FROM asignatura A inner join docente D inner join area AR inner join sede S ON A.id_docente = D.id_docente AND A.id_area = AR.id_area AND AR.id_sede = S.id_sede");
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    /**
     * [register_asignaturas description]
     * @param  [type] $id_area     [description]
     * @param  [type] $nombre_area [description]
     * @return [type]              [description]
     */
    public function register_asignaturas($id_docente,$id_area,$nombre_asignatura)
    {

        $id_asignatura=$id_area;

        $iniciales_asignatura = $this->iniciales($nombre_asignatura);

        $id_asignatura.="-".$iniciales_asignatura;


        try
        {
            $stmt = $this->conn->prepare("INSERT INTO asignatura(id_asignatura,id_docente,id_area,nombre_asignatura) 
                                          VALUES(:id_asignatura,:id_docente,:id_area,:nombre_asignatura)");
                                                  
            $stmt->bindparam(":id_asignatura", $id_asignatura);
            $stmt->bindparam(":id_docente", $id_docente);
            $stmt->bindparam(":id_area", $id_area);
            $stmt->bindparam(":nombre_asignatura", $nombre_asignatura);                                 
                
            $stmt->execute();   
            
            return $stmt;   
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }               
    }

    /**
     * [Read_asignaturas description]
     */
    public function Read_grados()
    {
        $query = $this->conn->prepare("SELECT * FROM grado G inner join sede S ON G.id_sede = S.id_sede");
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    /**
     * Listar Grados por SEDE
     */
    public function Read_grados_sede($id_sede)
    {
        $query = $this->conn->prepare('SELECT * FROM grado WHERE id_sede = :id_sede');
        $query->bindParam(":id_sede",$id_sede);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    /**
     * [register_asignaturas description]
     * @param  [type] $id_area     [description]
     * @param  [type] $nombre_area [description]
     * @return [type]              [description]
     */
    public function register_grados($id_sede,$descripcion_grado)
    {
        $anios = $this->Read_anio_lectivo();

        foreach ($anios as $anio) 
        {
            $id_grado = $anio['id_anio_lectivo'];
        }
        $id_grado.=$id_sede;
        $id_grado.=$descripcion_grado;

        try
        {
            $stmt = $this->conn->prepare("INSERT INTO grado(id_grado,id_sede,descripcion_grado) 
                                          VALUES(:id_grado,:id_sede,:descripcion_grado)");
                                                  
            $stmt->bindparam(":id_grado", $id_grado);
            $stmt->bindparam(":id_sede", $id_sede);
            $stmt->bindparam(":descripcion_grado", $descripcion_grado);                                 
                
            $stmt->execute();   
            
            return $stmt;   
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }               
    }

    /**
     * [Read_asignaturas description]
     */
    public function Read_grupos()
    {
        $query = $this->conn->prepare("SELECT * FROM grupo GP inner join grado GD inner join docente D inner join sede S ON GP.id_grado = GD.id_grado AND GP.id_docente = D.id_docente AND GD.id_sede = S.id_sede");
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }


    /**
     * [register_asignaturas description]
     * @param  [type] $id_area     [description]
     * @param  [type] $nombre_area [description]
     * @return [type]              [description]
     */
    public function register_grupos($id_grado,$id_docente,$descripcion_grupo)
    {
        $id_grupo=$id_grado;
        $id_grupo.="-".$descripcion_grupo;

        try
        {
            $stmt = $this->conn->prepare("INSERT INTO grupo(id_grupo,id_grado,id_docente,descripcion_grupo) 
                                          VALUES(?,?,?,?)");
                                                  
            $stmt->bindparam(1, $id_grupo);
            $stmt->bindparam(2, $id_grado);
            $stmt->bindparam(3, $id_docente);
            $stmt->bindparam(4, $descripcion_grupo);                                 
                
            $stmt->execute();   
            
            return $stmt;   
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }               
    }


    /**
     * Listar Anio_lectivo
     */
    public function Read_anio_lectivo()
    {
        //$query = $this->conn->prepare("SELECT * FROM anio_lectivo");
        
        $query = $this->conn->prepare('SELECT * FROM anio_lectivo AL inner join sede S ON AL.id_sede = S.id_sede');
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }


    /**
     * [register_anio_periodos description]
 
     */
    public function register_anio_periodos($id_anio_lectivo, $descripcion_anio_lectivo, $fecha_inicio, $fecha_fin, $fecha_inicio_primer, $fecha_fin_primer, $fecha_inicio_segundo, $fecha_fin_segundor, $fecha_inicio_tercer, $fecha_fin_tercer, $fecha_inicio_cuarto, $fecha_fin_cuarto, $id_sede)
    {
        $id_anio_lectivo.=$id_sede;
        
        $id_periodo1 = $id_anio_lectivo;
        $id_periodo2 = $id_anio_lectivo;
        $id_periodo3 = $id_anio_lectivo;
        $id_periodo4 = $id_anio_lectivo;

        $id_periodo1.="P1";
        $id_periodo2.="P2";
        $id_periodo3.="P3";
        $id_periodo4.="P4";

        $desc_periodo1 = "Primer Periodo Año ".$id_anio_lectivo;
        $desc_periodo2 = "Segundo Periodo Año ".$id_anio_lectivo;
        $desc_periodo3 = "Tercer Periodo Año ".$id_anio_lectivo;
        $desc_periodo4 = "Cuarto Periodo Año ".$id_anio_lectivo;

        try
        {
        //---- Ingresar en la base de datos Año lectivo
            $stmt_anio = $this->conn->prepare("INSERT INTO anio_lectivo(id_anio_lectivo, id_sede, descripcion_anio_lectivo, fecha_inicio, fecha_fin) 
                                          VALUES(?, ?, ?, ?, ?)");
                
        /** Insertar datos Año lectivo */                               
            $stmt_anio->bindparam(1, $id_anio_lectivo);
            $stmt_anio->bindparam(2, $id_sede);
            $stmt_anio->bindparam(3, $descripcion_anio_lectivo);
            $stmt_anio->bindparam(4, $fecha_inicio);
            $stmt_anio->bindparam(5, $fecha_fin);

            $stmt_anio->execute();


        //---- Ingresar en la base de datos Periodo 1
            $stmt_periodo = $this->conn->prepare("INSERT INTO periodo(id_periodo, id_anio_lectivo, desc_periodo, fecha_inicio, fecha_fin) 
                                          VALUES(?, ?, ?, ?, ?)");
                
        /** Insertar datos primer periodo */                               
            $stmt_periodo->bindparam(1, $id_periodo1);
            $stmt_periodo->bindparam(2, $id_anio_lectivo);
            $stmt_periodo->bindparam(3, $desc_periodo1);
            $stmt_periodo->bindparam(4, $fecha_inicio_primer);
            $stmt_periodo->bindparam(5, $fecha_fin_primer);

            $stmt_periodo->execute();

        /* Insertar datos segundo periodo */
            $stmt_periodo->bindparam(1, $id_periodo2);
            $stmt_periodo->bindparam(2, $id_anio_lectivo);
            $stmt_periodo->bindparam(3, $desc_periodo2);
            $stmt_periodo->bindparam(4, $fecha_inicio_segundo);
            $stmt_periodo->bindparam(5, $fecha_fin_segundo);

            $stmt_periodo->execute();

        /* Insertar datos tercero periodo */
            $stmt_periodo->bindparam(1, $id_periodo3);
            $stmt_periodo->bindparam(2, $id_anio_lectivo);
            $stmt_periodo->bindparam(3, $desc_periodo3);
            $stmt_periodo->bindparam(4, $fecha_inicio_tercer);
            $stmt_periodo->bindparam(5, $fecha_fin_tercer);

            $stmt_periodo->execute();

        /* Insertar datos cuarto periodo */
            $stmt_periodo->bindparam(1, $id_periodo4);
            $stmt_periodo->bindparam(2, $id_anio_lectivo);
            $stmt_periodo->bindparam(3, $desc_periodo4);
            $stmt_periodo->bindparam(4, $fecha_inicio_cuarto);
            $stmt_periodo->bindparam(5, $fecha_fin_cuarto);

            $stmt_periodo->execute();

            
            return "true";   
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }               
    }

    /**
     * [new_pass_docente_admin description]
     * @param  [type] $u_id     [description]
     * @param  [type] $old_pass [description]
     * @param  [type] $new_pass [description]
     * @return [type]           [description]
     */
    public function new_pass_docente_admin($u_id)
    {
        $new_password = password_hash($u_id, PASSWORD_DEFAULT);
        $res_change;

        try
        {
            $stmt = $this->conn->prepare("SELECT id_docente, pass FROM docente WHERE id_docente=:u_id");
            $stmt->execute(array(':u_id'=>$u_id));
            $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
            if($stmt->rowCount() == 1)
            {
                $stmt=$this->conn->prepare("UPDATE docente SET pass=:new_password WHERE id_docente=:u_id");

                $stmt->bindparam(":new_password",$new_password);
                $stmt->bindparam(":u_id",$u_id);
                $stmt->execute();

                $res_change= true;
            }

            return $res_change;          
        }

        catch(PDOException $e)
        {
            echo $e->getMessage();
            return false;
        }
    }

    
    /* -------------F U N C I O N E S  D O C E N T E ----------*/
     
    /**
     * Leer lista de doncente desde Base de Datos
     */
    public function Read_docente()
    {
        //$query = $this->conn->prepare("SELECT * FROM docente");
        
        $query = $this->conn->prepare('SELECT * FROM docente D inner join sede S ON D.id_sede = S.id_sede inner join tipo_usuario TU ON D.id_tipo_usuario = TU.id_tipo_usuario WHERE D.id_tipo_usuario = "3"');
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

    /**
     * [cambiar_pass_docente description]
     * @param  [type] $u_id     [description]
     * @param  [type] $old_pass [description]
     * @param  [type] $new_pass [description]
     * @return [type]           [description]
     */
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

    /**
     * Leer lista de doncente desde Base de Datos
     */
    public function Read_director_grupo($id_docente)
    {        
        $query = $this->conn->prepare('SELECT * FROM alumno A inner join nota N inner join periodo P inner Join  ON D.id_sede = S.id_sede AND D.id_tipo_usuario = TU.id_tipo_usuario');
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    /**
     * Leer lista de doncente desde Base de Datos segun sede ($id_sede)
     */
    public function Read_docente_sede($id_sede)
    {
        $query = $this->conn->prepare('SELECT * FROM docente WHERE id_sede = :id_sede AND id_tipo_usuario = "3"');
        $query->bindParam(":id_sede",$id_sede);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    /**
     * [Read_alumnos_grupo description]
     * @param [type] $id_docente [description]
     */
    public function Read_alumnos_grupo($id_docente)
    {
        $query = $this->conn->prepare('SELECT * FROM alumno AL inner join grupo GR inner join grado GRA inner join sede S ON AL.id_grupo = GR.id_grupo AND GR.id_grado = GRA.id_grado AND s.id_sede = GRA.id_sede WHERE GR.id_docente = :id_docente ORDER BY AL.primer_apellido ');
        $query->bindParam(":id_docente",$id_docente);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }


    /**
     * [Read_alumnos_grupo description]
     * @param [type] $id_docente [description]
     */
    public function Read_cabecera_grupo($id_docente)
    {
        $query = $this->conn->prepare('SELECT * FROM grupo GRU  inner join asignatura ASI  ON ASI.id_grupo = GRU.id_grupo WHERE ASI.id_docente = :id_docente ');
        $query->bindParam(":id_docente",$id_docente);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    /**
     * [Read_notas description]
     * @param [type] $id_asignatura [description]
     * @param [type] $id_alumno     [description]
     */
    public function Read_notas($id_asignatura, $id_alumno)
    {
        $query = $this->conn->prepare('SELECT * FROM nota WHERE id_asignatura = :id_asignatura AND id_alumno = :id_alumno');
        $query->bindParam(":id_asignatura",$id_asignatura);
        $query->bindParam(":id_alumno",$id_alumno);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    /**
     * [Read_faltas description]
     * @param [type] $id_asignatura [description]
     * @param [type] $id_alumno     [description]
     */
    public function Read_faltas($id_asignatura, $id_alumno)
    {
        $query = $this->conn->prepare('SELECT * FROM asistencia WHERE id_asignatura = :id_asignatura AND id_alumno = :id_alumno');
        $query->bindParam(":id_asignatura",$id_asignatura);
        $query->bindParam(":id_alumno",$id_alumno);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

/* -------------F U N C I O N E S  A L U M N O ----------*/
    
    /**
     * [Read_alumno description]
     */
    public function Read_alumno()
    {        
        $query = $this->conn->prepare('SELECT * FROM alumno AL inner join sede S inner join grupo G inner join grado GR ON AL.id_sede = S.id_sede AND AL.id_grupo = G.id_grupo AND G.id_grado = GR.id_grado');
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    
    /**
     * [Read_alumno_sede description]
     * @param [type] $id_sede [description]
     */
    public function Read_alumno_sede($id_sede)
    {        
        $query = $this->conn->prepare('SELECT * FROM alumno AL inner join sede S ON AL.id_sede = S.id_sede WHERE AL.id_sede = :id_sede');
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }


    /**
     * [Read_periodo description]
     */
    public function Read_periodo()
    {
        //$query = $this->conn->prepare("SELECT * FROM alumno");4
        
        $query = $this->conn->prepare('SELECT * FROM periodo P inner join anio_lectivo AL ON P.id_anio_lectivo = Al.id_anio_lectivo');
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    /**
     * [Read_grupos_sede description]
     * @param [type] $id_sede [description]
     */
    public function Read_grupos_sede($id_sede)
    {
        
        $query = $this->conn->prepare('SELECT * FROM grado G inner join docente D inner join sede S ON G.id_docente = D.id_docente AND G.id_sede = S.id_sede  WHERE G.id_sede = :id_sede');
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }


    /**
     * [register_alumno description]
     * @param  [type] $id_alumno           [description]
     * @param  [type] $id_sede             [description]
     * @param  [type] $id_grado            [description]
     * @param  [type] $nombres             [description]
     * @param  [type] $primer_apellido     [description]
     * @param  [type] $segundo_apellido    [description]
     * @param  [type] $desplazado          [description]
     * @param  [type] $repitente           [description]
     * @param  [type] $nombre_acudiente    [description]
     * @param  [type] $apellidos_acudiente [description]
     * @param  [type] $telefono_acudiente  [description]
     * @param  [type] $fecha_matricula     [description]
     * @return [type]                      [description]
     */
    public function register_alumno($id_alumno,$id_sede,$id_grupo,$nombres,$primer_apellido,$segundo_apellido,$desplazado,$repitente,$nombre_acudiente,$apellidos_acudiente,$telefono_acudiente,$fecha_matricula)
    {
        try
        {
            $stmt = $this->conn->prepare("INSERT INTO alumno(id_alumno,id_sede,id_grupo,nombres,primer_apellido,segundo_apellido,desplazado,repitente,nombre_acudiente,apellidos_acudiente,telefono_acudiente,fecha_matricula) 
                                          VALUES(:id_alumno,:id_sede,:id_grupo,:nombres,:primer_apellido,:segundo_apellido,:desplazado,:repitente,:nombre_acudiente,:apellidos_acudiente,:telefono_acudiente,:fecha_matricula)");
                                                  
            $stmt->bindparam(":id_alumno", $id_alumno);
            $stmt->bindparam(":id_sede", $id_sede);
            $stmt->bindparam(":id_grupo", $id_grupo);
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


/**----------------------------------------------------------------**/

    /**
     * Loguear al usuario
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