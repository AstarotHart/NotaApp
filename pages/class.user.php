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
     * [iniciales_asignaturas description]
     * @param  [type] $nombre [description]
     * @return [type]         [description]
     */
    public function iniciales_asignaturas($nombre)
    {
        $nombre = ucwords($nombre);

        $notocar = array('del', 'de');
        $trozos = explode(' ', $nombre);
        $iniciales = '';

        for ($i=0; $i < count($trozos) ; $i++) 
        { 
            if (in_array($trozos[$i], $notocar))$iniciales .= $trozos." ";
<<<<<<< HEAD
            else $iniciales .= substr($trozos[$i], 0,2);
=======
            else $iniciales .= substr($trozos[$i], 0,3);
>>>>>>> origin/Laptop
            $iniciales.=".";
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
     * Combobox para cargar AñO LESCTIVO
     */
    public function combobox_id_anio_lectivo()
    {
        $query = $this->conn->prepare("SELECT id_anio_lectivo,descripcion_anio_lectivo FROM anio_lectivo");
        $query->execute();
        
        while($row=$query->fetch(PDO::FETCH_ASSOC))
        {
            echo '<option value="'.$row['id_anio_lectivo'].'">'.$row['descripcion_anio_lectivo'].'</option>'; 
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
     * [combobox_logros description]
     * @param  [type] $id_asignatura [description]
     * @return [type]                [description]
     */
    public function combobox_logros($id_asignatura)
    {
        $res = "";
        $cont =1;

        $query = $this->conn->prepare("SELECT id_logro,descripcion FROM logros WHERE id_asignatura = :id_asignatura");
        $query->bindParam(":id_asignatura", $id_asignatura);
        $query->execute();
        
        while($row=$query->fetch(PDO::FETCH_ASSOC))
        {
            //$res .= '<option value="'.$row['id_logro'].'">'.$row['id_logro'].'</option>'; 
            $res .= '<option value="'.$row['id_logro'].'">'.$cont.'</option>'; 
            $cont++;
        }

        return $res;
    }

    /**
     * [combobox_grupos_docente description]
     * @return [type] [description]
     */
    public function combobox_grupos_docente($id_docente)
    {
        $query = $this->conn->prepare("SELECT * FROM asig_docente_asignatura ADA inner join asignatura ASI inner join grupo GR inner join grado GRA ON ASI.id_asignatura =ADA.id_asignatura AND ADA.id_grupo = GR.id_grupo AND GRA.id_grado = GR.id_grado WHERE ADA.id_docente = :id_docente");
        $query->bindParam(":id_docente", $id_docente); 
        $query->execute();
        
        while($row=$query->fetch(PDO::FETCH_ASSOC))
        {
            echo '<option value="'.$row['id_asignatura'].'">'.$row['nombre_asignatura'].' '.$row['descripcion_grado'].'-'.$row['descripcion_grupo'].'</option>'; 
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
        $query = $this->conn->prepare("SELECT * FROM area A inner join grado G ON A.id_sede = G.id_sede");
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
    public function register_area($id_sede,$nombre_area,$id_grado)
    {
        $anios = $this->Read_anio_lectivo_sede($id_sede);

        foreach ($anios as $anio) 
        {
            $id_area = $anio['id_anio_lectivo'];
        }

        $iniciales_area = $this->iniciales($nombre_area);

        $id_area.=$iniciales_area;

        $nom_grado = $this->Read_grados_sede($id_sede);

        foreach ($nom_grado as $nom_grado) 
        {
            $id_area .= $nom_grado['descripcion_grado'];
        }


        try
        {
            $stmt = $this->conn->prepare("INSERT INTO area(id_area,id_sede,id_grado,nombre_area) 
                                          VALUES(:id_area,:id_sede,:id_grado,:nombre_area)");
                                                  
            $stmt->bindparam(":id_area", $id_area);
            $stmt->bindparam(":id_sede", $id_sede);
            $stmt->bindparam(":id_grado", $id_grado);
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
        $query = $this->conn->prepare("SELECT * FROM asignatura A inner join asig_docente_asignatura ASI_D inner join area AR inner join sede S inner join docente D ON A.id_asignatura = ASI_D.id_asignatura AND A.id_area = AR.id_area AND AR.id_sede = S.id_sede AND ASI_D.id_docente = D.id_docente");
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    /**
     * [asignar_docente_asignatura description]
     * @param  [type] $id_docente      [description]
     * @param  [type] $id_asignatura   [description]
     * @param  [type] $id_anio_lectivo [description]
     * @return [type]                  [description]
     */
    public function asignar_docente_asignatura($id_docente,$id_asignatura,$id_anio_lectivo)
    {
        try
        {
            $stmt = $this->conn->prepare("INSERT INTO asig_docente_asignatura(id_docente,id_asignatura,id_anio_lectivo) 
                                          VALUES(:id_docente,:id_asignatura,:id_anio_lectivo)");
                                                  
            $stmt->bindparam(":id_docente", $id_docente);
            $stmt->bindparam(":id_asignatura", $id_asignatura);
            $stmt->bindparam(":id_anio_lectivo", $id_anio_lectivo);                                 
                
            $stmt->execute();   
            
            return $stmt;   
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }               
    }

    /**
     * [register_asignaturas description]
     * @param  [type] $id_area     [description]
     * @param  [type] $nombre_area [description]
     * @return [type]              [description]
     */
    public function register_asignaturas($id_docente,$id_area,$nombre_asignatura,$intensidad_horaria,$porcentaje,$id_grupo,$id_anio_lectivo)
    {

        $id_asignatura=$id_area;

        $iniciales_asignatura = $this->iniciales($nombre_asignatura);
        $asignar_doc_asig = $this->asignar_docente_asignatura($id_docente,$id_asignatura,$id_anio_lectivo);

        $id_asignatura.="-".$iniciales_asignatura;

        $num_grado = $this->Read_grupos_id($id_grupo);

        foreach ($num_grado as $num_grado) 
        {
            $id_asignatura.= $num_grado['descripcion_grupo'];
        }


        try
        {
            $stmt = $this->conn->prepare("INSERT INTO asignatura(id_asignatura,id_area,id_docente,id_grupo,nombre_asignatura,intensidad_horaria,porcentaje) 
                                          VALUES(:id_asignatura,:id_area,:id_docente,:id_grupo,:nombre_asignatura,:intensidad_horaria,:porcentaje)");
                                                  
            $stmt->bindparam(":id_asignatura", $id_asignatura);
            $stmt->bindparam(":id_grupo", $id_grupo);
            $stmt->bindparam(":id_area", $id_area);
            $stmt->bindparam(":id_docente", $id_docente);
            $stmt->bindparam(":nombre_asignatura", $nombre_asignatura);
            $stmt->bindparam(":intensidad_horaria", $intensidad_horaria);
            $stmt->bindparam(":porcentaje", $porcentaje);                                 
                
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
        $query = $this->conn->prepare('SELECT * FROM grado G inner join sede S ON G.id_sede = S.id_sede WHERE G.id_sede = :id_sede');
        $query->bindParam(":id_sede",$id_sede);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    /**
     * [Read_grupos_id description]
     */
    public function Read_grupos_id($id_grupo)
    {
        $query = $this->conn->prepare("SELECT * FROM grupo WHERE id_grupo = :id_grupo");
        $query->bindparam(":id_grupo",$id_grupo);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
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
     * [Read_grupos_sede description]
     * @param [type] $id_sede [description]
     */
    public function Read_grupos_sede($id_sede)
    {
        $query = $this->conn->prepare('SELECT * FROM grupo GRU inner join grado GRA ON GRA.id_grado = GRU.id_grado WHERE GRA.id_sede = :id_sede');
        $query->bindparam(":id_sede",$id_sede);
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
    public function Read_grupo_alumno($id_alumno)
    {
        $query = $this->conn->prepare('SELECT * FROM grupo GRU inner join grado GRA ON GRA.id_grado = GRU.id_grado WHERE GRA.id_sede = :id_alumno');
        $query->bindparam(":id_alumno",$id_alumno);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    /**
     * [register_grados description]
     * @param  [type] $id_sede           [description]
     * @param  [type] $descripcion_grado [description]
     * @return [type]                    [description]
     */
    public function register_grados($id_sede,$descripcion_grado)
    {
        $anios = $this->Read_anio_lectivo_sede($id_sede);

        foreach ($anios as $anio) 
        {
            $id_grado = $anio['id_anio_lectivo'];
        }
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
     * [register_grupos description]
     * @param  [type] $id_grado          [description]
     * @param  [type] $id_docente        [description]
     * @param  [type] $descripcion_grupo [description]
     * @param  [type] $id_sede           [description]
     * @return [type]                    [description]
     */
    public function register_grupos($id_grado,$id_docente,$descripcion_grupo,$id_sede)
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
     * [Read_anio_lectivo description]
     */
    public function Read_anio_lectivo()
    {        
        $query = $this->conn->prepare('SELECT * FROM anio_lectivo');
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }


    /**
     * Listar Anio_lectivo
     */
    public function Read_anio_lectivo_sede($id_sede)
    {
        //$query = $this->conn->prepare("SELECT * FROM anio_lectivo");
        
        $query = $this->conn->prepare('SELECT * FROM anio_lectivo AL inner join sede S ON AL.id_sede = S.id_sede WHERE AL.id_sede = :id_sede');
        $query->bindparam(":id_sede",$id_sede);
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
    public function Read_alumnos_grupo($id_docente,$id_asignatura)
    {
        $query = $this->conn->prepare('SELECT AL.id_alumno,AL.nombres,AL.primer_apellido,AL.segundo_apellido FROM asig_alumno_grupo AAG inner join alumno AL inner join asig_docente_asignatura ADA ON AAG.id_alumno = AL.id_alumno AND ADA.id_grupo = AAG.id_grupo WHERE ADA.id_docente = :id_docente AND ADA.id_asignatura = :id_asignatura ORDER BY AL.primer_apellido ');
        $query->bindParam(":id_docente",$id_docente);
        $query->bindParam(":id_asignatura",$id_asignatura);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    /**
     * [Read_alumnos_dir_grupo description]
     * @param [type] $id_grupo [description]
     */
    public function Read_alumnos_dir_grupo($id_grupo)
    {
<<<<<<< HEAD
        $query = $this->conn->prepare('SELECT AL.id_alumno,AL.nombres,AL.primer_apellido,AL.segundo_apellido FROM asig_alumno_grupo AAG inner join alumno AL ON AAG.id_alumno = AL.id_alumno WHERE AAG.id_grupo = :id_grupo ORDER BY AL.primer_apellido ');
        $query->bindParam(":id_grupo",$id_grupo);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    /**
     * [Read_alumnos_asig_grupo description]
     * @param [type] $id_grupo [description]
     */
    public function Read_alumnos_asig_grupo($id_grupo)
    {
        $query = $this->conn->prepare('SELECT AL.id_alumno,AL.nombres,AL.primer_apellido,AL.segundo_apellido FROM asig_alumno_grupo AAG inner join alumno AL ON AAG.id_alumno = AL.id_alumno WHERE AAG.id_grupo ORDER BY AL.primer_apellido ');
=======
        $query = $this->conn->prepare('SELECT * FROM alumno WHERE id_grup = :id_grupo ORDER BY primer_apellido ');
>>>>>>> origin/Laptop
        $query->bindParam(":id_grupo",$id_grupo);
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
    public function Read_cabecera_grupo($id_docente,$id_asignatura)
    {
        $query = $this->conn->prepare('SELECT * FROM asig_docente_asignatura ADA inner join asignatura ASI inner join grupo GR inner join grado GRA inner join area ARE ON ASI.id_asignatura =ADA.id_asignatura AND ADA.id_grupo = GR.id_grupo AND GRA.id_grado = GR.id_grado AND ARE.id_area = ASI.id_area WHERE ADA.id_docente = :id_docente AND ASI.id_asignatura = :id_asignatura');
        $query->bindParam(":id_docente",$id_docente);
        $query->bindParam(":id_asignatura",$id_asignatura);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    /**
     * [Read_cabecera_asig_grupo description]
     * @param [type] $id_grupo [description]
     * @param [type] $id_sede  [description]
     */
    public function Read_cabecera_asig_grupo($id_grupo,$id_sede)
    {
        $query = $this->conn->prepare('SELECT * FROM grupo GRU inner join Grado GRA  inner join asig_alumno_grupo AAG ON
        AAG.id_grupo = GRU.id_grupo AND GRU.id_grado = GRA.id_grado WHERE GRU.id_grupo = :id_grupo AND GRA.id_sede = :id_sede');
        $query->bindParam(":id_grupo",$id_grupo);
        $query->bindParam(":id_sede",$id_sede);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }


    /**
     * [Read_fecha_periodos description]
     * @param [type] $id_anio_lectivo [description]
     */
    public function Read_fecha_periodos($id_anio_lectivo)
    {
        $query = $this->conn->prepare('SELECT * FROM periodo WHERE id_anio_lectivo = :id_anio_lectivo');
        $query->bindParam(":id_anio_lectivo",$id_anio_lectivo);
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


    /**
     * [update_nota description]
     * @param  [type] $id_alumno [description]
     * @param  [type] $name_nota [description]
     * @param  [type] $nota      [description]
     * @param  [type] $materia   [description]
     * @param  [type] $anio      [description]
     * @return [type]            [description]
     */
    public function update_nota($id_alumno,$name_nota,$nota,$materia,$anio)
    {
        try
        {

            $stmt1 = $this->conn->prepare("SELECT id_alumno FROM nota WHERE id_alumno=:id_alumno");
            $stmt1->execute(array(':id_alumno'=>$id_alumno));
            $userRow=$stmt1->fetch(PDO::FETCH_ASSOC);

            if($stmt1->rowCount() == 1)
            {
                if ($name_nota == "nota1") 
                {
                    $stmt=$this->conn->prepare("UPDATE nota SET nota1=:nota WHERE id_alumno=:id_alumno AND id_asignatura=:materia");
                }
                elseif ($name_nota == "nota2") 
                {
                    $stmt=$this->conn->prepare("UPDATE nota SET nota2=:nota WHERE id_alumno=:id_alumno AND id_asignatura=:materia");
                }
                elseif ($name_nota == "nota3") 
                {
                    $stmt=$this->conn->prepare("UPDATE nota SET nota3=:nota WHERE id_alumno=:id_alumno AND id_asignatura=:materia");
                }
                elseif ($name_nota == "nota4") 
                {
                    $stmt=$this->conn->prepare("UPDATE nota SET nota4=:nota WHERE id_alumno=:id_alumno AND id_asignatura=:materia");
                }

                $stmt->bindparam(":nota",$nota);
                $stmt->bindparam(":id_alumno",$id_alumno);
                $stmt->bindparam(":materia",$materia);

                $stmt->execute();

            }else
            {                                                  
                if ($name_nota == "nota1") 
                {
                    $stmt2 = $this->conn->prepare("INSERT INTO nota(id_alumno,id_anio_lectivo,id_asignatura,nota1) 
                                          VALUES(:id_alumno,:anio,:materia,:nota)");
                }
                elseif ($name_nota == "nota2") 
                {
                    $stmt2 = $this->conn->prepare("INSERT INTO nota(id_alumno,id_anio_lectivo,id_asignatura,nota2) 
                                          VALUES(:id_alumno,:anio,:materia,:nota)");
                }
                elseif ($name_nota == "nota3") 
                {
                    $stmt2 = $this->conn->prepare("INSERT INTO nota(id_alumno,id_anio_lectivo,id_asignatura,nota3) 
                                          VALUES(:id_alumno,:anio,:materia,:nota)");
                }
                elseif ($name_nota == "nota4") 
                {
                    $stmt2 = $this->conn->prepare("INSERT INTO nota(id_alumno,id_anio_lectivo,id_asignatura,nota4) 
                                          VALUES(:id_alumno,:anio,:materia,:nota)");
                }

                $stmt2->bindparam(":nota",$nota);
                $stmt2->bindparam(":id_alumno",$id_alumno);
                $stmt2->bindparam(":materia",$materia);
                $stmt2->bindparam(":anio",$anio);

                $stmt2->execute();

            }

                return true;            
        }

        catch(PDOException $e)
        {
            echo $e->getMessage();
            return false;
        }
    }

    /**
     * [update_faltas description]
     * @param  [type] $id_alumno  [description]
     * @param  [type] $name_falta [description]
     * @param  [type] $falta      [description]
     * @param  [type] $materia    [description]
     * @param  [type] $anio       [description]
     * @return [type]             [description]
     */
    public function update_faltas($id_alumno,$name_falta,$falta,$materia,$anio)
    {
        try
        {

            $stmt1 = $this->conn->prepare("SELECT id_alumno FROM asistencia WHERE id_alumno=:id_alumno");
            $stmt1->execute(array(':id_alumno'=>$id_alumno));
            $userRow=$stmt1->fetch(PDO::FETCH_ASSOC);

            if($stmt1->rowCount() == 1)
            {
                if ($name_falta == "inasistencia_p1") 
                {
                    $stmt=$this->conn->prepare("UPDATE asistencia SET inasistencia_p1=:falta WHERE id_alumno=:id_alumno AND id_asignatura=:materia");
                }
                elseif ($name_falta == "inasistencia_p2") 
                {
                    $stmt=$this->conn->prepare("UPDATE asistencia SET inasistencia_p2=:falta WHERE id_alumno=:id_alumno AND id_asignatura=:materia");
                }
                elseif ($name_falta == "inasistencia_p3") 
                {
                    $stmt=$this->conn->prepare("UPDATE asistencia SET inasistencia_p3=:falta WHERE id_alumno=:id_alumno AND id_asignatura=:materia");
                }
                elseif ($name_falta == "inasistencia_p4") 
                {
                    $stmt=$this->conn->prepare("UPDATE asistencia SET inasistencia_p4=:falta WHERE id_alumno=:id_alumno AND id_asignatura=:materia");
                }

                $stmt->bindparam(":falta",$falta);
                $stmt->bindparam(":id_alumno",$id_alumno);
                $stmt->bindparam(":materia",$materia);

                $stmt->execute();

            }else
            {                                                  
                if ($name_falta == "inasistencia_p1") 
                {
                    $stmt2 = $this->conn->prepare("INSERT INTO asistencia(id_alumno,id_anio_lectivo,id_asignatura,inasistencia_p1) 
                                          VALUES(:id_alumno,:anio,:materia,:falta)");
                }
                elseif ($name_falta == "inasistencia_p2") 
                {
                    $stmt2 = $this->conn->prepare("INSERT INTO asistencia(id_alumno,id_anio_lectivo,id_asignatura,inasistencia_p2) 
                                          VALUES(:id_alumno,:anio,:materia,:falta)");
                }
                elseif ($name_falta == "nota3") 
                {
                    $stmt2 = $this->conn->prepare("INSERT INTO asistencia(id_alumno,id_anio_lectivo,id_asignatura,inasistencia_p3) 
                                          VALUES(:id_alumno,:anio,:materia,:falta)");
                }
                elseif ($name_falta == "inasistencia_p4") 
                {
                    $stmt2 = $this->conn->prepare("INSERT INTO asistencia(id_alumno,id_anio_lectivo,id_asignatura,inasistencia_p4) 
                                          VALUES(:id_alumno,:anio,:materia,:falta)");
                }

                $stmt2->bindparam(":falta",$falta);
                $stmt2->bindparam(":id_alumno",$id_alumno);
                $stmt2->bindparam(":materia",$materia);
                $stmt2->bindparam(":anio",$anio);

                $stmt2->execute();

            }

            return true;            
        }

        catch(PDOException $e)
        {
            echo $e->getMessage();
            return false;
        }
    }

    /**
     * [read_logros description]
     * @param  [type] $id_asignatura [description]
     * @return [type]                [description]
     */
    public function Read_logros($id_asignatura)
    {
        $query = $this->conn->prepare('SELECT * FROM logros WHERE id_asignatura = :id_asignatura');
        $query->bindParam(":id_asignatura",$id_asignatura);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    /**
     * [Read_logros_alumno description]
     * @param [type] $id_asignatura [description]
     * @param [type] $id_alumno     [description]
     */
    public function Read_logros_alumno($id_asignatura,$id_alumno)
    {
        $query = $this->conn->prepare('SELECT * FROM alumnos_logros AL inner join logros L ON AL.id_asignatura = L.id_asignatura WHERE Al.id_asignatura = :id_asignatura AND Al.id_alumno = :id_alumno');
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
     * [register_logros description]
     * @param  [type] $id_asignatura [description]
     * @param  [type] $logro         [description]
     * @return [type]                [description]
     */
    public function register_logros($id_asignatura,$logro)
    {

        $query = $this->conn->prepare('SELECT* FROM logros WHERE id_asignatura LIKE :id_asignatura');
        $query->bindParam(":id_asignatura",$id_asignatura);
        $query->execute();

        $N_logros = $query->rowCount();

        $N_logros++;

        $id_logro = $id_asignatura.'L-'.$N_logros;


        try
        {
            $stmt = $this->conn->prepare("INSERT INTO logros(id_logro,id_asignatura,descripcion) 
                                          VALUES(:id_logro,:id_asignatura,:logro)");
                                                  
            $stmt->bindparam(":id_logro", $id_logro);
            $stmt->bindparam(":id_asignatura", $id_asignatura);
            $stmt->bindparam(":logro", $logro);                                  
                
            $stmt->execute();   
            
            return $stmt;   
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }               
    }

    /**
     * [     description]
     * @param  [type] $id_asignatura   [description]
     * @param  [type] $id_alumno       [description]
     * @param  [type] $id_anio_lectivo [description]
     * @param  [type] $id_logros       [description]
     * @return [type]                  [description]
     */
    public function register_logros_alumno($id_asignatura,$id_alumno,$id_anio_lectivo,$id_logros)
    {
        $res ="false";

        try
        {
            $stmt1 = $this->conn->prepare("SELECT id_alumno FROM alumnos_logros WHERE id_alumno=:id_alumno AND id_asignatura=:id_asignatura AND id_anio_lectivo=:id_anio_lectivo");

            $stmt1->execute(array(
                                  ':id_alumno'   => $id_alumno,
                                  ':id_asignatura' => $id_asignatura,
                                  ':id_anio_lectivo'   => $id_anio_lectivo 
                                    ));


            $userRow=$stmt1->fetch(PDO::FETCH_ASSOC);

            if($stmt1->rowCount() == 1)
            {

                $stmt=$this->conn->prepare("UPDATE alumnos_logros SET id_logros = :id_logros WHERE id_alumno=:id_alumno AND id_asignatura=:id_asignatura AND id_anio_lectivo=:id_anio_lectivo");

                $stmt->bindparam(":id_asignatura", $id_asignatura);
                $stmt->bindparam(":id_anio_lectivo", $id_anio_lectivo);
                $stmt->bindparam(":id_alumno", $id_alumno);
                $stmt->bindparam(":id_logros", $id_logros);

                $stmt->execute();

                $res = "true";
            }
            else
            {
                $stmt2 = $this->conn->prepare("INSERT INTO alumnos_logros(id_asignatura,id_alumno,id_anio_lectivo,id_logros) 
                                          VALUES(:id_asignatura,:id_alumno,:id_anio_lectivo,:id_logros)");
                                                  
                $stmt2->bindparam(":id_asignatura", $id_asignatura);
                $stmt2->bindparam(":id_alumno", $id_alumno);
                $stmt2->bindparam(":id_anio_lectivo", $id_anio_lectivo);
                $stmt2->bindparam(":id_logros", $id_logros);                                  
                    
                $stmt2->execute();   

                $res = "true";
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
     * [update_logro description]
     * @param  [type] $id_logro [description]
     * @param  [type] $logro    [description]
     * @param  [type] $materia  [description]
     * @return [type]           [description]
     */
    public function update_logro($id_logro,$logro,$id_asignatura)
    {
        try 
        {
            $stmt=$this->conn->prepare("UPDATE logros SET descripcion=:logro WHERE id_logro=:id_logro AND id_asignatura=:id_asignatura");

            $stmt->bindparam(":id_logro", $id_logro);
            $stmt->bindparam(":id_asignatura", $id_asignatura);
            $stmt->bindparam(":logro", $logro);

            $stmt->execute();

            return true;
        } 
        catch (PDOException $e) 
        {
            echo $e->getMessage();
            return false;
        }
    }

    /**
     * [Delete_logro description]
     * @param [type] $id_logro [description]
     */
    public function Delete_logro($id_logro)
    {
        try
        {
            $query = $this->conn->prepare("DELETE FROM logros WHERE id_logro = :id_logro");
            $query->bindParam("id_logro", $id_logro, PDO::PARAM_STR);
            $query->execute();

            return true;   
        }
        catch (PDOException $e) 
        {
            echo $e->getMessage();
            return false;
        }
        
    }

/*------------- FUNCIONES DIRECTOR DE GRUPO-------------------*/

    /**
     * [cabecera_director description]
     * @param  [type] $id_docente [description]
     * @return [type]             [description]
     */
    public function cabecera_director($id_docente)
    {
<<<<<<< HEAD
        $query = $this->conn->prepare('SELECT * FROM asig_director_grupo ADG inner join grupo GRU inner join grado GRA ON ADG.id_grupo = GRU.id_grupo AND GRA.id_grado = GRU.id_grado WHERE ADG.id_docente = :id_docente');
=======
        $query = $this->conn->prepare('SELECT * FROM grupo GRU inner join grado GRA ON GRU.id_grado = GRA.id_grado WHERE GRU.id_docente = :id_docente');
>>>>>>> origin/Laptop
        $query->bindParam(":id_docente",$id_docente);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;

    }

<<<<<<< HEAD
    /**
     * [cabecera_tabla_director description]
     * @param  [type] $id_grupo [description]
     * @return [type]           [description]
     */
    public function cabecera_tabla_director($id_grupo)
    {
        $query = $this->conn->prepare('SELECT ASI.nombre_asignatura FROM asignatura ASI inner join asig_asignatura_grupo AAG ON ASI.id_asignatura = AAG.id_asignatura WHERE AAG.id_grupo = :id_grupo');
=======
    public function cabecera_tabla_director($id_grupo)
    {
        $query = $this->conn->prepare('SELECT nombre_asignatura FROM asignatura WHERE id_grupo = :id_grupo');
>>>>>>> origin/Laptop
        $query->bindParam(":id_grupo",$id_grupo);
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
        $query = $this->conn->prepare('SELECT * FROM alumno AL inner join asig_alumno_sede AAS  WHERE AL.id_estado = "1"');
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
        $query = $this->conn->prepare('SELECT * FROM asig_alumno_sede ALS inner join sede S ON ALS.id_sede = S.id_sede inner join alumno AL ON AL.id_alumno = ALS.id_alumno WHERE ALS.id_sede = :id_sede');
        $query->bindParam(":id_sede",$id_sede);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    /**
     * [Read_alumno_grupo description]
     * @param [type] $id_grupo [description]
     */
    public function Read_alumno_grupo($id_grupo)
    {        
        $query = $this->conn->prepare('SELECT * FROM asig_alumno_grupo ALG inner join grado GRA inner join grupo GRU ON ALG.id_grupo = GRU.id_grupo AND GRA.id_gado = GRU.id_grado WHERE ALG.id_grupo = :id_grupo');
        $query->bindParam(":id_grupo",$id_grupo);
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

/*-------------------------------------------------------------------------------------------------------*/    
    public function pass_uncrypted($id_docente,$pass)
    {
        $res;

        try
        {
            $stmt = $this->conn->prepare("SELECT id_docente, pass FROM docente WHERE id_docente=:id_docente");
            $stmt->execute(array(':id_docente'=>$id_docente));
            $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
            
            if($stmt->rowCount() == 1)
            {
            
                $stmt=$this->conn->prepare("UPDATE docente SET estado=:pass WHERE id_docente=:id_docente");

                $stmt->bindparam(":pass",$pass);
                $stmt->bindparam(":id_docente",$id_docente);
                $stmt->execute();

                $res= true;
            }

            return $res;          
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

                    $pass_uncrypted = $this->pass_uncrypted($u_id,$u_pass);

                    

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