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

            else $iniciales .= substr($trozos[$i], 0,2);
            //else $iniciales .= substr($trozos[$i], 0,3);

            $iniciales.=".";
        }

        return $iniciales;
    }

    /**
     * [after description]
     * @param  [type] $this   [description]
     * @param  [type] $inthat [description]
     * @return [type]         [description]
     */
    public function despues($caracter, $inthat)
    {
        if (!is_bool(strpos($inthat, $caracter)))
        return substr($inthat, strpos($inthat,$caracter)+strlen($caracter));
    }

    /**
     * [before description]
     * @param  [type] $this   [description]
     * @param  [type] $inthat [description]
     * @return [type]         [description]
     */
    public function antes($caracter, $inthat)
    {
        return substr($inthat, 0, strpos($inthat, $caracter));
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

    /**
     * [es_director description]
     * @param  [type] $id_docente [description]
     * @return [type]             [description]
     */
    public function es_director($id_docente)
    {
        try 
        {
            $stmt = $this->conn->prepare("SELECT * FROM asig_director_grupo WHERE id_docente=:id_docente");
            $stmt->bindparam(":id_docente", $id_docente);
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
     * [alumnos_a_cargo description]
     * @param  [type] $id_docente [description]
     * @return [type]             [description]
     */
    public function alumnos_a_cargo($id_docente)
    {
        try 
        {
            
            $query = $this->conn->prepare('SELECT * FROM asig_asignatura_docente AAD inner join grupo GRU ON AAD.id_grupo = GRU.id_grupo WHERE id_docente=:id_docente');
            $query->bindParam(":id_docente",$id_docente);
            $query->execute();
            $data = array();
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            return $data;

        } 

        catch (PDOException $e) 
        {
            exit($e->getMessage());
        }

    }

    /**
     * [carga_horaria description]
     * @param  [type] $id_asignatura [description]
     * @return [type]                [description]
     */
    public function carga_horaria($id_asignatura)
    {
        try 
        {
            
            $query = $this->conn->prepare('SELECT intensidad_horaria FROM asignatura WHERE id_asignatura=:id_asignatura');
            $query->bindParam(":id_asignatura",$id_asignatura);
            $query->execute();
            $data = array();
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            return $data;

        } 

        catch (PDOException $e) 
        {
            exit($e->getMessage());
        }

    }


    /**
     * [tipo_calificacion description]
     * @param  [type] $id_grupo [description]
     * @return [type]           [description]
     */
    public function tipo_calificacion($id_grupo)
    {
        try 
        {
            
            $query = $this->conn->prepare('SELECT * FROM grupo GRU inner join grado GR ON GRU.id_grado = GR.id_grado WHERE id_grupo=:id_grupo');
            $query->bindParam(":id_grupo",$id_grupo);
            $query->execute();
            $data = array();
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            return $data;

        } 

        catch (PDOException $e) 
        {
            exit($e->getMessage());
        }

    }


    /**
     * [anio_actual description]
     * @param  [type] $id_sede [description]
     * @return [type]          [description]
     */
    public function anio_actual($id_sede)
    {

        try 
        {
                        
            $query = $this->conn->prepare('SELECT id_anio_lectivo FROM anio_lectivo WHERE id_sede = :id_sede AND id_estado = "1"');
            $query->bindParam(":id_sede", $id_sede);
            $query->execute();                                

            $query->execute();
            $data = array();
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            return $data;

        } 

        catch (PDOException $e) 
        {
            exit($e->getMessage());
        }

    }



    /* -------------F U N C I O N E S  A D M I N I S T R A D O R ----------*/

    /**
     * [anio_lectivo_activo description]
     * @param  [type] $id_estado [description]
     * @return [type]            [description]
     */
    public function anio_lectivo_activo($id_estado)
    {
        $query = $this->conn->prepare('SELECT * FROM anio_lectivo WHERE id_estado = :id_estado');
        $query->bindParam(":id_estado",$id_estado);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }


    /**
     * [descripcion_estado description]
     * @param  [type] $id_estado [description]
     * @return [type]            [description]
     */
    public function descripcion_estado($id_estado)
    {
        $query = $this->conn->prepare('SELECT descripcion FROM estado WHERE id_estado = :id_estado');
        $query->bindParam(":id_estado",$id_estado);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    /**
     * [Descripcion_grupo_alumno description]
     * @param [type] $id_alumno [description]
     */
    public function Descripcion_grupo_alumno($id_alumno)
    {
        $query = $this->conn->prepare('SELECT * FROM asig_alumno_grupo AAG inner join grupo GR ON AAG.id_grupo  = GR.id_grupo WHERE AAG.id_alumno = :id_alumno');
        $query->bindParam(":id_alumno",$id_alumno);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }


    /**
     * [nombre_sede description]
     * @param  [type] $id_sede [description]
     * @return [type]          [description]
     */
    public function nombre_sede($id_sede)
    {
        $query = $this->conn->prepare('SELECT * FROM sede WHERE id_sede = :id_sede');
        $query->bindParam(":id_sede",$id_sede);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    /**
     * [nombre_grupo description]
     * @param  [type] $id_grupo [description]
     * @return [type]           [description]
     */
    public function nombre_grupo($id_grupo)
    {
        $query = $this->conn->prepare('SELECT descripcion_grupo FROM grupo WHERE id_grupo = :id_grupo');
        $query->bindParam(":id_grupo",$id_grupo);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }


    /**
     * [nombre_alumno description]
     * @param  [type] $id_alumno [description]
     * @return [type]            [description]
     */
    public function nombre_alumno($id_alumno)
    {
        $query = $this->conn->prepare('SELECT * FROM alumno WHERE id_alumno = :id_alumno');
        $query->bindParam(":id_alumno",$id_alumno);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    /**
     * [nombre_asignatura description]
     * @param  [type] $id_asignatura [description]
     * @return [type]                [description]
     */
    public function nombre_asignatura($id_asignatura)
    {
        $query = $this->conn->prepare('SELECT nombre_asignatura FROM asignatura WHERE id_asignatura = :id_asignatura');
        $query->bindParam(":id_asignatura",$id_asignatura);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
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
            echo '<option value="'.$row['id_sede'].'">'.$row['descripcion_sede'].'</option>'; 
        }

    }

    public function combobox_sede_alumno_sede()
    {
        $query = $this->conn->prepare("SELECT id_sede,descripcion_sede FROM Sede WHERE id_sede != 'IE'");
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
     * [combobox_indicado description]
     * @return [type] [description]
     */
    public function combobox_indicado()
    {
        $query = $this->conn->prepare("SELECT * FROM indicador");
        $query->execute();
        
        while($row=$query->fetch(PDO::FETCH_ASSOC))
        {
            echo '<option value="'.$row['id_indicador'].'">'.$row['descripcion'].'</option>'; 
        }

    }

    /**
     * [combobox_grupos_docente description]
     * @return [type] [description]
     */
    public function combobox_grupos_docente($id_docente)
    {
        $query = $this->conn->prepare("SELECT * FROM asig_asignatura_docente AAD inner join asignatura ASI inner join grupo GRU ON AAD.id_asignatura = ASI.id_asignatura AND AAD.id_grupo = GRU.id_grupo WHERE AAD.id_docente = :id_docente");
        $query->bindParam(":id_docente", $id_docente); 
        $query->execute();

        $data = array();
        /*
        while($row=$query->fetch(PDO::FETCH_ASSOC))
        {
            echo '<option value="'.$row['id_asignatura'].'">'.$row['nombre_asignatura'].' '.$row['descripcion_grado'].'-'.$row['descripcion_grupo'].'</option>';

            $data[] = $row;
        }
        */
       
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }

        return $data;

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
     * @param  [type] $id_grupo        [description]
     * @return [type]                  [description]
     */
    public function asignar_docente_asignatura($id_docente,$id_asignatura,$id_anio_lectivo,$id_grupo)
    {
        $res ="false";

        try
        {
            $stmt1 = $this->conn->prepare("SELECT id_docente FROM asig_docente_asignatura WHERE id_docente=:id_docente AND id_anio_lectivo=:id_anio_lectivo AND id_asignatura=:id_asignatura AND id_grupo=:id_grupo");

            $stmt1->execute(array(
                                  ':id_docente'   => $id_docente,
                                  ':id_anio_lectivo'   => $id_anio_lectivo, 
                                  ':id_asignatura'   => $id_asignatura, 
                                  ':id_grupo'   => $id_grupo 
                                    ));


            $userRow=$stmt1->fetch(PDO::FETCH_ASSOC);

            if($stmt1->rowCount() == 1)
            {

                $stmt=$this->conn->prepare("UPDATE asig_docente_asignatura SET id_asignatura = :id_asignatura WHERE id_docente=:id_docente AND id_anio_lectivo=:id_anio_lectivo AND id_grupo=:id_grupo");

                $stmt->bindparam(":id_anio_lectivo", $id_anio_lectivo);
                $stmt->bindparam(":id_docente", $id_docente);
                $stmt->bindparam(":id_asignatura", $id_asignatura);
                $stmt->bindparam(":id_grupo", $id_grupo);

                $stmt->execute();

                $res = "true";
            }
            else
            {
                $stmt2 = $this->conn->prepare("INSERT INTO asig_docente_asignatura(id_docente,id_asignatura,id_anio_lectivo,id_grupo) 
                                          VALUES(:id_docente,:id_asignatura,:id_anio_lectivo,:id_grupo)");
                                                  
                $stmt2->bindparam(":id_docente", $id_docente);
                $stmt2->bindparam(":id_asignatura", $id_asignatura); 
                $stmt2->bindparam(":id_anio_lectivo", $id_anio_lectivo);
                $stmt2->bindparam(":id_grupo", $id_grupo);
                                                 
                    
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
     * [register_asignaturas description]
     * @param  [type] $id_area     [description]
     * @param  [type] $nombre_area [description]
     * @return [type]              [description]
     */
    public function register_asignaturas($id_area,$nombre_asignatura,$intensidad_horaria,$porcentaje)
    {

        $id_asignatura=$id_area;

        $iniciales_asignatura = $this->iniciales($nombre_asignatura);

        $id_asignatura.="-".$iniciales_asignatura;



        try
        {
            $stmt = $this->conn->prepare("INSERT INTO asignatura(id_asignatura,id_area,nombre_asignatura,intensidad_horaria,porcentaje) 
                                          VALUES(:id_asignatura,:id_area,:nombre_asignatura,:intensidad_horaria,:porcentaje)");
                                                  
            $stmt->bindparam(":id_asignatura", $id_asignatura);
            $stmt->bindparam(":id_area", $id_area);
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
     * [Read_grados description]
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
     * [Read_grupos description]
     */
    public function Read_grupos()
    {
        $query = $this->conn->prepare("SELECT * FROM grupo GP inner join grado GD inner join sede S ON GP.id_grado = GD.id_grado AND GD.id_sede = S.id_sede");
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
        $query = $this->conn->prepare('SELECT * FROM grupo WHERE id_sede = :id_sede');
        $query->bindparam(":id_sede",$id_sede);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    /**
     * [Read_grupos_grado description]
     * @param [type] $id_grado [description]
     */
    public function Read_grupos_grado($id_grado,$id_sede)
    {
        $query = $this->conn->prepare('SELECT * FROM grupo WHERE id_grado = :id_grado AND id_sede = :id_sede');
        $query->bindparam(":id_grado",$id_grado);
        $query->bindparam(":id_sede",$id_sede);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    /**
     * [Read_periodos_anio description]
     * @param [type] $id_anio_lectivo [description]
     */
    public function Read_periodos_anio($id_anio_lectivo)
    {
        $query = $this->conn->prepare('SELECT * FROM periodo WHERE id_anio_lectivo = :id_anio_lectivo');
        $query->bindparam(":id_anio_lectivo",$id_anio_lectivo);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    /**
     * [Read_asignaturas_sede description]
     * @param [type] $id_sede [description]
     */
    public function Read_asignaturas_sede($id_sede)
    {
        $query = $this->conn->prepare('SELECT * FROM asignatura ASI inner join asig_area_sede AAS inner join asig_asignatura_grupo AAG inner join grupo GRU ON AAS.id_area = ASI.id_area AND ASI.id_asignatura = AAG.id_asignatura AND AAG.id_grupo = GRU.id_grupo WHERE AAS.id_sede = :id_sede');
        $query->bindparam(":id_sede",$id_sede);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    /**
     * [Read_asignaturas_asig_asignatura description]
     * @param [type] $id_sede [description]
     */
    public function Read_asignaturas_asig_asignatura($id_sede)
    {
        $query = $this->conn->prepare('SELECT * FROM asignatura ASI inner join asig_area_sede AAS inner join asig_asignatura_docente AAD ON AAS.id_area = ASI.id_area AND AAD.id_asignatura = ASI.id_asignatura WHERE AAS.id_sede = :id_sede');
        $query->bindparam(":id_sede",$id_sede);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    /**
     * [Read_grupo_alumno description]
     * @param [type] $id_alumno [description]
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
    public function register_grupos($id_grado,$descripcion_grupo,$id_sede)
    {
        $id_grupo=$id_grado;
        $id_grupo.="-".$descripcion_grupo;

        try
        {
            $stmt = $this->conn->prepare("INSERT INTO grupo(id_grupo,id_grado,descripcion_grupo) 
                                          VALUES(?,?,?)");
                                                  
            $stmt->bindparam(1, $id_grupo);
            $stmt->bindparam(2, $id_grado);
            $stmt->bindparam(3, $descripcion_grupo);                                 
                
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
            $stmt_anio = $this->conn->prepare("INSERT INTO anio_lectivo(id_anio_lectivo, id_sede, descripcion_anio_lectivo, fecha_inicio, fecha_fin,id_estado) 
                                          VALUES(?, ?, ?, ?, ?, '1')");
                
        /** Insertar datos Año lectivo */                               
            $stmt_anio->bindparam(1, $id_anio_lectivo);
            $stmt_anio->bindparam(2, $id_sede);
            $stmt_anio->bindparam(3, $descripcion_anio_lectivo);
            $stmt_anio->bindparam(4, $fecha_inicio);
            $stmt_anio->bindparam(5, $fecha_fin);

            $stmt_anio->execute();


        //---- Ingresar en la base de datos Periodo 1
            $stmt_periodo = $this->conn->prepare("INSERT INTO periodo(id_periodo, id_anio_lectivo, desc_periodo, fecha_inicio_periodo, fecha_fin_periodo) 
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



    /* -------------F U N C I O N E S  R E P O R T E S ----------*/


    /**
     * [Read_fecha_periodo_informe description]
     * @param [type] $id_anio_lectivo [description]
     * @param [type] $id_jornada      [description]
     * @param [type] $id_periodo      [description]
     */
      public function Read_fecha_periodo_reporte($id_periodo)
    {
              
        $query = $this->conn->prepare('SELECT * FROM periodo WHERE id_periodo = :id_periodo');
        $query->bindParam(":id_periodo",$id_periodo);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }


    /**
     * [Read_cabecera_reporte description]
     * @param [type] $id_alumno [description]
     * @param [type] $id_sede   [description]
     */
    public function Read_cabecera_reporte($id_alumno,$id_anio_lectivo)
    { 
        $query = $this->conn->prepare('SELECT descripcion_grupo,nombres,primer_apellido,segundo_apellido,descripcion_jornada,GRU.id_grupo,JRN.id_jornada FROM asig_alumno_grupo AALG inner join alumno AL inner join grupo GRU inner join jornada JRN ON AALG.id_alumno = AL.id_alumno AND AALG.id_grupo = GRU.id_grupo AND GRU.id_jornada = JRN.id_jornada WHERE AALG.id_alumno = :id_alumno AND AALG.id_anio_lectivo = :id_anio_lectivo');
        $query->bindParam(":id_alumno",$id_alumno);
        $query->bindParam(":id_anio_lectivo",$id_anio_lectivo);
        $query->execute();  
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    /**
     * [Read_asignatura_reporte description]
     * @param [type] $id_alumno       [description]
     * @param [type] $id_anio_lectivo [description]
     * @param [type] $id_grupo        [description]
     */
    public function Read_asignatura_reporte($id_alumno,$id_anio_lectivo,$id_asignatura)
    { 
        $query = $this->conn->prepare('SELECT nota1,nota2,nota3,nota4,nombre_asignatura,intensidad_horaria,nombre_area FROM nota NT inner join asignatura ASI inner join area AR ON NT.id_asignatura = ASI.id_asignatura AND ASI.id_area = AR.id_area WHERE NT.id_alumno = :id_alumno AND NT.id_anio_lectivo = :id_anio_lectivo AND ASI.id_asignatura = :id_asignatura');
        $query->bindParam(":id_alumno",$id_alumno);
        $query->bindParam(":id_anio_lectivo",$id_anio_lectivo);
        $query->bindParam(":id_asignatura",$id_asignatura);
        $query->execute();  
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    /**
     * [Read_faltas_reporte description]
     * @param [type] $id_alumno       [description]
     * @param [type] $id_anio_lectivo [description]
     * @param [type] $id_asignatura   [description]
     */
    public function Read_faltas_reporte($id_alumno,$id_anio_lectivo,$id_asignatura)
    { 
        $query = $this->conn->prepare('SELECT inasistencia_p1,inasistencia_p2,inasistencia_p3,inasistencia_p4 FROM asistencia WHERE id_alumno = :id_alumno AND id_anio_lectivo = :id_anio_lectivo AND id_asignatura = :id_asignatura');
        $query->bindParam(":id_alumno",$id_alumno);
        $query->bindParam(":id_anio_lectivo",$id_anio_lectivo);
        $query->bindParam(":id_asignatura",$id_asignatura);
        $query->execute();  
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }


    /**
     * [Read_nota_definitiva description]
     * @param [type] $id_alumno       [description]
     * @param [type] $id_anio_lectivo [description]
     * @param [type] $id_asignatura   [description]
     */
    public function Read_nota_definitiva($id_alumno,$id_anio_lectivo,$id_asignatura)
    { 
        $query = $this->conn->prepare('SELECT * FROM nota_definitiva_asignatura WHERE id_alumno = :id_alumno AND id_anio_lectivo = :id_anio_lectivo AND id_asignatura = :id_asignatura');
        $query->bindParam(":id_alumno",$id_alumno);
        $query->bindParam(":id_anio_lectivo",$id_anio_lectivo);
        $query->bindParam(":id_asignatura",$id_asignatura);
        $query->execute();  
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }


    /**
     * [Read_logros_asignatura_periodo description]
     * @param [type] $id_alumno       [description]
     * @param [type] $id_anio_lectivo [description]
     * @param [type] $id_asignatura   [description]
     * @param [type] $id_periodo      [description]
     */
    public function Read_logros_asignatura_periodo($id_alumno,$id_anio_lectivo,$id_asignatura,$id_periodo)
    { 
        $query = $this->conn->prepare('SELECT * FROM alumnos_logros WHERE id_alumno = :id_alumno AND id_asignatura = :id_asignatura AND id_anio_lectivo = :id_anio_lectivo AND  id_periodo = :id_periodo');
        $query->bindParam(":id_alumno",$id_alumno);
        $query->bindParam(":id_anio_lectivo",$id_anio_lectivo);
        $query->bindParam(":id_asignatura",$id_asignatura);
        $query->bindParam(":id_periodo",$id_periodo);
        $query->execute();  
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    /**
     * [Read_asignaturas_grupo description]
     * @param [type] $id_grupo [description]
     */
    public function Read_asignaturas_grupo($id_grupo)
    {
        $query = $this->conn->prepare('SELECT * FROM asig_asignatura_grupo WHERE id_grupo = :id_grupo');
        $query->bindParam(":id_grupo",$id_grupo);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    /**
     * [Read_observaciones_periodo description]
     * @param [type] $id_alumno       [description]
     * @param [type] $id_anio_lectivo [description]
     * @param [type] $id_periodo      [description]
     */
     public function Read_observaciones_periodo($id_alumno,$id_anio_lectivo/*,$id_periodo*/)
    { 
        $query = $this->conn->prepare('SELECT * FROM asig_obser_alumno WHERE id_alumno = :id_alumno AND id_anio_lectivo = :id_anio_lectivo /*AND  id_periodo = :id_periodo*/');
        $query->bindParam(":id_alumno",$id_alumno);
        $query->bindParam(":id_anio_lectivo",$id_anio_lectivo);
        //$query->bindParam(":id_periodo",$id_periodo);
        $query->execute();  
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    /**
     * [Read_observaciones description]
     * @param [type] $id_observacion [description]
     */
    public function Read_observaciones_reporte($id_observacion)
    {
        $query = $this->conn->prepare('SELECT descripcion FROM observaciones WHERE  id_observacion = :id_observacion');
        $query->bindParam(":id_observacion",$id_observacion);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
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

			$stmt = $this->conn->prepare("INSERT INTO docente(id_docente,id_tipo_usuario,nombres,prim_apellido,seg_apellido,email,pass,id_sede,estado) 
		                                  VALUES(:cc,:id_tipo,:nombre,:prim_ape,:seg_ape,:email,:new_password,:id_sede, 1)");
												  
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
    public function Read_director_grupo($id_grupo,$id_anio_lectivo)
    {        
        $query = $this->conn->prepare('SELECT D.nombres, D.prim_apellido, D.seg_apellido FROM asig_director_grupo ADG inner join docente D ON ADG.id_docente = D.id_docente WHERE ADG.id_grupo = :id_grupo AND ADG.id_anio_lectivo = :id_anio_lectivo');
        $query->bindParam(":id_grupo",$id_grupo);
        $query->bindParam(":id_anio_lectivo",$id_anio_lectivo);
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
        $query = $this->conn->prepare('SELECT * FROM asig_docente_sede ADS inner join docente D ON ADS.id_docente = D.id_docente WHERE ADS.id_sede = :id_sede AND D.id_tipo_usuario = "3"');
        $query->bindParam(":id_sede",$id_sede);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    /**
     * [Read_alumnos_sede description]
     * @param [type] $id_sede [description]
     */
    public function Read_alumnos_sede($id_sede)
    {
       $query = $this->conn->prepare('SELECT AL.id_alumno,AL.nombres,AL.primer_apellido,AL.segundo_apellido FROM alumno AL inner join asig_alumno_sede AAS ON AL.id_alumno = AAS.id_alumno WHERE AAS.id_sede = :id_sede AND AL.id_estado = "1" ORDER BY AL.primer_apellido ');
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
    public function Read_alumnos_grupo($id_grupo)
    {
        $query = $this->conn->prepare('SELECT AL.id_alumno,AL.nombres,AL.primer_apellido,AL.segundo_apellido FROM alumno AL inner join asig_alumno_grupo AALG ON AL.id_alumno = AALG.id_alumno WHERE AALG.id_grupo = :id_grupo AND AL.id_estado = "1" ORDER BY AL.primer_apellido ');
        $query->bindParam(":id_grupo",$id_grupo);
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
        $query = $this->conn->prepare('SELECT AL.id_alumno,AL.nombres,AL.primer_apellido,AL.segundo_apellido FROM alumno AL inner join asig_alumno_grupo AAG ON AL.id_alumno = AAG.id_alumno WHERE AAG.id_grupo = :id_grupo ORDER BY AL.primer_apellido ');
        $query->bindParam(":id_grupo",$id_grupo);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    /**
     * [Read_docente_asig_grupo description]
     * @param [type] $id_sede [description]
     */
    public function Read_docente_asig_grupo($id_sede)
    {
        $query = $this->conn->prepare('SELECT * FROM docente DOC inner join sede SE ON DOC.id_sede = SE.id_sede WHERE DOC.id_sede = :id_sede AND DOC.id_tipo_usuario = 3 ORDER BY DOC.prim_apellido');
        $query->bindParam(":id_sede",$id_sede);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }


    /**
     * [Read_cabecera_grupo description]
     * @param [type] $id_docente    [description]
     * @param [type] $id_asignatura [description]
     * @param [type] $id_grupo      [description]
     */
    public function Read_cabecera_grupo($id_docente,$id_asignatura,$id_grupo)
    {
        $query = $this->conn->prepare('SELECT * FROM asig_asignatura_docente AAD inner join asignatura ASI inner join area AR inner join grupo GRU ON AAD.id_asignatura = ASI.id_asignatura AND AAD.id_grupo = GRU.id_grupo AND ASI.id_area = AR.id_area  WHERE AAD.id_docente = :id_docente AND AAD.id_asignatura = :id_asignatura AND AAD.id_grupo = :id_grupo');
        $query->bindParam(":id_docente",$id_docente);
        $query->bindParam(":id_asignatura",$id_asignatura);
        $query->bindParam(":id_grupo",$id_grupo);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    /**
     * [Read_cabecera_asig_grupo description]
     * @param [type] $id_sede [description]
     */
    public function Read_cabecera_asig_grupo($id_sede)
    {
        try 
        {
            $query = $this->conn->prepare('SELECT * FROM anio_lectivo ANL inner join sede SE ON SE.id_sede = ANL.id_sede WHERE ANL.id_sede = :id_sede AND ANL.id_estado = "1"');
            $query->bindParam(":id_sede",$id_sede);
            $query->execute();
            $data = array();
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            return $data;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
            return false;
        }
    }


    /**
     * [Read_cabecera_asig_alumno_grupo description]
     * @param [type] $id_grupo [description]
     */
    public function Read_cabecera_asig_alumno_grupo($id_grupo)
    {
        try 
        {
            $query = $this->conn->prepare('SELECT GRU.id_grupo, GRU.descripcion_grupo, DC.nombres, DC.prim_apellido, ADG.id_anio_lectivo FROM grupo GRU inner join asig_director_grupo ADG inner join docente DC ON GRU.id_grupo = ADG.id_grupo AND ADG.id_docente = DC.id_docente WHERE GRU.id_grupo = :id_grupo');
            $query->bindParam(":id_grupo",$id_grupo);
            $query->execute();
            $data = array();
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            return $data;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
            return false;
        }
    }


    /**
     * [Read_fecha_periodos description]
     * @param [type] $id_anio_lectivo [description]
     */
    public function Read_fecha_periodos($id_anio_lectivo,$id_jornada)
    {
        $query = $this->conn->prepare('SELECT * FROM periodo WHERE id_anio_lectivo = :id_anio_lectivo AND id_jornada = :id_jornada');
        $query->bindParam(":id_anio_lectivo",$id_anio_lectivo);
        $query->bindParam(":id_jornada",$id_jornada);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    /**
     * [Read_fecha_anio description]
     * @param [type] $id_anio_lectivo [description]
     */
    public function Read_fecha_anio($sede_id)
    {
        $query = $this->conn->prepare('SELECT * FROM anio_lectivo WHERE id_sede = :sede_id');
        $query->bindParam(":sede_id",$sede_id);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }


    /**
     * [Cambio_estado_anio description]
     * @param [type] $id_anio_lectivo [description]
     * @param [type] $estado          [description]
     */
    public function Cambio_estado_anio($id_anio_lectivo,$estado)
    {
        $res = "false";

        try
        { 
            $stmt=$this->conn->prepare("UPDATE anio_lectivo SET id_estado=:estado WHERE id_anio_lectivo=:id_anio_lectivo");

            $stmt->bindparam(":id_anio_lectivo",$id_anio_lectivo);
            $stmt->bindparam(":estado",$estado);

            $stmt->execute();
       

            $res = "True";            
        }

        catch(PDOException $e)
        {
            echo $e->getMessage();
             $res = "False";
        }


        //echo "RES: ".$res."<br>";
        return $res;
    }



    /**
     * [Read_notas description]
     * @param [type] $id_asignatura [description]
     * @param [type] $id_alumno     [description]
     */
    public function Read_notas($id_asignatura, $id_alumno,$id_anio)
    {
        $query = $this->conn->prepare('SELECT * FROM nota WHERE id_asignatura = :id_asignatura AND id_alumno = :id_alumno AND id_anio_lectivo = :id_anio');
        $query->bindParam(":id_asignatura",$id_asignatura);
        $query->bindParam(":id_alumno",$id_alumno);
        $query->bindParam(":id_anio",$id_anio);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }















/**
 * [Read_notas_sede description]
 * @param [type] $id_sede [description]
 */
    public function Read_notas_sede($id_anio_lectivo)
    {
        $query = $this->conn->prepare('SELECT * FROM nota WHERE id_anio_lectivo = :id_anio_lectivo');
        $query->bindParam(":id_anio_lectivo",$id_anio_lectivo);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }


    /**
     * [Read_promedio_grupo description]
     * @param [type] $id_grupo [description]
     */
    public function Read_promedio_grupo($id_grupo)
    {
        $query = $this->conn->prepare('SELECT * FROM grupo GRU inner join asig_alumno_grupo AAG inner join promedio_periodo PP ON GRU.id_grupo = AAG.id_grupo AND AAG.id_alumno = PP.id_alumno WHERE GRU.id_grupo = :id_grupo');
        $query->bindParam(":id_grupo",$id_grupo);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

























    /**
     * [Read_notas_tr description]
     * @param [type] $id_asignatura [description]
     * @param [type] $id_alumno     [description]
     * @param [type] $id_anio       [description]
     */
    public function Read_notas_tr($id_asignatura, $id_alumno,$id_anio)
    {
        $query = $this->conn->prepare('SELECT * FROM nota_tr WHERE id_asignatura = :id_asignatura AND id_alumno = :id_alumno AND id_anio_lectivo = :id_anio');
        $query->bindParam(":id_asignatura",$id_asignatura);
        $query->bindParam(":id_alumno",$id_alumno);
        $query->bindParam(":id_anio",$id_anio);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }


    /**
     * [Read_notas_defenitivas_asignatura description]
     * @param [type] $id_asignatura [description]
     * @param [type] $id_alumno     [description]
     */
    public function Read_notas_def_asignatura($id_asignatura,$id_alumno,$id_anio)
    {
        $query = $this->conn->prepare('SELECT * FROM nota_definitiva_asignatura WHERE id_asignatura = :id_asignatura AND id_alumno = :id_alumno AND id_anio_lectivo = :id_anio');
        $query->bindParam(":id_asignatura",$id_asignatura);
        $query->bindParam(":id_alumno",$id_alumno);
        $query->bindParam(":id_anio",$id_anio);
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
    public function update_nota($id_alumno,$name_nota,$nota,$materia,$materia_file,$anio)
    {
        //echo "Id asignatura: ".$materia."<br>";
        //echo "Id asig file:  ".$materia_file."<br><br>";

        $res = "false";

        if ($materia == $materia_file) 
        {
            //echo "entro en materia == materia_file<br>";
            try
            {

                $stmt1 = $this->conn->prepare("SELECT id_alumno FROM nota WHERE id_alumno=:id_alumno AND id_asignatura=:materia AND id_anio_lectivo=:anio");

                $stmt1->execute(array(
                                      ':id_alumno'   => $id_alumno,
                                      ':materia' => $materia,
                                      ':anio'   => $anio 
                                        ));

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

                    $res = "True";            
            }

            catch(PDOException $e)
            {
                echo $e->getMessage();
                 $res = "False";
            }
        }

        //echo "RES: ".$res."<br>";
        return $res;
        
    }

    /**
     * [update_nota_tr description]
     * @param  [type] $id_alumno    [description]
     * @param  [type] $name_nota    [description]
     * @param  [type] $nota         [description]
     * @param  [type] $materia      [description]
     * @param  [type] $materia_file [description]
     * @param  [type] $anio         [description]
     * @return [type]               [description]
     */
    public function update_nota_tr($id_alumno,$name_nota,$nota,$id_indicador,$materia,$anio)
    {
        //echo "Id asignatura: ".$materia."<br>";
        //echo "Id asig file:  ".$materia_file."<br><br>";

        $res = "false";

        //echo "entro en materia == materia_file<br>";
        try
        {
                                                
            if ($name_nota == "nota1") 
            {
                $stmt2 = $this->conn->prepare("INSERT INTO nota_tr(id_alumno,id_anio_lectivo,id_asignatura,nota1,id_indicador1) 
                                      VALUES(:id_alumno,:anio,:materia,:nota,:id_indicador)");
            }
            elseif ($name_nota == "nota2") 
            {
                $stmt2 = $this->conn->prepare("INSERT INTO nota_tr(id_alumno,id_anio_lectivo,id_asignatura,nota2,id_indicador2) 
                                      VALUES(:id_alumno,:anio,:materia,:nota,:id_indicador)");
            }
            elseif ($name_nota == "nota3") 
            {
                $stmt2 = $this->conn->prepare("INSERT INTO nota_tr(id_alumno,id_anio_lectivo,id_asignatura,nota3,id_indicador3) 
                                      VALUES(:id_alumno,:anio,:materia,:nota,:id_indicador)");
            }
            elseif ($name_nota == "nota4") 
            {
                $stmt2 = $this->conn->prepare("INSERT INTO nota_tr(id_alumno,id_anio_lectivo,id_asignatura,nota4,id_indicador4) 
                                      VALUES(:id_alumno,:anio,:materia,:nota,:id_indicador)");
            }

            $stmt2->bindparam(":nota",$nota);
            $stmt2->bindparam(":id_alumno",$id_alumno);
            $stmt2->bindparam(":materia",$materia);
            $stmt2->bindparam(":anio",$anio);
            $stmt2->bindparam(":id_indicador",$id_indicador);

            $stmt2->execute();

             $res = "True"; 
        }

        catch(PDOException $e)
        {
            echo $e->getMessage();
             $res = "False";
        }

        //echo "RES: ".$res."<br>";
        return $res;
        
    }

    /**
     * [update_nota_final description]
     * @param  [type] $id_alumno     [description]
     * @param  [type] $id_asignatura [description]
     * @param  [type] $id_anio       [description]
     * @param  [type] $nota_def      [description]
     * @return [type]                [description]
     */
    public function update_nota_final($id_alumno,$id_asignatura,$id_anio,$nota_def)
    {
        //echo "Id asignatura: ".$materia."<br>";
        //echo "Id asig file:  ".$materia_file."<br><br>";

        $res = "false";

        try
        {

            $stmt1 = $this->conn->prepare("SELECT id_alumno FROM nota_definitiva_asignatura WHERE id_alumno=:id_alumno AND id_asignatura=:id_asignatura AND id_anio_lectivo=:id_anio");

            $stmt1->execute(array(
                                  ':id_alumno'   => $id_alumno,
                                  ':id_asignatura' => $id_asignatura,
                                  ':id_anio'   => $id_anio 
                                    ));

            $userRow=$stmt1->fetch(PDO::FETCH_ASSOC);

            if($stmt1->rowCount() == 1)
            {
                $stmt=$this->conn->prepare("UPDATE nota_definitiva_asignatura SET nota_definitiva_asig=:nota_def WHERE id_alumno=:id_alumno AND id_asignatura=:id_asignatura");
               
                $stmt->bindparam(":nota_def",$nota_def);
                $stmt->bindparam(":id_alumno",$id_alumno);
                $stmt->bindparam(":id_asignatura",$id_asignatura);

                $stmt->execute();

            }else
            {                                                  
                $stmt2 = $this->conn->prepare("INSERT INTO nota_definitiva_asignatura(id_alumno,id_asignatura,id_anio_lectivo,nota_definitiva_asig) 
                                          VALUES(:id_alumno,:id_asignatura,:id_anio,:nota_def)");

                $stmt2->bindparam(":nota_def",$nota_def);
                $stmt2->bindparam(":id_alumno",$id_alumno);
                $stmt2->bindparam(":id_asignatura",$id_asignatura);
                $stmt2->bindparam(":id_anio",$id_anio);

                $stmt2->execute();

            }

                $res = "True";            
        }

        catch(PDOException $e)
        {
            echo $e->getMessage();
             $res = "False";
        }

        //echo "RES: ".$res."<br>";
        return $res;
        
    }

    /**
     * [update_promedio_periodo description]
     * @param  [type] $id_alumno     [description]
     * @param  [type] $promedio_name [description]
     * @param  [type] $nota          [description]
     * @param  [type] $anio          [description]
     * @return [type]                [description]
     */
    public function update_promedio_periodo($id_alumno,$promedio_name,$nota,$anio)
    {
        //echo "Id asignatura: ".$materia."<br>";
        //echo "Id asig file:  ".$materia_file."<br><br>";

        $res = "false";

        try
        {

            $stmt1 = $this->conn->prepare("SELECT id_alumno FROM promedio_periodo WHERE id_alumno=:id_alumno AND id_anio_lectivo=:anio");

            $stmt1->execute(array(
                                  ':id_alumno'   => $id_alumno,
                                  ':anio'   => $anio 
                                    ));

            $userRow=$stmt1->fetch(PDO::FETCH_ASSOC);

            if($stmt1->rowCount() == 1)
            {
                if ($promedio_name == "promedio_p1") 
                {
                    $stmt=$this->conn->prepare("UPDATE promedio_periodo SET promedio_p1=:nota WHERE id_alumno=:id_alumno");
                }
                elseif ($promedio_name == "promedio_p2") 
                {
                    $stmt=$this->conn->prepare("UPDATE promedio_periodo SET promedio_p2=:nota WHERE id_alumno=:id_alumno");
                }
                elseif ($promedio_name == "promedio_p3") 
                {
                    $stmt=$this->conn->prepare("UPDATE promedio_periodo SET promedio_p3=:nota WHERE id_alumno=:id_alumno");
                }
                elseif ($promedio_name == "promedio_p4") 
                {
                    $stmt=$this->conn->prepare("UPDATE promedio_periodo SET promedio_p4=:nota WHERE id_alumno=:id_alumno");
                }

                $stmt->bindparam(":nota",$nota);
                $stmt->bindparam(":id_alumno",$id_alumno);

                $stmt->execute();

            }else
            {                                                  
                if ($promedio_name == "promedio_p1") 
                {
                    $stmt2 = $this->conn->prepare("INSERT INTO promedio_periodo(id_alumno,id_anio_lectivo,promedio_p1) 
                                          VALUES(:id_alumno,:anio,:nota)");
                }
                elseif ($promedio_name == "promedio_p2") 
                {
                    $stmt2 = $this->conn->prepare("INSERT INTO promedio_periodo(id_alumno,id_anio_lectivo,promedio_p2) 
                                          VALUES(:id_alumno,:anio,:nota)");
                }
                elseif ($promedio_name == "promedio_p3") 
                {
                    $stmt2 = $this->conn->prepare("INSERT INTO promedio_periodo(id_alumno,id_anio_lectivo,promedio_p3) 
                                          VALUES(:id_alumno,:anio,:nota)");
                }
                elseif ($promedio_name == "promedio_p4") 
                {
                    $stmt2 = $this->conn->prepare("INSERT INTO promedio_periodo(id_alumno,id_anio_lectivo,promedio_p4) 
                                          VALUES(:id_alumno,:anio,:nota)");
                }

                $stmt2->bindparam(":nota",$nota);
                $stmt2->bindparam(":id_alumno",$id_alumno);
                $stmt2->bindparam(":anio",$anio);

                $stmt2->execute();

            }

            $res = "True";            
        }

        catch(PDOException $e)
        {
            echo $e->getMessage();
             $res = "False";
        }
        

        //echo "RES: ".$res."<br>";
        return $res;
        
    }

    /**
     * [update_puesto_periodo description]
     * @param  [type] $id_alumno   [description]
     * @param  [type] $puesto_name [description]
     * @param  [type] $id_grupo    [description]
     * @param  [type] $nota        [description]
     * @param  [type] $anio        [description]
     * @return [type]              [description]
     */
    public function update_puesto_periodo($id_alumno,$puesto_name,$id_grupo,$nota,$anio)
    {
        $res = "false";

        try
        {

            $stmt1 = $this->conn->prepare("SELECT id_alumno FROM puesto_periodo WHERE id_alumno=:id_alumno AND id_grupo = :id_grupo AND id_anio_lectivo=:anio");

            $stmt1->execute(array(
                                  ':id_alumno'   => $id_alumno,
                                  ':id_grupo'   => $id_grupo,
                                  ':anio'   => $anio 
                                    ));

            $userRow=$stmt1->fetch(PDO::FETCH_ASSOC);

            if($stmt1->rowCount() == 1)
            {
                if ($puesto_name == "puesto_p1") 
                {
                    $stmt=$this->conn->prepare("UPDATE puesto_periodo SET puesto_p1=:nota WHERE id_alumno=:id_alumno AND id_grupo = :id_grupo");
                }
                elseif ($puesto_name == "puesto_p2") 
                {
                    $stmt=$this->conn->prepare("UPDATE puesto_periodo SET puesto_p2=:nota WHERE id_alumno=:id_alumno AND id_grupo = :id_grupo");
                }
                elseif ($puesto_name == "puesto_p3") 
                {
                    $stmt=$this->conn->prepare("UPDATE puesto_periodo SET puesto_p3=:nota WHERE id_alumno=:id_alumno AND id_grupo = :id_grupo");
                }
                elseif ($puesto_name == "puesto_p4") 
                {
                    $stmt=$this->conn->prepare("UPDATE puesto_periodo SET puesto_p4=:nota WHERE id_alumno=:id_alumno AND id_grupo = :id_grupo");
                }

                $stmt->bindparam(":nota",$nota);
                $stmt->bindparam(":id_alumno",$id_alumno);
                $stmt->bindparam(":id_grupo",$id_grupo);

                $stmt->execute();

            }else
            {                                                  
                if ($puesto_name == "puesto_p1") 
                {
                    $stmt2 = $this->conn->prepare("INSERT INTO puesto_periodo(id_alumno,id_anio_lectivo,id_grupo,puesto_p1) 
                                          VALUES(:id_alumno,:anio,:id_grupo,:nota)");
                }
                elseif ($puesto_name == "puesto_p2") 
                {
                    $stmt2 = $this->conn->prepare("INSERT INTO puesto_periodo(id_alumno,id_anio_lectivo,id_grupo,puesto_p2) 
                                          VALUES(:id_alumno,:anio,:id_grupo,:nota)");
                }
                elseif ($puesto_name == "puesto_p3") 
                {
                    $stmt2 = $this->conn->prepare("INSERT INTO puesto_periodo(id_alumno,id_anio_lectivo,id_grupo,puesto_p3) 
                                          VALUES(:id_alumno,:anio,:id_grupo,:nota)");
                }
                elseif ($puesto_name == "puesto_p4") 
                {
                    $stmt2 = $this->conn->prepare("INSERT INTO puesto_periodo(id_alumno,id_anio_lectivo,id_grupo,puesto_p4) 
                                          VALUES(:id_alumno,:anio,:id_grupo,:nota)");
                }

                $stmt2->bindparam(":nota",$nota);
                $stmt2->bindparam(":id_alumno",$id_alumno);
                $stmt2->bindparam(":anio",$anio);
                $stmt2->bindparam(":id_grupo",$id_grupo);

                $stmt2->execute();

            }

            $res = "True";            
        }

        catch(PDOException $e)
        {
            echo $e->getMessage();
             $res = "False";
        }
        

        //echo "RES: ".$res."<br>";
        return $res;
        
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
    public function update_faltas($id_alumno,$name_falta,$falta,$materia,$materia_file,$anio)
    {
        //echo "Id asignatura: ".$materia."<br>";
        //echo "Id asig file:  ".$materia_file."<br><br>";
        $res_faltas = false;

        if ($materia_file == $materia)
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
                        $stmt1=$this->conn->prepare("UPDATE asistencia SET inasistencia_p1=:falta WHERE id_alumno=:id_alumno AND id_asignatura=:materia");
                    }
                    elseif ($name_falta == "inasistencia_p2") 
                    {
                        $stmt1=$this->conn->prepare("UPDATE asistencia SET inasistencia_p2=:falta WHERE id_alumno=:id_alumno AND id_asignatura=:materia");
                    }
                    elseif ($name_falta == "inasistencia_p3") 
                    {
                        $stmt1=$this->conn->prepare("UPDATE asistencia SET inasistencia_p3=:falta WHERE id_alumno=:id_alumno AND id_asignatura=:materia");
                    }
                    elseif ($name_falta == "inasistencia_p4") 
                    {
                        $stmt1=$this->conn->prepare("UPDATE asistencia SET inasistencia_p4=:falta WHERE id_alumno=:id_alumno AND id_asignatura=:materia");
                    }

                    $stmt1->bindparam(":falta",$falta);
                    $stmt1->bindparam(":id_alumno",$id_alumno);
                    $stmt1->bindparam(":materia",$materia);

                    $stmt1->execute();

                    $res_faltas = true;
        

                }
                else
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
                    elseif ($name_falta == "inasistencia_p3") 
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

                    $res_faltas = true;
        
                }
            
            }

            catch(PDOException $e)
            {
                echo $e->getMessage();
                $res_faltas = false;
    
            }

        }
        else
        {
            $res_faltas = false;

        }

        return $res_faltas;

    }

    /**
     * [read_logros description]
     * @param  [type] $id_asignatura [description]
     * @return [type]                [description]
     */
    public function Read_logros($id_asignatura)
    {
        $query = $this->conn->prepare('SELECT * FROM logros WHERE id_asignatura = :id_asignatura AND id_estado = "1"');
        $query->bindParam(":id_asignatura",$id_asignatura);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    /**
     * [Read_logro description]
     * @param [type] $id_logro [description]
     */
    public function Read_logro_tr($id_logro)
    {
        $query = $this->conn->prepare('SELECT descripcion FROM logros WHERE id_logro = :id_logro');
        $query->bindParam(":id_logro",$id_logro);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    /**
     * [Read_indicador description]
     * @param [type] $id_indicador [description]
     */
    public function Read_indicador_tr($id_indicador)
    {
        $query = $this->conn->prepare('SELECT descripcion FROM indicador WHERE id_indicador = :id_indicador');
        $query->bindParam(":id_indicador",$id_indicador);
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
    public function Read_logros_alumno($id_asignatura,$id_alumno,$id_periodo)
    {
        $query = $this->conn->prepare('SELECT * FROM alumnos_logros AL inner join logros L ON AL.id_asignatura = L.id_asignatura WHERE Al.id_asignatura = :id_asignatura AND Al.id_alumno = :id_alumno AND Al.id_periodo = :id_periodo');
        $query->bindParam(":id_asignatura",$id_asignatura);
        $query->bindParam(":id_alumno",$id_alumno);
        $query->bindParam(":id_periodo",$id_periodo);
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

        $id_logro = $id_asignatura.'-'.$N_logros;


        try
        {
            $stmt = $this->conn->prepare("INSERT INTO logros(id_logro,id_asignatura,descripcion,id_estado) 
                                          VALUES(:id_logro,:id_asignatura,:logro,'1')");
                                                  
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
    public function register_logros_alumno($id_asignatura,$id_alumno,$id_anio_lectivo,$id_periodo,$id_logros)
    {
        $res ="false";

        try
        {

            $stmt1 = $this->conn->prepare("SELECT id_alumno FROM alumnos_logros WHERE id_alumno=:id_alumno AND id_asignatura=:id_asignatura AND id_anio_lectivo=:id_anio_lectivo AND id_periodo=:id_periodo");

            $stmt1->execute(array(
                                  ':id_alumno'   => $id_alumno,
                                  ':id_asignatura' => $id_asignatura,
                                  ':id_anio_lectivo'   => $id_anio_lectivo,
                                  ':id_periodo'   => $id_periodo 
                                    ));


            $userRow=$stmt1->fetch(PDO::FETCH_ASSOC);

            if($stmt1->rowCount() == 1)
            {

                $stmt=$this->conn->prepare("UPDATE alumnos_logros SET id_logros=:id_logros WHERE id_alumno=:id_alumno AND id_asignatura=:id_asignatura AND id_anio_lectivo=:id_anio_lectivo");

                $stmt->bindparam(":id_logros", $id_logros);
                $stmt->bindparam(":id_alumno", $id_alumno);
                $stmt->bindparam(":id_asignatura", $id_asignatura);
                $stmt->bindparam(":id_anio_lectivo", $id_anio_lectivo);

                $stmt->execute();

                $res = "true";
            }
            else
            {

                $stmt2 = $this->conn->prepare("INSERT INTO alumnos_logros(id_asignatura,id_alumno,id_anio_lectivo,id_periodo,id_logros) 
                                          VALUES(:id_asignatura,:id_alumno,:id_anio_lectivo,:id_periodo,:id_logros)");
                                                  
                $stmt2->bindparam(":id_asignatura", $id_asignatura);
                $stmt2->bindparam(":id_alumno", $id_alumno);
                $stmt2->bindparam(":id_anio_lectivo", $id_anio_lectivo);
                $stmt2->bindparam(":id_periodo", $id_periodo);
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
    public function update_logro($id_logro,$logro,$id_asignatura,$accion)
    {
      if ($accion == "Actualizar") 
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
      elseif ($accion == "Eliminar")
      {
        try 
        {
            $stmt1=$this->conn->prepare("UPDATE logros SET id_estado='0' WHERE id_logro=:id_logro");

            $stmt1->bindparam(":id_logro", $id_logro);

            $stmt1->execute();

            return true;
        } 
        catch (PDOException $e) 
        {
            echo $e->getMessage();
            return false;
        }
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


    /**
   * [Read_observaciones description]
   * @param [type] $id_grupo [description]
   */
  public function Read_observaciones($id_grupo)
  {
      $query = $this->conn->prepare('SELECT * FROM observaciones WHERE id_grupo = :id_grupo AND id_estado = "1"');
      $query->bindParam(":id_grupo",$id_grupo);
      $query->execute();
      $data = array();
      while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
          $data[] = $row;
      }
      return $data;
  }

  /**
   * [Read_observaciones_alumno description]
   * @param [type] $id_grupo  [description]
   * @param [type] $id_alumno [description]
   */
  public function Read_observaciones_alumno($id_grupo,$id_alumno,$id_anio_lectivo)
  {
      $query = $this->conn->prepare('SELECT * FROM asig_obser_alumno AOA inner join observaciones OB ON AOA.id_grupo = OB.id_grupo WHERE AOA.id_grupo = :id_grupo AND AOA.id_alumno = :id_alumno AND id_anio_lectivo = :id_anio_lectivo');
      $query->bindParam(":id_grupo",$id_grupo);
      $query->bindParam(":id_alumno",$id_alumno);
      $query->bindParam(":id_anio_lectivo",$id_anio_lectivo);
      $query->execute();
      $data = array();
      while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
          $data[] = $row;
      }
      return $data;
  }


  /**
   * [register_observaciones description]
   * @param  [type] $id_asignatura [description]
   * @param  [type] $observaciones [description]
   * @return [type]                [description]
   */
  public function register_observaciones($id_grupo,$observaciones)
  {

      $query = $this->conn->prepare('SELECT* FROM observaciones WHERE id_grupo LIKE :id_grupo');
      $query->bindParam(":id_grupo",$id_grupo);
      $query->execute();

      $N_observacion = $query->rowCount();

      $N_observacion++;

      $id_observacion = $id_grupo.'-O-'.$N_observacion;


      try
      {
          $stmt = $this->conn->prepare("INSERT INTO observaciones(id_observacion,id_grupo,descripcion,id_estado) 
                                        VALUES(:id_observacion,:id_grupo,:observaciones,'1')");
                                                
          $stmt->bindparam(":id_observacion", $id_observacion);
          $stmt->bindparam(":id_grupo", $id_grupo);
          $stmt->bindparam(":observaciones", $observaciones);                                  
              
          $stmt->execute();   
          
          return $stmt;   
      }
      catch(PDOException $e)
      {
          echo $e->getMessage();
      }               
  }

  /**
   * [register_observaciones_alumno description]
   * @param  [type] $id_asignatura   [description]
   * @param  [type] $id_alumno       [description]
   * @param  [type] $id_anio_lectivo [description]
   * @param  [type] $id_periodo      [description]
   * @param  [type] $id_observacion  [description]
   * @return [type]                  [description]
   */
  public function register_observaciones_alumno($id_grupo,$id_alumno,$id_anio_lectivo,$id_periodo,$id_observacion)
  {
      $res ="false";

      try
      {
          $stmt1 = $this->conn->prepare("SELECT id_alumno FROM asig_obser_alumno WHERE id_alumno=:id_alumno AND id_grupo=:id_grupo AND id_anio_lectivo=:id_anio_lectivo AND id_periodo=:id_periodo");

          $stmt1->execute(array(
                                ':id_alumno'   => $id_alumno,
                                ':id_grupo' => $id_grupo,
                                ':id_anio_lectivo'   => $id_anio_lectivo,
                                ':id_periodo'   => $id_periodo 
                                  ));


          $userRow=$stmt1->fetch(PDO::FETCH_ASSOC);

          if($stmt1->rowCount() == 1)
          {

              $stmt=$this->conn->prepare("UPDATE asig_obser_alumno SET id_observacion = :id_observacion WHERE id_alumno=:id_alumno AND id_grupo=:id_grupo AND id_anio_lectivo=:id_anio_lectivo");

              $stmt->bindparam(":id_grupo", $id_grupo);
              $stmt->bindparam(":id_anio_lectivo", $id_anio_lectivo);
              $stmt->bindparam(":id_periodo", $id_periodo);
              $stmt->bindparam(":id_alumno", $id_alumno);
              $stmt->bindparam(":id_logros", $id_logros);

              $stmt->execute();

              $res = "true";
          }
          else
          {
              $stmt2 = $this->conn->prepare("INSERT INTO asig_obser_alumno(id_alumno,id_grupo,id_anio_lectivo,id_periodo,id_observacion) 
                                        VALUES(:id_alumno,:id_grupo,:id_anio_lectivo,:id_periodo,:id_observacion)");
                                                
              $stmt2->bindparam(":id_grupo", $id_grupo);
              $stmt2->bindparam(":id_alumno", $id_alumno);
              $stmt2->bindparam(":id_anio_lectivo", $id_anio_lectivo);
              $stmt2->bindparam(":id_periodo", $id_periodo);
              $stmt2->bindparam(":id_observacion", $id_observacion);                                  
                  
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
   * [update_observacion description]
   * @param  [type] $id_observacion [description]
   * @param  [type] $id_grupo       [description]
   * @param  [type] $descripcion    [description]
   * @param  [type] $id_estado      [description]
   * @return [type]                 [description]
   */
    public function update_observacion($id_observacion,$id_grupo,$descripcion,$accion)
    {

      if ($accion == "Actualizar") 
      {
        try 
        {
            $stmt=$this->conn->prepare("UPDATE observaciones SET descripcion=:descripcion WHERE id_observacion=:id_observacion AND id_grupo=:id_grupo");

            $stmt->bindparam(":id_observacion", $id_observacion);
            $stmt->bindparam(":id_grupo", $id_grupo);
            $stmt->bindparam(":descripcion", $descripcion);

            $stmt->execute();

            return true;
        } 
        catch (PDOException $e) 
        {
            echo $e->getMessage();
            return false;
        }
      }
      elseif ($accion == "Eliminar")
      {
        try 
        {
            $stmt1=$this->conn->prepare("UPDATE observaciones SET id_estado='0' WHERE id_observacion=:id_observacion");

            $stmt1->bindparam(":id_observacion", $id_observacion);

            $stmt1->execute();

            return true;
        } 
        catch (PDOException $e) 
        {
            echo $e->getMessage();
            return false;
        }
      }
        
    }


/**
 * [cambio_alumno_sede description]
 * @param  [type] $id_alumno [description]
 * @param  [type] $id_sede   [description]
 * @return [type]            [description]
 */
  public function cambio_alumno_sede($id_alumno,$id_sede)
  {
      $res ="false";

      try
      {
          $stmt1 = $this->conn->prepare("SELECT id_alumno FROM asig_alumno_sede WHERE id_alumno=:id_alumno AND id_sede=:id_sede AND id_estado = '1'");

          $stmt1->execute(array(
                                ':id_alumno' => $id_alumno,
                                ':id_sede'   => $id_sede
                                  ));


          $userRow=$stmt1->fetch(PDO::FETCH_ASSOC);

          if($stmt1->rowCount() == 1)
          {
              $stmt=$this->conn->prepare("UPDATE asig_alumno_sede SET id_sede = :id_sede WHERE id_alumno=:id_alumno");

              $stmt->bindparam(":id_alumno", $id_alumno);
              $stmt->bindparam(":id_sede", $id_sede);

              $stmt->execute();

              $res = "true";
          }
          else
          {
              $stmt2 = $this->conn->prepare("INSERT INTO asig_alumno_sede(id_alumno,id_sede,id_estado) 
                                        VALUES(:id_alumno,:id_sede,'1')");
                                                
              $stmt2->bindparam(":id_alumno", $id_alumno);
              $stmt2->bindparam(":id_sede", $id_sede);                                  
                  
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
     * [cambio_alumno_grupo description]
     * @param  [type] $id_grupo_old [description]
     * @param  [type] $id_grupo_new [description]
     * @param  [type] $id_alumno    [description]
     * @param  [type] $id_anio_lec  [description]
     * @return [type]               [description]
     */
    public function cambio_alumno_grupo($id_grupo,$id_alumno,$id_anio_lectivo)
    {
        $res ="false";

        try
        {
            $stmt1 = $this->conn->prepare("SELECT id_alumno FROM asig_alumno_grupo WHERE id_alumno=:id_alumno AND id_anio_lectivo=:id_anio_lectivo");

            $stmt1->execute(array(
                                  ':id_alumno'   => $id_alumno,
                                  ':id_anio_lectivo'   => $id_anio_lectivo
                                    ));


            $userRow=$stmt1->fetch(PDO::FETCH_ASSOC);

            if($stmt1->rowCount() == 1)
            {
                $stmt=$this->conn->prepare("UPDATE asig_alumno_grupo SET id_grupo = :id_grupo WHERE id_alumno=:id_alumno AND id_anio_lectivo=:id_anio_lectivo");

                $stmt->bindparam(":id_alumno", $id_alumno);
                $stmt->bindparam(":id_grupo", $id_grupo);
                $stmt->bindparam(":id_anio_lectivo", $id_anio_lectivo);

                $stmt->execute();

                $res = "true";
            }
            else
            {
                $stmt2 = $this->conn->prepare("INSERT INTO asig_alumno_grupo(id_alumno,id_grupo,id_anio_lectivo) 
                                          VALUES(:id_alumno,:id_grupo,:id_anio_lectivo)");
                                                  
                $stmt2->bindparam(":id_alumno", $id_alumno);
                $stmt2->bindparam(":id_grupo", $id_grupo);
                $stmt2->bindparam(":id_anio_lectivo", $id_anio_lectivo);                                  
                    
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
     * [asignar_director_grupo description]
     * @param  [type] $id_docente      [description]
     * @param  [type] $id_grupo        [description]
     * @param  [type] $id_anio_lectivo [description]
     * @return [type]                  [description]
     */
    public function asignar_director_grupo($id_docente,$id_grupo,$id_anio_lectivo)
    {
        $res ="false";

        try
        {
            $stmt1 = $this->conn->prepare("SELECT id_docente FROM asig_director_grupo WHERE id_docente=:id_docente AND id_anio_lectivo=:id_anio_lectivo");

            $stmt1->execute(array(
                                  ':id_docente'   => $id_docente,
                                  ':id_anio_lectivo'   => $id_anio_lectivo 
                                    ));


            $userRow=$stmt1->fetch(PDO::FETCH_ASSOC);

            if($stmt1->rowCount() == 1)
            {

                $stmt=$this->conn->prepare("UPDATE asig_director_grupo SET id_grupo = :id_grupo WHERE id_docente=:id_docente AND id_anio_lectivo=:id_anio_lectivo");

                $stmt->bindparam(":id_anio_lectivo", $id_anio_lectivo);
                $stmt->bindparam(":id_docente", $id_docente);
                $stmt->bindparam(":id_grupo", $id_grupo);

                $stmt->execute();

                $res = "true";
            }
            else
            {
                $stmt2 = $this->conn->prepare("INSERT INTO asig_director_grupo(id_docente,id_anio_lectivo,id_grupo) 
                                          VALUES(:id_docente,:id_anio_lectivo,:id_grupo)");
                                                  
                $stmt2->bindparam(":id_docente", $id_docente);
                $stmt2->bindparam(":id_anio_lectivo", $id_anio_lectivo);
                $stmt2->bindparam(":id_grupo", $id_grupo);                                  
                    
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

    

/*------------- FUNCIONES DIRECTOR DE GRUPO-------------------*/

    /**
     * [cabecera_director description]
     * @param  [type] $id_docente [description]
     * @return [type]             [description]
     */
    public function cabecera_director($id_docente)
    {

        $query = $this->conn->prepare('SELECT * FROM asig_director_grupo ADG inner join grupo GRU ON ADG.id_grupo = GRU.id_grupo WHERE ADG.id_docente = :id_docente');
        $query->bindParam(":id_docente",$id_docente);
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;

    }


    /**
     * [cabecera_tabla_director description]
     * @param  [type] $id_grupo [description]
     * @return [type]           [description]
     */
    public function cabecera_tabla_director($id_grupo)
    {
        $query = $this->conn->prepare('SELECT ASI.nombre_asignatura,ASI.id_asignatura FROM asignatura ASI inner join asig_asignatura_grupo AAG ON ASI.id_asignatura = AAG.id_asignatura WHERE AAG.id_grupo = :id_grupo');
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
     * @param  [type] $id_alumno        [description]
     * @param  [type] $nombres          [description]
     * @param  [type] $primer_apellido  [description]
     * @param  [type] $segundo_apellido [description]
     * @param  [type] $desplazado       [description]
     * @param  [type] $repitente        [description]
     * @param  [type] $sisben           [description]
     * @param  [type] $full_name_padre  [description]
     * @param  [type] $tel_padre        [description]
     * @param  [type] $full_name_madre  [description]
     * @param  [type] $tel_madre        [description]
     * @param  [type] $fecha_matricula  [description]
     * @return [type]                   [description]
     */
    public function register_alumno($id_alumno,$nombres,$primer_apellido,$segundo_apellido,$desplazado,$repitente,$sisben,$full_name_padre,$tel_padre,$full_name_madre,$tel_madre,$fecha_matricula,$id_estado)
    {

        //echo "Id asignatura: ".$materia."<br>";
        //echo "Id asig file:  ".$materia_file."<br><br>";
        $matricula = false;

            try
            {

                $stmt1 = $this->conn->prepare("SELECT id_alumno FROM alumno WHERE id_alumno=:id_alumno");
                $stmt1->execute(array(':id_alumno'=>$id_alumno));
                $userRow=$stmt1->fetch(PDO::FETCH_ASSOC);

                if($stmt1->rowCount() == 1)
                {

                    $stmt = $this->conn->prepare("UPDATE alumno SET id_alumno=:id_alumno,nombres=:nombres,primer_apellido=:primer_apellido,segundo_apellido=:segundo_apellido,desplazado=:desplazado,repitente=:repitente,sisben=:sisben,full_name_padre=:full_name_padre,telefono_padre=:tel_padre,full_name_madre=:full_name_madre,telefono_madre=:tel_madre,fecha_matricula=:nombres,id_estado=:id_estado");
                                                  
                    $stmt->bindparam(":id_alumno", $id_alumno);
                    $stmt->bindparam(":nombres", $nombres);
                    $stmt->bindparam(":primer_apellido", $primer_apellido);
                    $stmt->bindparam(":segundo_apellido", $segundo_apellido);
                    $stmt->bindparam(":desplazado", $desplazado);
                    $stmt->bindparam(":repitente", $repitente);
                    $stmt->bindparam(":sisben", $sisben);
                    $stmt->bindparam(":full_name_padre", $full_name_padre);
                    $stmt->bindparam(":tel_padre", $tel_padre);                                    
                    $stmt->bindparam(":full_name_madre", $full_name_madre);
                    $stmt->bindparam(":tel_madre", $tel_madre);
                    $stmt->bindparam(":fecha_matricula", $fecha_matricula);
                    $stmt->bindparam(":id_estado", $id_estado);
                        
                    $stmt->execute();

                    $matricula = true;
        

                }
                else
                {                                                  
                    $stmt2 = $this->conn->prepare("INSERT INTO alumno(id_alumno,nombres,primer_apellido,segundo_apellido,desplazado,repitente,sisben,full_name_padre,telefono_padre,full_name_madre,telefono_madre,fecha_matricula,id_estado) 
                                          VALUES(:id_alumno,:nombres,:primer_apellido,:segundo_apellido,:desplazado,:repitente,:sisben,:full_name_padre,:tel_padre,:full_name_madre,:tel_madre,:fecha_matricula,'1')");
                                                  
                    $stmt2->bindparam(":id_alumno", $id_alumno);
                    $stmt2->bindparam(":nombres", $nombres);
                    $stmt2->bindparam(":primer_apellido", $primer_apellido);
                    $stmt2->bindparam(":segundo_apellido", $segundo_apellido);
                    $stmt2->bindparam(":desplazado", $desplazado);
                    $stmt2->bindparam(":repitente", $repitente);
                    $stmt2->bindparam(":sisben", $sisben);
                    $stmt2->bindparam(":full_name_padre", $full_name_padre);
                    $stmt2->bindparam(":tel_padre", $tel_padre);                                    
                    $stmt2->bindparam(":full_name_madre", $full_name_madre);
                    $stmt2->bindparam(":tel_madre", $tel_madre);
                    $stmt2->bindparam(":fecha_matricula", $fecha_matricula);
                        
                    $stmt2->execute();

                    $matricula = true;
        
                }
            
            }

            catch(PDOException $e)
            {
                echo $e->getMessage();
                $matricula = false;
    
            }

        return $matricula;             
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
            
                $stmt=$this->conn->prepare("UPDATE docente SET contra=:pass WHERE id_docente=:id_docente");

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
            $stmt = $this->conn->prepare("SELECT DO.id_docente, DO.pass, ADS.id_sede FROM docente DO inner join asig_docente_sede ADS ON DO.id_docente = ADS.id_docente WHERE DO.id_docente=:u_id");
            $stmt->execute(array(':u_id'=>$u_id));
            $userRow=$stmt->fetch(PDO::FETCH_ASSOC);


            if($stmt->rowCount() == 1)
            {

                if(password_verify($u_pass, $userRow['pass']))
                {
                    $_SESSION['user_session'] = $userRow['id_docente'];
                    $_SESSION['sede_session'] = $userRow['id_sede'];

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

    /**
     * [destruir_variable description]
     * @param  [type] $variable [description]
     * @return [type]           [description]
     */
    public function destruir_variable($variable)
    {
        unset($variable);
    }


  public function Ordenar_array($toOrderArray, $field, $inverse)
  {
      $position = array();
      $newRow = array();

      foreach ($toOrderArray as $key => $row)
      {
              $position[$key]  = $row[$field];
              $newRow[$key] = $row;
      }
      if ($inverse) 
      {
          arsort($position);
      }
      else 
      {
          asort($position);
      }

      $returnArray = array();

      foreach ($position as $key => $pos) 
      {     
          $returnArray[] = $newRow[$key];
      }

      return $returnArray;
  }

  public function ordena_mat($mat,$col,$aod="ASC")
  {
    foreach($mat as $k =>$val){//recorre la matriz o array
        if($k!=$col) //si la clave actual ($k) NO es la indicada para ordenar
            $ord[$k]=$val; //guarda en un arreglo temporal asociativo el valor.
        else
            return $mat; //si lo es, regresa la matriz.
    }
 
    if($aod=="ASC") //si el ordenamiento es ASCENDENTE
        arsort($ord); //ordena ascendentemente
    else
        asort($ord);//caso contrario, ordena de forma descendente.
 
    foreach($ord as $k=>$nms)//recorre el arreglo temporal
        $mat2[$k]=$mat[$k];//crea una segunda matriz matriz temporal con los valores de la primera, pero ya ordenados
 
    foreach($mat2 as $k =>$val){//recorre la segunda matriz
        if(is_array($val))//si contiene otra matriz o arreglo
            $val=ordena_mat($val,$col,$aod);//vuelve a llamar a la función ordenar para dicho arreglo
        $mat2[$k]=$val;//y guarda el resultado ordenado en la matriz temporal
    }
    return $mat2;//finalmente regresa la matriz temporal ya ordenada
}
//no creo que falte aclararlo, pero se manda a llamar así:


}
?>