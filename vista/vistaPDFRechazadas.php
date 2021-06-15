<?php


require('../librerias/fpdf/fpdf.php');
//include_once('../controladores/solicitudesController.php');
class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('../recursos/imagenes/umss.png',8,1,53);
    // Arial bold 15
  /*   $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(120);
    // Título
    $this->Cell(30,10,'Title',1,0,'C');
    // Salto de línea
    $this->Ln(20); */

        $ancho=190;
         $this->setFont('Arial','B',8);

   
            $this->SetY(12); //Mencionamos que el curso en la posición Y empezará a los 12 puntos para escribir el Usuario:
            $this->Cell($ancho, 10,'programandoElFuturo.SRL@gmail.com', 0, 0, 'R');
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
    //$x = 12;
    $this->AddPage($this->CurOrientation);
     
    $this->SetFont('helvetica', 'BU', 20); //Asignar la fuente, el estilo de la fuente (negrita) y el tamaño de la fuente
    $this->SetXY(45, 45); //Ubicación según coordenadas X, Y. X=0 porque empezará desde el borde izquierdo de la página
    $this->Cell(120, 10, "Informe solicitud rechazada", 0, 1, 'C');

    $this->SetFont('Arial', '', 12);
    $this->setY(60);
    $this->Cell(50,10,'Solicitado Por: ',0,0,'L');


    $this->setY(60);
    $this->setX(105);
    $this->Cell(50,10,utf8_decode('Solicitud N°:'),0,0,'R');
    $this->setY(65);
    $this->setX(120);
    $this->Cell(50,10,'Fecha de recepcion:',0,0,'R');
    $this->setY(70);
    $this->setX(116);
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
$solicitud =new Solicitud();
$dato = $solicitud->mostrar("pedido,solicitudes,usuarios,usuarioconrol,unidad_gasto","pedido.id_pedido=solicitudes.id_pedido
                                                AND usuarios.id_usuarios=pedido.id_usuarios
                                                AND usuarios.id_usuarios=usuarioconrol.id_usuarios
                                                AND usuarioconrol.id_gasto=unidad_gasto.id_gasto
                                                AND estado='rechazada'
                                                order by fecha desc");

                                       
$i=0;
foreach($dato as $valor):
//do{
	$idRescate=$_GET['id'];							
    // Creación del objeto de la clase heredada
    $pdf = new PDF();
  
    $pdf->pagina=0;
    $pdf->AliasNbPages();
    $pdf->Body();

    //$pdf->AddPage();
    $pdf->SetFont('Times','BI',14);
    $pdf->setY(25);
    $pdf->setX(155);
    $pdf->Cell(10,80,$valor[$idRescate]['id_solicitudes'],0,0,'L');

    $pdf->setY(45);
    $pdf->setX(170);
    $pdf->Cell(10,50,$valor[$idRescate]['fecha'],0,0,'L');

    $pdf->setY(50);
    $pdf->setX(170);
    $pdf->Cell(10,50,$valor[$idRescate]['fecha_evaluacion'],0,0,'L');

    $pdf->setY(40);
    $pdf->setX(40);
    $pdf->Cell(10,50,$valor[$idRescate]['nombres'],0,0,'L');


    $pdf->SetFont('Times','I',14);
    $pdf->setY(100);
    $pdf->setX(15);
    $txt=$valor[$idRescate]['detalle'];
    $pdf->MultiCell(0,5,$txt,0,'L');

    
    /* $pdf->setY(170);
    $pdf->setX(40);
    $pdf->Cell(10,50,$idRescate,0,0,'L'); */
  
   $i++;
//}
//while($i<sizeof($valor));
endforeach;	
$pdf->Output();
?>
