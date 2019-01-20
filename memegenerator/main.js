var canvas = new fabric.Canvas('memeCanvas');
var url = "distracted.jpg";


setBackgroundImage(); 

function setBackgroundImage(){
    fabric.Image.fromURL(url, function(img){
        // add background image
        canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas), {
            scaleX: canvas.width / img.width,
            scaleY: canvas.height / img.height
        });
    });
}


function addText(){
    var text = document.querySelector("#meme-text").value;

    var textObject = new fabric.Textbox(text, {
        left: 50,
        top: 50,
        fill: 'white',
        fontSize: 30,
        charSpacing: 10,
        fontFamily: 'Impact',
        shadow: 'rgba(0, 0, 0, 1) 2px 2px 2px',
        // borderColor: 'red',
        // editingBorderColor: 'blue',
        padding: 2,
        showTextBoxBorder: true,
        textboxBorderColor: 'green'
    });

    canvas.add(textObject);

}

function deleteText(){
    this.canvas.clear();

    setBackgroundImage();
}

function downloadImg(){
    if (!fabric.Canvas.supports('toDataURL')) {
        alert('This browser doesn\'t provide means to serialize canvas to an image');
    }
    else {
        window.open(canvas.toDataURL('png'));
    }
}