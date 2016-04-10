<!DOCTYPE html>
<html>
<head>
<script src="https://code.jquery.com/jquery-1.9.1.js"></script>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>JS Bin</title>
  <style type="text/css">
    .datapicker_header{
      background-color: #99b3ff;
    }
    #date_container{
      display: none;
    }
    .container{
      width:250px;
      position: absolute;
    }
    td{
      height: 15px;
      text-align: center;
    }
    td:not(.datapicker_header):hover{
      background-color: #b3d1ff;
    }
    .active{
      color:red;
    }
  </style>
  <script>

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

      function Days(date, month){
        var i = 1;
        var thisMonth = [];
        date.setMonth(month);
        while (true){
          var d = new Date(date.toString());
          d.setDate(i);
          if (d.getMonth() != date.getMonth()) {
            break;
          }
          d.setHours(0);
          d.setMinutes(0);
          d.setSeconds(0);
          d.setMilliseconds(0);
          thisMonth.push(d);
          i++;
        }
        return thisMonth;
      }

      function weeks(dates) {
        var weeks = [];
        var sd = dates[0].getUTCDay();
        var ed = dates[dates.length - 1].getUTCDay();
        var pd = dates[0];
        var px = pd.getDate();
        pd = pd.toString();
        for (var i = 0; i < sd; i++) {
          var d = new Date(pd);
          d.setDate(i - sd + px);
          weeks.push(d);
        }

        for(var i = 0; i < dates.length; i++) {
          weeks.push(dates[i]);
        }
        var ld = dates[dates.length - 1];
        var lx = ld.getDate();
        ld = ld.toString();
        for (var i = ed + 1; i <= 6; i++){
          var d = new Date(ld);
          d.setDate(i + lx - ed);
          weeks.push(d);
        }
        var w = [];
        while(weeks.length > 7){
          w.push(weeks.splice(0, 7));
        }
        w.push(weeks);
        return w;
      }

      function Datapicker(element, settings) {
        this.element = element;
        this.dateContainer = $('#date_container');
        this.d = new Date();
        this.currentMonth = this.d.getMonth();
        this.currentDate = weeks(Days(this.d, this.currentMonth));
        this.currentYear = this.d.toString().split(" ")[3];
        this.settings = settings || {
          table: '<table class="datapicker_table" />',
          row: '<tr />',
          headerday: '<td class="datapicker_header" />',
          day: '<td class="days"/>'
        };
        this.setCurrentMonth();
        var self = this;
        this.element.on('click', function() {
          self.dateContainer.show();
        });

        this.createDateTable(this.currentDate);
        $('#next_month').on('click', function() {
          self.currentMonth++;

          if(self.currentMonth < 12)
          {
            self.currentDate = weeks(Days(self.d, self.currentMonth));
            self.recreateDatapicker();
          }
          else
          {
            self.currentMonth = 0;
            self.currentYear++;
            self.d.setYear(self.currentYear);
            self.currentDate = weeks(Days(self.d, self.currentMonth));
            self.recreateDatapicker();
          }
        });
        $('#previev_month').on('click', function() {
          self.currentMonth--;

          if(self.currentMonth >= 0)
          {
            self.currentDate = weeks(Days(self.d, self.currentMonth));
            self.recreateDatapicker();
          }
          else
          {
            self.currentMonth = 12;
            self.currentYear--;
            self.d.setYear(self.currentYear);
            self.currentDate = weeks(Days(self.d, self.currentMonth));
            self.recreateDatapicker();
          }
        });

      }
      Datapicker.prototype.createDateTable = function(weeks) {
      var dateContainer = $(this.settings.table);

        for(var i = -1; i < weeks.length; i++) {
          var row = $(this.settings.row);
          dateContainer.append(row);
          if(i == -1)
            var k = 0;
          else
            k = i;
           for(var j = 0; j < weeks[k].length; j++) {
             if(i == -1)
              var day = this.createDay(this.settings.headerday, weeks[k][j].toString().split(" ")[0]);
             else
              day = this.createDay(this.settings.day, weeks[k][j].getDate());
             //day.attr('id', "day_" + k + "_" + j);
             row.append(day);
           }
        }
        this.dateContainer.append(dateContainer);
        var self = this;
        $('.days').on('click', function(event) {
            $('.active').removeClass('active');
            var day_click = $(event.target);
            var date = day_click.text() + "/" + Month[self.currentMonth] + "/" + self.currentYear;

            self.element.val(date);
            day_click.addClass('active');
            self.dateContainer.hide();

          });
      };
      Datapicker.prototype.createDay = function(tag, val) {
        return $(tag).text(val)
      }
      Datapicker.prototype.nextMonth = function() {

      };
      Datapicker.prototype.setCurrentMonth = function() {
        var monthPrint =  Month[this.currentMonth]+ ' ' + this.currentYear;
        $('#current_date').text(monthPrint);
      };
      Datapicker.prototype.recreateDatapicker = function() {
        $('table').remove();
        this.setCurrentMonth();
        this.createDateTable(this.currentDate);
      }
      $(document).ready(function(){
         new Datapicker($('.datepicker'));
      });


  </script>
  <style>
    .days_header{
      background-color:red;
    }
    .days_body{
      background-color:blue;
    }
    td{
      width:50px;
      height:50px;
    }
  </style>
</head>
<body>
  <div class="container">
    <p id="data_input"><laber>Date:</laber><input type="text" class="datepicker"/></p>

    <div id="date_container">
      <center><p><input type="button" id="previev_month" value=" < "/><span id="current_date"></span><input type="button" id="next_month" value = " > "/></p></center>
    </div>
  </div>
</body>
</html>