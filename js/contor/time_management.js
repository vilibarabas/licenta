
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
      var days = ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'];
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

        for(var i = 0; i < dates.length; i++) {
          weeks.push(dates[i]);
        }
        return weeks;
      }

      function Datapicker(element, result,  settings) {
        this.getNewMonthUserTime(1, 1, true);
        this.result = result;
        this.element = element;
        this.dateContainer = $('#date_container');
        this.d = new Date();

        this.currentMonth = this.d.getMonth();
        this.currentDate = weeks(Days(this.d, this.currentMonth));
        this.currentYear = this.d.toString().split(" ")[3];
        this.settings = settings || {
          table: '<table class="time_management_table" />',
          row: '<tr class="time_management_body"/>',
          rowHeader: '<tr class="time_management_header"/>',
          headerday: '<td class="datapicker_header" />',
          day: '<td class="days"/>',
          day_week: '<td class="days week"/>',
          day_head: '<td class="time_header"/>',
          today: '<td class="time_header today"/>',
          td: '<td />',
          dayHead: '<th class="days_head"/>'
        };
        this.colors = {
          tr_head: '#3399ff',
          tr: '#d9d9d9',
          name: '#cccccc',
          week: '#ffcccc',
          hover: '#8080ff',
          mouse: '#3333ff',
        };
        this.setCurrentMonth();
        var self = this;
        this.element.on('click', function() {
          self.dateContainer.show();
        });
        //this.createDateTable(this.currentDate);
        $('#next_month').on('click', function() {
          self.currentMonth++;

          if(self.currentMonth < 12)
          {
            self.currentDate = weeks(Days(self.d, self.currentMonth));
            
          }
          else
          {
            self.currentMonth = 0;
            self.currentYear++;
            self.d.setYear(self.currentYear);
            self.currentDate = weeks(Days(self.d, self.currentMonth));
            
          }
          self.recreateDatapicker();
        });
        $('#previev_month').on('click', function() {
          self.currentMonth--;

          if(self.currentMonth >= 0)
          {

            self.currentDate = weeks(Days(self.d, self.currentMonth));
            
          }
          else
          {
            self.currentMonth = 11;
            self.currentYear--;
            self.d.setYear(self.currentYear);
            self.currentDate = weeks(Days(self.d, self.currentMonth));
          }
          self.recreateDatapicker();
        });
      }

      
      Datapicker.prototype.getUserDataJson = function(){
        
        var data = $('#users_data_json').val();
        return JSON.parse(data);
      }

      Datapicker.prototype.getNewMonthUserTime = function(month, year, q = false){
        if(q){
          data = new Date();
          month = data.getMonth();
          year = data.getFullYear();
        }
        var self = this;
        $(".loader").fadeIn();
        $.ajax({
          url:"ajax/time/getNewMonthUserTime.php",
          type:"POST",
          data: {month:month,year:year,department:$('#user_department').val()}
        }).done(function(result){
            $('#users_data_json').val(result);
              if(q)
                self.recreateDatapicker(this.currentDate);
          });
      }

      Datapicker.prototype.createDateTable = function(weeks) {
        var dateContainer = $(this.settings.table);
        var row = $(this.settings.rowHeader);
        row.css({'background-color': this.colors.tr_head, 'color':'#FFFFFF'});
        dateContainer.append(row);
        day = this.createDay(this.settings.td, 'User');
        row.append(day);
        
        for(var i = 0; i < weeks.length; i++) {
          tag = this.settings.td;
          var today = new Date();
          if(today.getDate() == weeks[i].getDate() && today.getMonth() == weeks[i].getMonth() && today.getFullYear() == weeks[i].getFullYear())
            tag = this.settings.today;
          day = this.createDay(tag, weeks[i].getDate());
          row.append(day);
        }

        var row = $(this.settings.rowHeader);
        row.css({'background-color': this.colors.tr});
        dateContainer.append(row);
        day = this.createDay(this.settings.dayHead, '');
        row.append(day);
        
        for(var i = 0; i < weeks.length; i++) {
          tag = this.settings.day;
          if(weeks[i].getDay() == 0 || weeks[i].getDay() == 6){
              tag = this.settings.day_week;
            }
          day = this.createDay(tag, days[weeks[i].getDay()]);
          row.append(day);
        }
        
        var users = this.getUserDataJson();
        
        for(var i = 0; i < users.length; i++) {
          var row = $(this.settings.row);
          row.css('background-color', this.colors.tr);
          dateContainer.append(row);
          day = this.createDay(this.settings.dayHead, users[i].user);
          row.append(day);
          for(var j = 1; j <= weeks.length; j++) {
            tag = this.settings.day;
            if(weeks[j-1].getDay() == 0 || weeks[j-1].getDay() == 6){
              tag = this.settings.day_week;
            }
            var vl = users[i].time[j]? users[i].time[j]: '0:0';
            day = this.createDay(tag, vl);
            row.append(day);     
          }
        }
        this.dateContainer.append(dateContainer);
        var self = this;
        $('.days').hover(function(event){
          var index = $(this).index();
          var rows = $(this).parent().parent().children();

          for(var i = 1; i < rows.length; i++)
            rows.eq(i).children().eq(index).css({'background-color':self.colors.hover});

          $(this).parent().children().css({'background-color':self.colors.hover});
          $(this).css({'background-color':self.colors.mouse, 'color': '#FFFFFF'});
        }).mouseleave(function(){
          $('.days').css({'background-color':self.colors.tr, 'color': '#000000'});
          $('.week').css({'background-color':self.colors.week, 'color': '#000000'});
          $(this).parent().children().first().css({'background-color':'#cccccc'});
        })
      };
      Datapicker.prototype.createDay = function(tag, val) {
        return $(tag).text(val);
      }
      Datapicker.prototype.setCurrentMonth = function() {
        var monthPrint =  Month[this.currentMonth]+ ' ' + this.currentYear;
        $('#current_date').text(monthPrint);
      };
      Datapicker.prototype.recreateDatapicker = function() {
        $('table').remove();
        this.setCurrentMonth();
        this.getNewMonthUserTime(this.currentMonth, this.currentYear);
        self = this;
        setTimeout(function(){
          self.createDateTable(self.currentDate);
          $(".loader").fadeOut();
        }, 500);
        
      }
      $(document).ready(function(){
        var datap = new Datapicker($('.datepicker'), $('#users_data_json').val());
      });