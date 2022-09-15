<?php //Inicio de codigo php
require('rotacion.php');//requiere el archivo 	

//inicia la asignacion de variables resibidas de la formulario.html	
$variable_donde_se_guarda_el_valor_del_texto = $_POST['texto']; 
$variable_donde_se_guarda_el_valor_de_la_ciudad = $_POST['ciudad']; 
$variable_donde_se_guarda_el_valor_del_dirigido = $_POST['dirigido']; 
$variable_donde_se_guarda_el_valor_del_radicado = $_POST['radicado'];
$variable_donde_se_guarda_el_valor_del_cargo_del_dirigido = $_POST['cargo'];
$variable_donde_se_guarda_el_valor_de_la_fecha_actual = $_POST['fecha_actual']; 
$variable_donde_se_guarda_el_valor_del_asunto_del_documento = $_POST['asunto'];
$variable_donde_se_guarda_el_valor_de_quien_genero_este_documento = $_POST['nombre'];
$variable_donde_se_guarda_el_valor_de_la_direccion_del_dirigido = $_POST['direccion'];
$variable_donde_se_guarda_el_valor_del_cargo_del_remitente = $_POST['cargo_remitente'];
$variable_donde_se_guarda_el_valor_de_la_empresa_donde_labora_el_dirigido = $_POST['empresa'];
$variable_donde_se_guarda_el_valor_de_en_nombre_de_quien_se_genera_el_documento = $_POST['en_nombre_de_quien'];
//Finaliza la asignacion de variables resibidas de la formulario.html	

class PDF extends PDF_Rotate
{//inicia la clase PDF con extencion PDF_ROTATE 
	
protected $T128;                                         // tabla de códigos 128
protected $ABCset = "";                                  // conjunto de caracteres elegibles C128
protected $Aset = "";                                    // Ajuste del juego de caracteres A elegibles
protected $Bset = "";                                    // Ajuste del juego de caracteres B elegibles
protected $Cset = "";                                    // Ajuste del juego de caracteres C elegibles
protected $SetFrom;                                      // Convertidor de fuente juegos para la tabla
protected $SetTo;                                        // Convertidor de destinacion de juegos de la tablas
protected $JStart = array("A"=>103, "B"=>104, "C"=>105); // Criterios de selección de juego al inicio del C128
protected $JSwap = array("A"=>101, "B"=>100, "C"=>99);   // los personajes del juego cambiante

//____________________________ Extension du constructeur _______________________
function __construct($orientation='P', $unit='mm', $format='A4') 
        {

            parent::__construct($orientation,$unit,$format);

            $this->T128[] = array(2, 1, 2, 2, 2, 2);           //0 : [ ]               // composicion de los caracteres
            $this->T128[] = array(2, 2, 2, 1, 2, 2);           //1 : [!]
            $this->T128[] = array(2, 2, 2, 2, 2, 1);           //2 : ["]
            $this->T128[] = array(1, 2, 1, 2, 2, 3);           //3 : [#]
            $this->T128[] = array(1, 2, 1, 3, 2, 2);           //4 : [$]
            $this->T128[] = array(1, 3, 1, 2, 2, 2);           //5 : [%]
            $this->T128[] = array(1, 2, 2, 2, 1, 3);           //6 : [&]
            $this->T128[] = array(1, 2, 2, 3, 1, 2);           //7 : [']
            $this->T128[] = array(1, 3, 2, 2, 1, 2);           //8 : [(]
            $this->T128[] = array(2, 2, 1, 2, 1, 3);           //9 : [)]
            $this->T128[] = array(2, 2, 1, 3, 1, 2);           //10 : [*]
            $this->T128[] = array(2, 3, 1, 2, 1, 2);           //11 : [+]
            $this->T128[] = array(1, 1, 2, 2, 3, 2);           //12 : [,]
            $this->T128[] = array(1, 2, 2, 1, 3, 2);           //13 : [-]
            $this->T128[] = array(1, 2, 2, 2, 3, 1);           //14 : [.]
            $this->T128[] = array(1, 1, 3, 2, 2, 2);           //15 : [/]
            $this->T128[] = array(1, 2, 3, 1, 2, 2);           //16 : [0]
            $this->T128[] = array(1, 2, 3, 2, 2, 1);           //17 : [1]
            $this->T128[] = array(2, 2, 3, 2, 1, 1);           //18 : [2]
            $this->T128[] = array(2, 2, 1, 1, 3, 2);           //19 : [3]
            $this->T128[] = array(2, 2, 1, 2, 3, 1);           //20 : [4]
            $this->T128[] = array(2, 1, 3, 2, 1, 2);           //21 : [5]
            $this->T128[] = array(2, 2, 3, 1, 1, 2);           //22 : [6]
            $this->T128[] = array(3, 1, 2, 1, 3, 1);           //23 : [7]
            $this->T128[] = array(3, 1, 1, 2, 2, 2);           //24 : [8]
            $this->T128[] = array(3, 2, 1, 1, 2, 2);           //25 : [9]
            $this->T128[] = array(3, 2, 1, 2, 2, 1);           //26 : [:]
            $this->T128[] = array(3, 1, 2, 2, 1, 2);           //27 : [;]
            $this->T128[] = array(3, 2, 2, 1, 1, 2);           //28 : [<]
            $this->T128[] = array(3, 2, 2, 2, 1, 1);           //29 : [=]
            $this->T128[] = array(2, 1, 2, 1, 2, 3);           //30 : [>]
            $this->T128[] = array(2, 1, 2, 3, 2, 1);           //31 : [?]
            $this->T128[] = array(2, 3, 2, 1, 2, 1);           //32 : [@]
            $this->T128[] = array(1, 1, 1, 3, 2, 3);           //33 : [A]
            $this->T128[] = array(1, 3, 1, 1, 2, 3);           //34 : [B]
            $this->T128[] = array(1, 3, 1, 3, 2, 1);           //35 : [C]
            $this->T128[] = array(1, 1, 2, 3, 1, 3);           //36 : [D]
            $this->T128[] = array(1, 3, 2, 1, 1, 3);           //37 : [E]
            $this->T128[] = array(1, 3, 2, 3, 1, 1);           //38 : [F]
            $this->T128[] = array(2, 1, 1, 3, 1, 3);           //39 : [G]
            $this->T128[] = array(2, 3, 1, 1, 1, 3);           //40 : [H]
            $this->T128[] = array(2, 3, 1, 3, 1, 1);           //41 : [I]
            $this->T128[] = array(1, 1, 2, 1, 3, 3);           //42 : [J]
            $this->T128[] = array(1, 1, 2, 3, 3, 1);           //43 : [K]
            $this->T128[] = array(1, 3, 2, 1, 3, 1);           //44 : [L]
            $this->T128[] = array(1, 1, 3, 1, 2, 3);           //45 : [M]
            $this->T128[] = array(1, 1, 3, 3, 2, 1);           //46 : [N]
            $this->T128[] = array(1, 3, 3, 1, 2, 1);           //47 : [O]
            $this->T128[] = array(3, 1, 3, 1, 2, 1);           //48 : [P]
            $this->T128[] = array(2, 1, 1, 3, 3, 1);           //49 : [Q]
            $this->T128[] = array(2, 3, 1, 1, 3, 1);           //50 : [R]
            $this->T128[] = array(2, 1, 3, 1, 1, 3);           //51 : [S]
            $this->T128[] = array(2, 1, 3, 3, 1, 1);           //52 : [T]
            $this->T128[] = array(2, 1, 3, 1, 3, 1);           //53 : [U]
            $this->T128[] = array(3, 1, 1, 1, 2, 3);           //54 : [V]
            $this->T128[] = array(3, 1, 1, 3, 2, 1);           //55 : [W]
            $this->T128[] = array(3, 3, 1, 1, 2, 1);           //56 : [X]
            $this->T128[] = array(3, 1, 2, 1, 1, 3);           //57 : [Y]
            $this->T128[] = array(3, 1, 2, 3, 1, 1);           //58 : [Z]
            $this->T128[] = array(3, 3, 2, 1, 1, 1);           //59 : [[]
            $this->T128[] = array(3, 1, 4, 1, 1, 1);           //60 : [\]
            $this->T128[] = array(2, 2, 1, 4, 1, 1);           //61 : []]
            $this->T128[] = array(4, 3, 1, 1, 1, 1);           //62 : [^]
            $this->T128[] = array(1, 1, 1, 2, 2, 4);           //63 : [_]
            $this->T128[] = array(1, 1, 1, 4, 2, 2);           //64 : [`]
            $this->T128[] = array(1, 2, 1, 1, 2, 4);           //65 : [a]
            $this->T128[] = array(1, 2, 1, 4, 2, 1);           //66 : [b]
            $this->T128[] = array(1, 4, 1, 1, 2, 2);           //67 : [c]
            $this->T128[] = array(1, 4, 1, 2, 2, 1);           //68 : [d]
            $this->T128[] = array(1, 1, 2, 2, 1, 4);           //69 : [e]
            $this->T128[] = array(1, 1, 2, 4, 1, 2);           //70 : [f]
            $this->T128[] = array(1, 2, 2, 1, 1, 4);           //71 : [g]
            $this->T128[] = array(1, 2, 2, 4, 1, 1);           //72 : [h]
            $this->T128[] = array(1, 4, 2, 1, 1, 2);           //73 : [i]
            $this->T128[] = array(1, 4, 2, 2, 1, 1);           //74 : [j]
            $this->T128[] = array(2, 4, 1, 2, 1, 1);           //75 : [k]
            $this->T128[] = array(2, 2, 1, 1, 1, 4);           //76 : [l]
            $this->T128[] = array(4, 1, 3, 1, 1, 1);           //77 : [m]
            $this->T128[] = array(2, 4, 1, 1, 1, 2);           //78 : [n]
            $this->T128[] = array(1, 3, 4, 1, 1, 1);           //79 : [o]
            $this->T128[] = array(1, 1, 1, 2, 4, 2);           //80 : [p]
            $this->T128[] = array(1, 2, 1, 1, 4, 2);           //81 : [q]
            $this->T128[] = array(1, 2, 1, 2, 4, 1);           //82 : [r]
            $this->T128[] = array(1, 1, 4, 2, 1, 2);           //83 : [s]
            $this->T128[] = array(1, 2, 4, 1, 1, 2);           //84 : [t]
            $this->T128[] = array(1, 2, 4, 2, 1, 1);           //85 : [u]
            $this->T128[] = array(4, 1, 1, 2, 1, 2);           //86 : [v]
            $this->T128[] = array(4, 2, 1, 1, 1, 2);           //87 : [w]
            $this->T128[] = array(4, 2, 1, 2, 1, 1);           //88 : [x]
            $this->T128[] = array(2, 1, 2, 1, 4, 1);           //89 : [y]
            $this->T128[] = array(2, 1, 4, 1, 2, 1);           //90 : [z]
            $this->T128[] = array(4, 1, 2, 1, 2, 1);           //91 : [{]
            $this->T128[] = array(1, 1, 1, 1, 4, 3);           //92 : [|]
            $this->T128[] = array(1, 1, 1, 3, 4, 1);           //93 : [}]
            $this->T128[] = array(1, 3, 1, 1, 4, 1);           //94 : [~]
            $this->T128[] = array(1, 1, 4, 1, 1, 3);           //95 : [DEL]
            $this->T128[] = array(1, 1, 4, 3, 1, 1);           //96 : [FNC3]
            $this->T128[] = array(4, 1, 1, 1, 1, 3);           //97 : [FNC2]
            $this->T128[] = array(4, 1, 1, 3, 1, 1);           //98 : [SHIFT]
            $this->T128[] = array(1, 1, 3, 1, 4, 1);           //99 : [Cswap]
            $this->T128[] = array(1, 1, 4, 1, 3, 1);           //100 : [Bswap]                
            $this->T128[] = array(3, 1, 1, 1, 4, 1);           //101 : [Aswap]
            $this->T128[] = array(4, 1, 1, 1, 3, 1);           //102 : [FNC1]
            $this->T128[] = array(2, 1, 1, 4, 1, 2);           //103 : [Astart]
            $this->T128[] = array(2, 1, 1, 2, 1, 4);           //104 : [Bstart]
            $this->T128[] = array(2, 1, 1, 2, 3, 2);           //105 : [Cstart]
            $this->T128[] = array(2, 3, 3, 1, 1, 1);           //106 : [STOP]
            $this->T128[] = array(2, 1);                       //107 : [END BAR]

            for ($i = 32; $i <= 95; $i++) {                                            // juego de caracteres
                $this->ABCset .= chr($i);
            }
            $this->Aset = $this->ABCset;
            $this->Bset = $this->ABCset;
            
            for ($i = 0; $i <= 31; $i++) {
                $this->ABCset .= chr($i);
                $this->Aset .= chr($i);
            }
            for ($i = 96; $i <= 127; $i++) {
                $this->ABCset .= chr($i);
                $this->Bset .= chr($i);
            }
            for ($i = 200; $i <= 210; $i++) {                                           // control de codigo 128
                $this->ABCset .= chr($i);
                $this->Aset .= chr($i);
                $this->Bset .= chr($i);
            }
            $this->Cset="0123456789".chr(206);

            for ($i=0; $i<96; $i++) {                                                   // convertidor de juego A & B
                @$this->SetFrom["A"] .= chr($i);
                @$this->SetFrom["B"] .= chr($i + 32);
                @$this->SetTo["A"] .= chr(($i < 32) ? $i+64 : $i-32);
                @$this->SetTo["B"] .= chr($i);
            }
            for ($i=96; $i<107; $i++) {                                                 // control de juego A & B
                @$this->SetFrom["A"] .= chr($i + 104);
                @$this->SetFrom["B"] .= chr($i + 104);
                @$this->SetTo["A"] .= chr($i);
                @$this->SetTo["B"] .= chr($i);
            }
        }

//________________ Fonction encodage et dessin du code 128 _____________________
function Code128($x, $y, $code, $w, $h) {
    $Aguid = "";                                                                      // Création des guia de opciones ABC
    $Bguid = "";
    $Cguid = "";
    for ($i=0; $i < strlen($code); $i++) {
        $needle = substr($code,$i,1);
        $Aguid .= ((strpos($this->Aset,$needle)===false) ? "N" : "O"); 
        $Bguid .= ((strpos($this->Bset,$needle)===false) ? "N" : "O"); 
        $Cguid .= ((strpos($this->Cset,$needle)===false) ? "N" : "O");
    }

    $SminiC = "OOOO";
    $IminiC = 4;

    $crypt = "";
    while ($code > "") {
                                                                                    // BUCLE PRINCIPAL DE codificacion
        $i = strpos($Cguid,$SminiC);                                                // forzando el juego C, si es posible
        if ($i!==false) {
            $Aguid [$i] = "N";
            $Bguid [$i] = "N";
        }

        if (substr($Cguid,0,$IminiC) == $SminiC) {                                  // juego C
            $crypt .= chr(($crypt > "") ? $this->JSwap["C"] : $this->JStart["C"]);  // principio C inicio, de lo contrario C intercambiable  
            $made = strpos($Cguid,"N");                                             // extendido del conjunto C
            if ($made === false) {
                $made = strlen($Cguid);
            }
            if (fmod($made,2)==1) {
                $made--;                                                            // solo un par de numeros (de dos en dos)
            }
            for ($i=0; $i < $made; $i += 2) {
                $crypt .= chr(strval(substr($code,$i,2)));                          // conversion 2 en 2
            }
            $jeu = "C";
        } else {
            $madeA = strpos($Aguid,"N");                                            // extendiendo el conjunto A
            if ($madeA === false) {
                $madeA = strlen($Aguid);
            }
            $madeB = strpos($Bguid,"N");                                            // extendiendo el conjunto B
            if ($madeB === false) {
                $madeB = strlen($Bguid);
            }
            $made = (($madeA < $madeB) ? $madeB : $madeA );                         // tratando o modificando la extension
            $jeu = (($madeA < $madeB) ? "B" : "A" );                                // partida o columna actual
            $crypt .= chr(($crypt > "") ? $this->JSwap[$jeu] : $this->JStart[$jeu]); // comienzo de codificacion o de lo contrario intercambiar

            $crypt .= strtr(substr($code, 0,$made), $this->SetFrom[$jeu], $this->SetTo[$jeu]); // conversion segun el juego

        }
        $code = substr($code,$made);                                           // acortar campos y guías de la zona tratada
        $Aguid = substr($Aguid,$made);
        $Bguid = substr($Bguid,$made);
        $Cguid = substr($Cguid,$made);
    }                                                                          // FIN BUCLE PRINCIPAL

    $check = ord($crypt[0]);                                                   // calcule la suma del control
    for ($i=0; $i<strlen($crypt); $i++) {
        $check += (ord($crypt[$i]) * $i);
    }
    $check %= 103;

    $crypt .= chr($check) . chr(106) . chr(107);                               // canal de codificacion completada

    $i = (strlen($crypt) * 11) - 8;                                            // calcula el largo del modulo
    $modul = $w/$i;

    for ($i=0; $i<strlen($crypt); $i++) {                                      // BUCLE DE IMPRESION
        $c = $this->T128[ord($crypt[$i])];
        for ($j=0; $j<count($c); $j++) {
            $this->Rect($x,$y,$c[$j]*$modul,$h,"F");
            $x += ($c[$j++]+$c[$j])*$modul;
        }
    }
}
	function Header()
		{//inicia la funcion Header y cada vez que se agregue una pagina al documento se va a repetir esta funcion

			//se recibe los datos de 'marca_de_agua' y se asigna a una variable_donde_se_guarda_el_valor_de_la_marca_de_agua aqui por que fuera de si se hace fuera de la clase PDF no la reconoce y bota Error 'undefined'
			$variable_donde_se_guarda_el_valor_de_la_marca_de_agua = $_POST['marca_de_agua'];
			//se recibe los datos de 'radicado' y se asigna a una variable_donde_se_guarda_el_valor_del_radicado aqui por que fuera de si se hace fuera de la clase PDF no la reconoce y bota Error 'undefined'
            $variable_donde_se_guarda_el_valor_del_radicado = $_POST['radicado'];
			//Inicia las caracteristicas para la cabezera de las paginas

                //false = valor falso
                //40 = saltos de linea despues de termina la imagen
                //Cell = metodo para transformar e imprimir imagene y texto
                //Image = para que sepa que va a imprimir y entre parentesis y con comillas simples la ruta de la imagen
                //10 = la cantidad de pixeles que va a haber desde el borde izquierdo de la pagina hasta el borde izquierdo de la imagen
                // 9 = la cantidad de pixeles que se va a correr la imagen desde el borde superior de la pagina
                //190 = la cantidad de acercamiento a la imagen (efecto zoom)
                $this->Cell(false,40,false,false,40,false,$this->Image('./img/imagen_cabezera.jpg', 10,9, 190));
			//Fin de las caracteristicas de la cabezera de las paginas

			//Inicio de las caracteristicas de la marca de agua 
                //Arial = tipo de letra 
                // B = Bolt
                // 200 = tamaño de letra
                $this->SetFont('Arial','B',200);
                //color del texto de la marca de agua
                $this->SetTextColor(225,225,1000);

                // 100 = la cantidad de pixeles que va a haber desde el borde izquierdo de la pagina hasta la primera letra de la palabra
                // 185 = la cantidad de pixeles que va a haber desde el borde superior de la pagina hasta borde superior letra de la palabra
                // utf8_decode = para que acepte caracteres raors como tildes y signos de puntuacion mientras imprime la variable_donde_se_guarda_el_valor_de_la_marca_de_agua
                // 45 =  los grados que se va a girar el texto
                $this->RotatedText(100,185,utf8_decode($variable_donde_se_guarda_el_valor_de_la_marca_de_agua),45);
			//Fin de caracteristicas de la marca de agua

			//Inicio de caracteristicas del codigo de barras
                //120 = la cantidad de pixeles que va a haber desde el borde izquierdo de la pagina y el bode izquierdo de la primera barra
                //45 = la cantidad de pixeles qe va a haber desde el inicio de la pagina y la parte superior del codigo de barras
                //80 = width
                //15 = heigth
                $this->Code128(120,45,$variable_donde_se_guarda_el_valor_del_radicado,80,15);
            //Fin de caracteristicas del codigo de barras

			//se va a aplicar el metodo SetFont a todo el contenido hasta encontrar otro metodo SetFont
                //Arial = tipo de letra 
                // B = Bolt
                // 25 = tamaño de letra
                $this->SetFont('Arial','B',25);

            //se va a aplicar el metodo SetTextColor a todo el contenido hasta encontrar otro metodo SetTextColor
                //(0,0,0) = negro;
			    $this->SetTextColor(0,0,0);

			//esto es para que en todas las paginas tenga el mismo eje x,y
                //130.2 = la cantidad de pixeles que va a haber desde el borde izquierdo de la pagina y el bode izquierdo de la primera letra
                //30 = la cantidad de pixeles que va a haber desde el borde superior de la pagina y el bode superior del radicado
                $this->SetXY(130.2,30); 
                    //70= la cantidad de pixeles que va a haber desde el borde izquierdo de la pagina y el bode izquierdo de la  primera letra
                    //70 = la cantidad de pixeles que va a haber desde el borde superior de la pagina y el bode superior del radicado
                    $this->Cell(70,70,$variable_donde_se_guarda_el_valor_del_radicado,0,0,'R'); 
			
			$this->Ln(45);//salta 45 pixeles hacia abajo

		}//Finaliza la funcion Header

// la funcion de RotatedText es crear variables para que cuando se use se pueda llenar con los datos que establecemos 
	function RotatedText($x, $y, $txt, $angle)
		{
			//El texto gira alrededor de su origen
			$this->Rotate($angle,$x,$y);
			$this->Text($x,$y,$txt);
			$this->Rotate(0);
		}

	function Footer()
		{//inicio de la funcion Footer
			// false = valor falso 
			//Image = para que sepa que va a imprimir y entre parentesis y con comillas simples la ruta de la imagen
			// 10 = la cantidad de pixeles que va a haber desde el borde izquierdo de la pagina hasta el borde izquierdo de la imagen
			// 275 = la cantidad de pixeles que va a haber desde el borde superior de la pagina hasta borde superior letra de la imagen
			//190 = la cantidad de acercamiento a la imagen (efecto zoom)
			$this->Cell(false,false,'',false,false,'',$this->Image('./img/imagen_pie_de_pagina.jpg', 10,285, 190));
		
		}//Fin funcion Footer
}

$pdf=new PDF();// se le asigna a la variable $pdf la clase PDF y se crea un nuevo documento apartir de las caracteristicas establecidas en la clase PDF que esta en 'fpdf.php'



$pdf->AddPage();//se agrega una nueva pagina


$pdf->SetMargins(20,20,20,20);//20 = la cantidad de pixeles desde los bordes superior,inferior,del borde izquierdo y del borde derecho de la pagina  


//se va a aplicar el metodo SetFont a todo el contenido hasta encontrar otro metodo SetFont
    //Arial = tipo de letra 
    // B = Bolt
    // 11 = tamaño de letra
    $pdf->SetFont('Arial','B',11);

//Cell (103) = la cantidad de pixeles que se va a correr desde el borde izquierdo de la pagina  hasta la primera letra de el texto
    $pdf->Cell(103);

//0 = la cantidad de pixeles que va a haber desde el borde inferior del radicado hasta borde superior del texto 'Al contestar por favor cite estos datos:'
    $pdf->Cell(false,0,'Al contestar por favor cite estos datos:',false,false,false);

$pdf->Ln(1);//salta 1 pixel hacia abajo

//se va a aplicar el metodo SetFont a todo el contenido hasta encontrar otro metodo SetFont
    //Arial = tipo de letra 
    // 11 = tamaño de letra
    $pdf->SetFont('Arial','',11);

//Cell (93) = la cantidad de pixeles que se va a correr desde el borde izquierdo de la pagina  hasta la primera letra de el texto
    $pdf->Cell(93);

//10 = la cantidad de pixeles que va a haber desde el borde inferior del texto 'Al contestar por favor cite estos datos:' hasta borde superior del texto 'Radicado No:'
    $pdf->Cell(false,10,'Radicado No:',false,false,false);

//se va a aplicar el metodo SetFont a todo el contenido hasta encontrar otro metodo SetFont
    //Arial = tipo de letra 
    // B = Bolt
    // 11 = tamaño de letra
    $pdf->SetFont('Arial','B',11);

//Cell (-36) = la cantidad de pixeles que se va a correr desde el borde izquierdo de la pagina  hasta la primera letra de el texto
    $pdf->Cell(-36);

//10 = la cantidad de pixeles que va a haber desde el borde inferior  del texto 'Radicado No:' hasta borde izquierdo del radicado
    $pdf->Cell(false,10,utf8_decode($variable_donde_se_guarda_el_valor_del_radicado),false,false,false);

    $pdf->Ln(5);//salta 5 pixeles hacia abajo


//se va a aplicar el metodo SetFont a todo el contenido hasta encontrar otro metodo SetFont
    //Arial = tipo de letra 
    // 11 = tamaño de letra
    $pdf->SetFont('Arial','',11);

//Cell (93) = la cantidad de pixeles que se va a correr desde el borde izquierdo de la pagina hasta la primera letra de el texto
    $pdf->Cell(93);

//10 = la cantidad de pixeles que va a haber desde el borde inferior del texto 'Radicado No:' hasta borde superior del texto 'Fecha'
    $pdf->Cell(false,10,'Fecha:',false,false,false);

//se va a aplicar el metodo SetFont a todo el contenido hasta encontrar otro metodo SetFont
    //Arial = tipo de letra 
    // B = Bolt
    // 11 = tamaño de letra
    $pdf->SetFont('Arial','B',11);

//Cell (-44) = la cantidad de pixeles que se va a correr desde el borde izquierdo de la pagina hasta la primera letra de el texto
    $pdf->Cell(-44);

//10 = la cantidad de pixeles que va a haber desde el borde inferior del radicado hasta borde superior de la fecha
    $pdf->Cell(false,10,$variable_donde_se_guarda_el_valor_de_la_fecha_actual,false,false,false);

$pdf->Ln(15);//salta 15 pixeles hacia abajo



//se va a aplicar el metodo SetFont a todo el contenido hasta encontrar otro metodo SetFont
    //helvetica = tipo de letra 
    // 12 = tamaño de letra
    $pdf->SetFont('helvetica','',12); 


$pdf->SetTextColor(0,0,0); //esto asigna el color negro a todo lo que siga hasta encontrar otro SetTextColor


$pdf->Write(false,utf8_decode($variable_donde_se_guarda_el_valor_de_la_ciudad));//imprime el valor que le llega de la variable_donde_se_guarda_el_valor_de_la_ciudad

$pdf->Ln(8);//salta 8 pixeles hacia abajo

$pdf->Write(0,utf8_decode("Señor(a):"));//Imprime el texto "Señor(a)"

$pdf->Ln(5);//salta 5 pixeles hacia abajo

$pdf->Write(0,utf8_decode($variable_donde_se_guarda_el_valor_del_dirigido));//imprime el valor que le llega de la variable_donde_se_guarda_el_valor_del_dirigido

$pdf->Ln(5);//salta 5 pixeles hacia abajo

$pdf->Write(0,utf8_decode($variable_donde_se_guarda_el_valor_del_cargo_del_dirigido));//imprime el valor que le llega de la variable_donde_se_guarda_el_valor_del_cargo_del_dirigido

$pdf->Ln(5);//salta 5 pixeles hacia abajo

$pdf->Write(0,utf8_decode($variable_donde_se_guarda_el_valor_de_la_empresa_donde_labora_el_dirigido));//imprime el valor que le llega de la variable_donde_se_guarda_el_valor_de_la_empresa_donde_labora_el_dirigido

$pdf->Ln(5);//salta 5 pixeles hacia abajo

$pdf->Write(0,utf8_decode($variable_donde_se_guarda_el_valor_de_la_direccion_del_dirigido ));//imprime el valor que le llega de la variable_donde_se_guarda_el_valor_de_la_direccion_del_dirigido

$pdf->Ln(15);//salta 15 pixeles hacia abajo

$pdf->Write(0,utf8_decode("Asunto:"));//imprime el texto "Asunto:"

$pdf->Ln(5);//salta 5 pixeles hacia abajo

$pdf->Write(0,utf8_decode($variable_donde_se_guarda_el_valor_del_asunto_del_documento ));//imprime el valor que le llega de la variable_donde_se_guarda_el_valor_del_asunto_del_documento

$pdf->Ln(7);//salta 7 pixeles hacia abajo

//se va a aplicar el metodo SetFont a todo el contenido hasta encontrar otro metodo SetFont
    //Arial = tipo de letra 
    // 11 = tamaño de letra
    $pdf->SetFont('Arial','',11); 


$pdf->SetTextColor(0,0,0); //esto asigna el color negro a todo lo que siga hasta encontrar otro  SetTextColor

$pdf->MultiCell(0,4,utf8_decode($variable_donde_se_guarda_el_valor_del_texto),0,'J');//esto imprime la variable_donde_se_guarda_el_valor_del_texto, lo codifica para que acepte tilde y caracteres raros y lo justifica con la letra "J"

$pdf->Ln(7);//salta 7 pixeles hacia abajo

//se va a aplicar el metodo SetFont a todo el contenido hasta encontrar otro metodo SetFont
    //helvetica = tipo de letra 
    // 12 = tamaño de letra
    $pdf->SetFont('helvetica','',12); 

$pdf->Ln(8);//salta 8 pixeles hacia abajo

$pdf->Write(0,utf8_decode("Respetado Señor(a):")) ;//Imprime el texto "Respetado Señor(a):" 


$pdf->Ln(18);//salta 18 pixeles hacia abajo

$pdf->Write(0,utf8_decode("Reciba un atento saludo")) ;//Imprime el texto "Reciba un atento saludo"


$pdf->Ln(15);//salta 15 pixeles hacia abajo

$pdf->Write(0,utf8_decode($variable_donde_se_guarda_el_valor_de_en_nombre_de_quien_se_genera_el_documento));//esto imprime la variable_donde_se_guarda_el_valor_de_en_nombre_de_quien_se_genera_el_documento

$pdf->Ln(5);//salta 5 pixeles hacia abajo

$pdf->Write(0,utf8_decode($variable_donde_se_guarda_el_valor_del_cargo_del_remitente));//esto imprime la variable_donde_se_guarda_el_valor_del_cargo_del_remitente

$pdf->Ln(5);//salta 5 pixeles hacia abajo

//se va a aplicar el metodo SetFont a todo el contenido hasta encontrar otro metodo SetFont
    //Arial = tipo de letra 
    // 9 = tamaño de letra
    $pdf->SetFont('Arial','',9);

$pdf->Write(0,utf8_decode("Proyectó:"));//Imprime el texto "Proyectó:"

$pdf->Write(0,utf8_decode($variable_donde_se_guarda_el_valor_de_quien_genero_este_documento));//esto imprime la variable_donde_se_guarda_el_valor_de_quien_genero_este_documento



// "prueba.pdf" = nombre del documento cuando se descargue
// "D" = Descargar documento
$pdf->Output("prueba.pdf","D");

//Fin de codigo php?>
