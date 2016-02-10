var m1 ;
var h1 ;
var s1 ;

$(document).ready(function (){
    if(document.getElementById('#last_time') !== ''){
        
        var last_date = document.getElementById("last_date").value;
        last_date = last_date.split("-");
        var today = new Date();

        var day = today.getDate();
        var month = today.getMonth()+1;
        if(month < 10)
            month = '0'+ month; 
        if(last_date[0] == day && last_date[1] == month)
        {
            h1 = document.getElementById("last_hours").value;
            m1 = document.getElementById("last_min").value;
            s1 = document.getElementById("last_sec").value;
            document.getElementById("start_button").style.display = "none";
            document.getElementById("stop_button").style.display  = "block";
            var data = getElementById('#last_time');
            var h = today.getHours();
            var m = today.getMinutes();
            var s = today.getSeconds();
            alert(h);
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
    }
});