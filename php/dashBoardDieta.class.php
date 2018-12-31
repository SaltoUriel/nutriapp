<?php 

    class dashBoardDieta{
        
        private $CONECCIONDIETA;

        public function __construct($BD){
            $this->CONECCIONDIETA = $BD;
        }

        public function mostrarListaAlmuerzo(){
            try{
                $SQL = $this->CONECCIONDIETA->prepare("
                                                SELECT
                                                    AL.idalmuerzo, 
                                                    AL.hora_armuerzo, 
                                                    AL.fecha_alta, 
                                                    AL.uuid,
                                                    P.idproteina,
                                                    P.nombre_proteina, 
                                                    P.porcion_proteina, 
                                                    G.idgrasas,
                                                    G.nombre_grasa, 
                                                    G.porcion_grasa,
                                                    V.idverdura,
                                                    V.nombre_verdura,
                                                    V.porcion_verdura,
                                                    C.idcereal,
                                                    C.nombre_cereal,
                                                    C.porcion_cereal
                                                 FROM almuerzo AS AL 
                                                 INNER JOIN proteina AS P 
                                                 ON P.idproteina = AL.fk_idproteina
                                                 INNER JOIN grasa AS G
                                                 ON G.idgrasas = AL.fk_idgrasas
                                                 INNER JOIN verdura AS V
                                                 ON V.idverdura = AL.fk_idverdura
                                                 INNER JOIN cereal AS C
                                                 ON C.idcereal = AL.fk_idcereal
                                                 WHERE AL.fk_idproteina = P.idproteina
                                                 AND AL.fk_idgrasas = G.idgrasas AND AL.fk_idverdura = V.idverdura AND
                                                 AL.fk_idcereal = C.idcereal
                ");
                $SQL->execute();
                while($Almuerzo = $SQL->fetch(PDO::FETCH_ASSOC)){
                    echo '<tr id="'.$Almuerzo['idalmuerzo'].'">
                        <td>'.date("g:i a", strtotime($Almuerzo['hora_armuerzo'])).'</td>
                        <td >'.$Almuerzo['nombre_proteina'].'</td>
                        <td>'.$Almuerzo['nombre_grasa'].'</td>
                        <td>'.$Almuerzo['nombre_verdura'].'</td>
                        <td>'.$Almuerzo['nombre_cereal'].'</td>
                        <td> 
                            <div> 
                                <a href="#" class="editar" data-horaarmuerzo="'.$Almuerzo['hora_armuerzo'].'"
                                   data-proteina="'.$Almuerzo['idproteina'].'" data-grasa="'.$Almuerzo['idgrasas'].'"
                                   data-verdura="'.$Almuerzo['idverdura'].'" data-cereal="'.$Almuerzo['idcereal'].'"
                                   data-idalmuerzo="'.$Almuerzo['idalmuerzo'].'">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                </a> 
                            </div>
                        </td>
                        <td> <div class="div-eliminar" data="'.$Almuerzo['idalmuerzo'].'" id="div-eliminar'.$Almuerzo['idalmuerzo'].'"> <a class="eliminar" id="eliminar'.$Almuerzo['idalmuerzo'].'" href="#"><i class="glyphicon glyphicon-remove"></i></a></div> </td>                    
                    </tr>';
                }
            } catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }
        }
        
        public function seleccionProteina(){
            try{
                $SQL = $this->CONECCIONDIETA->prepare("SELECT 
                                                        idproteina, 
                                                        nombre_proteina, 
                                                        porcion_proteina 
                                                        FROM proteina");

                $SQL->execute();
                while($Proteina = $SQL->fetch(PDO::FETCH_ASSOC)){
                    echo '<option value="'.$Proteina['idproteina'].'">'.$Proteina['nombre_proteina'].' '.$Proteina['porcion_proteina'].'</option>';
                }
            }catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }
        }

        public function seleccionGrasa(){
            try{
                $SQL = $this->CONECCIONDIETA->prepare("SELECT 
                                                        idgrasas, 
                                                        nombre_grasa, 
                                                        porcion_grasa 
                                                        FROM grasa");

                $SQL->execute();
                while($Grasa = $SQL->fetch(PDO::FETCH_ASSOC)){
                    echo '<option value="'.$Grasa['idgrasas'].'">'.$Grasa['nombre_grasa'].' '.$Grasa['porcion_grasa'].'</option>';
                }
            }catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }
        }

        public function seleccionVerdura(){
            try{
                $SQL = $this->CONECCIONDIETA->prepare("SELECT 
                                                        idverdura, 
                                                        nombre_verdura, 
                                                        porcion_verdura 
                                                        FROM verdura");

                $SQL->execute();
                while($Verdura = $SQL->fetch(PDO::FETCH_ASSOC)){
                    echo '<option value="'.$Verdura['idverdura'].'">'.$Verdura['nombre_verdura'].' '.$Verdura['porcion_verdura'].'</option>';
                }
            }catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }
        }

        public function seleccionCereal(){
            try{
                $SQL = $this->CONECCIONDIETA->prepare("SELECT 
                                                        idcereal, 
                                                        nombre_cereal, 
                                                        porcion_cereal 
                                                        FROM cereal");

                $SQL->execute();
                
                while($Cereal = $SQL->fetch(PDO::FETCH_ASSOC)){
                    echo '<option value="'.$Cereal['idcereal'].'">'.$Cereal['nombre_cereal'].' '.$Cereal['porcion_cereal'].'</option>';
                }
            }catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }
        }

        public function seleccionLeguminosa(){
            try{
                $SQL = $this->CONECCIONDIETA->prepare("SELECT 
                                                        idleguminosa, 
                                                        nombre_leguminosa, 
                                                        porcion_leguminosa 
                                                        FROM leguminosa");

                $SQL->execute();
                
                while($Cereal = $SQL->fetch(PDO::FETCH_ASSOC)){
                    echo '<option value="'.$Cereal['idleguminosa'].'">'.$Cereal['nombre_leguminosa'].' '.$Cereal['porcion_leguminosa'].'</option>';
                }
            }catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }
        }

        public function seleccionFruta(){
            try{
                $SQL = $this->CONECCIONDIETA->prepare("SELECT 
                                                        idfruta, 
                                                        nombre_fruta, 
                                                        porcion_fruta 
                                                        FROM fruta");

                $SQL->execute();
                
                while($Fruta = $SQL->fetch(PDO::FETCH_ASSOC)){
                    echo '<option value="'.$Fruta['idfruta'].'">'.$Fruta['nombre_fruta'].' '.$Fruta['porcion_fruta'].'</option>';
                }
            }catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        </div>';
            }
              
        }

        public function seleccionLacteo(){
            try{
                $SQL = $this->CONECCIONDIETA->prepare("SELECT 
                                                        idlacteo, 
                                                        nombre_lacteo, 
                                                        porcion_lacteo 
                                                        FROM lacteo");

                $SQL->execute();
                
                while($Fruta = $SQL->fetch(PDO::FETCH_ASSOC)){
                    echo '<option value="'.$Fruta['idlacteo'].'">'.$Fruta['nombre_lacteo'].' '.$Fruta['porcion_lacteo'].'</option>';
                }
            }catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        </div>';
            }
              
        }

        public function insertAlmuerzo($hora, $proteina, $grasa, $verdura, $cereal, $usuario){
            try{
                $SQL = $this->CONECCIONDIETA->prepare("INSERT INTO 
                                                        almuerzo (hora_armuerzo, fk_idproteina, fk_idgrasas, fk_idverdura, fk_idcereal, uuid, fk_idusuarios)
                                                        VALUES (:hora, :proteina, :grasa, :verdura, :cereal, :uuid, :usuario)");
                    $uuid = gen_uuid();
                    $SQL->bindParam(":hora", $hora);
                    $SQL->bindParam(":proteina", $proteina);
                    $SQL->bindParam(":grasa", $grasa);
                    $SQL->bindParam(":verdura", $verdura);
                    $SQL->bindParam(":cereal", $cereal);
                    $SQL->bindParam(":uuid", $uuid);
                    $SQL->bindParam(":usuario", $usuario);
                    $SQL->execute();

                    echo "Almuerzo registrado";
            }catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                            <button type="button" class="close" data-dismiss="alert">x</button>
                        </div>';
            }
        }

        public function deleteAlmuerzo($id){
            try{
                $SQL = $this->CONECCIONDIETA->prepare("DELETE FROM almuerzo WHERE idalmuerzo = ".$id.";");
                $SQL->execute();
                echo $id;
            }catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                    </div>';
            }
        }
        

        public function editarAlmuerzo($id, $hora, $proteina, $grasa, $verdura, $cereal){
            try{
                 $SQL = $this->CONECCIONDIETA->PREPARE("UPDATE 
                                                        almuerzo 
                                                    SET 
                                                        hora_armuerzo =:hora,
                                                        fk_idproteina =:proteina,
                                                        fk_idgrasas =:grasa,
                                                        fk_idverdura =:verdura,
                                                        fk_idcereal =:cereal
                                                    WHERE 
                                                        idalmuerzo =:id");
                 
                 $SQL->bindParam(":hora",$hora);
                 $SQL->bindParam(":proteina",$proteina);
                 $SQL->bindParam(":grasa",$grasa);
                 $SQL->bindParam(":verdura",$verdura);
                 $SQL->bindParam(":cereal", $cereal);
                 $SQL->bindParam(":id", $id);
                 $SQL->execute();
                                                       
                     echo "OK";
                       
             }catch (PDOException $e) {
                 echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                         <button type="button" class="close" data-dismiss="alert">x</button>
                       </div>';
             }
         }
        

         public function mostrarListaDesayuno(){
            try{
                $SQL = $this->CONECCIONDIETA->prepare("
                                                SELECT
                                                    iddesayuno,
                                                    tipo_desayuno,
                                                    descripcion_desayuno,
                                                    hora_desayuno,
                                                    uuid,
                                                    fk_idusuarios
                                                 FROM desayuno");
                $SQL->execute();
                while($Desayuno = $SQL->fetch(PDO::FETCH_ASSOC)){
                    echo '<tr id="'.$Desayuno['iddesayuno'].'">
                            <td>'.$Desayuno['tipo_desayuno'].'</td>
                            <td >'.$Desayuno['descripcion_desayuno'].'</td>
                            <td>'.date("g:i a", strtotime($Desayuno['hora_desayuno'])).'</td>
                            <td> 
                                <div> 
                                    <a href="#" class="editar" data-tipodesayuno="'.$Desayuno['tipo_desayuno'].'"
                                        data-id="'.$Desayuno['iddesayuno'].'"
                                        data-descripcion="'.$Desayuno['descripcion_desayuno'].'" 
                                        data-horadesayuno="'.$Desayuno['hora_desayuno'].'">
                                            <i class="glyphicon glyphicon-pencil"></i>
                                    </a> 
                                </div>
                            </td>
                            <td> <div class="div-eliminar" data="'.$Desayuno['iddesayuno'].'" id="div-eliminar'.$Desayuno['iddesayuno'].'"> <a class="eliminar" id="eliminar'.$Desayuno['iddesayuno'].'" href="#"><i class="glyphicon glyphicon-remove"></i></a></div> </td>                    
                           </tr>';
                }
            } catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }   
         }

         public function deleteDesayuno($id){
            try{
                $SQL = $this->CONECCIONDIETA->prepare("DELETE FROM desayuno WHERE iddesayuno = ".$id.";");
                $SQL->execute();
                echo $id;
            }catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                    </div>';
            }
        }

        public function insertDesayuno($alimento, $descripcion, $hora, $usuario){
            try{
                $SQL = $this->CONECCIONDIETA->prepare("INSERT INTO 
                                                        desayuno (tipo_desayuno, descripcion_desayuno, hora_desayuno, uuid, fk_idusuarios)
                                                        VALUES (:alimento, :descripcion, :hora, :uuid, :usuario)");
                    $uuid = gen_uuid();
                    $SQL->bindParam(":alimento", $alimento);
                    $SQL->bindParam(":descripcion", $descripcion);
                    $SQL->bindParam(":hora", $hora);
                    $SQL->bindParam(":uuid", $uuid);
                    $SQL->bindParam(":usuario", $usuario);
                    $SQL->execute();

                    echo "Almuerzo registrado";
            }catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                            <button type="button" class="close" data-dismiss="alert">x</button>
                        </div>';
            }
        }

        public function updateDesayuno($id, $alimento, $descripcion, $hora){
            try{
                 $SQL = $this->CONECCIONDIETA->PREPARE("UPDATE 
                                                        desayuno 
                                                    SET 
                                                        tipo_desayuno =:alimento,
                                                        descripcion_desayuno =:descripcion,
                                                        hora_desayuno =:hora                                                        
                                                    WHERE 
                                                        iddesayuno =:id");
                 
                 $SQL->bindParam(":alimento",$alimento);
                 $SQL->bindParam(":descripcion",$descripcion);
                 $SQL->bindParam(":hora",$hora);
                 $SQL->bindParam(":id", $id);
                 $SQL->execute();
                                                       
                     echo "OK";
                       
             }catch (PDOException $e) {
                 echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                         <button type="button" class="close" data-dismiss="alert">x</button>
                       </div>';
             }
         }

         public function mostrarListaComida(){
            try{
                $SQL = $this->CONECCIONDIETA->prepare("
                                                SELECT
                                                    CO.idcomida, 
                                                    CO.hora_comida, 
                                                    CO.fecha_alta, 
                                                    CO.uuid,
                                                    G.idgrasas,
                                                    G.nombre_grasa, 
                                                    G.porcion_grasa,
                                                    P.idproteina,
                                                    P.nombre_proteina, 
                                                    P.porcion_proteina, 
                                                    V.idverdura,
                                                    V.nombre_verdura,
                                                    V.porcion_verdura,
                                                    C.idcereal,
                                                    C.nombre_cereal,
                                                    C.porcion_cereal,
                                                    L.idleguminosa,
                                                    L.nombre_leguminosa,
                                                    L.porcion_leguminosa
                                                 FROM comida AS CO 
                                                 INNER JOIN proteina AS P 
                                                 ON P.idproteina = CO.fk_idproteina
                                                 INNER JOIN grasa AS G
                                                 ON G.idgrasas = CO.fk_idgrasas
                                                 INNER JOIN verdura AS V
                                                 ON V.idverdura = CO.fk_idverdura
                                                 INNER JOIN cereal AS C
                                                 ON C.idcereal = CO.fk_idcereal
                                                 INNER JOIN leguminosa AS L
                                                 ON L.idleguminosa = CO.fk_idleguminosa
                                                 WHERE CO.fk_idproteina = P.idproteina
                                                 AND CO.fk_idgrasas = G.idgrasas 
                                                 AND CO.fk_idverdura = V.idverdura
                                                 AND CO.fk_idcereal = C.idcereal
                                                 AND CO.fk_idleguminosa = L.idleguminosa
                ");
                $SQL->execute();
                while($Comida = $SQL->fetch(PDO::FETCH_ASSOC)){
                    echo '<tr id="'.$Comida['idcomida'].'">
                        <td>'.date("g:i a", strtotime($Comida['hora_comida'])).'</td>
                        <td>'.$Comida['nombre_grasa'].'</td>
                        <td >'.$Comida['nombre_proteina'].'</td>
                        <td>'.$Comida['nombre_verdura'].'</td>
                        <td>'.$Comida['nombre_cereal'].'</td>
                        <td>'.$Comida['nombre_leguminosa'].'</td>
                        <td> 
                            <div> 
                                <a href="#" class="editar" data-horacomida="'.$Comida['hora_comida'].'"
                                   data-proteina="'.$Comida['idproteina'].'" data-grasa="'.$Comida['idgrasas'].'"
                                   data-verdura="'.$Comida['idverdura'].'" data-cereal="'.$Comida['idcereal'].'"
                                   data-leguminosa="'.$Comida['idleguminosa'].'" data-idcomida="'.$Comida['idcomida'].'">

                                    <i class="glyphicon glyphicon-pencil"></i>
                                </a> 
                            </div>
                        </td>
                        <td> <div class="div-eliminar" data="'.$Comida['idcomida'].'" id="div-eliminar'.$Comida['idcomida'].'"> <a class="eliminar" id="eliminar'.$Comida['idcomida'].'" href="#"><i class="glyphicon glyphicon-remove"></i></a></div> </td>                    
                    </tr>';
                }
            } catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }
        }


        public function insertComida($hora, $proteina, $grasa, $verdura, $cereal, $leguminosa, $usuario){
            try{
                $SQL = $this->CONECCIONDIETA->prepare("INSERT INTO 
                                                        comida (hora_comida, fk_idgrasas ,fk_idproteina, fk_idverdura, fk_idcereal, fk_idleguminosa, uuid, fk_idusuarios)
                                                        VALUES (:hora, :proteina, :grasa, :verdura, :cereal, :leguminosa, :uuid, :usuario)");
                    $uuid = gen_uuid();
                    $SQL->bindParam(":hora", $hora);
                    $SQL->bindParam(":grasa", $grasa);
                    $SQL->bindParam(":proteina", $proteina);
                    $SQL->bindParam(":verdura", $verdura);
                    $SQL->bindParam(":cereal", $cereal);
                    $SQL->bindParam(":leguminosa", $leguminosa);
                    $SQL->bindParam(":uuid", $uuid);
                    $SQL->bindParam(":usuario", $usuario);
                    $SQL->execute();

                    echo "Comida registrado";
            }catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                            <button type="button" class="close" data-dismiss="alert">x</button>
                        </div>';
            }
        }

        public function deleteComida($id){
            try{
                $SQL = $this->CONECCIONDIETA->prepare("DELETE FROM comida WHERE idcomida = ".$id.";");
                $SQL->execute();
                echo $id;
            }catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                    </div>';
            }
        }
        

        public function updateComida($id, $hora, $proteina, $grasa, $verdura, $cereal, $leguminosa){
            try{
                 $SQL = $this->CONECCIONDIETA->PREPARE("UPDATE 
                                                        comida 
                                                    SET 
                                                        hora_comida =:hora,
                                                        fk_idgrasas =:grasa,
                                                        fk_idproteina =:proteina,
                                                        fk_idverdura =:verdura,
                                                        fk_idcereal =:cereal,
                                                        fk_idleguminosa =:leguminosa
                                                    WHERE 
                                                        idcomida =:id");
                 
                 $SQL->bindParam(":hora",$hora);
                 $SQL->bindParam(":grasa",$grasa);
                 $SQL->bindParam(":proteina",$proteina);
                 $SQL->bindParam(":verdura",$verdura);
                 $SQL->bindParam(":cereal", $cereal);
                 $SQL->bindParam(":leguminosa", $leguminosa);
                 $SQL->bindParam(":id", $id);
                 $SQL->execute();
                                                       
                     echo "OK";
                       
             }catch (PDOException $e) {
                 echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                         <button type="button" class="close" data-dismiss="alert">x</button>
                       </div>';
             }
         }

         public function mostrarListaColacionUno(){
            try{
                $SQL = $this->CONECCIONDIETA->prepare("
                                                SELECT
                                                    CLU.idcolacion_uno, 
                                                    CLU.hora_colacion, 
                                                    F.idfruta,
                                                    F.nombre_fruta,
                                                    F.porcion_fruta
                                                 FROM colacion_uno AS CLU 
                                                 INNER JOIN fruta AS F 
                                                 ON F.idfruta = CLU.fk_idfruta
                                                 WHERE CLU.fk_idfruta = F.idfruta
                ");
                $SQL->execute();
                while($Colacion = $SQL->fetch(PDO::FETCH_ASSOC)){
                    echo '<tr id="'.$Colacion['idcolacion_uno'].'">
                        <td>'.date("g:i a", strtotime($Colacion['hora_colacion'])).'</td>
                        <td>'.$Colacion['nombre_fruta'].'</td>
                        <td >'.$Colacion['porcion_fruta'].'</td>
                        
                        <td> 
                            <div> 
                                <a href="#" class="editar" data-horacolacion="'.$Colacion['hora_colacion'].'"
                                   data-fruta="'.$Colacion['idfruta'].'" data-porcion="'.$Colacion['porcion_fruta'].'"
                                   data-idcolacion="'.$Colacion['idcolacion_uno'].'">

                                    <i class="glyphicon glyphicon-pencil"></i>
                                </a> 
                            </div>
                        </td>
                        <td> <div class="div-eliminar" data="'.$Colacion['idcolacion_uno'].'" id="div-eliminar'.$Colacion['idcolacion_uno'].'"> <a class="eliminar" id="eliminar'.$Colacion['idcolacion_uno'].'" href="#"><i class="glyphicon glyphicon-remove"></i></a></div> </td>                    
                    </tr>';
                }
            } catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }
        }

        public function deleteColacionUno($id){
            try{
                $SQL = $this->CONECCIONDIETA->prepare("DELETE FROM colacion_uno WHERE idcolacion_uno = ".$id.";");
                $SQL->execute();
                echo $id;
            }catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                    </div>';
            }
        }

        public function insertColacionUno($hora, $fruta, $usuario){
            try{
                $SQL = $this->CONECCIONDIETA->prepare("INSERT INTO 
                                                        colacion_uno (hora_colacion, fk_idfruta, uuid, fk_idusuarios)
                                                        VALUES (:hora, :fruta, :uuid, :usuario)");
                    $uuid = gen_uuid();
                    $SQL->bindParam(":hora", $hora);
                    $SQL->bindParam(":fruta", $fruta);
                    $SQL->bindParam(":uuid", $uuid);
                    $SQL->bindParam(":usuario", $usuario);
                    $SQL->execute();

                    echo "Almuerzo registrado";
            }catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                            <button type="button" class="close" data-dismiss="alert">x</button>
                        </div>';
            }
        }

        public function updateColacionUno($id, $hora, $fruta){
            try{
                $SQL = $this->CONECCIONDIETA->PREPARE("UPDATE 
                                                       colacion_uno 
                                                   SET 
                                                       hora_colacion =:hora,
                                                       fk_idfruta =:fruta
                                                   WHERE 
                                                       idcolacion_uno =:id");
                
                $SQL->bindParam(":hora",$hora);
                $SQL->bindParam(":fruta",$fruta);
                $SQL->bindParam(":id", $id);
                $SQL->execute();
                                                      
                    echo "OK";
                      
            }catch (PDOException $e) {
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }
        }
        

        public function mostrarListaCenaUno(){
            try{
                $SQL = $this->CONECCIONDIETA->prepare("
                                                SELECT
                                                    CE.idcena,
                                                    CE.hora_cena, 
                                                    TC.idtipo_cena,
                                                    TC.nombre_cena,
                                                    C.idcereal,
                                                    C.nombre_cereal,
                                                    C.porcion_cereal,
                                                    L.idlacteo,
                                                    L.nombre_lacteo,
                                                    L.porcion_lacteo
                                                 FROM cena AS CE 
                                                 INNER JOIN tipo_cena AS TC 
                                                 ON TC.idtipo_cena = CE.fk_idtipo_cena
                                                 INNER JOIN cereal AS C
                                                 ON C.idcereal = CE.fk_idcereal
                                                 INNER JOIN lacteo AS L
                                                 ON L.idlacteo = CE.fk_idlacteo
                                                 WHERE CE.fk_idtipo_cena = TC.idtipo_cena
                                                 AND CE.fk_idcereal = C.idcereal
                                                 AND CE.fk_idlacteo = L.idlacteo
                ");
                $SQL->execute();
                while($Cena = $SQL->fetch(PDO::FETCH_ASSOC)){
                    echo '<tr id="uno'.$Cena['idcena'].'">
                        <td>'.date("g:i a", strtotime($Cena['hora_cena'])).'</td>
                        <td>'.$Cena['nombre_cena'].'</td>
                        <td >'.$Cena['nombre_cereal'].'</td>
                        <td >'.$Cena['nombre_lacteo'].'</td>
                        <td> 
                            <div> 
                                <a href="#" class="editarCenaUno" data-horacena="'.$Cena['hora_cena'].'" data-cena="'.$Cena['idcena'].'"
                                   data-tipocena="'.$Cena['idtipo_cena'].'" data-cereal="'.$Cena['idcereal'].'"
                                   data-lacteo="'.$Cena['idlacteo'].'">

                                    <i class="glyphicon glyphicon-pencil"></i>
                                </a> 
                            </div>
                        </td>
                        <td> <div class="div-eliminar" data="'.$Cena['idcena'].'" id="div-eliminar'.$Cena['idcena'].'"> <a class="eliminarCenaUno" id="eliminar'.$Cena['idcena'].'" href="#"><i class="glyphicon glyphicon-remove"></i></a></div> </td>                    
                    </tr>';
                }
            } catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }
        }



        public function mostrarListaCenaDos(){
            try{
                $SQL = $this->CONECCIONDIETA->prepare("
                                                SELECT
                                                    CE.idcena,
                                                    CE.hora_cena, 
                                                    TC.idtipo_cena,
                                                    TC.nombre_cena,
                                                    C.idcereal,
                                                    C.nombre_cereal,
                                                    C.porcion_cereal,
                                                    P.idproteina,
                                                    P.nombre_proteina,
                                                    P.porcion_proteina,
                                                    V.idverdura,
                                                    V.nombre_verdura,
                                                    V.porcion_verdura
                                                 FROM cena AS CE 
                                                 INNER JOIN tipo_cena AS TC 
                                                 ON TC.idtipo_cena = CE.fk_idtipo_cena
                                                 INNER JOIN cereal AS C
                                                 ON C.idcereal = CE.fk_idcereal
                                                 INNER JOIN proteina AS P
                                                 ON P.idproteina = CE.fk_idproteina
                                                 INNER JOIN verdura AS V
                                                 ON V.idverdura = CE.fk_idverdura
                                                 WHERE CE.fk_idtipo_cena = TC.idtipo_cena
                                                 AND CE.fk_idcereal = C.idcereal
                                                 AND CE.fk_idproteina = P.idproteina
                                                 AND CE.fk_idverdura = V.idverdura
                ");
                $SQL->execute();
                while($Cena = $SQL->fetch(PDO::FETCH_ASSOC)){
                    echo '<tr id="dos'.$Cena['idcena'].'">
                        <td>'.date("g:i a", strtotime($Cena['hora_cena'])).'</td>
                        <td>'.$Cena['nombre_cena'].'</td>
                        <td >'.$Cena['nombre_cereal'].'</td>
                        <td >'.$Cena['nombre_proteina'].'</td>
                        <td >'.$Cena['nombre_verdura'].'</td>
                        <td> 
                            <div> 
                                <a href="#" class="editarCenaDos" data-horacena="'.$Cena['hora_cena'].'"
                                   data-tipocena="'.$Cena['idtipo_cena'].'" data-cereal="'.$Cena['idcereal'].'"
                                   data-proteina="'.$Cena['idproteina'].'" data-verdura="'.$Cena['idverdura'].'"
                                   data-cena="'.$Cena['idcena'].'">

                                    <i class="glyphicon glyphicon-pencil"></i>
                                </a> 
                            </div>
                        </td>
                        <td> <div class="div-eliminar" data="'.$Cena['idcena'].'" id="div-eliminar'.$Cena['idcena'].'"> <a class="eliminarCenaDos" id="eliminar'.$Cena['idcena'].'" href="#"><i class="glyphicon glyphicon-remove"></i></a></div> </td>                    
                    </tr>';
                }
            } catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }
        }

        public function deleteCena($id){
            try{
                $SQL = $this->CONECCIONDIETA->prepare("DELETE FROM cena WHERE idcena = ".$id.";");
                $SQL->execute();
                echo $id;
            }catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                    </div>';
            }
        }

        public function insertCenaUno($hora, $tipoCena, $cereal, $lacteo, $usuario){
            try{
                $SQL = $this->CONECCIONDIETA->prepare("INSERT INTO 
                                                        cena (hora_cena, fk_idtipo_cena, fk_idcereal, fk_idlacteo, uuid, fk_idusuarios)
                                                        VALUES (:hora, :tipoCena, :cereal, :lacteo, :uuid, :usuario)");
                    $uuid = gen_uuid();
                    $SQL->bindParam(":hora", $hora);
                    $SQL->bindParam(":tipoCena", $tipoCena);
                    $SQL->bindParam(":cereal", $cereal);
                    $SQL->bindParam(":lacteo", $lacteo);
                    $SQL->bindParam(":uuid", $uuid);
                    $SQL->bindParam(":usuario", $usuario);
                    $SQL->execute();

                    echo "Cena registrado";
            }catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                            <button type="button" class="close" data-dismiss="alert">x</button>
                        </div>';
            }
        }

        public function updateCenaUno($id, $hora, $tipoCena, $cereal, $lacteo){
            try{
                $SQL = $this->CONECCIONDIETA->PREPARE("UPDATE 
                                                       cena 
                                                   SET 
                                                       hora_cena =:hora,
                                                       fk_idtipo_cena =:tipoCena,
                                                       fk_idcereal = :cereal,
                                                       fk_idlacteo = :lacteo
                                                   WHERE 
                                                       idcena =:id");
                
                $SQL->bindParam(":hora",$hora);
                $SQL->bindParam(":tipoCena",$tipoCena);
                $SQL->bindParam(":cereal",$cereal);
                $SQL->bindParam(":lacteo",$lacteo);
                $SQL->bindParam(":id", $id);
                $SQL->execute();
                                                      
                    echo "OK";
                      
            }catch (PDOException $e) {
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }
        }
        
        public function insertCenaDos($hora, $tipoCena, $cereal, $proteina, $verdura, $usuario){
            try{
                $SQL = $this->CONECCIONDIETA->prepare("INSERT INTO 
                                                        cena (hora_cena, fk_idtipo_cena, fk_idcereal, fk_idverdura, fk_idproteina, uuid, fk_idusuarios)
                                                        VALUES (:hora, :tipoCena, :cereal, :verdura, :proteina, :uuid, :usuario)");
                    $uuid = gen_uuid();
                    $SQL->bindParam(":hora", $hora);
                    $SQL->bindParam(":tipoCena", $tipoCena);
                    $SQL->bindParam(":cereal", $cereal);
                    $SQL->bindParam(":verdura", $verdura);
                    $SQL->bindParam(":proteina", $proteina);
                    $SQL->bindParam(":uuid", $uuid);
                    $SQL->bindParam(":usuario", $usuario);
                    $SQL->execute();

                    echo "Cena registrado";
            }catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                            <button type="button" class="close" data-dismiss="alert">x</button>
                        </div>';
            }
        }

        public function updateCenaDos($id, $hora, $tipoCena, $cereal, $proteina, $verdura){
            try{
                $SQL = $this->CONECCIONDIETA->PREPARE("UPDATE 
                                                       cena 
                                                   SET 
                                                       hora_cena =:hora,
                                                       fk_idtipo_cena =:tipoCena,
                                                       fk_idcereal = :cereal,
                                                       fk_idproteina = :proteina,
                                                       fk_idverdura = :verdura
                                                   WHERE 
                                                       idcena =:id");
                
                $SQL->bindParam(":hora",$hora);
                $SQL->bindParam(":tipoCena",$tipoCena);
                $SQL->bindParam(":cereal",$cereal);
                $SQL->bindParam(":proteina",$proteina);
                $SQL->bindParam(":verdura",$verdura);
                $SQL->bindParam(":id", $id);
                $SQL->execute();
                                                      
                    echo "OK";
                      
            }catch (PDOException $e) {
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }
        }

        public function mostrarListaColacionDos(){
            try{
                $SQL = $this->CONECCIONDIETA->prepare("
                                                SELECT
                                                    CLD.idcolacion_dos, 
                                                    CLD.hora_colacion, 
                                                    F.idfruta,
                                                    F.nombre_fruta,
                                                    F.porcion_fruta
                                                 FROM colacion_dos AS CLD 
                                                 INNER JOIN fruta AS F 
                                                 ON F.idfruta = CLD.fruta_idfruta
                                                 WHERE CLD.fruta_idfruta = F.idfruta
                ");
                $SQL->execute();
                while($Colacion = $SQL->fetch(PDO::FETCH_ASSOC)){
                    echo '<tr id="'.$Colacion['idcolacion_dos'].'">
                        <td>'.date("g:i a", strtotime($Colacion['hora_colacion'])).'</td>
                        <td>'.$Colacion['nombre_fruta'].'</td>
                        <td >'.$Colacion['porcion_fruta'].'</td>
                        
                        <td> 
                            <div> 
                                <a href="#" class="editar" data-horacolacion="'.$Colacion['hora_colacion'].'"
                                   data-fruta="'.$Colacion['idfruta'].'" data-porcion="'.$Colacion['porcion_fruta'].'"
                                   data-idcolacion="'.$Colacion['idcolacion_dos'].'">

                                    <i class="glyphicon glyphicon-pencil"></i>
                                </a> 
                            </div>
                        </td>
                        <td> <div class="div-eliminar" data="'.$Colacion['idcolacion_dos'].'" id="div-eliminar'.$Colacion['idcolacion_dos'].'"> <a class="eliminar" id="eliminar'.$Colacion['idcolacion_dos'].'" href="#"><i class="glyphicon glyphicon-remove"></i></a></div> </td>                    
                    </tr>';
                }
            } catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }
        }


        public function selectorTipoCena(){
            try{               
                $SQL = $this->CONECCIONDIETA->prepare("SELECT 
                                                        idtipo_cena, 
                                                        nombre_cena 
                                                        FROM tipo_cena");

                $SQL->execute();
                
                while($Fruta = $SQL->fetch(PDO::FETCH_ASSOC)){
                    echo '<option value="'.$Fruta['idtipo_cena'].'">'.$Fruta['nombre_cena'].' </option>';
                }               

            }catch(PDOException $e){

            }
        }
        public function deleteColacionDos($id){
            try{
                $SQL = $this->CONECCIONDIETA->prepare("DELETE FROM colacion_dos WHERE idcolacion_dos = ".$id.";");
                $SQL->execute();
                echo $id;
            }catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                    </div>';
            }
        }

        public function insertColacionDos($hora, $fruta, $usuario){
            try{
                $SQL = $this->CONECCIONDIETA->prepare("INSERT INTO 
                                                        colacion_dos (hora_colacion, fruta_idfruta, uuid, fk_idusuarios)
                                                        VALUES (:hora, :fruta, :uuid, :usuario)");
                    $uuid = gen_uuid();
                    $SQL->bindParam(":hora", $hora);
                    $SQL->bindParam(":fruta", $fruta);
                    $SQL->bindParam(":uuid", $uuid);
                    $SQL->bindParam(":usuario", $usuario);
                    $SQL->execute();

                    echo "Almuerzo registrado";
            }catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                            <button type="button" class="close" data-dismiss="alert">x</button>
                        </div>';
            }
        }

        public function updateColacionDos($id, $hora, $fruta){
            try{
                $SQL = $this->CONECCIONDIETA->PREPARE("UPDATE 
                                                       colacion_dos 
                                                   SET 
                                                       hora_colacion =:hora,
                                                       fruta_idfruta =:fruta
                                                   WHERE 
                                                       idcolacion_dos =:id");
                
                $SQL->bindParam(":hora",$hora);
                $SQL->bindParam(":fruta",$fruta);
                $SQL->bindParam(":id", $id);
                $SQL->execute();
                                                      
                    echo "OK";
                      
            }catch (PDOException $e) {
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }
        }
        
        public function mostrarListaDietaDia(){
            try{
                $SQL = $this->CONECCIONDIETA->prepare("
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
                                                 AND DD.fk_idcena = CE.idcena
                ");
                $SQL->execute();
                while($DietaDia = $SQL->fetch(PDO::FETCH_ASSOC)){
                    echo '<tr id="'.$DietaDia['iddieta_dia'].'">
                        <td>'.date("d-m-Y", strtotime($DietaDia['fecha'])).'</td>
                        <td>'.date("g:i a", strtotime($DietaDia['hora_desayuno'])).'</td>
                        <td>'.date("g:i a", strtotime($DietaDia['hora_armuerzo'])).'</td>
                        <td>'.date("g:i a", strtotime($DietaDia['hora_colacion_uno'])).'</td>
                        <td>'.date("g:i a", strtotime($DietaDia['hora_comida'])).'</td>
                        <td>'.date("g:i a", strtotime($DietaDia['hora_colacion_dos'])).'</td>
                        <td>'.date("g:i a", strtotime($DietaDia['hora_cena'])).'</td>
                        <td> 
                            <div> 
                                <a href="#" class="editar" data-iddesayuno="'.$DietaDia['iddesayuno'].'" data-horadesayuno="'.$DietaDia['hora_desayuno'].'"
                                    data-idalmuerzo="'.$DietaDia['idalmuerzo'].'" data-horaalmuerzo="'.$DietaDia['hora_armuerzo'].'" 
                                    data-idcolacionuno="'.$DietaDia['idcolacion_uno'].'" data-horacolacionuno="'.$DietaDia['hora_colacion_uno'].'"
                                    data-idcomida="'.$DietaDia['idcomida'].'" data-horacomida="'.$DietaDia['hora_comida'].'"
                                    data-idcolaciondos="'.$DietaDia['idcolacion_dos'].'" data-horacolaciondos="'.$DietaDia['hora_colacion_dos'].'"
                                    data-idcena="'.$DietaDia['idcena'].'" data-horacena="'.$DietaDia['hora_cena'].'"
                                    data-dietadia="'.$DietaDia['iddieta_dia'].'"
                                    ><i class="glyphicon glyphicon-pencil"></i>
                                </a> 
                            </div>
                        </td>
                        <td> <div class="div-eliminar" data="'.$DietaDia['iddieta_dia'].'" id="div-eliminar'.$DietaDia['iddieta_dia'].'"> <a class="eliminar" id="eliminar'.$DietaDia['iddieta_dia'].'" href="#"><i class="glyphicon glyphicon-remove"></i></a></div> </td>                    
                    </tr>';
                }
            } catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }
        }
        

        public function mostrarDesayunosSeleccion(){
            try{
                $SQL = $this->CONECCIONDIETA->prepare("SELECT 
                                                            iddesayuno,
                                                            tipo_desayuno,
                                                            descripcion_desayuno,
                                                            hora_desayuno
                                                       FROM
                                                            desayuno");
                $SQL->execute();

                while($Desayuno = $SQL->fetch(PDO::FETCH_ASSOC)){
                    echo '                      
                            <div class="col-lg-4 col-sm-4" id="'.$Desayuno['iddesayuno'].'" id="card">
                                <div class="card card-default">
                                    <div class="card-header">Desayuno</div>
                                    <div class="card-body card-5-7">
                                        <div class="card-center">
                                            <p><strong>Hora :</strong> '.date("g:i a", strtotime($Desayuno['hora_desayuno'])).'</p>
                                            <p><strong>Alimento :</strong> '.$Desayuno['tipo_desayuno'].'</p>
                                            <p><strong>Descripcion :</strong> '.$Desayuno['descripcion_desayuno'].'</p>
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">                                        
                                        <button class="btn btn-info add-desayuno" data-iddesayuno="'.$Desayuno['iddesayuno'].'" data-hora="'.$Desayuno['hora_desayuno'].'">
                                            <i class="glyphicon glyphicon-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                    ';
                }

            }catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }
        }

        public function mostrarALmuerzoSeleccion(){
            try{
                $SQL = $this->CONECCIONDIETA->prepare("SELECT 
                                                            A.idalmuerzo,
                                                            A.hora_armuerzo,
                                                            P.idproteina,
                                                            P.nombre_proteina,
                                                            P.porcion_proteina,
                                                            G.idgrasas,
                                                            G.nombre_grasa,
                                                            G.porcion_grasa,
                                                            V.idverdura,
                                                            V.nombre_verdura,
                                                            V.porcion_verdura,
                                                            C.idcereal,
                                                            C.nombre_cereal,
                                                            C.porcion_cereal
                                                       FROM
                                                            almuerzo AS A
                                                       INNER JOIN proteina AS P ON P.idproteina = A.fk_idproteina
                                                       INNER JOIN grasa AS G ON G.idgrasas = A.fk_idgrasas
                                                       INNER JOIN verdura AS V ON V.idverdura = A.fk_idverdura
                                                       INNER JOIN cereal AS C ON C.idcereal = A.fk_idcereal
                                                       
                                                       WHERE A.fk_idproteina = P.idproteina
                                                       AND A.fk_idgrasas = G.idgrasas
                                                       AND A.fk_idverdura = V.idverdura
                                                       AND A.fk_idcereal = C.idcereal");
                $SQL->execute();

                while($Almuerzo = $SQL->fetch(PDO::FETCH_ASSOC)){
                    echo '                      
                            <div class="col-lg-4 col-sm-4" id="'.$Almuerzo['idalmuerzo'].'" id="card">
                                <div class="card card-default">
                                    <div class="card-header">Almuerzo '.$Almuerzo['idalmuerzo'].'</div>
                                    <div class="card-body card-5-7">
                                        <div class="card-center">
                                            <p><strong>Hora :</strong> '.date("g:i a", strtotime($Almuerzo['hora_armuerzo'])).'</p>
                                            <p><strong>Proteina :</strong> '.$Almuerzo['nombre_proteina'].' '.$Almuerzo['porcion_proteina'].'</p>
                                            <p><strong>Grasa :</strong> '.$Almuerzo['nombre_grasa'].' '.$Almuerzo['porcion_grasa'].'</p>
                                            <p><strong>Verdura :</strong> '.$Almuerzo['nombre_verdura'].' '.$Almuerzo['porcion_verdura'].'</p>
                                            <p><strong>Cereal :</strong> '.$Almuerzo['nombre_cereal'].' '.$Almuerzo['porcion_cereal'].'</p>
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">                                        
                                        <button class="btn btn-info add-almuerzo" data-idalmuerzo="'.$Almuerzo['idalmuerzo'].'" data-hora="'.$Almuerzo['hora_armuerzo'].'">
                                            <i class="glyphicon glyphicon-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                    ';
                }

            }catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }
        }


        public function mostrarComidaSeleccion(){
            try{
                $SQL = $this->CONECCIONDIETA->prepare("SELECT 
                                                            CO.idcomida,
                                                            CO.hora_comida,
                                                            G.idgrasas,
                                                            G.nombre_grasa,
                                                            G.porcion_grasa,
                                                            P.idproteina,
                                                            P.nombre_proteina,
                                                            P.porcion_proteina,
                                                            V.idverdura,
                                                            V.nombre_verdura,
                                                            V.porcion_verdura,
                                                            C.idcereal,
                                                            C.nombre_cereal,
                                                            C.porcion_cereal,
                                                            L.idleguminosa,
                                                            L.nombre_leguminosa,
                                                            L.porcion_leguminosa
                                                       FROM
                                                            comida AS CO
                                                       INNER JOIN grasa AS G ON G.idgrasas = CO.fk_idgrasas
                                                       INNER JOIN proteina AS P ON P.idproteina = CO.fk_idproteina
                                                       INNER JOIN verdura AS V ON V.idverdura = CO.fk_idverdura
                                                       INNER JOIN cereal AS C ON C.idcereal = CO.fk_idcereal
                                                       INNER JOIN leguminosa AS L ON L.idleguminosa = CO.fk_idleguminosa
                                                       
                                                       WHERE CO.fk_idgrasas = G.idgrasas
                                                       AND  CO.fk_idproteina = P.idproteina
                                                       AND CO.fk_idverdura = V.idverdura
                                                       AND CO.fk_idcereal = C.idcereal
                                                       AND CO.fk_idleguminosa = L.idleguminosa");
                $SQL->execute();

                while($Comida = $SQL->fetch(PDO::FETCH_ASSOC)){
                    echo '                      
                            <div class="col-lg-4 col-sm-4" id="'.$Comida['idcomida'].'" id="card">
                                <div class="card card-default">
                                    <div class="card-header">Comida '.$Comida['idcomida'].'</div>
                                    <div class="card-body card-5-7">
                                        <div class="card-center">
                                            <p><strong>Hora :</strong> '.date("g:i a", strtotime($Comida['hora_comida'])).'</p>
                                            <p><strong>Proteina :</strong> '.$Comida['nombre_proteina'].' '.$Comida['porcion_proteina'].'</p>
                                            <p><strong>Grasa :</strong> '.$Comida['nombre_grasa'].' '.$Comida['porcion_grasa'].'</p>
                                            <p><strong>Verdura :</strong> '.$Comida['nombre_verdura'].' '.$Comida['porcion_verdura'].'</p>
                                            <p><strong>Cereal :</strong> '.$Comida['nombre_cereal'].' '.$Comida['porcion_cereal'].'</p>
                                            <p><strong>Leguminosa :</strong> '.$Comida['nombre_leguminosa'].' '.$Comida['porcion_leguminosa'].'</p>
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">                                        
                                        <button class="btn btn-info add-comida" data-idcomida="'.$Comida['idcomida'].'" data-hora="'.$Comida['hora_comida'].'">
                                            <i class="glyphicon glyphicon-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                    ';
                }

            }catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }
        }


        public function mostrarCenaSeleccion(){
            try{
                $SQL = $this->CONECCIONDIETA->prepare("SELECT 
                                                            CE.idcena,
                                                            CE.hora_cena,
                                                            TC.idtipo_cena,
                                                            C.idcereal,
                                                            C.nombre_cereal,
                                                            C.porcion_cereal,
                                                            L.idlacteo,
                                                            L.nombre_lacteo,
                                                            L.porcion_lacteo,
                                                            V.idverdura,
                                                            V.nombre_verdura,
                                                            V.porcion_verdura,
                                                            P.idproteina,
                                                            P.nombre_proteina,
                                                            P.porcion_proteina                                                            
                                                       FROM
                                                            cena AS CE
                                                       LEFT JOIN tipo_cena AS TC ON TC.idtipo_cena = CE.fk_idtipo_cena
                                                       LEFT JOIN cereal AS C ON C.idcereal = CE.fk_idcereal
                                                       LEFT JOIN lacteo AS L ON L.idlacteo = CE.fk_idlacteo
                                                       LEFT JOIN verdura AS V ON V.idverdura = CE.fk_idverdura
                                                       LEFT JOIN proteina AS P ON P.idproteina = CE.fk_idproteina
                                                                                                              
                                                       
                                                       ");
                $SQL->execute();
                
                while($Cena = $SQL->fetch(PDO::FETCH_ASSOC)){
                    $lacteo ='';
                    $verdura = '';
                    $proteina = '';

                    if($Cena['nombre_lacteo'] != null){
                      $lacteo = '<p><strong>Lacteo :</strong> '.$Cena['nombre_lacteo'].' '.$Cena['porcion_lacteo'].'</p> ';
                    }
                    
                    if($Cena['nombre_verdura'] != null){
                        $verdura = '<p><strong>Verdura :</strong> '.$Cena['nombre_verdura'].' '.$Cena['porcion_verdura'].'</p> ';
                    }
                    if($Cena['nombre_proteina'] != null){
                        $proteina = '<p><strong>Proteina :</strong> '.$Cena['nombre_proteina'].' '.$Cena['porcion_proteina'].'</p> ';
                    }

                    echo '                      
                            <div class="col-lg-4 col-sm-4" id="'.$Cena['idcena'].'" id="card">
                                <div class="card card-default">
                                    <div class="card-header">Cena '.$Cena['idcena'].'</div>
                                    <div class="card-body card-5-7">
                                        <div class="card-center">
                                            <p><strong>Hora :</strong> '.date("g:i a", strtotime($Cena['hora_cena'])).'</p>
                                            <p><strong>Cereal :</strong> '.$Cena['nombre_cereal'].' '.$Cena['porcion_cereal'].'</p>
                                            '.$lacteo.'                                            
                                            '.$verdura.'
                                            '.$proteina.'
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">                                        
                                        <button class="btn btn-info add-cena" data-idcena="'.$Cena['idcena'].'" data-hora="'.$Cena['hora_cena'].'">
                                            <i class="glyphicon glyphicon-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                    ';
                    
                }

            }catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }
        }


        public function mostrarColacionUnoSeleccion(){
            try{
                $SQL = $this->CONECCIONDIETA->prepare("SELECT 
                                                            CLU.idcolacion_uno,
                                                            CLU.hora_colacion,
                                                            F.idfruta,
                                                            F.nombre_fruta,
                                                            F.porcion_fruta
                                                       FROM
                                                            colacion_uno AS CLU
                                                        INNER JOIN fruta AS F ON F.idfruta = CLU.fk_idfruta
                                                        WHERE CLU.fk_idfruta = F.idfruta");
                $SQL->execute();

                while($ColacionUno = $SQL->fetch(PDO::FETCH_ASSOC)){
                    echo '                      
                            <div class="col-lg-4 col-sm-4" id="'.$ColacionUno['idcolacion_uno'].'" id="card">
                                <div class="card card-default">
                                    <div class="card-header">Colacion '.$ColacionUno['idcolacion_uno'].'</div>
                                    <div class="card-body card-5-7">
                                        <div class="card-center">
                                            <p><strong>Hora :</strong> '.date("g:i a", strtotime($ColacionUno['hora_colacion'])).'</p>
                                            <p><strong>Alimento :</strong> '.$ColacionUno['nombre_fruta'].' '.$ColacionUno['porcion_fruta'].'</p>
                                         </div>
                                    </div>
                                    <div class="card-footer text-right">                                        
                                        <button class="btn btn-info add-colacion-uno" data-idcolacionuno="'.$ColacionUno['idcolacion_uno'].'" data-hora="'.$ColacionUno['hora_colacion'].'">
                                            <i class="glyphicon glyphicon-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                    ';
                }

            }catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }
        }



        public function mostrarColacionDosSeleccion(){
            try{
                $SQL = $this->CONECCIONDIETA->prepare("SELECT 
                                                            CLD.idcolacion_dos,
                                                            CLD.hora_colacion,
                                                            F.idfruta,
                                                            F.nombre_fruta,
                                                            F.porcion_fruta
                                                       FROM
                                                            colacion_dos AS CLD
                                                        INNER JOIN fruta AS F ON F.idfruta = CLD.fruta_idfruta
                                                        WHERE CLD.fruta_idfruta = F.idfruta");
                $SQL->execute();

                while($ColacionDos = $SQL->fetch(PDO::FETCH_ASSOC)){
                    echo '                      
                            <div class="col-lg-4 col-sm-4" id="'.$ColacionDos['idcolacion_dos'].'" id="card">
                                <div class="card card-default">
                                    <div class="card-header">Colacion '.$ColacionDos['idcolacion_dos'].'</div>
                                    <div class="card-body card-5-7">
                                        <div class="card-center">
                                            <p><strong>Hora :</strong> '.date("g:i a", strtotime($ColacionDos['hora_colacion'])).'</p>
                                            <p><strong>Alimento :</strong> '.$ColacionDos['nombre_fruta'].' '.$ColacionDos['porcion_fruta'].'</p>
                                         </div>
                                    </div>
                                    <div class="card-footer text-right">                                        
                                        <button class="btn btn-info add-colacion-dos" data-idcolaciondos="'.$ColacionDos['idcolacion_dos'].'" data-hora="'.$ColacionDos['hora_colacion'].'">
                                            <i class="glyphicon glyphicon-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                    ';
                }

            }catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                      </div>';
            }
        }


        public function insertDietaDia($desayuno, $almuerzo, $colacionUno, $comida, $colacionDos, $cena, $usuario){
            try{
                $SQL = $this->CONECCIONDIETA->prepare("INSERT INTO 
                                                        dieta_dia (fk_iddesayuno, fk_idalmuerzo, fk_idcolacion_uno, fk_idcomida, fk_idcolacion_dos, fk_idcena, fk_idusuarios, uuid)
                                                        VALUES (:desayuno, :almuerzo, :colacionUno, :comida, :colacionDos, :cena, :usuario, :uuid)");
                    $uuid = gen_uuid();
                    $SQL->bindParam(":desayuno", $desayuno);
                    $SQL->bindParam(":almuerzo", $almuerzo);
                    $SQL->bindParam(":colacionUno", $colacionUno);
                    $SQL->bindParam(":comida", $comida);
                    $SQL->bindParam(":colacionDos", $colacionDos);
                    $SQL->bindParam(":cena", $cena);
                    $SQL->bindParam(":usuario", $usuario);
                    $SQL->bindParam(":uuid", $uuid);
                    $SQL->execute();

                    echo "Dieta registrada";
            }catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                            <button type="button" class="close" data-dismiss="alert">x</button>
                        </div>';
            }
        }



        public function updateDietaDia($id, $desayuno, $almuerzo, $colacionUno, $comida, $colacionDos, $cena){
            try{
                 $SQL = $this->CONECCIONDIETA->PREPARE("UPDATE 
                                                        dieta_dia 
                                                    SET 
                                                        fk_iddesayuno =:desayuno,
                                                        fk_idalmuerzo =:almuerzo,
                                                        fk_idcolacion_uno =:colacionUno,
                                                        fk_idcomida =:comida,
                                                        fk_idcolacion_dos =:colacionDos,
                                                        fk_idcena = :cena
                                                    WHERE 
                                                        iddieta_dia =:id");
                 
                 $SQL->bindParam(":desayuno",$desayuno);
                 $SQL->bindParam(":almuerzo",$almuerzo);
                 $SQL->bindParam(":colacionUno",$colacionUno);
                 $SQL->bindParam(":comida",$comida);
                 $SQL->bindParam(":colacionDos", $colacionDos);
                 $SQL->bindParam(":cena", $cena);
                 $SQL->bindParam(":id", $id);
                 $SQL->execute();
                                                       
                     echo "OK";
                       
             }catch (PDOException $e) {
                 echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                         <button type="button" class="close" data-dismiss="alert">x</button>
                       </div>';
             }
         }
        

         public function deleteDietaDia($id){
            try{
                $SQL = $this->CONECCIONDIETA->prepare("DELETE FROM dieta_dia WHERE iddieta_dia = ".$id.";");
                $SQL->execute();
                echo $id;
            }catch(PDOException $e){
                echo '<div class="alert alert-dismissable alert-danger">Ocurrió un error: '.$e->getMessage().'
                        <button type="button" class="close" data-dismiss="alert">x</button>
                    </div>';
            }
        }

    }

    function gen_uuid() {
        return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            // 32 bits for "time_low"
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
    
            // 16 bits for "time_mid"
            mt_rand( 0, 0xffff ),
    
            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand( 0, 0x0fff ) | 0x4000,
    
            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand( 0, 0x3fff ) | 0x8000,
    
            // 48 bits for "node"
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
        );
    }

    
?>