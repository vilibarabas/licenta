var m1 ;
var h1 ;
var s1 ;
var stop = 0;
function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();

    if (m1 != undefined && stop == 0)
    {
        h = h - h1;
        m = checkTime(m) - checkTime(m1);
        
        if (m < 0)
        {
            m = 60 + m;
            h -= 1;
        }
        
        s = checkTime(s) - checkTime(s1);
        if (s < 0)
        {
            s = 60 + s;
            m -= 1;
        }
        
        hp = (h < 10) ? "0" : "";
        hm = (m < 10) ? "0" : "";
        hs = (s < 10) ? "0" : "";
        msg = 'Contorul este Pornit';
        color = '#00e600';
    }
    else
    {
        hp = '';
        hm = '';
        hs = '';
        h = '00';
        m = '00';
        s = '00';
        msg = 'Contorul este oprit';
        color = 'red';
    }
    document.getElementById('msg_box').style.backgroundColor = color;
    document.getElementById('msg').innerHTML = msg;
    document.getElementById('txt').innerHTML = hp + 
    h + ":" + hm + m + ":" + hs + s;
    var t = setTimeout(startTime, 500);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}

function clickStart()
{
    stop = 0;
    var today = new Date();
    h1 = today.getHours();
    m1 = today.getMinutes();
    s1 = today.getSeconds();
    document.getElementById("start_button").style.display = "none";
    document.getElementById("stop_button").style.display  = "block";
    
}

function clickstop()
{
    stop = 1;
    document.getElementById("start_button").style.display = "block";
    document.getElementById("stop_button").style.display  = "none";
}

