<?php
    class Solicitudes{
        private $bd;
        private $itms;
        public function __construct(){
            require_once("conexionPablo.php");
            $this->bd=Conectar::conexion();        
        }
        
        public function getTamPedido($id){            
            $consulta="SELECT  p.id_usuarios from items_pendientes p where p.id_usuarios=" . $id;
            $sql=$this->bd->query($consulta)->fetchAll(PDO::FETCH_OBJ);
            $row=0;
            foreach($sql as $a):    
                $row++;
            endforeach;                        
            return $row;
            //header("Location:solicitudes_vista");
        }

        public function getPedido($id){            
            $consulta="SELECT pedido.id_pedido from pedido where pedido.id_usuarios=" . $id;
            $sql=$this->bd->query($consulta)->fetchAll(PDO::FETCH_OBJ);
            $row=0;
            foreach($sql as $a):    
                $row++;
            endforeach;                        
            return $row+1;
            header("Location:solicitudes_vista");
        }
        public function getItems($id){
            $consulta="SELECT id_pendientes,cantida, unidad, detalle,archivo FROM items_pendientes WHERE items_pendientes.id_usuarios=" . $id;
            $sql=$this->bd->query($consulta)->fetchAll(PDO::FETCH_OBJ);
            return $sql;
            header("Location:solicitudes_vista.php");
        }
        public function addItems($idPedido,$cantidad,$unidad,$detalle,$archivo){                                            
            $sql = "INSERT INTO items(id_pedido,cantidad,unidad,detalle,archivo) VALUES (:idPedido,:cantidad,:unidad,:detalle,:archivo)";
            $resultado=$this->bd->prepare($sql);
            $resultado->execute(array(":idPedido"=>$idPedido, ":cantidad"=>$cantidad,":unidad"=>$unidad,":detalle"=>$detalle,":archivo"=>$archivo));                    
            header("Location:solicitudes_vista");
        }
        public function addPedido($fecha,$justificacion,$id_usuarios){                                            
            $sql = "INSERT INTO pedido(fecha,justificacion,id_usuarios) VALUES (:fecha,:justificacion,:id_usuarios)";
            $resultado=$this->bd->prepare($sql);
            $resultado->execute(array(":fecha"=>$fecha, ":justificacion"=>$justificacion,":id_usuarios"=>$id_usuarios));
            $dato=$this->ultimoPedido();
            $this->moveItems($dato,$this->getItems($id_usuarios));
            $this->removeItemsPendientes($id_usuarios);
            $this->addSolicitud($dato);              
            header("Location:solicitudes_vista");          
        }
        public function addItemsPendientes($id_usuario,$cantidad,$unidad,$detalle,$archivo,$ruta){                                            
            $sql = "INSERT INTO items_pendientes(cantida,unidad,detalle,archivo,ruta,id_usuarios) VALUES (:cantida,:unidad,:detalle,:archivo,:ruta,:id_usuarios)";
            $resultado=$this->bd->prepare($sql);
            $resultado->execute(array(":cantida"=>$cantidad,":unidad"=>$unidad,":detalle"=>$detalle,":archivo"=>$archivo,":ruta"=>$ruta,":id_usuarios"=>$id_usuario));                    
           
        }        
        public function ultimoPedido(){            
            $consulta="SELECT MAX(id_pedido) as id_pedido FROM pedido";
            $sql=$this->bd->query($consulta)->fetchAll(PDO::FETCH_OBJ);        
            foreach($sql as $s):
                $dato=$s->id_pedido;
            endforeach;
            return $dato;      
            
        }
        public function moveItems($dato,$registros){
            foreach($registros as $r):
                $c=$r->cantida;
                $u=$r->unidad;            
                $d=$r->detalle;
                $a=$r->archivo;
                $sql = "INSERT INTO items(id_pedido,cantidad,unidad,detalle,archivo) VALUES (?,?,?,?,?)";                
                $resultado=$this->bd->prepare($sql);
                $resultado->execute([$dato,$c,$u,$d,$a]);
            endforeach;
        }

        public function removeItemsPendientes($id_usuarios){
                $sql = "DELETE FROM items_pendientes WHERE items_pendientes.id_usuarios=?";                
                $resultado=$this->bd->prepare($sql);
                $resultado->execute([$id_usuarios]);
        }
        public function addSolicitud($dato){            
            $sql = "INSERT INTO solicitudes(id_pedido,estado) VALUES (?,?)";                
            $resultado=$this->bd->prepare($sql);
            $resultado->execute([$dato,"pendiente"]);
        }

        public function borrarItem($id){
            $sql = "DELETE FROM items_pendientes WHERE items_pendientes.id_pendientes=?";                
            $resultado=$this->bd->prepare($sql);
            $resultado->execute([$id]);
        }

        public function getUsuario($id_usuario){
            $consulta="SELECT nombres,apellidos FROM usuarios WHERE usuarios.id_usuarios=".$id_usuario;
            $sql=$this->bd->query($consulta)->fetchAll(PDO::FETCH_OBJ);      

            foreach($sql as $s):
                $dato=$s->nombres;
                $apellido=$s->apellidos;
            endforeach;
            return $apellido." ".$dato;  
        }

        public function getItemsPedido($id_usuario,$id_pedido,$id_solicitud){
            $consulta="SELECT i.cantidad, i.unidad, i.detalle, i.archivo FROM solicitudes s, pedido p, items i WHERE (s.id_pedido=p.id_pedido && p.id_pedido=i.id_pedido) && s.id_solicitudes=".$id_solicitud." && p.id_pedido=".$id_pedido;
            $sql=$this->bd->query($consulta)->fetchAll(PDO::FETCH_OBJ);
            return $sql;
            header("Location:solicitudes_vista.php");                    
        }

        public function getJustificacion($id_usuario,$id_pedido,$id_solicitud){
            $consulta="SELECT p.justificacion FROM solicitudes s, pedido p WHERE (s.id_pedido=p.id_pedido) && s.id_solicitudes=".$id_solicitud." && p.id_pedido=".$id_pedido;
            $sql=$this->bd->query($consulta)->fetchAll(PDO::FETCH_OBJ);      
            foreach($sql as $s):
                $dato=$s->justificacion;                
            endforeach;
            return $dato;  
        }

    }
?>