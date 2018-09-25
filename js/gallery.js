var selectImg = null;
var formData = new FormData();

$(".box-caption").click(function () {
    console.log('test');
});
$(".img__file").change(function () {

    console.log(selectImg);
    let reader = new FileReader();
    var img = document.createElement("img");
    img.classList.add("photo");
    // selectImg.innerHTML = '';
    selectImg.innerHTML = '<div class="fas fa-minus fa-7x minus"></div>';
    selectImg.appendChild(img);
    reader.onload = (e) => {
        img.src = e.target.result;
        img.style.cssText = "width: 100%;";
        selectImg.style.cssText = "border: none;";
    };
    reader.readAsDataURL(this.files[0]);
    formData.append('zd[]', this.files[0]);
});

$(".gallery_save").click(function(){
    console.log('gallery save');
    formData.append('operacja', 'dodaj');
    let xml = new XMLHttpRequest();
    xml. open("POST", "operationGallery.php", true);
    xml.send(formData);
    xml.onload = () => {
        console.log('onload');
        console.log(xml.responseText);
    }
    // $.post("operationGallery.php", {operacja: 'zapisz', zdjecia: formData}, function(data){
        // console.log(data);
    // });
});

function clickImg() {
    $(".gallery .img").click(function () {
        selectImg = this;
        if ($(this).has("img").length == 0) {
            //dodawanie
            let elem = $(this).parent().siblings("input");
            elem.click();
        } else if ($(this).has("img").length == 1) {
            //odejmowanie
            console.log('odejmowanie');
            selectImg.innerHTML = '<span class="fas fa-plus fa-7x"></span>';
        }
    });
}

function loadGallery() {
    $.post("operationGallery.php", {operacja: 'wczytaj'}, function (data) {
        // console.log(data);
        try {
            let json = JSON.parse(data);
            // console.log(json);
            $(".gallery__content").empty().html(json.div);
            clickImg();
        } catch (error) {
            console.log(error);
        }
    });
}