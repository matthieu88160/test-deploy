function Client(button, input, container) {
		this.button = button;
	    this.input = input;
	    this.container = container;
};

Client.prototype.start = function() {
	this.button.addEventListener('click', this.load.bind(this));
};

Client.prototype.load = function() {
	this.oReq = new XMLHttpRequest();
	this.oReq.addEventListener("load", this.processResult.bind(this));
	this.oReq.open("GET", "/brand/search?pattern=" + this.input.value);
	this.oReq.send();
};

Client.prototype.processResult = function() {
	let data = JSON.parse(this.oReq.response).data;
	this.container.innerHTML = '';
	
	data.forEach(this.processLine.bind(this));
};

Client.prototype.processLine = function() {
	this.container.insertAdjacentHTML('beforeend', '<li>'+arguments[0].name+'</li>');
};
