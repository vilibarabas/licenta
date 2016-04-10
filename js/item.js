settings = {
	monitor:{
		nume:'monitor',
		select:'select_monitor',
		container:'monitor_container',
		tagname:'img',
		classname: 'monitor_new_item',
		sursa: 'img/monitor.png',
	},
	unitate:{
		nume:'unitate',
		select:'select_unit',
		container:'unitate_container',
		tagname:'img',
		classname: 'monitor_new_item',
		sursa: 'img/unitate.jpg',
	}
};

function Items(element, name){	
	this.element = element;
	this.item = settings[name];
}

Items.prototype.clickAdd = function(){
	container = this.getEmptyContainer();
	if(container){
		if(container == 1)
		{
			alert('nu exista container gol');	
		}
		else if(container == 2)
		{
			alert('Nu ati selectat nimic!');	
		}
		else
		{
			this.addElement(container);	
		}	
	}else{
		alert('exista deja un item in cerere');
	}
}

Items.prototype.getEmptyContainer = function(){
	var select = document.getElementById(this.item.select).value;
	var newclass = document.getElementById(this.item.container).getElementsByClassName(this.item.classname).length;
	
	var container = document.getElementById(this.item.container).getElementsByClassName('empty');
	if(container.length > 0 && select != 0 && newclass == 0){
		return container[0];
	}
	else if(select == 0){
		return 2;
	}
	else if(container.length == 0){
		return 1;
	}
	else{
		return null;
	}
}

Items.prototype.addElement = function(container){
	container.appendChild(this.createElement());
	container.className = 'col-sm-3';
}

Items.prototype.createElement = function(){

	var new_monitor = document.createElement(this.item.tagname);
	new_monitor.classList.add(this.item.classname);
	new_monitor.src = this.item.sursa;
	self = this;
	new_monitor.addEventListener('click', function(){
		monitor = new Items(this, self.item.nume);
		monitor.clickDelete();
	});
	return new_monitor;
}

Items.prototype.clickDelete = function(){
	var content = this.element.parentNode;
	content.className = 'col-sm-3 empty';
	content.removeChild(this.element);
}

function Info(elements){
	for(i = 0; i < elements.length; i++){
		$(elements[i]).mouseenter(function(event) {
			var div = $(event.target).parent().find('div');
			div.show();
		}).mouseleave(function(event) {
			var div = $(event.target).parent().find('div');
			div.hide();
		});
	}
}

function onload(event) {
	var add_monitor = document.getElementById('add_monitor');
	add_monitor.addEventListener('click', function(){
		monitor = new Items(this, 'monitor');
		monitor.clickAdd();
	});
	var add_monitor = document.getElementById('add_unitate');
	add_monitor.addEventListener('click', function(){
		monitor = new Items(this, 'unitate');
		monitor.clickAdd();
	});
	var elements = document.getElementsByTagName('img');
	var viewInfo = new Info(elements);
}

window.addEventListener('load', onload);