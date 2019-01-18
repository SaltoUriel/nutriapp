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
                                <td class="left">                                
                                    <div class="material-switch pull-center activo-edit" data-idrol="'.$Roles['idroles'].'">
                                        <input id="'.$Roles['idroles'].'" value="'.$Roles['activo'].'" '.$cheked.' name="'.$Roles['idroles'].'"  type="checkbox"/>
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
    }

   
   
?>





