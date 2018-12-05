let searchButton = document.getElementById('brandSearchButton');
searchButton.addEventListener('click', function(){
	let searchPattern = document.getElementById('brandSearch').value;
	
	let oReq = new XMLHttpRequest();
	oReq.addEventListener("load", function(event){
		let data = JSON.parse(oReq.response).data;
		let container = document.getElementById('searchResults');
		container.innerHTML = '';
		
		data.forEach(function(element) {console.log(element);
			container.insertAdjacentHTML('beforeend', '<li>'+element.name+'</li>');
		});
	});
	oReq.open("GET", "/brand/search?pattern=" + searchPattern);
	oReq.send();
});
