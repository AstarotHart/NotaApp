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
        $query = $this->conn->prepare("SELECT * FROM asignatura A inner join docente D inner join area AR ON A.id_docente = D.id_docente AND A.id_area = AR.id_area");
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
        $query = $this->conn->prepare("SELECT * FROM grupo GP inner join grado GD inner join docente D ON GP.id_grado = GD.id_grado AND GP.id_docente = D.id_docente");
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
            $stmt = $this->conn->prepare("INSERT INTO grupo(id_grupo,id_docente,id_grado,descripcion_grupo) 
                                          VALUES(:id_grupo,:id_docente,:id_grado,:descripcion_grupo)");
                                                  
            $stmt->bindparam(":id_grupo", $id_grupo);
            $stmt->bindparam(":id_docente", $id_docente);
            $stmt->bindparam(":id_grado", $id_grado);
            $stmt->bindparam(":descripcion_grupo", $descripcion_grupo);                                 
                
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
    public function register_anio_periodos($id_anio_lectivo, $descripcion_anio_lectivo, $fecha_inicio_anio_lectivo, $fecha_fin_anio_lectivo, $fecha_inicio_primer, $fecha_fin_primer, $fecha_inicio_segundo, $fecha_fin_segundor, $fecha_inicio_tercer, $fecha_fin_tercer, $fecha_inicio_cuarto, $fecha_fin_cuarto)
    {
        $id_perdiodo1 = $id_anio_lectivo."-1";
        $id_perdiodo2 = $id_anio_lectivo."-2";
        $id_perdiodo3 = $id_anio_lectivo."-3";
        $id_perdiodo4 = $id_anio_lectivo."-4";

        $desc_periodo1 = "Primer Periodo Año ".$id_anio_lectivo;
        $desc_periodo2 = "Primer Segundo Año ".$id_anio_lectivo;
        $desc_periodo3 = "Primer Tercer Año ".$id_anio_lectivo;
        $desc_periodo4 = "Primer Cuarto Año ".$id_anio_lectivo;

        try
        {
        //---- Ingresar en la base de datos Año lectivo
            $stmt_anio = $this->conn->prepare("INSERT INTO anio_lectivo(id_anio_lectivo, id_sede, descripcion_anio_lectivo, fecha_inicio_anio_lectivo, fecha_fin_anio_lectivo) 
                                          VALUES(:id_anio_lectivo, :id_sede, :descripcion_anio_lectivo, :fecha_inicio_anio_lectivo, :fecha_fin_anio_lectivo)");
                                                  
            $stmt_anio->bindparam(":id_anio_lectivo", $id_anio_lectivo);
            $stmt_anio->bindparam(":id_sede", $id_sede);
            $stmt_anio->bindparam(":descripcion_anio_lectivo", $descripcion_anio_lectivo);
            $stmt_anio->bindparam(":fecha_inicio_anio_lectivo", $fecha_inicio_anio_lectivo);
            $stmt_anio->bindparam(":fecha_fin_anio_lectivo", $fecha_fin_anio_lectivo);

        //---- Ingresar en la base de datos Periodo 1
            $stmt_periodo1 = $this->conn->prepare("INSERT INTO periodo(id_perdiodo1, id_anio_lectivo, desc_periodo1, fecha_inicio_primer, fecha_fin_primer) 
                                          VALUES(:id_perdiodo1, :id_anio_lectivo, :desc_periodo1, :fecha_inicio_primer, :fecha_fin_primer)");
                                                  
            $stmt_periodo1->bindparam(":id_perdiodo1", $id_perdiodo1);
            $stmt_periodo1->bindparam(":id_anio_lectivo", $id_anio_lectivo);
            $stmt_periodo1->bindparam(":desc_periodo1", $desc_periodo1);
            $stmt_periodo1->bindparam(":fecha_inicio_primer", $fecha_inicio_primer);
            $stmt_periodo1->bindparam(":fecha_fin_primer", $fecha_fin_primer);


        //---- Ingresar en la base de datos Periodo 2
            $stmt_periodo2 = $this->conn->prepare("INSERT INTO periodo(id_perdiodo2, id_anio_lectivo, desc_periodo2, fecha_inicio_segundo, fecha_fin_segundo) 
                                          VALUES(:id_perdiodo2, :id_anio_lectivo, :desc_periodo2, :fecha_inicio_segundo, :fecha_fin_segundo)");
                                                  
            $stmt_periodo2->bindparam(":id_perdiodo2", $id_perdiodo2);
            $stmt_periodo2->bindparam(":id_anio_lectivo", $id_anio_lectivo);
            $stmt_periodo2->bindparam(":desc_periodo2", $desc_periodo2);
            $stmt_periodo2->bindparam(":fecha_inicio_segundo", $fecha_inicio_segundo);
            $stmt_periodo2->bindparam(":fecha_fin_segundo", $fecha_fin_segundo);


        //---- Ingresar en la base de datos Periodo 3
            $stmt_periodo3 = $this->conn->prepare("INSERT INTO periodo(id_perdiodo3, id_anio_lectivo, desc_periodo3, fecha_inicio_tercer, fecha_fin_tercer) 
                                          VALUES(:id_perdiodo3, :id_anio_lectivo, :desc_periodo3, :fecha_inicio_tercer, :fecha_fin_tercer)");
                                                  
            $stmt_periodo3->bindparam(":id_perdiodo3", $id_perdiodo3);
            $stmt_periodo3->bindparam(":id_anio_lectivo", $id_anio_lectivo);
            $stmt_periodo3->bindparam(":desc_periodo3", $desc_periodo3);
            $stmt_periodo3->bindparam(":fecha_inicio_tercer", $fecha_inicio_tercer);
            $stmt_periodo3->bindparam(":fecha_fin_tercer", $fecha_fin_tercer);


        //---- Ingresar en la base de datos Periodo 4
            $stmt_periodo4 = $this->conn->prepare("INSERT INTO periodo(id_perdiodo4, id_anio_lectivo, desc_periodo4, fecha_inicio_cuarto, fecha_fin_cuarto) 
                                          VALUES(:id_perdiodo4, :id_anio_lectivo, :desc_periodo4, :fecha_inicio_cuarto, :fecha_fin_cuarto)");
                                                  
            $stmt_periodo4->bindparam(":id_perdiodo4", $id_perdiodo4);
            $stmt_periodo4->bindparam(":id_anio_lectivo", $id_anio_lectivo);
            $stmt_periodo4->bindparam(":desc_periodo4", $desc_periodo4);
            $stmt_periodo4->bindparam(":fecha_inicio_cuarto", $fecha_inicio_cuarto);
            $stmt_periodo4->bindparam(":fecha_fin_cuarto", $fecha_fin_cuarto);
            




            $stmt_anio->execute();
            $stmt_periodo1->execute();
            $stmt_periodo2->execute();
            $stmt_periodo3->execute();
            $stmt_periodo4->execute(); 
            
            return $stmt;   
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
        
        $query = $this->conn->prepare('SELECT * FROM docente D inner join sede S inner join tipo_usuario TU ON D.id_sede = S.id_sede AND D.id_tipo_usuario = TU.id_tipo_usuario WHERE D.id_tipo_usuario = "3"');
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

/* -------------F U N C I O N E S  A L U M N O ----------*/
     
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