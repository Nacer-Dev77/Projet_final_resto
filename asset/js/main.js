let url = document.location.href;
let urlEnd = url.substring(url.lastIndexOf('/') + 1);

if (urlEnd === 'index.php?route=home') {
    let slide = new Array(
        'asset/images/img_home/brigade1.jpg',
        'asset/images/img_home/brigade2.jpg',
        'asset/images/img_home/header2.png',
        'asset/images/img_home/img_header1.jpg',
    );

    let numero = 0;

    function ChangeSlide(sens) {
        numero = numero + sens;
        if (numero < 0) numero = slide.length - 1;

        if (numero > slide.length - 1) numero = 0;

        document.getElementById('slide').src = slide[numero];
    }
    setInterval('ChangeSlide(1)', 3000);
}
