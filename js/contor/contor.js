var m1 ;
var h1 ;
var s1 ;
var stop =0;
function startTime() {
    
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();

    if (m1 != undefined && stop == 0)
    {
        msg = 'Contorul este Pornit';
        color = '#00e600';
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
        if(s%2 == 0)
        {
            document.getElementById('msg_box').style.color = color;
        }
        else
        {
            document.getElementById('msg_box').style.color = 'white';
        }
        hp = (h < 10) ? "0" : "";
        hm = (m < 10) ? "0" : "";
        hs = (s < 10) ? "0" : "";
        
    }
    else
    {
        hp = '';
        hm = '';
        hs = '';
        h = '00';
        m = '00';
        s = '00';
        document.getElementById('msg_box').style.color = 'white';
        msg = 'Contorul este oprit';
        color = 'red';
    }
    document.getElementById('msg_box').style.backgroundColor = color;
    document.getElementById('msg').innerHTML = msg;
    document.getElementById('txt').innerHTML = hp + 
    h + ":" + hm + m + ":" + hs + s;
    var total = getTotal();
    t_hr = parseInt(h) + parseInt(total[0]);
    t_m = parseInt(m) + parseInt(total[1]);
    t_s = parseInt(s) + parseInt(total[2]);
    if(t_s > 59){
        t_s -= 60;
        t_m++;
    }
    if(t_m > 59){
        t_m -= 60;
        t_hr++;
    }
    hp = (t_hr < 10) ? "0" : "";
    hm = (t_m < 10) ? "0" : "";
    hs = (t_s < 10) ? "0" : "";
    document.getElementById('total_hours').innerHTML = hp + t_hr + ":" + hm + t_m + ":" + hs + t_s;
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
    setTimeout(function(){
    window.location.reload();
    },1000);
}

function getTotal(){
    var total = document.getElementById('total_time').value;
    return total.split(':');
}
