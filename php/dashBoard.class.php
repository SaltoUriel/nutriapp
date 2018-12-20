<?php 

    class dashBoard {
    
        private $CONECCION;

        public function __construct($BD){
            $this->CONECCION = $BD;
        }

        
        public function login($datos){
           try{
                $SQL = $this->CONECCION->prepare("SELECT idusuarios, fk_idroles FROM usuarios WHERE correo = :icorreo AND contrasena = :icontrasena AND activo = 1");
                $SQL->bindParam(":icorreo", $datos['correo']);
                $SQL->bindParam(":icontrasena", $datos['contrasena']);
                $SQL->execute();
               
                if($SQL->rowCount() > 0){
                    $Usuario = $SQL->fetch(PDO::FETCH_ASSOC);
                    print_r($Usuario);
                    if($Usuario['fk_idroles'] == 1){
                        $SQLADMIN= $this->CONECCION->prepare("SELECT * FROM usuarios WHERE idusuarios = :idusuarios");
                        $SQLADMIN->bindParam(":idusuarios", $Usuario['idusuarios']);
                        $SQLADMIN->execute();		
                        $Admin = $SQLADMIN->fetch(PDO::FETCH_ASSOC);			
                        @session_start();					
                        $_SESSION['username'] = $Admin['nombre_usuario'];
                        $_SESSION['idusuarios'] = $Admin['idusuarios'];	
                        $_SESSION['codigo'] = '';
                    }

                    $SQLMODULOS = $this->CONECCION->prepare("
									SELECT DISTINCT 
										modulo.idmodulo, 
									    modulo.nombre_modulo 
									FROM permisos 
									INNER JOIN modulo 
									ON permisos.fk_idmodulo = modulo.idmodulo 
									WHERE permisos.fk_idroles = :idRol 
									AND permisos.activo = 1 
									AND modulo.activo = 1");
				$SQLMODULOS->bindParam(":idRol", $Usuario['fk_idroles']);
				$SQLMODULOS->execute();

                $SQLSUBMODULOS = $this->CONECCION->prepare("SELECT	
										submodulo.nombre_submodulo, 
									    submodulo.ruta
									FROM permisos 
									INNER JOIN submodulo 
									ON permisos.fk_idsubmodulo = submodulo.idsubmodulo 
									WHERE permisos.fk_idroles = :idRol 
									AND submodulo.activo = 1 
									AND permisos.activo = 1 
                                    AND permisos.fk_idmodulo = :idModulo");
                $NAVBAR_ = "";
				$PERMISOS = array();

				while($Modulos = $SQLMODULOS->fetch(PDO::FETCH_ASSOC)) {
					$arraySubmodulos = array(
						':idRol'=>$Usuario['fk_idroles'],
						':idModulo'=>$Modulos['idmodulo']
                    );

                    $SQLSUBMODULOS->execute($arraySubmodulos);
					$NAVBAR_ .= '<li><a href="#">'. utf8_encode(mostrarNombresModulo($Modulos['nombre_modulo'])).'<span class="fa arrow"></span></a>';
					$NAVBAR_ .= '<ul class="nav nav-second-level">';
					while($submodulos = $SQLSUBMODULOS->fetch(PDO::FETCH_ASSOC)) {
						if($submodulos['ruta'] != 'actividadextras' && $submodulos['ruta'] != 'calificaralumno') {							
							$NAVBAR_ .= '<li><a href="'.$submodulos['ruta'].'.php">'.utf8_encode(mostrarNombresSubModulo($submodulos['nombre_submodulo'])).'</a></li>';
						}
						array_push($PERMISOS, $submodulos['ruta']);
					}
					$NAVBAR_ .= '</ul></li>';
                }
                $_SESSION['navbar'] = $NAVBAR_;
				$_SESSION['permisos'] = $PERMISOS;
                header('Location: pages/');
                }else {
                    echo '<div class="alert alert-dismissable alert-danger">Lo sentimos, usuario y/o contraseña no coinciden!
                                <button type="button" class="close" data-dismiss="alert">x</button>
                               </div>';
                }	

               
           }catch(PDOException $e){
            echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
            <button type="button" class="close" data-dismiss="alert">x</button>
            </div>';
           
           }
        }
        public function mostrarElementoCatalogo($id, $nombreTabla){
            try{
                $SQL = $this->CONECCION->PREPARE("SELECT ".$nombreTabla.".nombre_".$nombreTabla.","
                                                .$nombreTabla.".porcion_".$nombreTabla.
                                                " FROM ".$nombreTabla." WHERE id".$nombreTabla." = ".$id);
                $SQL->execute();
                while($Elemento = $SQL->fetch(PDO::FETCH_ASSOC)){

                }
            }catch(PDOException $e) {
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }
        }

        public function mostrarListaFrutas() {
            try {
                $SQL = $this->CONECCION->PREPARE("SELECT
                        fruta.idfruta,
                        fruta.nombre_fruta,
                        fruta.porcion_fruta,
                        fruta.fecha_alta
                    FROM fruta");
                $SQL->execute();
    
                while($Fruta = $SQL->fetch(PDO::FETCH_ASSOC)) {
                    $idFruta = $Fruta['idfruta'];
                    echo ' <tr id="'.$idFruta.'">
                                <th scope="row">'.$Fruta['idfruta'].'</th>
                                <td id="N'.$idFruta.'">'.$Fruta['nombre_fruta'].'</td>
                                <td id="P'.$idFruta.'">'.$Fruta['porcion_fruta'].'</td>
                                <td> <div data="'.$idFruta.'" > <a href="#" class="editar"><i class="glyphicon glyphicon-pencil"></i></a> </div> </td>
                                <td> <div class="div-eliminar" data="'.$Fruta['idfruta'].'" id="div-eliminar'.$Fruta['idfruta'].'"> <a class="eliminar" id="eliminar'.$Fruta['idfruta'].'" href="#"><i class="glyphicon glyphicon-remove"></i></a></div> </td>
                            </tr>';
    
                }
            } catch (PDOException $e) {
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }
        } 

        public function mostrarListaLacteos() {
            try {
                $SQL = $this->CONECCION->PREPARE("SELECT
                        lacteo.idlacteo,
                        lacteo.nombre_lacteo,
                        lacteo.porcion_lacteo,
                        lacteo.fecha_alta
                    FROM lacteo");
                $SQL->execute();
    
                while($Lacteo = $SQL->fetch(PDO::FETCH_ASSOC)) {
                    $idLacteo = $Lacteo['idlacteo'];
                    echo ' <tr id="'.$idLacteo.'">
                                <th scope="row">'.$Lacteo['idlacteo'].'</th>
                                <td id="N'.$idLacteo.'">'.$Lacteo['nombre_lacteo'].'</td>
                                <td id="P'.$idLacteo.'">'.$Lacteo['porcion_lacteo'].'</td>
                                <td> <div data="'.$idLacteo.'" > <a href="#" class="editar"><i class="glyphicon glyphicon-pencil"></i></a> </div> </td>
                                <td> <div class="div-eliminar" data="'.$Lacteo['idlacteo'].'" id="div-eliminar'.$Lacteo['idlacteo'].'"> <a class="eliminar" id="eliminar'.$Lacteo['idlacteo'].'" href="#"><i class="glyphicon glyphicon-remove"></i></a></div> </td>
                            </tr>';
    
                }
            } catch (PDOException $e) {
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }
        } 

        public function mostrarListaLeguminosas() {
            try {
                $SQL = $this->CONECCION->PREPARE("SELECT
                        leguminosa.idleguminosa,
                        leguminosa.nombre_leguminosa,
                        leguminosa.porcion_leguminosa,
                        leguminosa.fecha_alta
                    FROM leguminosa");
                $SQL->execute();
    
                while($Leguminosa = $SQL->fetch(PDO::FETCH_ASSOC)) {
                    $idLeguminosa = $Leguminosa['idleguminosa'];
                    echo ' <tr id="'.$idLeguminosa.'">
                                <th scope="row">'.$Leguminosa['idleguminosa'].'</th>
                                <td id="N'.$idLeguminosa.'">'.$Leguminosa['nombre_leguminosa'].'</td>
                                <td id="P'.$idLeguminosa.'">'.$Leguminosa['porcion_leguminosa'].'</td>
                                <td> <div data="'.$idLeguminosa.'" > <a href="#" class="editar"><i class="glyphicon glyphicon-pencil"></i></a> </div> </td>
                                <td> <div class="div-eliminar" data="'.$Leguminosa['idleguminosa'].'" id="div-eliminar'.$Leguminosa['idleguminosa'].'"> <a class="eliminar" id="eliminar'.$Leguminosa['idleguminosa'].'" href="#"><i class="glyphicon glyphicon-remove"></i></a></div> </td>
                            </tr>';
    
                }
            } catch (PDOException $e) {
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }
        } 

        public function mostrarListaProteinas() {
            try {
                $SQL = $this->CONECCION->PREPARE("SELECT
                        proteina.idproteina,
                        proteina.nombre_proteina,
                        proteina.porcion_proteina,
                        proteina.fecha_alta
                    FROM proteina");
                $SQL->execute();
    
                while($Proteina = $SQL->fetch(PDO::FETCH_ASSOC)) {
                    
                    echo ' <tr id="'.$Proteina['idproteina'].'">
                                <th scope="row">'.$Proteina['idproteina'].'</th>
                                <td id="N'.$Proteina['idproteina'].'">'.$Proteina['nombre_proteina'].'</td>
                                <td id="P'.$Proteina['idproteina'].'">'.$Proteina['porcion_proteina'].'</td>
                                <td> <div data="'.$Proteina['idproteina'].'" > <a href="#" class="editar"><i class="glyphicon glyphicon-pencil"></i></a> </div> </td>
                                <td> <div class="div-eliminar" data="'.$Proteina['idproteina'].'" id="div-eliminar'.$Proteina['idproteina'].'"> <a class="eliminar" id="eliminar'.$Proteina['idproteina'].'" href="#"><i class="glyphicon glyphicon-remove"></i></a></div> </td>
                            </tr>';
    
                }
            } catch (PDOException $e) {
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }
        } 

        public function mostrarListaVerduras() {
            try {
                $SQL = $this->CONECCION->PREPARE("SELECT
                        verdura.idverdura,
                        verdura.nombre_verdura,
                        verdura.porcion_verdura,
                        verdura.fecha_alta
                    FROM verdura");
                $SQL->execute();
    
                while($Verdura = $SQL->fetch(PDO::FETCH_ASSOC)) {
                    
                    echo ' <tr id="'.$Verdura['idverdura'].'">
                                <th scope="row">'.$Verdura['idverdura'].'</th>
                                <td id="N'.$Verdura['idverdura'].'">'.$Verdura['nombre_verdura'].'</td>
                                <td id="P'.$Verdura['idverdura'].'">'.$Verdura['porcion_verdura'].'</td>
                                <td> <div data="'.$Verdura['idverdura'].'" > <a href="#" class="editar"><i class="glyphicon glyphicon-pencil"></i></a> </div> </td>
                                <td> <div class="div-eliminar" data="'.$Verdura['idverdura'].'" id="div-eliminar'.$Verdura['idverdura'].'"> <a class="eliminar" id="eliminar'.$Verdura['idverdura'].'" href="#"><i class="glyphicon glyphicon-remove"></i></a></div> </td>
                            </tr>';
    
                }
            } catch (PDOException $e) {
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }
        } 


        public function mostrarListaGrasas() {
            try {
                $SQL = $this->CONECCION->PREPARE("SELECT
                        grasa.idgrasas,
                        grasa.nombre_grasa,
                        grasa.porcion_grasa,
                        grasa.fecha_alta
                    FROM grasa");
                $SQL->execute();
    
                while($Grasa = $SQL->fetch(PDO::FETCH_ASSOC)) {
                    
                    echo ' <tr id="'.$Grasa['idgrasas'].'">
                                <th scope="row">'.$Grasa['idgrasas'].'</th>
                                <td id="N'.$Grasa['idgrasas'].'">'.$Grasa['nombre_grasa'].'</td>
                                <td id="P'.$Grasa['idgrasas'].'">'.$Grasa['porcion_grasa'].'</td>
                                <td> <div data="'.$Grasa['idgrasas'].'" > <a href="#" class="editar"><i class="glyphicon glyphicon-pencil"></i></a> </div> </td>
                                <td> <div class="div-eliminar" data="'.$Grasa['idgrasas'].'" id="div-eliminar'.$Grasa['idgrasas'].'"> <a class="eliminar" id="eliminar'.$Grasa['idgrasas'].'" href="#"><i class="glyphicon glyphicon-remove"></i></a></div> </td>
                            </tr>';
    
                }
            } catch (PDOException $e) {
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }
        } 


        public function mostrarListaCereales() {
            try {
                $SQL = $this->CONECCION->PREPARE("SELECT
                        cereal.idcereal,
                        cereal.nombre_cereal,
                        cereal.porcion_cereal,
                        cereal.fecha_alta
                    FROM cereal");
                $SQL->execute();
    
                while($Cereal = $SQL->fetch(PDO::FETCH_ASSOC)) {
                    
                    echo ' <tr id="'.$Cereal['idcereal'].'">
                                <th scope="row">'.$Cereal['idcereal'].'</th>
                                <td id="N'.$Cereal['idcereal'].'">'.$Cereal['nombre_cereal'].'</td>
                                <td id="P'.$Cereal['idcereal'].'">'.$Cereal['porcion_cereal'].'</td>
                                <td> <div data="'.$Cereal['idcereal'].'" > <a href="#" class="editar"><i class="glyphicon glyphicon-pencil"></i></a> </div> </td>
                                <td> <div class="div-eliminar" data="'.$Cereal['idcereal'].'" id="div-eliminar'.$Cereal['idcereal'].'"> <a class="eliminar" id="eliminar'.$Cereal['idcereal'].'" href="#"><i class="glyphicon glyphicon-remove"></i></a></div> </td>
                            </tr>';
    
                }
            } catch (PDOException $e) {
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }
        } 



        public function insertarCatalogo($tabla, $nombre, $porcion) {
            try {
                $SQL = $this->CONECCION->PREPARE("INSERT INTO ".$tabla."(nombre_".$tabla.", porcion_".$tabla.") VALUES (:nombre, :porcion)");
                
                $SQL->bindParam(":nombre",$nombre);
                $SQL->bindParam(":porcion",$porcion);
                $SQL->execute();
    
                echo $nombre;
                      
            } catch (PDOException $e) {
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }
        }
        public function editarFruta($id, $nombre, $porcion, $tabla){
           try{
                $SQL = $this->CONECCION->PREPARE("UPDATE ".$tabla." SET nombre_".$tabla." =:nombre, porcion_".$tabla." =:porcion  WHERE id".$tabla." =:id");
                $SQL->bindParam(":nombre",$nombre);
                $SQL->bindParam(":porcion",$porcion);
                $SQL->bindParam(":id",$id);
                $SQL->execute();
                                                      
                    echo $nombre;
                      
            }catch (PDOException $e) {
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }
        }

        public function editarGrasa($id, $nombre, $porcion){
            try{
                 $SQL = $this->CONECCION->PREPARE("UPDATE grasa SET nombre_grasa =:nombre, porcion_grasa =:porcion  WHERE idgrasas =:id");
                 $SQL->bindParam(":nombre",$nombre);
                 $SQL->bindParam(":porcion",$porcion);
                 $SQL->bindParam(":id",$id);
                 $SQL->execute();
                                                       
                     echo $nombre;
                       
             }catch (PDOException $e) {
                 echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                         <button type="button" class="close" data-dismiss="alert">x</button>
                       </div>';
             }
         }
        public function borrarCatalogo($id, $nombreTabla){
            try{
                $SQL = $this->CONECCION->PREPARE("DELETE FROM ".$nombreTabla." WHERE id".$nombreTabla." = ".$id."");
                $SQL->execute();
                echo $id;
            }catch (PDOException $e) {
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                    </div>';
            }                
            
        }
        public function logout() {
            @session_start();
            @session_unset($_SESSION['username']);
            @session_unset($_SESSION['idusuarios']);
            @session_unset($_SESSION['paginasrol']);
            @session_unset($_SESSION['navbar']);
            @session_unset($_SESSION['permisos']);
            @session_unset($_SESSION['codigo']);
            session_destroy();
            header('Location: ../index.php');
        }
    
        public function checkSession() {
            @session_start();
            if(!empty($_SESSION['idusuarios']) && !empty($_SESSION['username']))
                return true;
    
            return false;
        }
    
        public function isUserAvaliable($username){
            try {
                $SQL = $this->CONNECTION->prepare("SELECT idUsuario FROM usuarios WHERE vUsuario = :usuario");
                $SQL->bindParam(":usuario", $username);
                $SQL->execute();
    
                if($SQL->rowCount() > 0){
                    echo "1";
                } else {
                    echo "0";
                }
            } catch (PDOException $e) {
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }
        }
    }

   





    /**
     * Claves para almacenar en la base de datos.
     * 
     * Usuarios : users
     * Frutas   : fruits
     * Lácteos  : dairy
     * Grasas   : fats
     * Leguminosas : leg
     * Proteínas : proteins
     * Verduras : vegetables
     */
    function mostrarNombresSubModulo($clave){
        $nombreSubModulo = "";
        switch($clave){
            case "users": $nombreSubModulo = "Usuarios"; break;
            case "fruits" : $nombreSubModulo = "Frutas"; break;
            case "dairy" : $nombreSubModulo = "Lácteos"; break;
            case "fats" : $nombreSubModulo = "Grasas"; break;
            case "leg" : $nombreSubModulo = "Leguminosas"; break;
            case "proteins" : $nombreSubModulo = "Proteínas"; break;
            case "vegetables" : $nombreSubModulo = "Verduras"; break;
            case "cereal" : $nombreSubModulo = "Cereal"; break;
            case "lunch" : $nombreSubModulo = "Almuerzo"; break;
            case "breakfast" : $nombreSubModulo = "Desayuno"; break;
            case "meal" : $nombreSubModulo = "Comida"; break;
            case "dinner" : $nombreSubModulo = "Cena"; break;
            case "collationOne" : $nombreSubModulo = "Colacion Uno"; break;
            case "collationTwo" : $nombreSubModulo = "Colacion Dos"; break;
            case "dietday" : $nombreSubModulo = "Dieta por Día"; break;
        }
        return $nombreSubModulo;
    }

    /**
     * Claves para almacenar en la base de datos.
     * 
     * Catalogos : catalogs
     * Configuración   : conf
     */
    function mostrarNombresModulo($clave){
        $nombreModulo = "";
        switch($clave){
            case "catalogs": $nombreModulo = "Catálogos"; break;
            case "conf" : $nombreModulo = "Configuración"; break;
            case "diet" : $nombreModulo = "Dietas"; break;
            default: $nombreModulo = ""; break;
        }
        return $nombreModulo;
    }
   
?>





