function loadAvto() {
	$.get('avto.get.php', {token:localStorage['token']}, function(date) {
		let otvet = JSON.parse(date)
		if ('error' in otvet) {
			alert(otvet['error']['text'])
		}
		else if ('avto' in otvet) {
			let avto = otvet['avto']
			//let content = $('#commentBlock');
			let num = 1
			avto.forEach(function(item,i, avto) {
				$('#td_'+(i+1)).html('<img src="'+item['logo']+'" width="190" height="130" alt=""><figcaption>'+item['mark']+'<span>(год-'+item['year']+')</span></figcaption>')

			});
		}
	});
}