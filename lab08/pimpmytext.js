document.getElementById('biggerPimpinBtn').onclick = helloworld;
document.getElementById('Snoopify').onclick = Snoopify;
document.getElementById('Igpay_Atinlay').onclick = Igpay_Atinlay;
document.getElementById('Malkovitch').onclick = Malkovitch;
document.getElementById('checkbox').onchange = checkboxHandler;



function helloworld(){
    alert("Hello, world!");
    var size = parseInt($("text").style.fontSize);
    if (!size) {
        $("text").style.fontSize = "12pt";
    } else{
        size += 2;
        $("text").style.fontSize = size + "pt";
    }
    var increaseFont = setInterval(function(){
        var size = parseInt($("text").style.fontSize);
        size += 2;
        $("text").style.fontSize = size + "pt";
    }, 500)
}

function checkboxHandler(){
    alert();
    if($('checkbox').checked){
        $("text").style.fontWeight = "bold";
        $("text").style.color = "green";
        $("text").style.textDecoration = "underline";
        document.body.style.backgroundImage = 'url(https://selab.hanyang.ac.kr/courses/cse326/2019/labs/images/8/hundred.jpg)';
    }else{
        $("text").style.fontWeight = "normal";
        $("text").style.color = "black";
        $("text").style.textDecoration = "none";
        document.body.style.backgroundImage = "none";
    }
}

function Snoopify() {
    var text = $("text").value.toUpperCase();
    text = text.split(".").join('-izzle.');
    $("text").value = text;
}


function Igpay_Atinlay() {
    var text = $("text").value;
    var index = text.search(/[aeiouAEIOU]/g)
    if (index !== -1){
        var newStr = text.substring(index, text.length) + text.substring(0, index) + "ay";
        $("text").value  = newStr;
    }
}

function Malkovitch() {
    var text = $("text").value;
    if (text.length >= 5){
        $("text").value = "Malkovitch";
    }
}