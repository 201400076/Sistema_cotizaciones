<?php
require('../librerias/fpdf/fpdf.php');
class PDF extends FPDF{
function Header()
{
    $this->Image('../recursos/imagenes/umss.png',8,1,53);
        $ancho=190;
         $this->setFont('Arial','B',8);
   
            $this->SetY(12); //Mencionamos que el curso en la posición Y empezará a los 12 puntos para escribir el Usuario:
            $this->Cell($ancho, 10,'sistema.cotizaciones.umss@gmail.com', 0, 0, 'R');
            $this->SetY(15);
            $this->Cell($ancho, 10,'NIT: 6407874001 ', 0, 0, 'R');
            $this->SetY(18);
            $this->Cell($ancho, 10,utf8_decode('Vinto - Motecato, calle Bélgica y Noruega'), 0, 0, 'R');    
            $this->SetY(21);
            $this->Cell($ancho, 10,utf8_decode('(+591) 76436540 - 44355215'), 0, 0, 'R');       
}         

function Body(){  
    $yy = 40; //Variable auxiliar para desplazarse 40 puntos del borde superior hacia abajo en la coordenada de las Y para evitar que el título este al nivel de la cabecera.
    $y = $this->GetY(); 
    $this->AddPage($this->CurOrientation);
     
    $this->SetFont('helvetica', 'BU', 20); //Asignar la fuente, el estilo de la fuente (negrita) y el tamaño de la fuente
    $this->SetXY(45, 45); //Ubicación según coordenadas X, Y. X=0 porque empezará desde el borde izquierdo de la página
    $this->Cell(120, 10, "Informe solicitud rechazada", 0, 1, 'C');

    $this->SetFont('Arial', '', 12);
    $this->setY(60);
    $this->Cell(50,10,'Solicitado Por: ',0,0,'L');

    $this->setXY(10,65);
    $this->Cell(50,10,'Responsable: ',0,0,'L');
    $this->setXY(103,60);
    $this->setXY(105,60);
    $this->Cell(50,10,utf8_decode('Solicitud N°:'),0,0,'R');
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
require('../controladores/solicitudesController.php');
session_start();
$nomUsuAdm = $_SESSION['nombre_usuario'];  
$solicitud =new Solicitud();
$dato = $solicitud->mostrar("pedido,solicitudes,usuarios,usuarioconrol,unidad_gasto","pedido.id_pedido=solicitudes.id_pedido
                                                AND usuarios.id_usuarios=pedido.id_usuarios
                                                AND usuarios.id_usuarios=usuarioconrol.id_usuarios
                                                AND usuarioconrol.id_gasto=unidad_gasto.id_gasto
                                                AND estado='rechazada'
                                                order by fecha_evaluacion desc");

                                   
$i=0;
foreach($dato as $valor):
//do{
	$idRescate=$_GET['id'];							
    $pdf = new PDF();
  
    $pdf->pagina=0;
    $pdf->AliasNbPages();
    $pdf->Body();

    $pdf->SetFont('Times','BI',14);
    $pdf->setXY(155,25);
    $pdf->Cell(10,80,$valor[$idRescate]['id_solicitudes'],0,0,'L');

    $pdf->setXY(170,45);
    $pdf->Cell(10,50,$valor[$idRescate]['fecha'],0,0,'L');

    $pdf->setXY(170,50);
    $pdf->Cell(10,50,$valor[$idRescate]['fecha_evaluacion'],0,0,'L');

    $pdf->setXY(40,40);
    $pdf->Cell(10,50,$valor[$idRescate]['nombres']." ".$valor[$idRescate]['apellidos'],0,0,'L');
    $pdf->setXY(40,45);
    $pdf->Cell(10,50,$nomUsuAdm,0,0,'L');

    $pdf->SetFont('Times','I',14);
    $pdf->setXY(15,100);
    $txt=$valor[$idRescate]['detalle'];
    $pdf->MultiCell(0,5,$txt,0,'L');
    $i++;

    endforeach;	
    $pdf->Output();
?>
