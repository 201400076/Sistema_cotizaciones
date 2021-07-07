<?php

include '../librerias/fpdf/fpdf.php'; // Incluímos la clase fpdf.php para poder utilizar sus métodos para generar nuestro pdf
date_default_timezone_set('America/La_Paz'); //Configuramos el horario de acuerdo a la ubicación del servidor

class PDF extends FPDF{    
    function Header() {        
        $this->Image('../recursos/imagenes/umss.png', 5, 5, 50); //Insertamos el logo si es en PNG su calidad o formato debe estar entre PNG 8/PNG 24
         
        $ancho = 250;
        $this->SetFont('Arial', 'B', 12);
         
        if($this->pagina == 1){ //Cuando el archivo está en Horizontal
            $horizontal = 85; //Permitirá que las dimensiones que abarca horizontalmente sea 85 puntos más que cuando es vertical
            $this->SetY(12);
            $this->Cell($ancho + $horizontal, 10,'Usuario: http://tucafejava.blogspot.com', 0, 0, 'R');
            $this->SetY(17);
            $this->Cell($ancho + $horizontal, 10,'Fecha: '.date('d/m/Y'), 0, 0, 'R');
            $this->SetY(23);
            $this->Cell($ancho + $horizontal, 10,'Hora: '.date('H:i:s'), 0, 0, 'R');            
        } 
         else {            
            $this->SetY(15);
            $this->setX(1); //Mencionamos que el curso en la posición Y empezará a los 12 puntos para escribir el Usuario:
            $this->Cell($ancho, 10,'Emision:', 0, 1, 'R');
            $this->SetY(20);
            $this->SetX(35);
            $this->Cell($ancho, 10,'Fecha: '.date('d/m/Y'), 0, 0, 'R');
            $this->SetY(25);
            $this->SetX(28);
            $this->Cell($ancho, 10,'Hora: '.date('H:i:s'), 0, 0, 'R');            
        }     
    }
     
    function Body() {
        $yy = 40; //Variable auxiliar para desplazarse 40 puntos del borde superior hacia abajo en la coordenada de las Y para evitar que el título este al nivel de la cabecera.
        $y = $this->GetY(); 
        $x = 12;
        $this->AddPage($this->CurOrientation);
         
        $this->SetFont('helvetica', 'B', 20); //Asignar la fuente, el estilo de la fuente (negrita) y el tamaño de la fuente
        $this->SetXY(0, $y + $yy); //Ubicación según coordenadas X, Y. X=0 porque empezará desde el borde izquierdo de la página
        $this->Cell(300, 10, "Cuadro Comparativo de Cotizaciones", 0, 1, 'C');
         
        $this->SetFont('courier', 'U', 15); //Asignar la fuente, el estilo de la fuente (subrayado) y el tamaño de la fuente
        $y = $this->GetY(); 
        $this->SetXY(0, $y); //Ubicación según coordenadas X, Y. X=0 porque empezará desde el borde izquierdo de la página
        $this->Cell(300, 10, "Moneda (Bs)", 0, 1, 'C');
         
        $this->SetFont('arial', 'B', 9); //Asignar la fuente, el estilo de la fuente (subrayado) y el tamaño de la fuente
 
        $y = $this->GetY() + 8;
        $this->SetXY(141, $y-4);
        $this->MultiCell(145, 4, utf8_decode("Empresas Participantes"), 1, 'C');
        $this->SetXY(8, $y);
        $this->MultiCell(8, 4, utf8_decode("Nº"), 1, 'C'); //Utilizamos el utf8_decode para evitar código basura o ilegible
        $this->SetXY(16, $y); //El resultado 22 es la suma de la posición 10 y el tamaño del MultiCell de 12.
        $this->MultiCell(12, 4, utf8_decode("Cant."), 1, 'C');
        $this->SetXY(28, $y);
        $this->MultiCell(19, 4, utf8_decode("Unid."), 1, 'C');
        $this->SetXY(47, $y);
        $this->MultiCell(94, 4, utf8_decode("Detalle"), 1, 'C');
        $this->SetXY(141, $y);
        $this->MultiCell(29, 4, utf8_decode("1"), 1, 'C');      
        $this->SetXY(170, $y);
        $this->MultiCell(29, 4, utf8_decode("2"), 1, 'C');   
        $this->SetXY(199, $y);
        $this->MultiCell(29, 4, utf8_decode("3"), 1, 'C'); 
        $this->SetXY(228, $y);
        $this->MultiCell(29, 4, utf8_decode("4"), 1, 'C'); 
        $this->SetXY(257, $y);
        $this->MultiCell(29, 4, utf8_decode("5"), 1, 'C');
        $n = 1;





  




        /* $this->SetFont('arial', 'B', 10); //Asignar la fuente, el estilo de la fuente (subrayado) y el tamaño de la fuente
        $y = $this->GetY() + 8;
        $this->SetXY(15, $y);
        $this->MultiCell(70, 4, utf8_decode("Seccion Adquisicion "), 1, 'C'); //Utilizamos el utf8_decode para evitar código basura o ilegible
        $this->SetXY(85, $y); //El resultado 22 es la suma de la posición 10 y el tamaño del MultiCell de 12.
        $this->MultiCell(65, 4, utf8_decode("Jefe de Unidad"), 1, 'C');
        $this->SetXY(150, $y);
        $this->MultiCell(50, 4, utf8_decode("Tecnico Responsable"), 1, 'C');
        $this->SetXY(200, $y);
        $this->MultiCell(77, 4, utf8_decode("Jefe Administrativo"), 1, 'C');
       

        //###########################FIRMAS#####################################33
        $y = $this->GetY();
            $this->SetXY(15, $y);
            $this->MultiCell(70, 10, "", 1, 'C');
            $this->SetXY(85, $y);
            $this->MultiCell(65, 10, "", 1, 'C');
            $this->SetXY(150, $y);
            $this->MultiCell(50, 10, "", 1, 'C');
            $this->SetXY(200, $y);
            $this->MultiCell(77, 10, "", 1, 'C'); */
     
         
        /* $y = $this->GetY();
        $this->SetXY(10, $y);
        $this->Cell(190, 10, utf8_decode("Alineación a la derecha con 'R'"), 0, 1, 'R');
        $y = $this->GetY();
        $this->SetXY(10, $y);
        $this->Cell(190, 10, utf8_decode("Alineación a la derecha con 'L'"), 0, 1, 'L');
        $y = $this->GetY();
        $this->SetXY(10, $y);
        $this->Cell(190, 10, utf8_decode("Alineación centrado con 'C'"), 0, 1, 'C');
        $y = $this->GetY();
        $this->SetXY(10, $y);
        $this->Cell(190, 10, utf8_decode("Texto con Borde"), 1, 1, 'J');
         
        $this->pagina = 1;
        $this->AddPage('L');
         
        $this->pagina = 0;
        $this->AddPage('P');
         
        $this->pagina = 1;
        $this->AddPage('L'); */
         
    }
     
/*     function Footer() {        
        $this->SetY(-10);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, utf8_decode('Página ').$this->PageNo().'/{nb}', 0, 0, 'C');
        if($this->CurOrientation == 'L') { //Se reconoce el tipo de Orientación de la página (Vertical = P|Horizontal = L)
            $this->SetX(0);
            $this->Cell(292, 10, utf8_decode('Creado por el '.$this->), 0, 0, 'R');            
        } else {       
            $this->SetX(0);
            $this->Cell(205, 10, utf8_decode('Creado por el '.$this->Author), 0, 0, 'R');
             
        }        
    } */
}
$pdf = new PDF('L');
$pdf->pagina = 0;
$pdf->AliasNbPages(); //Permitir el conteo de la cantidad de páginas existentes {nb}
$pdf->Body(); //Llamada a la función Body para generar el PDF
$pdf->setX(10);
$pdf->setX(50);




require("../modelo/conexionPablo.php");

$id_solicitud=$_GET['id_solicitud'];
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();
    $consulta="SELECT i.id_items,i.cantidad, i.unidad,i.detalle,i.archivo,i.ruta 
                FROM solicitudes s, pedido p, items i 
                WHERE (s.id_pedido=p.id_pedido && p.id_pedido=i.id_pedido) && s.id_solicitudes=$id_solicitud";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

    //var_dump($data);

    $consulta="SELECT * 
               FROM `cotizacion_items` 
               WHERE id_solicitudes=$id_solicitud";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data1=$resultado->fetchAll(PDO::FETCH_ASSOC);
    //var_dump($data1);

    $consulta="SELECT distinct ci.id_empresa,e.nombre_empresa
    FROM cotizacion_items ci,empresas e 
    WHERE ci.id_empresa=e.id_empresa 
          AND id_solicitudes=$id_solicitud"; 
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data2=$resultado->fetchAll(PDO::FETCH_ASSOC);

//############################################################3
$pdf->SetFont('Arial', '', 10);    
   $aux;
    $n=1;
    $aux2=0;
    $id2=0;
    $valores=array();
    
     foreach($data as $a){
       $id=$a['id_items'];
       //while($n<=sizeof($a)){
       $y = $pdf->GetY();
       $pdf->SetXY(8, $y);
       $pdf->MultiCell(8, 8,$n, 1, 'C');
       $n++;
       $pdf->SetXY(16, $y);
       $pdf->MultiCell(12, 8,$a['cantidad'], 1, 'C');
       $pdf->SetXY(28, $y);
       $pdf->MultiCell(19, 8,$a['unidad'], 1, 'C');
       $pdf->SetXY(47, $y);
       $pdf->MultiCell(94, 8, $a['detalle'], 1, 'C');
     
       foreach($data1 as $d){
           if($d['id_items']==$id){
            
            $x=$pdf->GetX();
            //$pdf->setX($x+131);
            $y = $pdf->GetY();
            $pdf->setXY($x+131,$y-8);
            $pdf->MultiCell(29, 8,$d['precio_parcial'], 1, 'C');
            $pdf->setXY($x+29,$y);
            $valores[]=(int)$d['precio_parcial'];

           // $pdf->SetX(1);
            //$x+20;
            //$pdf->SetXY(160, $y);
           
           }
                
         
               //$valores[]=(int)$d['precio_parcial'];
              // echo count(array($valores));
             //var_dump($valores);
           
        }
        
      
    
    }

    for($i=sizeof($valores)/2;$i<5;$i++){
        $x=$pdf->GetX();
        //$pdf->setX($x+131);
        $y = $pdf->GetY();
            $pdf->setXY($x+131,$y-8);
            $pdf->MultiCell(29, 8,"", 1, 'C');
            $pdf->setXY($x+29,$y);

            $pdf->setXY($x+131,$y-16);
            $pdf->MultiCell(29, 8,"", 1, 'C');
            $pdf->setXY($x+29,$y);

    }

     for($j=$n;$j<=10;$j++){
       
        $y = $pdf->GetY();
        $pdf->SetXY(8, $y);
        $pdf->MultiCell(8, 8, $n, 1, 'C');
        $pdf->SetXY(16, $y);
        $pdf->MultiCell(12, 8, "", 1, 'C');
        $pdf->SetXY(28, $y);
        $pdf->MultiCell(19, 8, "", 1, 'C');
        $pdf->SetXY(47, $y);
        $pdf->MultiCell(94, 8, "", 1, 'C');
        $pdf->SetXY(141, $y);
        $pdf->MultiCell(29, 8, "", 1, 'C');
        $pdf->SetXY(170, $y);
        $pdf->MultiCell(29, 8, "", 1, 'C');
        $pdf->SetXY(199, $y);
        $pdf->MultiCell(29, 8, "", 1, 'C');
        $pdf->SetXY(228, $y);
        $pdf->MultiCell(29, 8, "", 1, 'C');
        $pdf->SetXY(257, $y);
        $pdf->MultiCell(29, 8, "", 1, 'C');
        $n++;


     }

//##################################TOTALES#################################################
$pdf->SetFont('Arial', 'B', 10); 
$y = $pdf->GetY();
$pdf->SetXY(8, $y+2);
$pdf->MultiCell(133, 8, "Totales", 1, 'C');
$suma=0;
$tam=sizeof($valores)/2;
$tam2=sizeof($valores);
$tamAux=$tam;
for($i=0;$i<$tam;$i++){
    for($j=$tamAux;$j<$tam2;$j++){
    //var_dump(sizeof($valores));
        $suma=$valores[$i]+$valores[$j];
        $x=$pdf->GetX();
        $y = $pdf->GetY();
        $pdf->SetXY($x+131, $y-8);
        $pdf->MultiCell(29, 8, $suma, 1, 'C');
        $pdf->SetXY($x+29, $y);

        $suma=0;
        $j+=$tam;
        //var_dump(sizeof($valores)/$id2);
    }
    $tamAux++;
}

for($k=$tam;$k<5;$k++){
    $x=$pdf->GetX();
    //$pdf->setX($x+131);
    $y = $pdf->GetY();
        $pdf->setXY($x+131,$y-8);
        $pdf->MultiCell(29, 8,"", 1, 'C');  
}



//##########################################################################################3


       $pdf->SetFont('arial', 'B', 10); //Asignar la fuente, el estilo de la fuente (subrayado) y el tamaño de la fuente
        $y =  $pdf->GetY() + 6;
        $pdf->SetXY(8, $y);
        $pdf->MultiCell(70, 4, utf8_decode("Seccion Adquisicion "), 1, 'C'); //Utilizamos el utf8_decode para evitar código basura o ilegible
        $pdf->SetXY(78, $y); //El resultado 22 es la suma de la posición 10 y el tamaño del MultiCell de 12.
        $pdf->MultiCell(72, 4, utf8_decode("Jefe de Unidad"), 1, 'C');
        $pdf->SetXY(150, $y);
        $pdf->MultiCell(60, 4, utf8_decode("Tecnico Responsable"), 1, 'C');
        $pdf->SetXY(210, $y);
        $pdf->MultiCell(77, 4, utf8_decode("Jefe Administrativo"), 1, 'C');
       

        //###########################FIRMAS#####################################33
        $y =  $pdf->GetY();
        $pdf->SetXY(8, $y);
        $pdf->MultiCell(70, 10, "", 1, 'C');
        $pdf->SetXY(78, $y);
        $pdf->MultiCell(72, 10, "", 1, 'C');
        $pdf->SetXY(150, $y);
        $pdf->MultiCell(60, 10, "", 1, 'C');
        $pdf->SetXY(210, $y);
        $pdf->MultiCell(77, 10, "", 1, 'C'); 






    $pdf->Output('ReporteEjemplo_TuCafeJava_'.date("d_m_Y_H_i_s"), 'I'); //El primer parámetro es para colocar el nombre del archivo al momento de ser descargado y el segundo parámetro es para abrir el archivo en el navegador con la opción para poder ser descargado





?>