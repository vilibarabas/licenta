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
    
    this.prevMonth = document.getElementById('prev');
    this.nextMonth = document.getElementById('next');

    this.prevMonth.addEventListener('click', function(){
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
    this.nextMonth.addEventListener('click', function(){
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
    this.container.innerHTML = "";
    this.container.appendChild(input);
}
SetData.prototype.setDataPageYear = function(year){
    var input = document.createElement('span');
    input.textContent = year;
    var year_container = document.getElementById('year_print');
    year_container.innerHTML = "";
    year_container.appendChild(input);
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
    for(i = 0; i < elements.length; i++){

        $(elements[i]).mouseenter(function(event) {
            var div = $(event.target).children();
            var pos = $(event.target).offset();
            div.offset({ top: pos.top + 50 , left: pos.left - 50 });
            div.offset({ top: 0, left: 0 });
            div.show();
        }).mouseleave(function(event) {
            var div = $(event.target).children();
            div.offset({ top: 0, left: 0 });
            div.hide();
        });
    }
}
$(document).ready(function(){
    var element = document.getElementById('data_input');
    new SetData(element);
    });

function onload(event) {
    var elements = document.getElementsByTagName('td');
    var viewInfo = new Info(elements);
}

window.addEventListener('load', onload);