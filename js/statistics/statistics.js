 var Month = [
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
    'July',
    'August',
    'September',
    'October',
    'November',
    'December',
  ];

function SetData(element){
    settings = {
        prev:'prev'

    }
    this.container = element;
    var d = new Date();
    this.month = d.getMonth();
    this.year = d.getFullYear()
    self = this;

    this.setDataPageMonth(Month[this.month]);
    this.setDataPageYear(this.year);
    
    this.prevMonth = $('#prev');
    this.nextMonth = $('#next');

    this.prevMonth.on('click', function(){
        self.month--;
        if(self.month < 0)
        {
            self.prevYear();
        }
        else
        {
            self.setDataPageMonth(Month[self.month]);
        }
    });
    this.nextMonth.on('click', function(){
        self.month++;
        if(self.month > 11)
        {
            self.nextYear();
        }
        else
        {   
            self.setDataPageMonth(Month[self.month]);
        }
    });
}

SetData.prototype.setDataPageMonth = function(month){
    var input = document.createElement('span');
    input.textContent = month;
    this.container.empty();
    this.container.append(input);
}
SetData.prototype.setDataPageYear = function(year){
    var input = document.createElement('span');
    input.textContent = year;
    var year_container = $('#year_print');
    year_container.empty();
    year_container.append(input);
}
SetData.prototype.prevYear = function(){
    this.month = 11;
    this.year--;
    this.setDataPageMonth(Month[this.month]);
    this.setDataPageYear(this.year);   

}
SetData.prototype.nextYear = function(){
    this.month = 0;
    this.year++;
    this.setDataPageMonth(Month[this.month]);
    this.setDataPageYear(this.year); 
       
}

function Info(elements){
        $(elements).hover(function(e) {
        $($(this).children()).css({
            left: e.pageX + 1,
            top: e.pageY + 1
        }).stop().show(100);
    }, function() {
        $($(this).children()).hide();
    });
  
    
}
$(document).ready(function(){
    var element = $('#data_input');
    new SetData(element);
    });


window.addEventListener('load', onload);