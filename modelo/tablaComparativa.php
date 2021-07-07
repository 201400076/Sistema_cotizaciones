<?php
class TablaComparativa{
    private $Modelo;
    private $db;
    public function __construct(){
        $this->Modelo = array();
        $this->db=new PDO('mysql:host=localhost;dbname=sistema_de_cotizaciones',"root","");
    }
 /*    public function insertar($tabla, $data){
        $consulta="insert into ".$tabla." values(null,". $data .")";
        $resultado=$this->db->query($consulta);
        if ($resultado) {
            return true;
        }else {
            return false;
        }
     } */
    public function mostrar($tabla,$condicion){

        $consul="select distinct id_items from ".$tabla." where ".$condicion.";";
            $resu=$this->db->query($consul);
           // $contarFilas=$resu->num_rows;
            while($filas = $resu->FETCHALL(PDO::FETCH_ASSOC)) {
                $this->Modelo[]=$filas;
            }
            return $this->Modelo;
    }

}
?>