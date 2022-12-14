// From: https://mrrio.github.io/jsPDF/examples/basic.html

import * as jsPDF from 'jspdf';

function test_simple_two_page_document() {
    var doc = new jsPDF();
    doc.text(20, 20, 'Hello world!');
    doc.text(20, 30, 'This is client-side Javascript, pumping out a PDF.');
    doc.addPage();
    doc.text(20, 20, 'Do you like that?');
    doc.save('Test.pdf');
}

function test_add_pages_with_different_format() {
    var doc = new jsPDF();
    doc.text(20, 20, 'Hello world!');
    doc.addPage('a5', 'l');
    doc.text(20, 20, 'Do you like that?');
    doc.addPage('c6');
    doc.text(20, 20, 'Do you like that?');
    doc.addPage([595.28, 841.89]);
    doc.text(20, 20, 'Do you like that?');
    doc.save('Test.pdf');
}

function test_landscape() {
    var doc = new jsPDF('landscape');
    doc.text(20, 20, 'Hello landscape world!');
    doc.save('Test.pdf');
}

function test_metadata() {
    var doc = new jsPDF();
    doc.text(20, 20, 'This PDF has a title, subject, author, keywords and a creator.');
    doc.setProperties({
        title: 'Title',
        subject: 'This is the subject',
        author: 'James Hall',
        keywords: 'generated, javascript, web 2.0, ajax',
        creator: 'MEEE'
    });
    doc.save('Test.pdf');
}

function test_user_input() {
    var doc = new jsPDF();
    doc.text(20, 20, 'This PDF has a title, subject, author, keywords and a creator.');
    doc.setProperties({
        title: 'Title',
        subject: 'This is the subject',
        author: 'James Hall',
        keywords: 'generated, javascript, web 2.0, ajax',
        creator: 'MEEE'
    });
    doc.save('Test.pdf');
}

function test_font_sizes() {
    var doc = new jsPDF();
    doc.setFontSize(22);
    doc.text(20, 20, 'This is a title');
    doc.setFontSize(16);
    doc.text(20, 30, 'This is some normal sized text underneath.');
    doc.save('Test.pdf');
}

function test_font_types() {
    var doc = new jsPDF();
    doc.text(20, 20, 'This is the default font.');
    doc.setFont("courier");
    doc.text(20, 30, 'This is courier normal.');
    doc.setFont("times");
    doc.setFontType("italic");
    doc.text(20, 40, 'This is times italic.');
    doc.setFont("helvetica");
    doc.setFontType("bold");
    doc.text(20, 50, 'This is helvetica bold.');
    doc.setFont("courier");
    doc.setFontType("bolditalic");
    doc.text(20, 60, 'This is courier bolditalic.');
    doc.save('Test.pdf');
}

function test_text_colors() {
    var doc = new jsPDF();
    doc.setTextColor(100);
    doc.text(20, 20, 'This is gray.');
    doc.setTextColor(150);
    doc.text(20, 30, 'This is light gray.');
    doc.setTextColor(255, 0, 0);
    doc.text(20, 40, 'This is red.');
    doc.setTextColor(0, 255, 0);
    doc.text(20, 50, 'This is green.');
    doc.setTextColor(0, 0, 255);
    doc.text(20, 60, 'This is blue.');
    doc.save('Test.pdf');
}

function test_font_metrics_based_line_sizing_split() {
    var pdf = new jsPDF('p', 'in', 'letter');
    var sizes:number[] = [12, 16, 20];
    var fonts = [['Times', 'Roman'], ['Helvetica', ''], ['Times', 'Italic']];
    var font:string[];
    var size:number;
    var lines:any[];
    var verticalOffset = 0.5; // inches on a 8.5 x 11 inch sheet.
    var loremipsum = 'Lorem ipsum dolor sit amet, ...';
    for (var i in fonts) {
        if (fonts.hasOwnProperty(i)) {
            font = fonts[i];
            size = sizes[i];
            lines = pdf.setFont(font[0], font[1])
                .setFontSize(size)
                .splitTextToSize(loremipsum, 7.5);
            pdf.text(0.5, verticalOffset + size / 72, lines);
            verticalOffset += (lines.length + 0.5) * size / 72
        }
    }
    pdf.save('Test.pdf');
}

function test_from_html() {
    var pdf = new jsPDF('p', 'pt', 'letter')
        , source = document.getElementById('#fromHTMLtestdiv')
        , specialElementHandlers = {
        '#bypassme': function (element:HTMLElement, renderer:any) {
            return true
        }
    };
    var margins = {
        top: 80,
        bottom: 60,
        left: 40,
        width: 522
    };

    pdf.fromHTML(
        source // HTML string or DOM elem ref.
        , margins.left // x coord
        , margins.top // y coord
        , {
            'width': margins.width // max width of content on PDF
            , 'elementHandlers': specialElementHandlers
        },
        function (dispose:any) {
            pdf.save('Test.pdf');
        },
        margins
    )
}

function test_rect_squares() {
    var doc = new jsPDF();
    doc.rect(20, 20, 10, 10); // empty square
    doc.rect(40, 20, 10, 10, 'F'); // filled square
    doc.setDrawColor(255, 0, 0);
    doc.rect(60, 20, 10, 10); // empty red square
    doc.setDrawColor(255, 0, 0);
    doc.rect(80, 20, 10, 10, 'FD'); // filled square with red borders
    doc.setDrawColor(0);
    doc.setFillColor(255, 0, 0);
    doc.rect(100, 20, 10, 10, 'F'); // filled red square
    doc.setDrawColor(0);
    doc.setFillColor(255, 0, 0);
    doc.rect(120, 20, 10, 10, 'FD'); // filled red square with black borders
    doc.setDrawColor(0);
    doc.setFillColor(255, 255, 255);
    doc.roundedRect(140, 20, 10, 10, 3, 3, 'FD'); //  Black sqaure with rounded corners
    doc.save('Test.pdf');
}

function test_lines() {
    var doc = new jsPDF();
    doc.line(20, 20, 60, 20); // horizontal line
    doc.setLineWidth(0.5);
    doc.line(20, 25, 60, 25);
    doc.setLineWidth(1);
    doc.line(20, 30, 60, 30);
    doc.setLineWidth(1.5);
    doc.line(20, 35, 60, 35);
    doc.setDrawColor(255, 0, 0); // draw red lines
    doc.setLineWidth(0.1);
    doc.line(100, 20, 100, 60); // vertical line
    doc.setLineWidth(0.5);
    doc.line(105, 20, 105, 60);
    doc.setLineWidth(1);
    doc.line(110, 20, 110, 60);
    doc.setLineWidth(1.5);
    doc.line(115, 20, 115, 60);
    doc.save('Test.pdf');
}

function test_circles_ellipses() {
    var doc = new jsPDF();
    doc.ellipse(40, 20, 10, 5);
    doc.setFillColor(0, 0, 255);
    doc.ellipse(80, 20, 10, 5, 'F');
    doc.setLineWidth(1);
    doc.setDrawColor(0);
    doc.setFillColor(255, 0, 0);
    doc.circle(120, 20, 5, 'FD');
    doc.save('Test.pdf');
}

function test_triangles() {
    var doc = new jsPDF();
    doc.triangle(60, 100, 60, 120, 80, 110, 'FD');
    doc.setLineWidth(1);
    doc.setDrawColor(255, 0, 0);
    doc.setFillColor(0, 0, 255);
    doc.triangle(100, 100, 110, 100, 120, 130, 'FD');
    doc.save('My file.pdf');
}

function test_images() {
    var getImageFromUrl = function (url:string, callback:Function) {
        var img = new Image();
        img.onerror = function () {
            alert('Cannot load image: "' + url + '"');
        };
        img.onload = function () {
            callback(img);
        };
        img.src = url;
    };

    var createPDF = function (imgData:string) {
        var doc = new jsPDF();
        doc.addImage(imgData, 'JPEG', 10, 10, 50, 50, 'monkey'); // Cache the image using the alias 'monkey'
        doc.addImage('monkey', 70, 10, 100, 120); // use the cached 'monkey' image, JPEG is optional regardless
        doc.addImage({
            imageData: imgData,
            angle: -20,
            x: 10,
            y: 78,
            w: 45,
            h: 58
        });
        doc.output('datauri');
    };
    getImageFromUrl('thinking-monkey.jpg', createPDF);
}

function test_add_html() {
    var pdf = new jsPDF('p', 'pt', 'a4');
    pdf.addHTML(document.body, function () {
        var string = pdf.output('datauristring');
        document.getElementsByClassName('preview-pane')[0].setAttribute('src', string);
    });
}

function test_context2d_smiley() {
    var doc = new jsPDF('p', 'pt', 'a4');
	var ctx = doc.context2d;

    
    ctx.beginPath();
    ctx.arc(75, 75, 50, 0, Math.PI * 2, true); // Outer circle
    ctx.moveTo(110, 75);
    ctx.arc(75, 75, 35, 0, Math.PI, false);    // Mund
    ctx.moveTo(65, 65);
    ctx.arc(60, 65, 5, 0, Math.PI * 2, true);  // Linkes Auge
    ctx.moveTo(95, 65);
    ctx.arc(90, 65, 5, 0, Math.PI * 2, true);  // Rechtes Auge
    ctx.stroke();
}

function test_context2d_warnsign() {
    
	var doc = new jsPDF('p', 'pt', 'a4');
	var context = doc.context2d;
		 
	var primaryColor = "#ffc821";
	var secondaryColor = "black";
	var tertiaryColor = "black";
	var lineWidth = 10;  
	// Dimensions of the triangle
	var width = 125;
	var height = 100;
	var padding = 20;
    
	// Create a triangluar path
	context.beginPath();
	context.moveTo(padding + width/2, padding);
	context.lineTo(padding + width, height + padding);
	context.lineTo(padding, height + padding);
	context.closePath();
		
	// Create fill gradient
	var gradient = context.createLinearGradient(0,0,0,height);
	gradient.addColorStop(0, primaryColor);
	gradient.addColorStop(1, secondaryColor);
		
	// Add a shadow around the object
	context.shadowBlur = 10;
	context.shadowColor = "black";
		
	// Stroke the outer outline
	context.lineWidth = lineWidth * 2;
	context.lineJoin = "round";	
	context.strokeStyle = gradient;
	context.stroke();
		
	// Turn off the shadow, or all future fills will have shadows
	context.shadowColor = "transparent";
		
	// Fill the path
	context.fillStyle = gradient;
	context.fill();

	// Add a horizon reflection with a gradient to transparent
	gradient=context.createLinearGradient(0,padding,0,padding+height);
	gradient.addColorStop(0, "transparent");
	gradient.addColorStop(0.5, "transparent");
	gradient.addColorStop(0.5, tertiaryColor);
	gradient.addColorStop(1, secondaryColor);

	context.fillStyle = gradient;
	context.fill();
		
	// Stroke the inner outline
	context.lineWidth = lineWidth;
	context.lineJoin = "round";	
	context.strokeStyle = "#333";
	context.stroke();

	// Draw the text exclamation point
	context.textAlign = "center";
	context.textBaseline = "middle";
	context.font = "bold 60px 'Times New Roman', Times, serif";
	context.fillStyle = "#333";
	context.fillText("!", padding + width/2, padding + height/1.5);
}

function test_context2d_fields () {
    
		var doc = new jsPDF();
		
		var ctx = doc.canvas.getContext('2d');
		
		ctx.fillStyle='#000000';
		ctx.filter='none';
		ctx.font='10px sans-serif';
		ctx.globalAlpha=1;
		ctx.globalCompositeOperation="source-over";
		ctx.imageSmoothingEnabled=true;
		ctx.imageSmoothingQuality="low";
		ctx.lineCap="butt";
		ctx.lineDashOffset=0;
		ctx.lineJoin="miter";
		ctx.lineWidth=1;
		ctx.miterLimit=10;
		ctx.shadowBlur=0;
		ctx.shadowColor="rgba(0, 0, 0, 0)";
		ctx.shadowOffsetX=0;
		ctx.shadowOffsetY=0;
		ctx.strokeStyle='#000000';
		ctx.textAlign='start';
		ctx.textBaseline='alphabetic';
}

function test_context2d_functions () {
    var doc = new jsPDF();
    doc.context2d.moveTo(1,1);
    doc.context2d.lineTo (1,1);
    doc.context2d.quadraticCurveTo (1,1,1,1);
    doc.context2d.bezierCurveTo(1,1,1,1,1,1);
    doc.context2d.arc(1,1,1,1,1,false);
    doc.context2d.rect (1,1,1,1);
    doc.context2d.fillRect (1,1,1,1);
    doc.context2d.strokeRect (1,1,1,1);
    doc.context2d.clearRect (1,1,1,1);
    doc.context2d.fillText ('valid',1,1,1);
    doc.context2d.strokeText ('valid',1,1,1);
    doc.context2d.measureText ('valid');
    doc.context2d.scale (1,1);
    doc.context2d.rotate (1);
    doc.context2d.translate (1,1);
    doc.context2d.transform(1,1,1,1,1,1);
}

function test_add_font() {
    
    var doc = new jsPDF('p','pt', 'a4');

    doc.addFont('helvetica', 'helvetica', 'normal', 'StandardEncoding');
}
function test_vfs() {
    
    var doc = new jsPDF('p','pt', 'a4');
	doc.addFileToVFS('test.pdf', 'BADFACE');
    doc.getFileFromVFS('test.pdf');
    doc.existsFileInVFS('test.pdf');
}

function test_outline() {
    var doc = new jsPDF({unit: 'pt'})
    doc.outline.add(null, "Page 1", {pageNumber:1});
    doc.addPage();
}

function test_page_operations() {
    
    var doc = new jsPDF()
    doc.text('Text that will end up on page 2', 20, 20)
    doc.addPage()
    doc.text('Text that will end up on page 1', 20, 20)
    doc.movePage(2, 1)

    doc.addPage()
    doc.text('Text that will end up on page 3', 20, 20)
    doc.deletePage(3)
}

function test_displayMode (){
    
    const doc = new jsPDF();
    doc.setDisplayMode('fullheight');
    doc.setDisplayMode('fullwidth');
    doc.setDisplayMode('fullpage');
    doc.setDisplayMode('original');
    doc.setDisplayMode('300%');
    doc.setDisplayMode(2);
    doc.text(10, 10, 'This is a test')
    doc.setDisplayMode(null, 'continuous');
    doc.setDisplayMode(null, 'single')
    doc.setDisplayMode(null, 'twoleft')
    doc.setDisplayMode(null, 'two')
    doc.setDisplayMode(null, 'tworight')
    doc.setDisplayMode(null, null, 'UseOutlines')
    doc.setDisplayMode(null, null, 'UseThumbs')
    doc.setDisplayMode(null, null, 'FullScreen')
}

function test_put_total_pages() {
    const doc = new jsPDF();
	const totalPagesExp = '{totalPages}';
	  

	doc.text(10, 10, "Page 1 of {totalPages}");
	doc.addPage();

	doc.text(10, 10, "Page 2 of {totalPages}");

	if (typeof doc.putTotalPages === 'function') {
	doc.putTotalPages(totalPagesExp);
	}
}

function test_autoprint() {
    
    const doc = new jsPDF()
    doc.text(10, 10, 'This is a test')
    doc.autoPrint()
    doc.autoPrint({variant: 'javascript'})
}

function test_viewerpreferences() {
    
    const doc = new jsPDF()
    doc.text(10, 10, 'This is a test')
    doc.viewerPreferences({'HideToolbar': true})
    doc.viewerPreferences({'HideMenubar': true})
    doc.viewerPreferences({'HideWindowUI': true})
    doc.viewerPreferences({ NumCopies:9})
    doc.viewerPreferences({'HideWindowUI': true})
    doc.viewerPreferences({'FitWindow': true}, true)
    doc.viewerPreferences({'ViewArea' : 'MediaBox'})
    doc.viewerPreferences({'PrintPageRange' : [[1,3],[5,9]]})
    doc.viewerPreferences({'HideWindowUI': true})
    doc.viewerPreferences('reset')
    doc.viewerPreferences({'FitWindow': true})
}

function test_arabic() {
    const doc = new jsPDF()
    doc.processArabic("??????");
}

function test_split_text_to_size() {
    var doc = new jsPDF();
    doc.setFont("Courier");

    doc.getTextWidth("Lorem Ipsum");
    doc.getStringUnitWidth("Lorem Ipsum");
    doc.getCharWidthsArray("Lorem Ipsum");
    doc.splitTextToSize("Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.", 100);

}

function test_setlanguage() {
    
    var doc = new jsPDF();
    doc.setLanguage("en-US");
    doc.setLanguage('de-DE')
    
}

function test_annotations() {
    const doc = new jsPDF()
    doc.createAnnotation({
      type: 'text',
      title: 'note',
      bounds: {
        x: 10,
        y: 10,
        w: 200,
        h: 80
      },
      contents: 'This is text annotation (closed by default)',
      open: false
    })
    doc.createAnnotation({
        type: 'text',
        title: 'note',
        bounds: {
          x: 10,
          y: 10,
          w: 200,
          h: 80
        },
        contents: 'This is text annotation (open by default)',
        open: true
      })
      
    doc.createAnnotation({
        type: 'freetext',
        bounds: {
          x: 0,
          y: 10,
          w: 200,
          h: 20
        },
        contents: 'This is a freetext annotation',
        color: '#ff0000'
      })
}

function test_AcroForm() {
    var doc = new jsPDF();
    var checkBox = doc.AcroForm.CheckBox();
    checkBox.value = 'Off';

    var radioGroup = doc.AcroForm.RadioButton();
    radioGroup.createOption('Test');

    var textField = doc.AcroForm.TextField();
    textField.value = 'Test';
    textField.defaultValue = '';
}