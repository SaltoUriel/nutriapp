<?php 

    class dashBoardConfi {
    
        private $CONECCION;

        public function __construct($BD){
            $this->CONECCION = $BD;
        }

        public function showRolesLista(){
            try{
                $SQL = $this->CONECCION->PREPARE("SELECT
                                                    idroles,
                                                    nivel_rol,
                                                    activo,
                                                    fecha_alta
                                                 FROM roles");
                $SQL->execute();
    
                while($Roles = $SQL->fetch(PDO::FETCH_ASSOC)) {
                    $cheked = $Roles['activo'] == 1 ? "checked" : "";
                    
                    echo ' <tr id="'.$Roles['idroles'].'">
                                <th scope="row">'.$Roles['idroles'].'</th>
                                <td>'.$Roles['nivel_rol'].'</td>
                                <td>'.$Roles['fecha_alta'].'</td>
                                
                                <td> 
                                    <a href="#" class="btn-permisos" data-rol="'.$Roles['idroles'].'"> 
                                        <i class="glyphicon glyphicon-eye-open"></i>
                                    </a> 
                                </td>
                                <td class="left">                                
                                    <div class="material-switch pull-center activo-edit" data-idrol="'.$Roles['idroles'].'">
                                        <input id="I'.$Roles['idroles'].'" value="'.$Roles['activo'].'" '.$cheked.' name="'.$Roles['idroles'].'"  type="checkbox"/>
                                        <label for="'.$Roles['idroles'].'" class="label-success"></label>
                                    </div>                                
                                </td>
                            </tr>';
    
                }
            }catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                <button type="button" class="close" data-dismiss="alert">x</button>
              </div>';
            }
        }


        public function showPermisosLista($idRol){
            try{
                $SQLMODULOS = $this->CONECCION->prepare("
                                        SELECT DISTINCT 
                                            modulo.idmodulo, 
                                            modulo.nombre_modulo 
                                        FROM permisos 
                                        INNER JOIN modulo 
                                        ON permisos.fk_idmodulo = modulo.idmodulo 
                                        INNER JOIN roles
                                        ON permisos.fk_idroles = roles.idroles
                                        WHERE permisos.fk_idroles = :idRol 
                                        AND roles.activo = 1
                                        AND permisos.activo = 1 
                                        AND modulo.activo = 1");
                        $SQLMODULOS->bindParam(":idRol", $idRol);
                        $SQLMODULOS->execute();
                
                while($Modulo = $SQLMODULOS->fetch(PDO::FETCH_ASSOC)) {
                    //$cheked = $Roles['activo'] == 1 ? "checked" : "";
                    
                   echo  '<div class="input-group">
                                    <span class="input-group-addon">
                                        <input id="'.$Modulo['idmodulo'].'" checked type="checkbox" aria-label="...">
                                    </span>
                                    <p type="text" class="form-control" aria-label="..." >'.$Modulo['nombre_modulo'].'</p>
                                </div>
                                <br>
                                ';
    
                }
            

                $SQLMODULOS_SIN_PERMISOS = $this->CONECCION->prepare("
                                        SELECT DISTINCT 
                                            modulo.idmodulo, 
                                            modulo.nombre_modulo 
                                        FROM permisos 
                                        INNER JOIN modulo 
                                        ON permisos.fk_idmodulo = modulo.idmodulo 
                                        INNER JOIN roles
                                        ON permisos.fk_idroles = roles.idroles
                                        WHERE permisos.fk_idroles != :idRol 
                                        AND roles.activo = 1
                                        AND permisos.activo = 1 
                                        AND modulo.activo = 1");
                        $SQLMODULOS_SIN_PERMISOS->bindParam(":idRol", $idRol);
                        $SQLMODULOS_SIN_PERMISOS->execute();
                        while($Modulo_Sin_Permisos = $SQLMODULOS_SIN_PERMISOS->fetch(PDO::FETCH_ASSOC)) {
                            //$cheked = $Roles['activo'] == 1 ? "checked" : "";
                            
                           echo '<div class="input-group">
                                            <span class="input-group-addon">
                                                <input id="'.$Modulo_Sin_Permisos['idmodulo'].'" type="checkbox" aria-label="...">
                                            </span>
                                            <p type="text" class="form-control" aria-label="..." >'.$Modulo_Sin_Permisos['nombre_modulo'].'</p>
                                        </div>
                                        <br>
                                        ';
            
                        }
            }catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                <button type="button" class="close" data-dismiss="alert">x</button>
              </div>';
            }
        }




        public function insertRoles($nivelRol, $activo){
            try{
                $SQL = $this->CONECCION->PREPARE("INSERT INTO
                                                        roles (nivel_rol, activo) 
                                                    VALUES (:nivel, :activo)");
                $SQL->bindParam(":nivel", $nivelRol);
                $SQL->bindParam(":activo", $activo);
                $SQL->execute();
                echo "Ok";
            }catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                <button type="button" class="close" data-dismiss="alert">x</button>
              </div>';
            }
        }

        public function updateRoles($rol, $activo){
            try{

                $SQL = $this->CONECCION->PREPARE("UPDATE roles SET activo =:activoI WHERE idroles =:id");
                $SQL->bindParam(":activoI", $activo);
                $SQL->bindParam(":id", $rol);
                $SQL->execute();
                echo "Ok";

            }catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                <button type="button" class="close" data-dismiss="alert">x</button>
              </div>';
            }
        }


        public function showUsuariosLista(){
            try{
                $SQL = $this->CONECCION->PREPARE("SELECT
                                                    U.idusuarios,
                                                    U.nombre_usuario,
                                                    U.correo,
                                                    U.activo,
                                                    U.fk_idroles,
                                                    R.idroles,
                                                    R.nivel_rol
                                                 FROM usuarios AS U
                                                 INNER JOIN roles AS R
                                                 ON R.idroles = U.fk_idroles
                                                 WHERE U.fk_idroles = R.idroles");
                $SQL->execute();
    
                while($Usuarios = $SQL->fetch(PDO::FETCH_ASSOC)) {
                    $cheked = $Usuarios['activo'] == 1 ? "checked" : "";
                    
                    echo ' <tr id="'.$Usuarios['idusuarios'].'">
                                <th scope="row">'.$Usuarios['idusuarios'].'</th>
                                <td>'.$Usuarios['nombre_usuario'].'</td>
                                <td>'.$Usuarios['correo'].'</td>
                                <td>'.$Usuarios['nivel_rol'].'</td>
                               
                                <td class="left">                                
                                    <div class="material-switch pull-center activo-edit" data-idusuario="'.$Usuarios['idusuarios'].'">
                                        <input id="I'.$Usuarios['idusuarios'].'" value="'.$Usuarios['activo'].'" '.$cheked.' name="'.$Usuarios['idusuarios'].'"  type="checkbox"/>
                                        <label for="'.$Usuarios['idusuarios'].'" class="label-success"></label>
                                    </div>                                
                                </td>
                            </tr>';
    
                }
            }catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                <button type="button" class="close" data-dismiss="alert">x</button>
              </div>';
            }
        }



        public function seleccionRol(){
            try{
                $SQL = $this->CONECCION->prepare("SELECT 
                                                        idroles, 
                                                        nivel_rol
                                                        FROM roles
                                                        WHERE activo = 1");

                $SQL->execute();
                while($Rol = $SQL->fetch(PDO::FETCH_ASSOC)){
                    echo '<option value="'.$Rol['idroles'].'">'.$Rol['nivel_rol'].'</option>';
                }
            }catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }
        }

        public function insertUsuario($nombre, $correo, $contrasena, $rol, $activo){
            try{
                $passSifrada = password_hash($contrasena, PASSWORD_DEFAULT, array("cost"=>15));
                $SQL = $this->CONECCION->PREPARE("INSERT INTO
                                                            usuarios (nombre_usuario, correo, contrasena, activo, fk_idroles) 
                                                  VALUES (:nombre, :correo, :contrasena, :activo, :rol)");
                $SQL->bindParam(":nombre", $nombre);
                $SQL->bindParam(":correo", $correo);
                $SQL->bindParam(":contrasena", $passSifrada);
                $SQL->bindParam(":activo", $activo);
                $SQL->bindParam(":rol", $rol);
                $SQL->execute();
                echo "Ok";


            }catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }
        }

        public function updateUsuarioActivo($usuario, $activo){
            try{

                $SQL = $this->CONECCION->PREPARE("UPDATE usuarios SET activo =:activoI WHERE idusuarios =:id");
                $SQL->bindParam(":activoI", $activo);
                $SQL->bindParam(":id", $usuario);
                $SQL->execute();
                echo "Ok";

            }catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                <button type="button" class="close" data-dismiss="alert">x</button>
              </div>';
            }
        }

    }

    
   
?>





