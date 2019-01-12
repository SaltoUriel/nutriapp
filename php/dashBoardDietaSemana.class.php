<?php 
    class dashBoardDietaSemana {
    
        private $CONECCION;
    
        public function __construct($BD){
            $this->CONECCION = $BD;
        }

        public function mostrarListaDietaLunes(){
            try{
                $SQL = $this->CONECCION->prepare("
                                                SELECT
                                                    L.idlunes,
                                                    L.fecha,
                                                    DD.iddieta_dia,
                                                    DD.fecha, 
                                                    D.iddesayuno, 
                                                    D.tipo_desayuno, 
                                                    D.descripcion_desayuno,
                                                    D.hora_desayuno,
                                                    A.idalmuerzo, 
                                                    A.hora_armuerzo,
                                                    A.fk_idproteina,
                                                    A.fk_idgrasas, 
                                                    A.fk_idverdura, 
                                                    A.fk_idcereal,
                                                    CU.idcolacion_uno,
                                                    CU.hora_colacion AS hora_colacion_uno,
                                                    CU.fk_idfruta,
                                                    CO.idcomida,
                                                    CO.hora_comida,
                                                    CO.fk_idgrasas,
                                                    CO.fk_idproteina,
                                                    CO.fk_idverdura,
                                                    CO.fk_idcereal,
                                                    CO.fk_idleguminosa,
                                                    CD.idcolacion_dos,
                                                    CD.hora_colacion AS hora_colacion_dos,
                                                    CD.fruta_idfruta,
                                                    CE.idcena,
                                                    CE.hora_cena,
                                                    CE.fk_idtipo_cena,
                                                    CE.fk_idcereal,
                                                    CE.fk_idlacteo,
                                                    CE.fk_idverdura,
                                                    CE.fk_idproteina
                                                 FROM lunes AS L
                                                 INNER JOIN dieta_dia AS DD 
                                                 ON DD.iddieta_dia = L.fk_iddieta_dia 
                                                 INNER JOIN desayuno AS D 
                                                 ON D.iddesayuno = DD.fk_iddesayuno
                                                 INNER JOIN almuerzo AS A
                                                 ON A.idalmuerzo = DD.fk_idalmuerzo
                                                 INNER JOIN colacion_uno AS CU
                                                 ON CU.idcolacion_uno = DD.fk_idcolacion_uno
                                                 INNER JOIN comida AS CO
                                                 ON CO.idcomida = DD.fk_idcomida
                                                 INNER JOIN colacion_dos AS CD
                                                 ON CD.idcolacion_dos = DD.fk_idcolacion_dos
                                                 INNER JOIN cena AS CE
                                                 ON CE.idcena = DD.fk_idcena
                                                 WHERE L.fk_iddieta_dia = DD.iddieta_dia
                                                 AND DD.fk_iddesayuno = D.iddesayuno
                                                 AND DD.fk_idalmuerzo = A.idalmuerzo 
                                                 AND DD.fk_idcolacion_uno = CU.idcolacion_uno
                                                 AND DD.fk_idcomida = CO.idcomida
                                                 AND DD.fk_idcolacion_dos = CD.idcolacion_dos
                                                 AND DD.fk_idcena = CE.idcena
                ");
                $SQL->execute();
                while($DietaLunes = $SQL->fetch(PDO::FETCH_ASSOC)){
                    echo '<tr id="'.$DietaLunes['idlunes'].'">
                        <td>'.date("d-m-Y", strtotime($DietaLunes['fecha'])).'</td>
                        <td>'.date("g:i a", strtotime($DietaLunes['hora_desayuno'])).'</td>
                        <td>'.date("g:i a", strtotime($DietaLunes['hora_armuerzo'])).'</td>
                        <td>'.date("g:i a", strtotime($DietaLunes['hora_colacion_uno'])).'</td>
                        <td>'.date("g:i a", strtotime($DietaLunes['hora_comida'])).'</td>
                        <td>'.date("g:i a", strtotime($DietaLunes['hora_colacion_dos'])).'</td>
                        <td>'.date("g:i a", strtotime($DietaLunes['hora_cena'])).'</td>
                        <td> 
                            <div> 
                                <a href="#" class="editar" data-iddesayuno="'.$DietaLunes['iddesayuno'].'" data-horadesayuno="'.$DietaLunes['hora_desayuno'].'"
                                    data-idalmuerzo="'.$DietaLunes['idalmuerzo'].'" data-horaalmuerzo="'.$DietaLunes['hora_armuerzo'].'" 
                                    data-idcolacionuno="'.$DietaLunes['idcolacion_uno'].'" data-horacolacionuno="'.$DietaLunes['hora_colacion_uno'].'"
                                    data-idcomida="'.$DietaLunes['idcomida'].'" data-horacomida="'.$DietaLunes['hora_comida'].'"
                                    data-idcolaciondos="'.$DietaLunes['idcolacion_dos'].'" data-horacolaciondos="'.$DietaLunes['hora_colacion_dos'].'"
                                    data-idcena="'.$DietaLunes['idcena'].'" data-horacena="'.$DietaLunes['hora_cena'].'"
                                    data-dietalunes="'.$DietaLunes['idlunes'].'"
                                    ><i class="glyphicon glyphicon-pencil"></i>
                                </a> 
                            </div>
                        </td>
                        <td> <div class="div-eliminar" id="div-eliminar'.$DietaLunes['idlunes'].'"> <a class="eliminar" data-dieta="'.$DietaLunes['idlunes'].'" id="eliminar'.$DietaLunes['idlunes'].'" href="#"><i class="glyphicon glyphicon-remove"></i></a></div> </td>                    
                    </tr>';
                }
            } catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }
        }
        
        public function mostrarListaDietasDiaSeleccion(){
            try{
                $SQL = $this->CONECCION->prepare("
                                                    SELECT
                                                        DD.iddieta_dia,
                                                        DD.fecha, 
                                                        D.iddesayuno, 
                                                        D.tipo_desayuno, 
                                                        D.descripcion_desayuno,
                                                        D.hora_desayuno,
                                                        A.idalmuerzo, 
                                                        A.hora_armuerzo,
                                                        A.fk_idproteina,
                                                        A.fk_idgrasas, 
                                                        A.fk_idverdura, 
                                                        A.fk_idcereal,
                                                        CU.idcolacion_uno,
                                                        CU.hora_colacion AS hora_colacion_uno,
                                                        CU.fk_idfruta,
                                                        CO.idcomida,
                                                        CO.hora_comida,
                                                        CO.fk_idgrasas,
                                                        CO.fk_idproteina,
                                                        CO.fk_idverdura,
                                                        CO.fk_idcereal,
                                                        CO.fk_idleguminosa,
                                                        CD.idcolacion_dos,
                                                        CD.hora_colacion AS hora_colacion_dos,
                                                        CD.fruta_idfruta,
                                                        CE.idcena,
                                                        CE.hora_cena,
                                                        CE.fk_idtipo_cena,
                                                        CE.fk_idcereal,
                                                        CE.fk_idlacteo,
                                                        CE.fk_idverdura,
                                                        CE.fk_idproteina
                                                    FROM dieta_dia AS DD 
                                                    INNER JOIN desayuno AS D 
                                                    ON D.iddesayuno = DD.fk_iddesayuno
                                                    INNER JOIN almuerzo AS A
                                                    ON A.idalmuerzo = DD.fk_idalmuerzo
                                                    INNER JOIN colacion_uno AS CU
                                                    ON CU.idcolacion_uno = DD.fk_idcolacion_uno
                                                    INNER JOIN comida AS CO
                                                    ON CO.idcomida = DD.fk_idcomida
                                                    INNER JOIN colacion_dos AS CD
                                                    ON CD.idcolacion_dos = DD.fk_idcolacion_dos
                                                    INNER JOIN cena AS CE
                                                    ON CE.idcena = DD.fk_idcena
                                                    WHERE DD.fk_iddesayuno = D.iddesayuno
                                                    AND DD.fk_idalmuerzo = A.idalmuerzo 
                                                    AND DD.fk_idcolacion_uno = CU.idcolacion_uno
                                                    AND DD.fk_idcomida = CO.idcomida
                                                    AND DD.fk_idcolacion_dos = CD.idcolacion_dos
                                                    AND DD.fk_idcena = CE.idcena");
                $SQL->execute();
                while($DietaDia = $SQL->fetch(PDO::FETCH_ASSOC)){
                    echo '                      
                            <div class="col-lg-4 col-sm-4" id="'.$DietaDia['iddieta_dia'].'" id="card">
                                <div class="card card-default">
                                    <div class="card-header">Dieta '.$DietaDia['iddieta_dia'].'</div>
                                    <div class="card-body card-5-7">
                                        <div class="card-center">
                                            <p><strong>Desayuno :</strong> '.date("g:i a", strtotime($DietaDia['hora_desayuno'])).'</p>
                                            <p><strong>Almuerzo :</strong> '.date("g:i a", strtotime($DietaDia['hora_armuerzo'])).'</p>
                                            <p><strong>Colacion :</strong> '.date("g:i a", strtotime($DietaDia['hora_colacion_uno'])).'</p>
                                            <p><strong>Comida :</strong> '.date("g:i a", strtotime($DietaDia['hora_comida'])).'</p>
                                            <p><strong>Colacion :</strong> '.date("g:i a", strtotime($DietaDia['hora_colacion_dos'])).'</p>
                                            <p><strong>Cena :</strong> '.date("g:i a", strtotime($DietaDia['hora_cena'])).'</p>
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">                                        
                                        <button class="btn btn-info add-dieta-dia" data-iddietadia="'.$DietaDia['iddieta_dia'].'">
                                            <i class="glyphicon glyphicon-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                    ';
                }
            } catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }   
         }

        public function insertLunes($dieta, $usuario){
            try{
                $SQL = $this->CONECCION->PREPARE("INSERT INTO 
                                                            lunes (fk_iddieta_dia, uuid, fk_idusuarios) 
                                                        VALUES 
                                                            (:dieta, :uuid, :usuario)");
                
                $uuid = gen_uuid();
                $SQL->bindParam(":dieta",$dieta);
                $SQL->bindParam(":uuid",$uuid);
                $SQL->bindParam(":usuario",$usuario);
                $SQL->execute();
    
                echo "Ok";
                      

            }catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }
        }

        public function deleteLunes($id){
            try{
                $SQL = $this->CONECCION->PREPARE("DELETE FROM lunes WHERE idlunes = ".$id."");
                $SQL->execute();
                echo $id;
            }catch (PDOException $e) {
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                    </div>';
            }                
            
        }

        public function editLunes($id, $dieta){
            try{
                 $SQL = $this->CONECCION->PREPARE("UPDATE lunes SET fk_iddieta_dia =:dieta WHERE idlunes =:id");
                 $SQL->bindParam(":dieta",$dieta);
                 $SQL->bindParam(":id",$id);
                 $SQL->execute();
                                                       
                     echo "Ok";
                       
             }catch (PDOException $e) {
                 echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                         <button type="button" class="close" data-dismiss="alert">x</button>
                       </div>';
             }
        }

/** CRUD para el dia MARTES ***************************************************************************************/
        public function mostrarListaDietaMartes(){
            try{
                $SQL = $this->CONECCION->prepare("
                                                SELECT
                                                    M.idmartes,
                                                    M.fecha,
                                                    DD.iddieta_dia,
                                                    DD.fecha, 
                                                    D.iddesayuno, 
                                                    D.tipo_desayuno, 
                                                    D.descripcion_desayuno,
                                                    D.hora_desayuno,
                                                    A.idalmuerzo, 
                                                    A.hora_armuerzo,
                                                    A.fk_idproteina,
                                                    A.fk_idgrasas, 
                                                    A.fk_idverdura, 
                                                    A.fk_idcereal,
                                                    CU.idcolacion_uno,
                                                    CU.hora_colacion AS hora_colacion_uno,
                                                    CU.fk_idfruta,
                                                    CO.idcomida,
                                                    CO.hora_comida,
                                                    CO.fk_idgrasas,
                                                    CO.fk_idproteina,
                                                    CO.fk_idverdura,
                                                    CO.fk_idcereal,
                                                    CO.fk_idleguminosa,
                                                    CD.idcolacion_dos,
                                                    CD.hora_colacion AS hora_colacion_dos,
                                                    CD.fruta_idfruta,
                                                    CE.idcena,
                                                    CE.hora_cena,
                                                    CE.fk_idtipo_cena,
                                                    CE.fk_idcereal,
                                                    CE.fk_idlacteo,
                                                    CE.fk_idverdura,
                                                    CE.fk_idproteina
                                                 FROM martes AS M
                                                 INNER JOIN dieta_dia AS DD 
                                                 ON DD.iddieta_dia = M.fk_iddieta_dia 
                                                 INNER JOIN desayuno AS D 
                                                 ON D.iddesayuno = DD.fk_iddesayuno
                                                 INNER JOIN almuerzo AS A
                                                 ON A.idalmuerzo = DD.fk_idalmuerzo
                                                 INNER JOIN colacion_uno AS CU
                                                 ON CU.idcolacion_uno = DD.fk_idcolacion_uno
                                                 INNER JOIN comida AS CO
                                                 ON CO.idcomida = DD.fk_idcomida
                                                 INNER JOIN colacion_dos AS CD
                                                 ON CD.idcolacion_dos = DD.fk_idcolacion_dos
                                                 INNER JOIN cena AS CE
                                                 ON CE.idcena = DD.fk_idcena
                                                 WHERE M.fk_iddieta_dia = DD.iddieta_dia
                                                 AND DD.fk_iddesayuno = D.iddesayuno
                                                 AND DD.fk_idalmuerzo = A.idalmuerzo 
                                                 AND DD.fk_idcolacion_uno = CU.idcolacion_uno
                                                 AND DD.fk_idcomida = CO.idcomida
                                                 AND DD.fk_idcolacion_dos = CD.idcolacion_dos
                                                 AND DD.fk_idcena = CE.idcena
                ");
                $SQL->execute();
                while($DietaMartes = $SQL->fetch(PDO::FETCH_ASSOC)){
                    echo '<tr id="'.$DietaMartes['idmartes'].'">
                        <td>'.date("d-m-Y", strtotime($DietaMartes['fecha'])).'</td>
                        <td>'.date("g:i a", strtotime($DietaMartes['hora_desayuno'])).'</td>
                        <td>'.date("g:i a", strtotime($DietaMartes['hora_armuerzo'])).'</td>
                        <td>'.date("g:i a", strtotime($DietaMartes['hora_colacion_uno'])).'</td>
                        <td>'.date("g:i a", strtotime($DietaMartes['hora_comida'])).'</td>
                        <td>'.date("g:i a", strtotime($DietaMartes['hora_colacion_dos'])).'</td>
                        <td>'.date("g:i a", strtotime($DietaMartes['hora_cena'])).'</td>
                        <td> 
                            <div> 
                                <a href="#" class="editar" data-iddesayuno="'.$DietaMartes['iddesayuno'].'" data-horadesayuno="'.$DietaMartes['hora_desayuno'].'"
                                    data-idalmuerzo="'.$DietaMartes['idalmuerzo'].'" data-horaalmuerzo="'.$DietaMartes['hora_armuerzo'].'" 
                                    data-idcolacionuno="'.$DietaMartes['idcolacion_uno'].'" data-horacolacionuno="'.$DietaMartes['hora_colacion_uno'].'"
                                    data-idcomida="'.$DietaMartes['idcomida'].'" data-horacomida="'.$DietaMartes['hora_comida'].'"
                                    data-idcolaciondos="'.$DietaMartes['idcolacion_dos'].'" data-horacolaciondos="'.$DietaMartes['hora_colacion_dos'].'"
                                    data-idcena="'.$DietaMartes['idcena'].'" data-horacena="'.$DietaMartes['hora_cena'].'"
                                    data-dietamartes="'.$DietaMartes['idmartes'].'"
                                    ><i class="glyphicon glyphicon-pencil"></i>
                                </a> 
                            </div>
                        </td>
                        <td> <div class="div-eliminar" id="div-eliminar'.$DietaMartes['idmartes'].'"> <a class="eliminar" data-dieta="'.$DietaMartes['idmartes'].'" id="eliminar'.$DietaMartes['idmartes'].'" href="#"><i class="glyphicon glyphicon-remove"></i></a></div> </td>                    
                    </tr>';
                }
            } catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }
        }

        public function insertMartes($dieta, $usuario){
            try{
                $SQL = $this->CONECCION->PREPARE("INSERT INTO 
                                                            martes (fk_iddieta_dia, uuid, fk_idusuarios) 
                                                        VALUES 
                                                            (:dieta, :uuid, :usuario)");
                
                $uuid = gen_uuid();
                $SQL->bindParam(":dieta",$dieta);
                $SQL->bindParam(":uuid",$uuid);
                $SQL->bindParam(":usuario",$usuario);
                $SQL->execute();
    
                echo "Ok";
                      

            }catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }
        }

        public function deleteMartes($id){
            try{
                $SQL = $this->CONECCION->PREPARE("DELETE FROM martes WHERE idmartes = ".$id."");
                $SQL->execute();
                echo $id;
            }catch (PDOException $e) {
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                    </div>';
            }                
            
        }

        public function editMartes($id, $dieta){
            try{
                 $SQL = $this->CONECCION->PREPARE("UPDATE martes SET fk_iddieta_dia =:dieta WHERE idmartes =:id");
                 $SQL->bindParam(":dieta",$dieta);
                 $SQL->bindParam(":id",$id);
                 $SQL->execute();
                                                       
                     echo "Ok";
                       
             }catch (PDOException $e) {
                 echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                         <button type="button" class="close" data-dismiss="alert">x</button>
                       </div>';
             }
        }

/** CRUD para el dia Miercoles ***************************************************************************************/
        public function mostrarListaDietaMiercoles(){
            try{
                $SQL = $this->CONECCION->prepare("
                                                SELECT
                                                    MI.idmiercoles,
                                                    MI.fecha,
                                                    DD.iddieta_dia,
                                                    DD.fecha, 
                                                    D.iddesayuno, 
                                                    D.tipo_desayuno, 
                                                    D.descripcion_desayuno,
                                                    D.hora_desayuno,
                                                    A.idalmuerzo, 
                                                    A.hora_armuerzo,
                                                    A.fk_idproteina,
                                                    A.fk_idgrasas, 
                                                    A.fk_idverdura, 
                                                    A.fk_idcereal,
                                                    CU.idcolacion_uno,
                                                    CU.hora_colacion AS hora_colacion_uno,
                                                    CU.fk_idfruta,
                                                    CO.idcomida,
                                                    CO.hora_comida,
                                                    CO.fk_idgrasas,
                                                    CO.fk_idproteina,
                                                    CO.fk_idverdura,
                                                    CO.fk_idcereal,
                                                    CO.fk_idleguminosa,
                                                    CD.idcolacion_dos,
                                                    CD.hora_colacion AS hora_colacion_dos,
                                                    CD.fruta_idfruta,
                                                    CE.idcena,
                                                    CE.hora_cena,
                                                    CE.fk_idtipo_cena,
                                                    CE.fk_idcereal,
                                                    CE.fk_idlacteo,
                                                    CE.fk_idverdura,
                                                    CE.fk_idproteina
                                                 FROM miercoles AS MI
                                                 INNER JOIN dieta_dia AS DD 
                                                 ON DD.iddieta_dia = MI.fk_iddieta_dia 
                                                 INNER JOIN desayuno AS D 
                                                 ON D.iddesayuno = DD.fk_iddesayuno
                                                 INNER JOIN almuerzo AS A
                                                 ON A.idalmuerzo = DD.fk_idalmuerzo
                                                 INNER JOIN colacion_uno AS CU
                                                 ON CU.idcolacion_uno = DD.fk_idcolacion_uno
                                                 INNER JOIN comida AS CO
                                                 ON CO.idcomida = DD.fk_idcomida
                                                 INNER JOIN colacion_dos AS CD
                                                 ON CD.idcolacion_dos = DD.fk_idcolacion_dos
                                                 INNER JOIN cena AS CE
                                                 ON CE.idcena = DD.fk_idcena
                                                 WHERE MI.fk_iddieta_dia = DD.iddieta_dia
                                                 AND DD.fk_iddesayuno = D.iddesayuno
                                                 AND DD.fk_idalmuerzo = A.idalmuerzo 
                                                 AND DD.fk_idcolacion_uno = CU.idcolacion_uno
                                                 AND DD.fk_idcomida = CO.idcomida
                                                 AND DD.fk_idcolacion_dos = CD.idcolacion_dos
                                                 AND DD.fk_idcena = CE.idcena
                ");
                $SQL->execute();
                while($DieteMiercoles = $SQL->fetch(PDO::FETCH_ASSOC)){
                    echo '<tr id="'.$DieteMiercoles['idmiercoles'].'">
                        <td>'.date("d-m-Y", strtotime($DieteMiercoles['fecha'])).'</td>
                        <td>'.date("g:i a", strtotime($DieteMiercoles['hora_desayuno'])).'</td>
                        <td>'.date("g:i a", strtotime($DieteMiercoles['hora_armuerzo'])).'</td>
                        <td>'.date("g:i a", strtotime($DieteMiercoles['hora_colacion_uno'])).'</td>
                        <td>'.date("g:i a", strtotime($DieteMiercoles['hora_comida'])).'</td>
                        <td>'.date("g:i a", strtotime($DieteMiercoles['hora_colacion_dos'])).'</td>
                        <td>'.date("g:i a", strtotime($DieteMiercoles['hora_cena'])).'</td>
                        <td> 
                            <div> 
                                <a href="#" class="editar" data-iddesayuno="'.$DieteMiercoles['iddesayuno'].'" data-horadesayuno="'.$DieteMiercoles['hora_desayuno'].'"
                                    data-idalmuerzo="'.$DieteMiercoles['idalmuerzo'].'" data-horaalmuerzo="'.$DieteMiercoles['hora_armuerzo'].'" 
                                    data-idcolacionuno="'.$DieteMiercoles['idcolacion_uno'].'" data-horacolacionuno="'.$DieteMiercoles['hora_colacion_uno'].'"
                                    data-idcomida="'.$DieteMiercoles['idcomida'].'" data-horacomida="'.$DieteMiercoles['hora_comida'].'"
                                    data-idcolaciondos="'.$DieteMiercoles['idcolacion_dos'].'" data-horacolaciondos="'.$DieteMiercoles['hora_colacion_dos'].'"
                                    data-idcena="'.$DieteMiercoles['idcena'].'" data-horacena="'.$DieteMiercoles['hora_cena'].'"
                                    data-dietamiercoles="'.$DieteMiercoles['idmiercoles'].'"
                                    ><i class="glyphicon glyphicon-pencil"></i>
                                </a> 
                            </div>
                        </td>
                        <td> <div class="div-eliminar" id="div-eliminar'.$DieteMiercoles['idmiercoles'].'"> <a class="eliminar" data-dieta="'.$DieteMiercoles['idmiercoles'].'" id="eliminar'.$DieteMiercoles['idmiercoles'].'" href="#"><i class="glyphicon glyphicon-remove"></i></a></div> </td>                    
                    </tr>';
                }
            } catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }
        }

        public function insertMiercoles($dieta, $usuario){
            try{
                $SQL = $this->CONECCION->PREPARE("INSERT INTO 
                                                            miercoles (fk_iddieta_dia, uuid, fk_idusuarios) 
                                                        VALUES 
                                                            (:dieta, :uuid, :usuario)");
                
                $uuid = gen_uuid();
                $SQL->bindParam(":dieta",$dieta);
                $SQL->bindParam(":uuid",$uuid);
                $SQL->bindParam(":usuario",$usuario);
                $SQL->execute();
    
                echo "Ok";
                      

            }catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }
        }

        public function deleteMiercoles($id){
            try{
                $SQL = $this->CONECCION->PREPARE("DELETE FROM miercoles WHERE idmiercoles = ".$id."");
                $SQL->execute();
                echo $id;
            }catch (PDOException $e) {
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                    </div>';
            }                
            
        }

        public function editMiercoles($id, $dieta){
            try{
                 $SQL = $this->CONECCION->PREPARE("UPDATE miercoles SET fk_iddieta_dia =:dieta WHERE idmiercoles =:id");
                 $SQL->bindParam(":dieta",$dieta);
                 $SQL->bindParam(":id",$id);
                 $SQL->execute();
                                                       
                     echo "Ok";
                       
             }catch (PDOException $e) {
                 echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                         <button type="button" class="close" data-dismiss="alert">x</button>
                       </div>';
             }
        }

/** CRUD para el dia JUEVES ***************************************************************************************/

        public function mostrarListaDietaJueves(){
            try{
                $SQL = $this->CONECCION->prepare("
                                                SELECT
                                                    J.idjueves,
                                                    J.fecha,
                                                    DD.iddieta_dia,
                                                    DD.fecha, 
                                                    D.iddesayuno, 
                                                    D.tipo_desayuno, 
                                                    D.descripcion_desayuno,
                                                    D.hora_desayuno,
                                                    A.idalmuerzo, 
                                                    A.hora_armuerzo,
                                                    A.fk_idproteina,
                                                    A.fk_idgrasas, 
                                                    A.fk_idverdura, 
                                                    A.fk_idcereal,
                                                    CU.idcolacion_uno,
                                                    CU.hora_colacion AS hora_colacion_uno,
                                                    CU.fk_idfruta,
                                                    CO.idcomida,
                                                    CO.hora_comida,
                                                    CO.fk_idgrasas,
                                                    CO.fk_idproteina,
                                                    CO.fk_idverdura,
                                                    CO.fk_idcereal,
                                                    CO.fk_idleguminosa,
                                                    CD.idcolacion_dos,
                                                    CD.hora_colacion AS hora_colacion_dos,
                                                    CD.fruta_idfruta,
                                                    CE.idcena,
                                                    CE.hora_cena,
                                                    CE.fk_idtipo_cena,
                                                    CE.fk_idcereal,
                                                    CE.fk_idlacteo,
                                                    CE.fk_idverdura,
                                                    CE.fk_idproteina
                                                 FROM jueves AS J
                                                 INNER JOIN dieta_dia AS DD 
                                                 ON DD.iddieta_dia = J.fk_iddieta_dia 
                                                 INNER JOIN desayuno AS D 
                                                 ON D.iddesayuno = DD.fk_iddesayuno
                                                 INNER JOIN almuerzo AS A
                                                 ON A.idalmuerzo = DD.fk_idalmuerzo
                                                 INNER JOIN colacion_uno AS CU
                                                 ON CU.idcolacion_uno = DD.fk_idcolacion_uno
                                                 INNER JOIN comida AS CO
                                                 ON CO.idcomida = DD.fk_idcomida
                                                 INNER JOIN colacion_dos AS CD
                                                 ON CD.idcolacion_dos = DD.fk_idcolacion_dos
                                                 INNER JOIN cena AS CE
                                                 ON CE.idcena = DD.fk_idcena
                                                 WHERE J.fk_iddieta_dia = DD.iddieta_dia
                                                 AND DD.fk_iddesayuno = D.iddesayuno
                                                 AND DD.fk_idalmuerzo = A.idalmuerzo 
                                                 AND DD.fk_idcolacion_uno = CU.idcolacion_uno
                                                 AND DD.fk_idcomida = CO.idcomida
                                                 AND DD.fk_idcolacion_dos = CD.idcolacion_dos
                                                 AND DD.fk_idcena = CE.idcena
                ");
                $SQL->execute();
                while($DieteJueves = $SQL->fetch(PDO::FETCH_ASSOC)){
                    echo '<tr id="'.$DieteJueves['idjueves'].'">
                        <td>'.date("d-m-Y", strtotime($DieteJueves['fecha'])).'</td>
                        <td>'.date("g:i a", strtotime($DieteJueves['hora_desayuno'])).'</td>
                        <td>'.date("g:i a", strtotime($DieteJueves['hora_armuerzo'])).'</td>
                        <td>'.date("g:i a", strtotime($DieteJueves['hora_colacion_uno'])).'</td>
                        <td>'.date("g:i a", strtotime($DieteJueves['hora_comida'])).'</td>
                        <td>'.date("g:i a", strtotime($DieteJueves['hora_colacion_dos'])).'</td>
                        <td>'.date("g:i a", strtotime($DieteJueves['hora_cena'])).'</td>
                        <td> 
                            <div> 
                                <a href="#" class="editar" data-iddesayuno="'.$DieteJueves['iddesayuno'].'" data-horadesayuno="'.$DieteJueves['hora_desayuno'].'"
                                    data-idalmuerzo="'.$DieteJueves['idalmuerzo'].'" data-horaalmuerzo="'.$DieteJueves['hora_armuerzo'].'" 
                                    data-idcolacionuno="'.$DieteJueves['idcolacion_uno'].'" data-horacolacionuno="'.$DieteJueves['hora_colacion_uno'].'"
                                    data-idcomida="'.$DieteJueves['idcomida'].'" data-horacomida="'.$DieteJueves['hora_comida'].'"
                                    data-idcolaciondos="'.$DieteJueves['idcolacion_dos'].'" data-horacolaciondos="'.$DieteJueves['hora_colacion_dos'].'"
                                    data-idcena="'.$DieteJueves['idcena'].'" data-horacena="'.$DieteJueves['hora_cena'].'"
                                    data-dietajueves="'.$DieteJueves['idjueves'].'"
                                    ><i class="glyphicon glyphicon-pencil"></i>
                                </a> 
                            </div>
                        </td>
                        <td> <div class="div-eliminar" id="div-eliminar'.$DieteJueves['idjueves'].'"> <a class="eliminar" data-dieta="'.$DieteJueves['idjueves'].'" id="eliminar'.$DieteJueves['idjueves'].'" href="#"><i class="glyphicon glyphicon-remove"></i></a></div> </td>                    
                    </tr>';
                }
            } catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }
        }

        public function insertJueves($dieta, $usuario){
            try{
                $SQL = $this->CONECCION->PREPARE("INSERT INTO 
                                                            jueves (fk_iddieta_dia, uuid, fk_idusuarios) 
                                                        VALUES 
                                                            (:dieta, :uuid, :usuario)");
                
                $uuid = gen_uuid();
                $SQL->bindParam(":dieta",$dieta);
                $SQL->bindParam(":uuid",$uuid);
                $SQL->bindParam(":usuario",$usuario);
                $SQL->execute();
    
                echo "Ok";
                      

            }catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }
        }

        public function deleteJueves($id){
            try{
                $SQL = $this->CONECCION->PREPARE("DELETE FROM jueves WHERE idjueves = ".$id."");
                $SQL->execute();
                echo $id;
            }catch (PDOException $e) {
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                    </div>';
            }                
            
        }

        public function editJueves($id, $dieta){
            try{
                 $SQL = $this->CONECCION->PREPARE("UPDATE jueves SET fk_iddieta_dia =:dieta WHERE idjueves =:id");
                 $SQL->bindParam(":dieta",$dieta);
                 $SQL->bindParam(":id",$id);
                 $SQL->execute();
                                                       
                     echo "Ok";
                       
             }catch (PDOException $e) {
                 echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                         <button type="button" class="close" data-dismiss="alert">x</button>
                       </div>';
             }
        }

/** CRUD para el dia VIERNES ***************************************************************************************/
        public function mostrarListaDietaViernes(){
            try{
                $SQL = $this->CONECCION->prepare("
                                                SELECT
                                                    V.idviernes,
                                                    V.fecha,
                                                    DD.iddieta_dia,
                                                    DD.fecha, 
                                                    D.iddesayuno, 
                                                    D.tipo_desayuno, 
                                                    D.descripcion_desayuno,
                                                    D.hora_desayuno,
                                                    A.idalmuerzo, 
                                                    A.hora_armuerzo,
                                                    A.fk_idproteina,
                                                    A.fk_idgrasas, 
                                                    A.fk_idverdura, 
                                                    A.fk_idcereal,
                                                    CU.idcolacion_uno,
                                                    CU.hora_colacion AS hora_colacion_uno,
                                                    CU.fk_idfruta,
                                                    CO.idcomida,
                                                    CO.hora_comida,
                                                    CO.fk_idgrasas,
                                                    CO.fk_idproteina,
                                                    CO.fk_idverdura,
                                                    CO.fk_idcereal,
                                                    CO.fk_idleguminosa,
                                                    CD.idcolacion_dos,
                                                    CD.hora_colacion AS hora_colacion_dos,
                                                    CD.fruta_idfruta,
                                                    CE.idcena,
                                                    CE.hora_cena,
                                                    CE.fk_idtipo_cena,
                                                    CE.fk_idcereal,
                                                    CE.fk_idlacteo,
                                                    CE.fk_idverdura,
                                                    CE.fk_idproteina
                                                 FROM viernes AS V
                                                 INNER JOIN dieta_dia AS DD 
                                                 ON DD.iddieta_dia = V.fk_iddieta_dia 
                                                 INNER JOIN desayuno AS D 
                                                 ON D.iddesayuno = DD.fk_iddesayuno
                                                 INNER JOIN almuerzo AS A
                                                 ON A.idalmuerzo = DD.fk_idalmuerzo
                                                 INNER JOIN colacion_uno AS CU
                                                 ON CU.idcolacion_uno = DD.fk_idcolacion_uno
                                                 INNER JOIN comida AS CO
                                                 ON CO.idcomida = DD.fk_idcomida
                                                 INNER JOIN colacion_dos AS CD
                                                 ON CD.idcolacion_dos = DD.fk_idcolacion_dos
                                                 INNER JOIN cena AS CE
                                                 ON CE.idcena = DD.fk_idcena
                                                 WHERE V.fk_iddieta_dia = DD.iddieta_dia
                                                 AND DD.fk_iddesayuno = D.iddesayuno
                                                 AND DD.fk_idalmuerzo = A.idalmuerzo 
                                                 AND DD.fk_idcolacion_uno = CU.idcolacion_uno
                                                 AND DD.fk_idcomida = CO.idcomida
                                                 AND DD.fk_idcolacion_dos = CD.idcolacion_dos
                                                 AND DD.fk_idcena = CE.idcena
                ");
                $SQL->execute();
                while($DietaViernes = $SQL->fetch(PDO::FETCH_ASSOC)){
                    echo '<tr id="'.$DietaViernes['idviernes'].'">
                        <td>'.date("d-m-Y", strtotime($DietaViernes['fecha'])).'</td>
                        <td>'.date("g:i a", strtotime($DietaViernes['hora_desayuno'])).'</td>
                        <td>'.date("g:i a", strtotime($DietaViernes['hora_armuerzo'])).'</td>
                        <td>'.date("g:i a", strtotime($DietaViernes['hora_colacion_uno'])).'</td>
                        <td>'.date("g:i a", strtotime($DietaViernes['hora_comida'])).'</td>
                        <td>'.date("g:i a", strtotime($DietaViernes['hora_colacion_dos'])).'</td>
                        <td>'.date("g:i a", strtotime($DietaViernes['hora_cena'])).'</td>
                        <td> 
                            <div> 
                                <a href="#" class="editar" data-iddesayuno="'.$DietaViernes['iddesayuno'].'" data-horadesayuno="'.$DietaViernes['hora_desayuno'].'"
                                    data-idalmuerzo="'.$DietaViernes['idalmuerzo'].'" data-horaalmuerzo="'.$DietaViernes['hora_armuerzo'].'" 
                                    data-idcolacionuno="'.$DietaViernes['idcolacion_uno'].'" data-horacolacionuno="'.$DietaViernes['hora_colacion_uno'].'"
                                    data-idcomida="'.$DietaViernes['idcomida'].'" data-horacomida="'.$DietaViernes['hora_comida'].'"
                                    data-idcolaciondos="'.$DietaViernes['idcolacion_dos'].'" data-horacolaciondos="'.$DietaViernes['hora_colacion_dos'].'"
                                    data-idcena="'.$DietaViernes['idcena'].'" data-horacena="'.$DietaViernes['hora_cena'].'"
                                    data-dietaviernes="'.$DietaViernes['idviernes'].'"
                                    ><i class="glyphicon glyphicon-pencil"></i>
                                </a> 
                            </div>
                        </td>
                        <td> <div class="div-eliminar" id="div-eliminar'.$DietaViernes['idviernes'].'"> <a class="eliminar" data-dieta="'.$DietaViernes['idviernes'].'" id="eliminar'.$DietaViernes['idviernes'].'" href="#"><i class="glyphicon glyphicon-remove"></i></a></div> </td>                    
                    </tr>';
                }
            } catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }
        }

        public function insertViernes($dieta, $usuario){
            try{
                $SQL = $this->CONECCION->PREPARE("INSERT INTO 
                                                            viernes (fk_iddieta_dia, uuid, fk_idusuarios) 
                                                        VALUES 
                                                            (:dieta, :uuid, :usuario)");
                
                $uuid = gen_uuid();
                $SQL->bindParam(":dieta",$dieta);
                $SQL->bindParam(":uuid",$uuid);
                $SQL->bindParam(":usuario",$usuario);
                $SQL->execute();
    
                echo "Ok";
                      

            }catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }
        }

        public function deleteViernes($id){
            try{
                $SQL = $this->CONECCION->PREPARE("DELETE FROM viernes WHERE idviernes = ".$id."");
                $SQL->execute();
                echo $id;
            }catch (PDOException $e) {
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                    </div>';
            }                
            
        }

        public function editViernes($id, $dieta){
            try{
                 $SQL = $this->CONECCION->PREPARE("UPDATE viernes SET fk_iddieta_dia =:dieta WHERE idviernes =:id");
                 $SQL->bindParam(":dieta",$dieta);
                 $SQL->bindParam(":id",$id);
                 $SQL->execute();
                                                       
                     echo "Ok";
                       
             }catch (PDOException $e) {
                 echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                         <button type="button" class="close" data-dismiss="alert">x</button>
                       </div>';
             }
        }     


/** CRUD para el dia SABADO ***************************************************************************************/
        public function mostrarListaDietaSabado(){
            try{
                $SQL = $this->CONECCION->prepare("
                                                SELECT
                                                    S.idsabado,
                                                    S.fecha,
                                                    DD.iddieta_dia,
                                                    DD.fecha, 
                                                    D.iddesayuno, 
                                                    D.tipo_desayuno, 
                                                    D.descripcion_desayuno,
                                                    D.hora_desayuno,
                                                    A.idalmuerzo, 
                                                    A.hora_armuerzo,
                                                    A.fk_idproteina,
                                                    A.fk_idgrasas, 
                                                    A.fk_idverdura, 
                                                    A.fk_idcereal,
                                                    CU.idcolacion_uno,
                                                    CU.hora_colacion AS hora_colacion_uno,
                                                    CU.fk_idfruta,
                                                    CO.idcomida,
                                                    CO.hora_comida,
                                                    CO.fk_idgrasas,
                                                    CO.fk_idproteina,
                                                    CO.fk_idverdura,
                                                    CO.fk_idcereal,
                                                    CO.fk_idleguminosa,
                                                    CD.idcolacion_dos,
                                                    CD.hora_colacion AS hora_colacion_dos,
                                                    CD.fruta_idfruta,
                                                    CE.idcena,
                                                    CE.hora_cena,
                                                    CE.fk_idtipo_cena,
                                                    CE.fk_idcereal,
                                                    CE.fk_idlacteo,
                                                    CE.fk_idverdura,
                                                    CE.fk_idproteina
                                                 FROM sabado AS S
                                                 INNER JOIN dieta_dia AS DD 
                                                 ON DD.iddieta_dia = S.fk_iddieta_dia 
                                                 INNER JOIN desayuno AS D 
                                                 ON D.iddesayuno = DD.fk_iddesayuno
                                                 INNER JOIN almuerzo AS A
                                                 ON A.idalmuerzo = DD.fk_idalmuerzo
                                                 INNER JOIN colacion_uno AS CU
                                                 ON CU.idcolacion_uno = DD.fk_idcolacion_uno
                                                 INNER JOIN comida AS CO
                                                 ON CO.idcomida = DD.fk_idcomida
                                                 INNER JOIN colacion_dos AS CD
                                                 ON CD.idcolacion_dos = DD.fk_idcolacion_dos
                                                 INNER JOIN cena AS CE
                                                 ON CE.idcena = DD.fk_idcena
                                                 WHERE S.fk_iddieta_dia = DD.iddieta_dia
                                                 AND DD.fk_iddesayuno = D.iddesayuno
                                                 AND DD.fk_idalmuerzo = A.idalmuerzo 
                                                 AND DD.fk_idcolacion_uno = CU.idcolacion_uno
                                                 AND DD.fk_idcomida = CO.idcomida
                                                 AND DD.fk_idcolacion_dos = CD.idcolacion_dos
                                                 AND DD.fk_idcena = CE.idcena
                ");
                $SQL->execute();
                while($DietaSabado = $SQL->fetch(PDO::FETCH_ASSOC)){
                    echo '<tr id="'.$DietaSabado['idsabado'].'">
                        <td>'.date("d-m-Y", strtotime($DietaSabado['fecha'])).'</td>
                        <td>'.date("g:i a", strtotime($DietaSabado['hora_desayuno'])).'</td>
                        <td>'.date("g:i a", strtotime($DietaSabado['hora_armuerzo'])).'</td>
                        <td>'.date("g:i a", strtotime($DietaSabado['hora_colacion_uno'])).'</td>
                        <td>'.date("g:i a", strtotime($DietaSabado['hora_comida'])).'</td>
                        <td>'.date("g:i a", strtotime($DietaSabado['hora_colacion_dos'])).'</td>
                        <td>'.date("g:i a", strtotime($DietaSabado['hora_cena'])).'</td>
                        <td> 
                            <div> 
                                <a href="#" class="editar" data-iddesayuno="'.$DietaSabado['iddesayuno'].'" data-horadesayuno="'.$DietaSabado['hora_desayuno'].'"
                                    data-idalmuerzo="'.$DietaSabado['idalmuerzo'].'" data-horaalmuerzo="'.$DietaSabado['hora_armuerzo'].'" 
                                    data-idcolacionuno="'.$DietaSabado['idcolacion_uno'].'" data-horacolacionuno="'.$DietaSabado['hora_colacion_uno'].'"
                                    data-idcomida="'.$DietaSabado['idcomida'].'" data-horacomida="'.$DietaSabado['hora_comida'].'"
                                    data-idcolaciondos="'.$DietaSabado['idcolacion_dos'].'" data-horacolaciondos="'.$DietaSabado['hora_colacion_dos'].'"
                                    data-idcena="'.$DietaSabado['idcena'].'" data-horacena="'.$DietaSabado['hora_cena'].'"
                                    data-dietasabado="'.$DietaSabado['idsabado'].'"
                                    ><i class="glyphicon glyphicon-pencil"></i>
                                </a> 
                            </div>
                        </td>
                        <td> <div class="div-eliminar" id="div-eliminar'.$DietaSabado['idsabado'].'"> <a class="eliminar" data-dieta="'.$DietaSabado['idsabado'].'" id="eliminar'.$DietaSabado['idsabado'].'" href="#"><i class="glyphicon glyphicon-remove"></i></a></div> </td>                    
                    </tr>';
                }
            } catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }
        }

        public function insertSabado($dieta, $usuario){
            try{
                $SQL = $this->CONECCION->PREPARE("INSERT INTO 
                                                            sabado (fk_iddieta_dia, uuid, fk_idusarios) 
                                                        VALUES 
                                                            (:dieta, :uuid, :usuario)");
                
                $uuid = gen_uuid();
                $SQL->bindParam(":dieta",$dieta);
                $SQL->bindParam(":uuid",$uuid);
                $SQL->bindParam(":usuario",$usuario);
                $SQL->execute();
    
                echo "Ok";
                      

            }catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }
        }

        public function deleteSabado($id){
            try{
                $SQL = $this->CONECCION->PREPARE("DELETE FROM sabado WHERE idsabado = ".$id."");
                $SQL->execute();
                echo $id;
            }catch (PDOException $e) {
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                    </div>';
            }                
            
        }

        public function editSabado($id, $dieta){
            try{
                 $SQL = $this->CONECCION->PREPARE("UPDATE sabado SET fk_iddieta_dia =:dieta WHERE idsabado =:id");
                 $SQL->bindParam(":dieta",$dieta);
                 $SQL->bindParam(":id",$id);
                 $SQL->execute();
                                                       
                     echo "Ok";
                       
             }catch (PDOException $e) {
                 echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                         <button type="button" class="close" data-dismiss="alert">x</button>
                       </div>';
             }
        }
       

        /** CRUD para el dia DOMINGO ***************************************************************************************/
        public function mostrarListaDietaDomingo(){
            try{
                $SQL = $this->CONECCION->prepare("
                                                SELECT
                                                    DO.iddomingo,
                                                    DO.fecha,
                                                    DD.iddieta_dia,
                                                    DD.fecha, 
                                                    D.iddesayuno, 
                                                    D.tipo_desayuno, 
                                                    D.descripcion_desayuno,
                                                    D.hora_desayuno,
                                                    A.idalmuerzo, 
                                                    A.hora_armuerzo,
                                                    A.fk_idproteina,
                                                    A.fk_idgrasas, 
                                                    A.fk_idverdura, 
                                                    A.fk_idcereal,
                                                    CU.idcolacion_uno,
                                                    CU.hora_colacion AS hora_colacion_uno,
                                                    CU.fk_idfruta,
                                                    CO.idcomida,
                                                    CO.hora_comida,
                                                    CO.fk_idgrasas,
                                                    CO.fk_idproteina,
                                                    CO.fk_idverdura,
                                                    CO.fk_idcereal,
                                                    CO.fk_idleguminosa,
                                                    CD.idcolacion_dos,
                                                    CD.hora_colacion AS hora_colacion_dos,
                                                    CD.fruta_idfruta,
                                                    CE.idcena,
                                                    CE.hora_cena,
                                                    CE.fk_idtipo_cena,
                                                    CE.fk_idcereal,
                                                    CE.fk_idlacteo,
                                                    CE.fk_idverdura,
                                                    CE.fk_idproteina
                                                 FROM domingo AS DO
                                                 INNER JOIN dieta_dia AS DD 
                                                 ON DD.iddieta_dia = DO.fk_iddieta_dia 
                                                 INNER JOIN desayuno AS D 
                                                 ON D.iddesayuno = DD.fk_iddesayuno
                                                 INNER JOIN almuerzo AS A
                                                 ON A.idalmuerzo = DD.fk_idalmuerzo
                                                 INNER JOIN colacion_uno AS CU
                                                 ON CU.idcolacion_uno = DD.fk_idcolacion_uno
                                                 INNER JOIN comida AS CO
                                                 ON CO.idcomida = DD.fk_idcomida
                                                 INNER JOIN colacion_dos AS CD
                                                 ON CD.idcolacion_dos = DD.fk_idcolacion_dos
                                                 INNER JOIN cena AS CE
                                                 ON CE.idcena = DD.fk_idcena
                                                 WHERE DO.fk_iddieta_dia = DD.iddieta_dia
                                                 AND DD.fk_iddesayuno = D.iddesayuno
                                                 AND DD.fk_idalmuerzo = A.idalmuerzo 
                                                 AND DD.fk_idcolacion_uno = CU.idcolacion_uno
                                                 AND DD.fk_idcomida = CO.idcomida
                                                 AND DD.fk_idcolacion_dos = CD.idcolacion_dos
                                                 AND DD.fk_idcena = CE.idcena
                ");
                $SQL->execute();
                while($DietaDomingo = $SQL->fetch(PDO::FETCH_ASSOC)){
                    echo '<tr id="'.$DietaDomingo['iddomingo'].'">
                        <td>'.date("d-m-Y", strtotime($DietaDomingo['fecha'])).'</td>
                        <td>'.date("g:i a", strtotime($DietaDomingo['hora_desayuno'])).'</td>
                        <td>'.date("g:i a", strtotime($DietaDomingo['hora_armuerzo'])).'</td>
                        <td>'.date("g:i a", strtotime($DietaDomingo['hora_colacion_uno'])).'</td>
                        <td>'.date("g:i a", strtotime($DietaDomingo['hora_comida'])).'</td>
                        <td>'.date("g:i a", strtotime($DietaDomingo['hora_colacion_dos'])).'</td>
                        <td>'.date("g:i a", strtotime($DietaDomingo['hora_cena'])).'</td>
                        <td> 
                            <div> 
                                <a href="#" class="editar" data-iddesayuno="'.$DietaDomingo['iddesayuno'].'" data-horadesayuno="'.$DietaDomingo['hora_desayuno'].'"
                                    data-idalmuerzo="'.$DietaDomingo['idalmuerzo'].'" data-horaalmuerzo="'.$DietaDomingo['hora_armuerzo'].'" 
                                    data-idcolacionuno="'.$DietaDomingo['idcolacion_uno'].'" data-horacolacionuno="'.$DietaDomingo['hora_colacion_uno'].'"
                                    data-idcomida="'.$DietaDomingo['idcomida'].'" data-horacomida="'.$DietaDomingo['hora_comida'].'"
                                    data-idcolaciondos="'.$DietaDomingo['idcolacion_dos'].'" data-horacolaciondos="'.$DietaDomingo['hora_colacion_dos'].'"
                                    data-idcena="'.$DietaDomingo['idcena'].'" data-horacena="'.$DietaDomingo['hora_cena'].'"
                                    data-dietadomingo="'.$DietaDomingo['iddomingo'].'"
                                    ><i class="glyphicon glyphicon-pencil"></i>
                                </a> 
                            </div>
                        </td>
                        <td> <div class="div-eliminar" id="div-eliminar'.$DietaDomingo['iddomingo'].'"> <a class="eliminar" data-dieta="'.$DietaDomingo['iddomingo'].'" id="eliminar'.$DietaDomingo['iddomingo'].'" href="#"><i class="glyphicon glyphicon-remove"></i></a></div> </td>                    
                    </tr>';
                }
            } catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }
        }

        public function insertDomingo($dieta, $usuario){
            try{
                $SQL = $this->CONECCION->PREPARE("INSERT INTO 
                                                            domingo (fk_iddieta_dia, uuid, fk_idusuarios) 
                                                        VALUES 
                                                            (:dieta, :uuid, :usuario)");
                
                $uuid = gen_uuid();
                $SQL->bindParam(":dieta",$dieta);
                $SQL->bindParam(":uuid",$uuid);
                $SQL->bindParam(":usuario",$usuario);
                $SQL->execute();
    
                echo "Ok";
                      

            }catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }
        }

        public function deleteDomingo($id){
            try{
                $SQL = $this->CONECCION->PREPARE("DELETE FROM domingo WHERE iddomingo = ".$id."");
                $SQL->execute();
                echo $id;
            }catch (PDOException $e) {
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                    </div>';
            }                
            
        }

        public function editDomingo($id, $dieta){
            try{
                 $SQL = $this->CONECCION->PREPARE("UPDATE domingo SET fk_iddieta_dia =:dieta WHERE iddomingo =:id");
                 $SQL->bindParam(":dieta",$dieta);
                 $SQL->bindParam(":id",$id);
                 $SQL->execute();
                                                       
                     echo "Ok";
                       
             }catch (PDOException $e) {
                 echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                         <button type="button" class="close" data-dismiss="alert">x</button>
                       </div>';
             }
        }


/** Crud de SEMANA *************************************************************************************************************************************/
        public function mostrarListaSemana(){
            try{
                $SQL = $this->CONECCION->prepare("SELECT 
                                                        SE.idsemana,
                                                        DI.iddieta,
                                                        DI.nombre_dieta,
                                                        DI.semanas_dieta,
                                                        LU.idlunes,
                                                        LU.fecha AS fecha_lunes,
                                                        MA.idmartes,
                                                        MA.fecha AS fecha_martes,
                                                        MI.idmiercoles,
                                                        MI.fecha AS fecha_miercoles,
                                                        JU.idjueves,
                                                        JU.fecha AS fecha_jueves,
                                                        VI.idviernes,
                                                        VI.fecha AS fecha_viernes,
                                                        SA.idsabado,
                                                        SA.fecha AS fecha_sabado,
                                                        DO.iddomingo,
                                                        DO.fecha AS fecha_domingo,
                                                        U.idusuarios,
                                                        U.nombre_usuario
                                                FROM semana AS SE
                                                INNER JOIN dieta AS DI
                                                ON DI.iddieta = SE.fk_iddieta
                                                INNER JOIN lunes AS LU 
                                                ON LU.idlunes = SE.fk_idlunes
                                                INNER JOIN martes AS MA
                                                ON MA.idmartes = SE.fk_idmartes
                                                INNER JOIN miercoles AS MI 
                                                ON MI.idmiercoles = SE.fk_idmiercoles
                                                INNER JOIN jueves AS JU
                                                ON JU.idjueves = SE.fk_idjueves
                                                INNER JOIN  viernes AS VI
                                                ON VI.idviernes = SE.fk_idviernes
                                                INNER JOIN sabado AS SA
                                                ON SA.idsabado = SE.fk_idsabado
                                                INNER JOIN domingo AS DO
                                                ON DO.iddomingo = SE.fk_iddomingo
                                                INNER JOIN usuarios AS U
                                                ON U.idusuarios = SE.fk_idusuarios
                                                
                                                WHERE SE.fk_iddieta = DI.iddieta
                                                AND SE.fk_idlunes = LU.idlunes
                                                AND SE.fk_idmartes = MA.idmartes
                                                AND SE.fk_idmiercoles = MI.idmiercoles
                                                AND SE.fk_idjueves = JU.idjueves
                                                AND SE.fk_idviernes = VI.idviernes
                                                AND SE.fk_idsabado = SA.idsabado
                                                AND SE.fk_iddomingo = DO.iddomingo
                                                AND SE.fk_idusuarios = U.idusuarios");
                $SQL->execute();
                while($DietaSemeana = $SQL->fetch(PDO::FETCH_ASSOC)){
                    echo '<tr id="'.$DietaSemeana['idsemana'].'">
                        <td>'.date("d-m-Y", strtotime($DietaSemeana['fecha_lunes'])).'</td>
                        <td>'.date("d-m-Y", strtotime($DietaSemeana['fecha_martes'])).'</td>
                        <td>'.date("d-m-Y", strtotime($DietaSemeana['fecha_miercoles'])).'</td>
                        <td>'.date("d-m-Y", strtotime($DietaSemeana['fecha_jueves'])).'</td>
                        <td>'.date("d-m-Y", strtotime($DietaSemeana['fecha_viernes'])).'</td>
                        <td>'.date("d-m-Y", strtotime($DietaSemeana['fecha_sabado'])).'</td>
                        <td>'.date("d-m-Y", strtotime($DietaSemeana['fecha_domingo'])).'</td>
                        <td>'.$DietaSemeana['nombre_usuario'].'</td> 
                        <td> 
                            <div> 
                                <a href="#" class="editar" data-lunes="'.$DietaSemeana['idlunes'].'" data-martes="'.$DietaSemeana['idmartes'].'"
                                    data-miercoles="'.$DietaSemeana['idmiercoles'].'" data-jueves="'.$DietaSemeana['idjueves'].'" 
                                    data-viernes="'.$DietaSemeana['idviernes'].'" data-sabado="'.$DietaSemeana['idsabado'].'"
                                    data-domingo="'.$DietaSemeana['iddomingo'].'" data-idusuario="'.$DietaSemeana['idusuarios'].'"
                                    data-nombreusuario="'.$DietaSemeana['nombre_usuario'].'" data-semana="'.$DietaSemeana['idsemana'].'"
                                    ><i class="glyphicon glyphicon-pencil"></i>
                                </a> 
                            </div>
                        </td>
                        <td> <div class="div-eliminar" id="div-eliminar'.$DietaSemeana['idsemana'].'"> <a class="eliminar" data-semana="'.$DietaSemeana['idsemana'].'" id="eliminar'.$DietaSemeana['idsemana'].'" href="#"><i class="glyphicon glyphicon-remove"></i></a></div> </td>                    
                    </tr>';
                }
            }catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                         <button type="button" class="close" data-dismiss="alert">x</button>
                       </div>';
            }
        }


        public function insertDietaSemana($dieta, $lunes, $martes, $miercoles, $jueves, $viernes, $sabado, $domingo, $usuario){
            try{
                $SQL = $this->CONECCION->PREPARE("INSERT INTO 
                                                            semana (fk_iddieta, fk_idlunes, fk_idmartes, fk_idmiercoles, fk_idjueves, fk_idviernes, fk_idsabado, fk_iddomingo, fk_idusuarios, uuid) 
                                                        VALUES 
                                                            (:dieta, :lunes, :martes, :miercoles, :jueves, :viernes, :sabado, :domingo, :usuario, :uuid)");
                
                $uuid = gen_uuid();
                $SQL->bindParam(":dieta",$dieta);
                $SQL->bindParam(":lunes",$lunes);
                $SQL->bindParam(":martes",$martes);
                $SQL->bindParam(":miercoles",$miercoles);
                $SQL->bindParam(":jueves",$jueves);
                $SQL->bindParam(":viernes",$viernes);
                $SQL->bindParam(":sabado",$sabado);
                $SQL->bindParam(":domingo",$domingo);
                $SQL->bindParam(":usuario",$usuario);
                $SQL->bindParam(":uuid",$uuid);
                $SQL->execute();
    
                echo "Ok";
                      

            }catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }
        }



        public function deleteDietaSemana($id){
            try{
                $SQL = $this->CONECCION->PREPARE("DELETE FROM semana WHERE idsemana = ".$id."");
                $SQL->execute();
                echo $id;
            }catch (PDOException $e) {
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                    </div>';
            }                
            
        }


        public function updateDietaSemana($id, $lunes, $martes, $miercoles, $jueves, $viernes, $sabado, $domingo){
            try{
                $SQL = $this->CONECCION->PREPARE("UPDATE 
                                                        semana
                                                     SET   
                                                        fk_idlunes =:lunes, 
                                                        fk_idmartes =:martes,
                                                        fk_idmiercoles =:miercoles,
                                                        fk_idjueves =:jueves,
                                                        fk_idviernes =:viernes,
                                                        fk_idsabado =:sabado,
                                                        fk_iddomingo =:domingo                                                        
                                                   WHERE idsemana =:id");
                $SQL->bindParam(":lunes",$lunes);
                $SQL->bindParam(":martes",$martes);
                $SQL->bindParam(":miercoles",$miercoles);
                $SQL->bindParam(":jueves",$jueves);
                $SQL->bindParam(":viernes",$viernes);
                $SQL->bindParam(":sabado",$sabado);
                $SQL->bindParam(":domingo",$domingo);
                $SQL->bindParam(":id",$id);
                $SQL->execute();
                                                      
                    echo "Ok";
                      
            }catch (PDOException $e) {
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }
        }

        public function mostrarListaDietasLunesSelection(){
            try{
                $SQL = $this->CONECCION->prepare("SELECT
                                                        LU.idlunes,
                                                        LU.fecha AS fecha_lunes,
                                                        DD.iddieta_dia,
                                                        DD.fecha AS fecha_dietaDia, 
                                                        D.iddesayuno, 
                                                        D.tipo_desayuno, 
                                                        D.descripcion_desayuno,
                                                        D.hora_desayuno,
                                                        A.idalmuerzo, 
                                                        A.hora_armuerzo,
                                                        A.fk_idproteina,
                                                        A.fk_idgrasas, 
                                                        A.fk_idverdura, 
                                                        A.fk_idcereal,
                                                        CU.idcolacion_uno,
                                                        CU.hora_colacion AS hora_colacion_uno,
                                                        CU.fk_idfruta,
                                                        CO.idcomida,
                                                        CO.hora_comida,
                                                        CO.fk_idgrasas,
                                                        CO.fk_idproteina,
                                                        CO.fk_idverdura,
                                                        CO.fk_idcereal,
                                                        CO.fk_idleguminosa,
                                                        CD.idcolacion_dos,
                                                        CD.hora_colacion AS hora_colacion_dos,
                                                        CD.fruta_idfruta,
                                                        CE.idcena,
                                                        CE.hora_cena,
                                                        CE.fk_idtipo_cena,
                                                        CE.fk_idcereal,
                                                        CE.fk_idlacteo,
                                                        CE.fk_idverdura,
                                                        CE.fk_idproteina
                                                    FROM lunes AS LU
                                                    INNER JOIN dieta_dia AS DD 
                                                    ON DD.iddieta_dia = LU.fk_iddieta_dia
                                                    INNER JOIN desayuno AS D 
                                                    ON D.iddesayuno = DD.fk_iddesayuno
                                                    INNER JOIN almuerzo AS A
                                                    ON A.idalmuerzo = DD.fk_idalmuerzo
                                                    INNER JOIN colacion_uno AS CU
                                                    ON CU.idcolacion_uno = DD.fk_idcolacion_uno
                                                    INNER JOIN comida AS CO
                                                    ON CO.idcomida = DD.fk_idcomida
                                                    INNER JOIN colacion_dos AS CD
                                                    ON CD.idcolacion_dos = DD.fk_idcolacion_dos
                                                    INNER JOIN cena AS CE
                                                    ON CE.idcena = DD.fk_idcena
                                                    WHERE LU.fk_iddieta_dia = DD.iddieta_dia
                                                    AND DD.fk_iddesayuno = D.iddesayuno
                                                    AND DD.fk_idalmuerzo = A.idalmuerzo 
                                                    AND DD.fk_idcolacion_uno = CU.idcolacion_uno
                                                    AND DD.fk_idcomida = CO.idcomida
                                                    AND DD.fk_idcolacion_dos = CD.idcolacion_dos
                                                    AND DD.fk_idcena = CE.idcena");
                $SQL->execute();
                while($DietaLunes = $SQL->fetch(PDO::FETCH_ASSOC)){
                    echo '                      
                            <div class="col-lg-4 col-sm-4" id="'.$DietaLunes['idlunes'].'" id="card">
                                <div class="card card-default">
                                    <div class="card-header">Dieta del Lunes '.date("d-m-Y", strtotime($DietaLunes['fecha_lunes'])).'</div>
                                    <div class="card-body card-5-7">
                                        <div class="card-center">
                                            <p><strong>Desayuno :</strong> '.date("g:i a", strtotime($DietaLunes['hora_desayuno'])).'</p>
                                            <p><strong>Almuerzo :</strong> '.date("g:i a", strtotime($DietaLunes['hora_armuerzo'])).'</p>
                                            <p><strong>Colacion :</strong> '.date("g:i a", strtotime($DietaLunes['hora_colacion_uno'])).'</p>
                                            <p><strong>Comida :</strong> '.date("g:i a", strtotime($DietaLunes['hora_comida'])).'</p>
                                            <p><strong>Colacion :</strong> '.date("g:i a", strtotime($DietaLunes['hora_colacion_dos'])).'</p>
                                            <p><strong>Cena :</strong> '.date("g:i a", strtotime($DietaLunes['hora_cena'])).'</p>
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">                                        
                                        <button class="btn btn-info add-dieta-lunes" data-idlunes="'.$DietaLunes['idlunes'].'">
                                            <i class="glyphicon glyphicon-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                    ';
                }
            } catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }   
         }


         public function mostrarListaDietasMartesSelection(){
            try{
                $SQL = $this->CONECCION->prepare("SELECT
                                                        MA.idmartes,
                                                        MA.fecha AS fecha_martes,
                                                        DD.iddieta_dia,
                                                        DD.fecha AS fecha_dietaDia, 
                                                        D.iddesayuno, 
                                                        D.tipo_desayuno, 
                                                        D.descripcion_desayuno,
                                                        D.hora_desayuno,
                                                        A.idalmuerzo, 
                                                        A.hora_armuerzo,
                                                        A.fk_idproteina,
                                                        A.fk_idgrasas, 
                                                        A.fk_idverdura, 
                                                        A.fk_idcereal,
                                                        CU.idcolacion_uno,
                                                        CU.hora_colacion AS hora_colacion_uno,
                                                        CU.fk_idfruta,
                                                        CO.idcomida,
                                                        CO.hora_comida,
                                                        CO.fk_idgrasas,
                                                        CO.fk_idproteina,
                                                        CO.fk_idverdura,
                                                        CO.fk_idcereal,
                                                        CO.fk_idleguminosa,
                                                        CD.idcolacion_dos,
                                                        CD.hora_colacion AS hora_colacion_dos,
                                                        CD.fruta_idfruta,
                                                        CE.idcena,
                                                        CE.hora_cena,
                                                        CE.fk_idtipo_cena,
                                                        CE.fk_idcereal,
                                                        CE.fk_idlacteo,
                                                        CE.fk_idverdura,
                                                        CE.fk_idproteina
                                                    FROM martes AS MA
                                                    INNER JOIN dieta_dia AS DD 
                                                    ON DD.iddieta_dia = MA.fk_iddieta_dia
                                                    INNER JOIN desayuno AS D 
                                                    ON D.iddesayuno = DD.fk_iddesayuno
                                                    INNER JOIN almuerzo AS A
                                                    ON A.idalmuerzo = DD.fk_idalmuerzo
                                                    INNER JOIN colacion_uno AS CU
                                                    ON CU.idcolacion_uno = DD.fk_idcolacion_uno
                                                    INNER JOIN comida AS CO
                                                    ON CO.idcomida = DD.fk_idcomida
                                                    INNER JOIN colacion_dos AS CD
                                                    ON CD.idcolacion_dos = DD.fk_idcolacion_dos
                                                    INNER JOIN cena AS CE
                                                    ON CE.idcena = DD.fk_idcena
                                                    WHERE MA.fk_iddieta_dia = DD.iddieta_dia
                                                    AND DD.fk_iddesayuno = D.iddesayuno
                                                    AND DD.fk_idalmuerzo = A.idalmuerzo 
                                                    AND DD.fk_idcolacion_uno = CU.idcolacion_uno
                                                    AND DD.fk_idcomida = CO.idcomida
                                                    AND DD.fk_idcolacion_dos = CD.idcolacion_dos
                                                    AND DD.fk_idcena = CE.idcena");
                $SQL->execute();
                while($DietaMartes = $SQL->fetch(PDO::FETCH_ASSOC)){
                    echo '                      
                            <div class="col-lg-4 col-sm-4" id="'.$DietaMartes['idmartes'].'" id="card">
                                <div class="card card-default">
                                    <div class="card-header">Dieta del Martes '.date("d-m-Y", strtotime($DietaMartes['fecha_martes'])).'</div>
                                    <div class="card-body card-5-7">
                                        <div class="card-center">
                                            <p><strong>Desayuno :</strong> '.date("g:i a", strtotime($DietaMartes['hora_desayuno'])).'</p>
                                            <p><strong>Almuerzo :</strong> '.date("g:i a", strtotime($DietaMartes['hora_armuerzo'])).'</p>
                                            <p><strong>Colacion :</strong> '.date("g:i a", strtotime($DietaMartes['hora_colacion_uno'])).'</p>
                                            <p><strong>Comida :</strong> '.date("g:i a", strtotime($DietaMartes['hora_comida'])).'</p>
                                            <p><strong>Colacion :</strong> '.date("g:i a", strtotime($DietaMartes['hora_colacion_dos'])).'</p>
                                            <p><strong>Cena :</strong> '.date("g:i a", strtotime($DietaMartes['hora_cena'])).'</p>
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">                                        
                                        <button class="btn btn-info add-dieta-martes" data-idmartes="'.$DietaMartes['idmartes'].'">
                                            <i class="glyphicon glyphicon-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                    ';
                }
            } catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }   
         }


        public function mostrarListaDietasMiercolesSelection(){
            try{
                $SQL = $this->CONECCION->prepare("SELECT
                                                        MI.idmiercoles,
                                                        MI.fecha AS fecha_miercoles,
                                                        DD.iddieta_dia,
                                                        DD.fecha AS fecha_dietaDia, 
                                                        D.iddesayuno, 
                                                        D.tipo_desayuno, 
                                                        D.descripcion_desayuno,
                                                        D.hora_desayuno,
                                                        A.idalmuerzo, 
                                                        A.hora_armuerzo,
                                                        A.fk_idproteina,
                                                        A.fk_idgrasas, 
                                                        A.fk_idverdura, 
                                                        A.fk_idcereal,
                                                        CU.idcolacion_uno,
                                                        CU.hora_colacion AS hora_colacion_uno,
                                                        CU.fk_idfruta,
                                                        CO.idcomida,
                                                        CO.hora_comida,
                                                        CO.fk_idgrasas,
                                                        CO.fk_idproteina,
                                                        CO.fk_idverdura,
                                                        CO.fk_idcereal,
                                                        CO.fk_idleguminosa,
                                                        CD.idcolacion_dos,
                                                        CD.hora_colacion AS hora_colacion_dos,
                                                        CD.fruta_idfruta,
                                                        CE.idcena,
                                                        CE.hora_cena,
                                                        CE.fk_idtipo_cena,
                                                        CE.fk_idcereal,
                                                        CE.fk_idlacteo,
                                                        CE.fk_idverdura,
                                                        CE.fk_idproteina
                                                    FROM miercoles AS MI
                                                    INNER JOIN dieta_dia AS DD 
                                                    ON DD.iddieta_dia = MI.fk_iddieta_dia
                                                    INNER JOIN desayuno AS D 
                                                    ON D.iddesayuno = DD.fk_iddesayuno
                                                    INNER JOIN almuerzo AS A
                                                    ON A.idalmuerzo = DD.fk_idalmuerzo
                                                    INNER JOIN colacion_uno AS CU
                                                    ON CU.idcolacion_uno = DD.fk_idcolacion_uno
                                                    INNER JOIN comida AS CO
                                                    ON CO.idcomida = DD.fk_idcomida
                                                    INNER JOIN colacion_dos AS CD
                                                    ON CD.idcolacion_dos = DD.fk_idcolacion_dos
                                                    INNER JOIN cena AS CE
                                                    ON CE.idcena = DD.fk_idcena
                                                    WHERE MI.fk_iddieta_dia = DD.iddieta_dia
                                                    AND DD.fk_iddesayuno = D.iddesayuno
                                                    AND DD.fk_idalmuerzo = A.idalmuerzo 
                                                    AND DD.fk_idcolacion_uno = CU.idcolacion_uno
                                                    AND DD.fk_idcomida = CO.idcomida
                                                    AND DD.fk_idcolacion_dos = CD.idcolacion_dos
                                                    AND DD.fk_idcena = CE.idcena");
                $SQL->execute();
                while($DietaMiercoles = $SQL->fetch(PDO::FETCH_ASSOC)){
                    echo '                      
                            <div class="col-lg-4 col-sm-4" id="'.$DietaMiercoles['idmiercoles'].'" id="card">
                                <div class="card card-default">
                                    <div class="card-header">Dieta del Miercoles '.date("d-m-Y", strtotime($DietaMiercoles['fecha_miercoles'])).'</div>
                                    <div class="card-body card-5-7">
                                        <div class="card-center">
                                            <p><strong>Desayuno :</strong> '.date("g:i a", strtotime($DietaMiercoles['hora_desayuno'])).'</p>
                                            <p><strong>Almuerzo :</strong> '.date("g:i a", strtotime($DietaMiercoles['hora_armuerzo'])).'</p>
                                            <p><strong>Colacion :</strong> '.date("g:i a", strtotime($DietaMiercoles['hora_colacion_uno'])).'</p>
                                            <p><strong>Comida :</strong> '.date("g:i a", strtotime($DietaMiercoles['hora_comida'])).'</p>
                                            <p><strong>Colacion :</strong> '.date("g:i a", strtotime($DietaMiercoles['hora_colacion_dos'])).'</p>
                                            <p><strong>Cena :</strong> '.date("g:i a", strtotime($DietaMiercoles['hora_cena'])).'</p>
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">                                        
                                        <button class="btn btn-info add-dieta-miercoles" data-idmiercoles="'.$DietaMiercoles['idmiercoles'].'">
                                            <i class="glyphicon glyphicon-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                    ';
                }
            } catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }   
        }



        public function mostrarListaDietasJuevesSelection(){
            try{
                $SQL = $this->CONECCION->prepare("SELECT
                                                        JU.idjueves,
                                                        JU.fecha AS fecha_jueves,
                                                        DD.iddieta_dia,
                                                        DD.fecha AS fecha_dietaDia, 
                                                        D.iddesayuno, 
                                                        D.tipo_desayuno, 
                                                        D.descripcion_desayuno,
                                                        D.hora_desayuno,
                                                        A.idalmuerzo, 
                                                        A.hora_armuerzo,
                                                        A.fk_idproteina,
                                                        A.fk_idgrasas, 
                                                        A.fk_idverdura, 
                                                        A.fk_idcereal,
                                                        CU.idcolacion_uno,
                                                        CU.hora_colacion AS hora_colacion_uno,
                                                        CU.fk_idfruta,
                                                        CO.idcomida,
                                                        CO.hora_comida,
                                                        CO.fk_idgrasas,
                                                        CO.fk_idproteina,
                                                        CO.fk_idverdura,
                                                        CO.fk_idcereal,
                                                        CO.fk_idleguminosa,
                                                        CD.idcolacion_dos,
                                                        CD.hora_colacion AS hora_colacion_dos,
                                                        CD.fruta_idfruta,
                                                        CE.idcena,
                                                        CE.hora_cena,
                                                        CE.fk_idtipo_cena,
                                                        CE.fk_idcereal,
                                                        CE.fk_idlacteo,
                                                        CE.fk_idverdura,
                                                        CE.fk_idproteina
                                                    FROM jueves AS JU
                                                    INNER JOIN dieta_dia AS DD 
                                                    ON DD.iddieta_dia = JU.fk_iddieta_dia
                                                    INNER JOIN desayuno AS D 
                                                    ON D.iddesayuno = DD.fk_iddesayuno
                                                    INNER JOIN almuerzo AS A
                                                    ON A.idalmuerzo = DD.fk_idalmuerzo
                                                    INNER JOIN colacion_uno AS CU
                                                    ON CU.idcolacion_uno = DD.fk_idcolacion_uno
                                                    INNER JOIN comida AS CO
                                                    ON CO.idcomida = DD.fk_idcomida
                                                    INNER JOIN colacion_dos AS CD
                                                    ON CD.idcolacion_dos = DD.fk_idcolacion_dos
                                                    INNER JOIN cena AS CE
                                                    ON CE.idcena = DD.fk_idcena
                                                    WHERE JU.fk_iddieta_dia = DD.iddieta_dia
                                                    AND DD.fk_iddesayuno = D.iddesayuno
                                                    AND DD.fk_idalmuerzo = A.idalmuerzo 
                                                    AND DD.fk_idcolacion_uno = CU.idcolacion_uno
                                                    AND DD.fk_idcomida = CO.idcomida
                                                    AND DD.fk_idcolacion_dos = CD.idcolacion_dos
                                                    AND DD.fk_idcena = CE.idcena");
                $SQL->execute();
                while($DietaJueves = $SQL->fetch(PDO::FETCH_ASSOC)){
                    echo '                      
                            <div class="col-lg-4 col-sm-4" id="'.$DietaJueves['idjueves'].'" id="card">
                                <div class="card card-default">
                                    <div class="card-header">Dieta del Jueves '.date("d-m-Y", strtotime($DietaJueves['fecha_jueves'])).'</div>
                                    <div class="card-body card-5-7">
                                        <div class="card-center">
                                            <p><strong>Desayuno :</strong> '.date("g:i a", strtotime($DietaJueves['hora_desayuno'])).'</p>
                                            <p><strong>Almuerzo :</strong> '.date("g:i a", strtotime($DietaJueves['hora_armuerzo'])).'</p>
                                            <p><strong>Colacion :</strong> '.date("g:i a", strtotime($DietaJueves['hora_colacion_uno'])).'</p>
                                            <p><strong>Comida :</strong> '.date("g:i a", strtotime($DietaJueves['hora_comida'])).'</p>
                                            <p><strong>Colacion :</strong> '.date("g:i a", strtotime($DietaJueves['hora_colacion_dos'])).'</p>
                                            <p><strong>Cena :</strong> '.date("g:i a", strtotime($DietaJueves['hora_cena'])).'</p>
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">                                        
                                        <button class="btn btn-info add-dieta-jueves" data-idjueves="'.$DietaJueves['idjueves'].'">
                                            <i class="glyphicon glyphicon-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                    ';
                }
            } catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }   
        }



        public function mostrarListaDietasViernesSelection(){
            try{
                $SQL = $this->CONECCION->prepare("SELECT
                                                        VI.idviernes,
                                                        VI.fecha AS fecha_viernes,
                                                        DD.iddieta_dia,
                                                        DD.fecha AS fecha_dietaDia, 
                                                        D.iddesayuno, 
                                                        D.tipo_desayuno, 
                                                        D.descripcion_desayuno,
                                                        D.hora_desayuno,
                                                        A.idalmuerzo, 
                                                        A.hora_armuerzo,
                                                        A.fk_idproteina,
                                                        A.fk_idgrasas, 
                                                        A.fk_idverdura, 
                                                        A.fk_idcereal,
                                                        CU.idcolacion_uno,
                                                        CU.hora_colacion AS hora_colacion_uno,
                                                        CU.fk_idfruta,
                                                        CO.idcomida,
                                                        CO.hora_comida,
                                                        CO.fk_idgrasas,
                                                        CO.fk_idproteina,
                                                        CO.fk_idverdura,
                                                        CO.fk_idcereal,
                                                        CO.fk_idleguminosa,
                                                        CD.idcolacion_dos,
                                                        CD.hora_colacion AS hora_colacion_dos,
                                                        CD.fruta_idfruta,
                                                        CE.idcena,
                                                        CE.hora_cena,
                                                        CE.fk_idtipo_cena,
                                                        CE.fk_idcereal,
                                                        CE.fk_idlacteo,
                                                        CE.fk_idverdura,
                                                        CE.fk_idproteina
                                                    FROM viernes AS VI
                                                    INNER JOIN dieta_dia AS DD 
                                                    ON DD.iddieta_dia = VI.fk_iddieta_dia
                                                    INNER JOIN desayuno AS D 
                                                    ON D.iddesayuno = DD.fk_iddesayuno
                                                    INNER JOIN almuerzo AS A
                                                    ON A.idalmuerzo = DD.fk_idalmuerzo
                                                    INNER JOIN colacion_uno AS CU
                                                    ON CU.idcolacion_uno = DD.fk_idcolacion_uno
                                                    INNER JOIN comida AS CO
                                                    ON CO.idcomida = DD.fk_idcomida
                                                    INNER JOIN colacion_dos AS CD
                                                    ON CD.idcolacion_dos = DD.fk_idcolacion_dos
                                                    INNER JOIN cena AS CE
                                                    ON CE.idcena = DD.fk_idcena
                                                    WHERE VI.fk_iddieta_dia = DD.iddieta_dia
                                                    AND DD.fk_iddesayuno = D.iddesayuno
                                                    AND DD.fk_idalmuerzo = A.idalmuerzo 
                                                    AND DD.fk_idcolacion_uno = CU.idcolacion_uno
                                                    AND DD.fk_idcomida = CO.idcomida
                                                    AND DD.fk_idcolacion_dos = CD.idcolacion_dos
                                                    AND DD.fk_idcena = CE.idcena");
                $SQL->execute();
                while($DietaViernes = $SQL->fetch(PDO::FETCH_ASSOC)){
                    echo '                      
                            <div class="col-lg-4 col-sm-4" id="'.$DietaViernes['idviernes'].'" id="card">
                                <div class="card card-default">
                                    <div class="card-header">Dieta del Viernes '.date("d-m-Y", strtotime($DietaViernes['fecha_viernes'])).'</div>
                                    <div class="card-body card-5-7">
                                        <div class="card-center">
                                            <p><strong>Desayuno :</strong> '.date("g:i a", strtotime($DietaViernes['hora_desayuno'])).'</p>
                                            <p><strong>Almuerzo :</strong> '.date("g:i a", strtotime($DietaViernes['hora_armuerzo'])).'</p>
                                            <p><strong>Colacion :</strong> '.date("g:i a", strtotime($DietaViernes['hora_colacion_uno'])).'</p>
                                            <p><strong>Comida :</strong> '.date("g:i a", strtotime($DietaViernes['hora_comida'])).'</p>
                                            <p><strong>Colacion :</strong> '.date("g:i a", strtotime($DietaViernes['hora_colacion_dos'])).'</p>
                                            <p><strong>Cena :</strong> '.date("g:i a", strtotime($DietaViernes['hora_cena'])).'</p>
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">                                        
                                        <button class="btn btn-info add-dieta-viernes" data-idviernes="'.$DietaViernes['idviernes'].'">
                                            <i class="glyphicon glyphicon-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                    ';
                }
            } catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }   
        }

        public function mostrarListaDietasSabadoSelection(){
            try{
                $SQL = $this->CONECCION->prepare("SELECT
                                                        SA.idsabado,
                                                        SA.fecha AS fecha_sabado,
                                                        DD.iddieta_dia,
                                                        DD.fecha AS fecha_dietaDia, 
                                                        D.iddesayuno, 
                                                        D.tipo_desayuno, 
                                                        D.descripcion_desayuno,
                                                        D.hora_desayuno,
                                                        A.idalmuerzo, 
                                                        A.hora_armuerzo,
                                                        A.fk_idproteina,
                                                        A.fk_idgrasas, 
                                                        A.fk_idverdura, 
                                                        A.fk_idcereal,
                                                        CU.idcolacion_uno,
                                                        CU.hora_colacion AS hora_colacion_uno,
                                                        CU.fk_idfruta,
                                                        CO.idcomida,
                                                        CO.hora_comida,
                                                        CO.fk_idgrasas,
                                                        CO.fk_idproteina,
                                                        CO.fk_idverdura,
                                                        CO.fk_idcereal,
                                                        CO.fk_idleguminosa,
                                                        CD.idcolacion_dos,
                                                        CD.hora_colacion AS hora_colacion_dos,
                                                        CD.fruta_idfruta,
                                                        CE.idcena,
                                                        CE.hora_cena,
                                                        CE.fk_idtipo_cena,
                                                        CE.fk_idcereal,
                                                        CE.fk_idlacteo,
                                                        CE.fk_idverdura,
                                                        CE.fk_idproteina
                                                    FROM sabado AS SA
                                                    INNER JOIN dieta_dia AS DD 
                                                    ON DD.iddieta_dia = SA.fk_iddieta_dia
                                                    INNER JOIN desayuno AS D 
                                                    ON D.iddesayuno = DD.fk_iddesayuno
                                                    INNER JOIN almuerzo AS A
                                                    ON A.idalmuerzo = DD.fk_idalmuerzo
                                                    INNER JOIN colacion_uno AS CU
                                                    ON CU.idcolacion_uno = DD.fk_idcolacion_uno
                                                    INNER JOIN comida AS CO
                                                    ON CO.idcomida = DD.fk_idcomida
                                                    INNER JOIN colacion_dos AS CD
                                                    ON CD.idcolacion_dos = DD.fk_idcolacion_dos
                                                    INNER JOIN cena AS CE
                                                    ON CE.idcena = DD.fk_idcena
                                                    WHERE SA.fk_iddieta_dia = DD.iddieta_dia
                                                    AND DD.fk_iddesayuno = D.iddesayuno
                                                    AND DD.fk_idalmuerzo = A.idalmuerzo 
                                                    AND DD.fk_idcolacion_uno = CU.idcolacion_uno
                                                    AND DD.fk_idcomida = CO.idcomida
                                                    AND DD.fk_idcolacion_dos = CD.idcolacion_dos
                                                    AND DD.fk_idcena = CE.idcena");
                $SQL->execute();
                while($DietaSabado = $SQL->fetch(PDO::FETCH_ASSOC)){
                    echo '                      
                            <div class="col-lg-4 col-sm-4" id="'.$DietaSabado['idsabado'].'" id="card">
                                <div class="card card-default">
                                    <div class="card-header">Dieta del Domingo '.date("d-m-Y", strtotime($DietaSabado['fecha_sabado'])).'</div>
                                    <div class="card-body card-5-7">
                                        <div class="card-center">
                                            <p><strong>Desayuno :</strong> '.date("g:i a", strtotime($DietaSabado['hora_desayuno'])).'</p>
                                            <p><strong>Almuerzo :</strong> '.date("g:i a", strtotime($DietaSabado['hora_armuerzo'])).'</p>
                                            <p><strong>Colacion :</strong> '.date("g:i a", strtotime($DietaSabado['hora_colacion_uno'])).'</p>
                                            <p><strong>Comida :</strong> '.date("g:i a", strtotime($DietaSabado['hora_comida'])).'</p>
                                            <p><strong>Colacion :</strong> '.date("g:i a", strtotime($DietaSabado['hora_colacion_dos'])).'</p>
                                            <p><strong>Cena :</strong> '.date("g:i a", strtotime($DietaSabado['hora_cena'])).'</p>
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">                                        
                                        <button class="btn btn-info add-dieta-sabado" data-idsabado="'.$DietaSabado['idsabado'].'">
                                            <i class="glyphicon glyphicon-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                    ';
                }
            } catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }   
        }



        public function mostrarListaDietasDomingoSelection(){
            try{
                $SQL = $this->CONECCION->prepare("SELECT
                                                        DO.iddomingo,
                                                        DO.fecha AS fecha_domingo,
                                                        DD.iddieta_dia,
                                                        DD.fecha AS fecha_dietaDia, 
                                                        D.iddesayuno, 
                                                        D.tipo_desayuno, 
                                                        D.descripcion_desayuno,
                                                        D.hora_desayuno,
                                                        A.idalmuerzo, 
                                                        A.hora_armuerzo,
                                                        A.fk_idproteina,
                                                        A.fk_idgrasas, 
                                                        A.fk_idverdura, 
                                                        A.fk_idcereal,
                                                        CU.idcolacion_uno,
                                                        CU.hora_colacion AS hora_colacion_uno,
                                                        CU.fk_idfruta,
                                                        CO.idcomida,
                                                        CO.hora_comida,
                                                        CO.fk_idgrasas,
                                                        CO.fk_idproteina,
                                                        CO.fk_idverdura,
                                                        CO.fk_idcereal,
                                                        CO.fk_idleguminosa,
                                                        CD.idcolacion_dos,
                                                        CD.hora_colacion AS hora_colacion_dos,
                                                        CD.fruta_idfruta,
                                                        CE.idcena,
                                                        CE.hora_cena,
                                                        CE.fk_idtipo_cena,
                                                        CE.fk_idcereal,
                                                        CE.fk_idlacteo,
                                                        CE.fk_idverdura,
                                                        CE.fk_idproteina
                                                    FROM domingo AS DO
                                                    INNER JOIN dieta_dia AS DD 
                                                    ON DD.iddieta_dia = DO.fk_iddieta_dia
                                                    INNER JOIN desayuno AS D 
                                                    ON D.iddesayuno = DD.fk_iddesayuno
                                                    INNER JOIN almuerzo AS A
                                                    ON A.idalmuerzo = DD.fk_idalmuerzo
                                                    INNER JOIN colacion_uno AS CU
                                                    ON CU.idcolacion_uno = DD.fk_idcolacion_uno
                                                    INNER JOIN comida AS CO
                                                    ON CO.idcomida = DD.fk_idcomida
                                                    INNER JOIN colacion_dos AS CD
                                                    ON CD.idcolacion_dos = DD.fk_idcolacion_dos
                                                    INNER JOIN cena AS CE
                                                    ON CE.idcena = DD.fk_idcena
                                                    WHERE DO.fk_iddieta_dia = DD.iddieta_dia
                                                    AND DD.fk_iddesayuno = D.iddesayuno
                                                    AND DD.fk_idalmuerzo = A.idalmuerzo 
                                                    AND DD.fk_idcolacion_uno = CU.idcolacion_uno
                                                    AND DD.fk_idcomida = CO.idcomida
                                                    AND DD.fk_idcolacion_dos = CD.idcolacion_dos
                                                    AND DD.fk_idcena = CE.idcena");
                $SQL->execute();
                while($DietaDomingo = $SQL->fetch(PDO::FETCH_ASSOC)){
                    echo '                      
                            <div class="col-lg-4 col-sm-4" id="'.$DietaDomingo['iddomingo'].'" id="card">
                                <div class="card card-default">
                                    <div class="card-header">Dieta del Domingo '.date("d-m-Y", strtotime($DietaDomingo['fecha_domingo'])).'</div>
                                    <div class="card-body card-5-7">
                                        <div class="card-center">
                                            <p><strong>Desayuno :</strong> '.date("g:i a", strtotime($DietaDomingo['hora_desayuno'])).'</p>
                                            <p><strong>Almuerzo :</strong> '.date("g:i a", strtotime($DietaDomingo['hora_armuerzo'])).'</p>
                                            <p><strong>Colacion :</strong> '.date("g:i a", strtotime($DietaDomingo['hora_colacion_uno'])).'</p>
                                            <p><strong>Comida :</strong> '.date("g:i a", strtotime($DietaDomingo['hora_comida'])).'</p>
                                            <p><strong>Colacion :</strong> '.date("g:i a", strtotime($DietaDomingo['hora_colacion_dos'])).'</p>
                                            <p><strong>Cena :</strong> '.date("g:i a", strtotime($DietaDomingo['hora_cena'])).'</p>
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">                                        
                                        <button class="btn btn-info add-dieta-domingo" data-iddomingo="'.$DietaDomingo['iddomingo'].'">
                                            <i class="glyphicon glyphicon-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                    ';
                }
            } catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }   
        }

/** *********************************************************************************************************************************/        
        public function mostrarListaTipoDietas(){
            try{
                $SQL = $this->CONECCION->prepare("SELECT 
                                                        iddieta,
                                                        nombre_dieta,
                                                        semanas_dieta
                                                FROM dieta");
                $SQL->execute();
                while($Dieta = $SQL->fetch(PDO::FETCH_ASSOC)){
                    echo '<tr id="'.$Dieta['iddieta'].'">
                    <td>'.$Dieta['iddieta'].'</td>
                    <td>'.$Dieta['nombre_dieta'].'</td>
                    <td>'.$Dieta['semanas_dieta'].'</td>
                    <td> 
                        <div> 
                            <a href="#" class="editar" data-iddieta="'.$Dieta['iddieta'].'" 
                                                       data-nombre="'.$Dieta['nombre_dieta'].'" data-semanas="'.$Dieta['semanas_dieta'].'">
                                <i class="glyphicon glyphicon-pencil"></i>
                            </a> 
                        </div>
                    </td>
                    <td> 
                        <div class="div-eliminar" id="div-eliminar'.$Dieta['iddieta'].'"> 
                            <a class="eliminar" data-dieta="'.$Dieta['iddieta'].'" id="eliminar'.$Dieta['iddieta'].'" href="#">
                                <i class="glyphicon glyphicon-remove"></i>
                            </a>
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

        public function insertTipoDieta($nombre_dieta, $semanas_dieta){
            try{
                $SQL = $this->CONECCION->PREPARE("INSERT INTO 
                                                            dieta (nombre_dieta, semanas_dieta) 
                                                        VALUES 
                                                            (:nombreDieta, :semanasDieta)");
                
                $uuid = gen_uuid();
                $SQL->bindParam(":nombreDieta",$nombre_dieta);
                $SQL->bindParam(":semanasDieta",$semanas_dieta);
                $SQL->execute();
    
                echo "Ok";
                      

            }catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }
        }

        public function deleteTipoDieta($id){
            try{
                $SQL = $this->CONECCION->PREPARE("DELETE FROM dieta WHERE iddieta = ".$id."");
                $SQL->execute();
                echo $id;
            }catch (PDOException $e) {
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                    </div>';
            }                
            
        }

        public function editTipoDieta($id, $nombre, $semanas){
            try{
                 $SQL = $this->CONECCION->PREPARE("UPDATE 
                                                          dieta 
                                                      SET 
                                                          nombre_dieta =:dieta,
                                                          semanas_dieta=:semanas 
                                                      WHERE 
                                                          iddieta =:id");
                 $SQL->bindParam(":dieta",$nombre);
                 $SQL->bindParam(":semanas",$semanas);
                 $SQL->bindParam(":id",$id);
                 $SQL->execute();
                                                       
                     echo "Ok";
                       
             }catch (PDOException $e) {
                 echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                         <button type="button" class="close" data-dismiss="alert">x</button>
                       </div>';
             }
        }

        public function mostrarListaTipoDietasSelection(){
            try{
                $SQL = $this->CONECCION->prepare("SELECT 
                                                        iddieta,
                                                        nombre_dieta,
                                                        semanas_dieta
                                                FROM dieta");
                $SQL->execute();
                while($Dieta = $SQL->fetch(PDO::FETCH_ASSOC)){
                    echo '                      
                            <div class="col-lg-4 col-sm-4" id="'.$Dieta['iddieta'].'" id="card">
                                <div class="card card-default">
                                    <div class="card-header">'.$Dieta['nombre_dieta'].'</div>
                                    <div class="card-body card-5-7">
                                        <div class="card-center">
                                            <p><strong>Nombre :</strong> '.$Dieta['nombre_dieta'].'</p>
                                            <p><strong>Semanas :</strong> '.$Dieta['semanas_dieta'].'</p>
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">                                        
                                        <button class="btn btn-info add-dieta-tipo-dieta" data-iddieta="'.$Dieta['iddieta'].'" data-nombre="'.$Dieta['nombre_dieta'].'" data-semanas="'.$Dieta['semanas_dieta'].'">
                                            <i class="glyphicon glyphicon-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                    ';
                }
            } catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }   
        }


    }    

   

?>