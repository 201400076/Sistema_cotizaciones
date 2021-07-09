<?php
require('../librerias/fpdf/fpdf.php');
class PDF extends FPDF{
function Header(){
    $this->Image('../recursos/imagenes/umss.png',8,1,53);    
}         

function Body(){  
    $yy = 40; //Variable auxiliar para desplazarse 40 puntos del borde superior hacia abajo en la coordenada de las Y para evitar que el título este al nivel de la cabecera.
    $y = $this->GetY(); 
    $this->AddPage($this->CurOrientation);
     
    $this->SetFont('helvetica', 'BU', 20);
    $this->SetXY(45, 35);
    $this->Cell(120, 10, "Informe Solicitud Rechazada", 0, 1, 'C');
    $this->SetFont('Arial', '', 12);
    $this->setY(60);
    $this->Cell(50,10,'Responsable  : ',0,0,'L');
    $this->setXY(10,65);
    $this->Cell(50,10,'Solicitante      : ',0,0,'L');
    $this->setXY(10,70);
    $this->Cell(50,10,'Encargado de: ',0,0,'L');
    $this->setXY(104,60);
    $this->Cell(50,10,utf8_decode('Solicitud N°:'),0,0,'R');;
    $this->setXY(120,65);
    $this->Cell(50,10,'Fecha de recepcion:',0,0,'R');
    $this->setXY(116,70);
    $this->Cell(50,10,'Fecha de revision:',0,0,'R');

    $this->SetFont('Times','BI',14);
    $this->SetY(80);
    $this->Cell(190, 10, utf8_decode("Descripción"), 0, 1, 'C');
    $this->Cell(190, 50, utf8_decode(""), 1, 1, 'L');

}  

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}
require_once '../configuraciones/conexion.php';
require('../controladores/solicitudesController.php');
session_start();
$nomUsuAdm = $_SESSION['nombre_usuario']; 
$unidad = $_SESSION['unidad']; 
$idRes=$_GET['id'];
$solicitud =new Solicitud();
$dato = $solicitud->mostrar("pedido,solicitudes,usuarios,usuarioconrol,unidad_gasto","pedido.id_pedido=solicitudes.id_pedido
                                                AND usuarios.id_usuarios=pedido.id_usuarios
                                                AND usuarios.id_usuarios=usuarioconrol.id_usuarios
                                                AND usuarioconrol.id_gasto=unidad_gasto.id_gasto
                                                AND pedido.id_unidad=unidad_gasto.id_unidad
                                                AND estado='rechazada' AND unidad_gasto.id_unidad=".$unidad);

                                   
$i=0;
foreach($dato as $valor):
//do{
    $nombre = nombreUnidad($unidad);
	$idRescate=$_GET['id'];							
    $pdf = new PDF();
  
    $pdf->pagina=0;
    $pdf->AliasNbPages();
    $pdf->Body();

    $pdf->setFont('Arial','B',8);
    $pdf->SetY(12);
    $pdf->Cell(190, 10,utf8_decode($nombre['nombre_facultad']), 0, 0, 'R');
    $pdf->SetY(16);
    $pdf->Cell(190, 10,'sistema.cotizaciones.umss@gmail.com', 0, 0, 'R');   
    $pdf->SetY(20);
    $pdf->Cell(190, 10,utf8_decode('Dir: Av. Oquendo final Jordán(Campus Central)'), 0, 0, 'R'); 


    $pdf->SetFont('Times','BI',14);
    $pdf->setXY(155,25);
    $pdf->Cell(10,80,$valor[$idRescate]['id_solicitudes'],0,0,'L');

    $pdf->setXY(170,45);
    $pdf->Cell(10,50,$valor[$idRescate]['fecha'],0,0,'L');

    $pdf->setXY(170,50);
    $pdf->Cell(10,50,$valor[$idRescate]['fecha_evaluacion'],0,0,'L');
    $pdf->setXY(40,40);
    $pdf->Cell(10,50,$nomUsuAdm,0,0,'L');
    $pdf->setXY(40,45);
    $pdf->Cell(10,50,$valor[$idRescate]['nombres']." ".$valor[$idRescate]['apellidos'],0,0,'L');
    $pdf->setXY(40,50);
    $pdf->Cell(10,50,$valor[$idRescate]['nombre_gasto'],0,0,'L');
    
    $pdf->SetFont('Times','BI',13);
    $pdf->SetXY(25,45);
    $pdf->Cell(150, 10, utf8_decode($nombre['nombre_unidad']), 0, 1, 'C');

    $pdf->SetFont('Times','I',14);
    $pdf->setXY(15,100);
    $txt=$valor[$idRescate]['detalle'];
    $pdf->MultiCell(0,5,$txt,0,'L');
    $i++;

    endforeach;	
    $pdf->Output();

    function nombreUnidad($idUnidad){
        $conn = new Conexiones();
        $estadoConexion = $conn->getConn();
        $datos = "SELECT * FROM unidad_administrativa, facultad WHERE facultad.id_facultad=unidad_administrativa.id_facultad AND unidad_administrativa.id_unidad=".$idUnidad;
        $queryDatos=$estadoConexion->query($datos);
        return $queryDatos->fetch_array(MYSQLI_BOTH);
    }
?>
