var startTime=new Date(), endTime, bestTime=100000000;

function disapear() {
    document.getElementById("shape").style.display="none";
    endTime = new Date();
    var timeDiff = endTime - startTime; //in ms
    // strip the ms
    timeDiff /= 1000;

    if(bestTime>timeDiff){
        bestTime=timeDiff;
    }
    /* get seconds
    var seconds = Math.round(timeDiff);*/
    document.getElementById("time").innerHTML=timeDiff+"";
    document.getElementById("bestTime").innerHTML=bestTime+"";
}

/*Random color generate*/
function generateRandomColor()
{
    var randomColor = '#'+Math.floor(Math.random()*16777215).toString(16);
    return randomColor;
    //random color will be freshly served
}

function getRndInteger(min, max) {
    return Math.floor(Math.random() * (max - min + 1) ) + min;
}

function appear(){
    startTime = new Date();
    var randTop=getRndInteger(15, 300);
    var randRight=getRndInteger(0, 100);
    var randLeft=getRndInteger(0,800);
    var randBottom=getRndInteger(15,150);
    randDim=getRndInteger(150, 400);

    var shapeType=getRndInteger(0, 1);
    var shape=document.getElementById("shape");

    /*random the shape type*/
    if(shapeType==1){
        shape.style.borderRadius = "50%";
    }else{
        shape.style.borderRadius = "0%";
    }


    shape.style.display="block";
    shape.style.marginTop= randTop+"px";
    shape.style.marginBottom= randBottom+"px";
    shape.style.marginLeft= randLeft+"px";
    shape.style.marginRight= randRight+"px";
    shape.style.height= randDim+"px";
    shape.style.width= randDim+"px";
    shape.style.backgroundColor=generateRandomColor();
}

document.getElementById("shape").onclick = function() {
    disapear();
    appear();

}