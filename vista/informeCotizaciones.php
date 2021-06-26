<?php
require('../librerias/fpdf/fpdf.php');
class PDF extends FPDF{
function Header(){
    // Logo
    $this->Image('../recursos/imagenes/umss.png',8,1,53);
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
    $this->Cell(120, 10, "Informe Cotizacion Rechazada", 0, 1, 'C');

    $this->SetFont('Arial', '', 12);
    $this->setY(60);
    $this->Cell(50,10,'Solicitado Por: ',0,0,'L');

    $this->setXY(10,65);
    $this->Cell(50,10,'Responsable: ',0,0,'L');
    $this->setXY(103,60);
    $this->Cell(50,10,utf8_decode('Solicitud N°:'),0,0,'R');
    $this->setXY(116,65);
    $this->Cell(50,10,'Fecha de licitacion:',0,0,'R');
    $this->setXY(120,70);
    $this->Cell(50,10,'Fecha de evaluacion:',0,0,'R');

    $this->SetFont('Times','BI',14);
    $this->SetY(80);
    $this->Cell(190, 10, utf8_decode("Justificativo"), 0, 1, 'C');
    $this->Cell(190, 50, utf8_decode(""), 1, 1, 'L');
}

function Body1(){

    $yy = 40; //Variable auxiliar para desplazarse 40 puntos del borde superior hacia abajo en la coordenada de las Y para evitar que el título este al nivel de la cabecera.
    $y = $this->GetY(); 
    //$x = 12;
    $this->AddPage($this->CurOrientation);
     
    $this->SetFont('helvetica', 'BU', 20); //Asignar la fuente, el estilo de la fuente (negrita) y el tamaño de la fuente
    $this->SetXY(45, 45); //Ubicación según coordenadas X, Y. X=0 porque empezará desde el borde izquierdo de la página
    $this->Cell(120, 10, "Informe Cotizacion Aceptada", 0, 1, 'C');

    $this->SetFont('Arial', '', 12);
    $this->setY(60);
    $this->Cell(50,10,'Solicitado Por: ',0,0,'L');

    $this->setXY(10,65);
    $this->Cell(50,10,'Responsable: ',0,0,'L');
    $this->setXY(103,60);
    $this->Cell(50,10,utf8_decode('Solicitud N°:'),0,0,'R');
    $this->setXY(116,65);
    $this->Cell(50,10,'Fecha de licitacion:',0,0,'R');
    $this->setXY(120,70);
    $this->Cell(50,10,'Fecha de evaluacion:',0,0,'R');

    $this->SetFont('Times','BI',14);
    $this->SetY(80);
    $this->Cell(190, 10, utf8_decode("Empresa Adjudicada"), 0, 1, 'C');
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
require_once('../configuraciones/conexion.php');
    session_start();
    $nomUsuAdm = $_SESSION['nombreUA'];
    
    $idRescate=$_GET['id'];
    $tipo=$_GET['tipo'];
    $conn = new Conexiones();
    $estadoConexion = $conn->getConn();
    $cotizaciones = " SELECT solicitudes.id_solicitudes, solicitudes_cotizaciones.fecha_ini_licitacion, solicitudes_cotizaciones.fecha_evaluacion, usuarios.nombres, usuarios.apellidos, solicitudes_cotizaciones.detalle, empresa_adjudicada FROM pedido,solicitudes,usuarios,usuarioconrol,unidad_gasto,solicitudes_cotizaciones WHERE solicitudes.id_solicitudes=solicitudes_cotizaciones.id_solicitudes
																															AND pedido.id_pedido=solicitudes.id_pedido
																															AND usuarios.id_usuarios=pedido.id_usuarios
																															AND usuarios.id_usuarios=usuarioconrol.id_usuarios
																															AND usuarioconrol.id_gasto=unidad_gasto.id_gasto
																															AND solicitudes.id_solicitudes=".$idRescate;
	$queryCotizaciones=$estadoConexion->query($cotizaciones);
    $registroCotizaciones=$queryCotizaciones->fetch_array(MYSQLI_BOTH);
    if($tipo == 'a'){
        $idEmpresa = $registroCotizaciones['empresa_adjudicada'];
    }

    $pdf = new PDF();
  
    $pdf->pagina=0;
    $pdf->AliasNbPages();
    if($tipo == 'r'){
        $pdf->Body();
    }else{
        $pdf->Body1();
    }
    
    $pdf->SetFont('Times','BI',14);
    $pdf->setXY(155,25);
    $pdf->Cell(10,80,$registroCotizaciones['id_solicitudes'],0,0,'L');
    $pdf->setXY(170,45);
    $pdf->Cell(10,50,$registroCotizaciones['fecha_ini_licitacion'],0,0,'L');
    $pdf->setXY(170,50);
    $pdf->Cell(10,50,$registroCotizaciones['fecha_evaluacion'],0,0,'L');
    $pdf->setXY(40,40);
    $pdf->Cell(10,50,$registroCotizaciones['nombres']." ".$registroCotizaciones['apellidos'],0,0,'L');
    $pdf->setXY(40,45);
    $pdf->Cell(10,50,$nomUsuAdm,0,0,'L');

    $pdf->SetFont('Times','I',14);
    $pdf->setY(95);
    $pdf->setX(15);

    if($tipo == 'r'){
        $txt=utf8_decode($registroCotizaciones['detalle']);
        $pdf->MultiCell(0,5,$txt,0,'L');
    }else{
        $datosEmpresa = datosEmpresa($registroCotizaciones['empresa_adjudicada']);
        $pdf->SetFont('Times','BI',14);
        $pdf->MultiCell(0,5,'Nombre: ',0,'L');
        $pdf->setXY(50,95);
        $txt=utf8_decode($datosEmpresa['nombre_empresa']);
        $pdf->SetFont('Times','I',14);
        $pdf->MultiCell(0,5,$txt,0,'L');
        $pdf->setXY(15,102);
        $pdf->SetFont('Times','BI',14);
        $pdf->MultiCell(0,5,'Correo: ',0,'L');
        $pdf->setXY(50,102);
        $txt=utf8_decode($datosEmpresa['correo_empresa']);
        $pdf->SetFont('Times','I',14);
        $pdf->MultiCell(0,5,$txt,0,'L');
        $pdf->setXY(15,109);
        $pdf->SetFont('Times','BI',14);
        $pdf->MultiCell(0,5,'NIT: ',0,'L');
        $pdf->setXY(50,109);
        $txt=utf8_decode($datosEmpresa['nit']);
        $pdf->SetFont('Times','I',14);
        $pdf->MultiCell(0,5,$txt,0,'L');
        $pdf->setXY(15,116);
        $pdf->SetFont('Times','BI',14);
        $pdf->MultiCell(0,5,'Telefono: ',0,'L');
        $pdf->setXY(50,116);
        $txt=utf8_decode($datosEmpresa['telefono']);
        $pdf->SetFont('Times','I',14);
        $pdf->MultiCell(0,5,$txt,0,'L');
        $pdf->setXY(15,123);
        $pdf->SetFont('Times','BI',14);
        $pdf->MultiCell(0,5,'Direccion: ',0,'L');
        $pdf->setXY(50,123);
        $txt=utf8_decode($datosEmpresa['direccion']);
        $pdf->SetFont('Times','I',14);
        $pdf->MultiCell(0,5,$txt,0,'L');
    }
$pdf->Output();

function datosEmpresa($idEmpresa){
    require_once('../configuraciones/conexion.php');
    $conn = new Conexiones();
    $estadoConexion = $conn->getConn();
    $empresa = " SELECT * FROM empresas WHERE id_empresa=".$idEmpresa;
	$queryEmpresa=$estadoConexion->query($empresa);
    return $queryEmpresa->fetch_array(MYSQLI_BOTH);
}
?>
