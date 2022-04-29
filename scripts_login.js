function register() {
	    let log = $('#login').val()
		let pas = $('#passw').val()
		let email = $('#email').val()
		
		$.post('register.php', {login:log, password:pas, email:email}, function(data){
			console.log(data)
		        let otvet = JSON.parse(data)
                // если пришла ошибка 
                if ('error' in otvet) {
                        alert(otvet['error']['text'])
                }
                else if ('response' in otvet) {
                        console.log(otvet)
                        alert(otvet['response']['text'])
                }
                else {
                        alert('Непредвиденная ошибка')
                        console.log(data)
                }
				window.location = "http://217.71.129.139:4222/api/login.html";
		});
}

function login() {
	    let log = $('#login').val()
		let pas = $('#passw').val()
		
		$.get('users.get.php', {login:log, password:pas}, function(data){
			    let otvet = JSON.parse(data)
				// если пришла ошибка
				if ('error' in otvet) {
					    alert(otvet['error']['text'])
				}
				else if ('response' in otvet) {
					    // такой пользователь уже существует 
						if (otvet['response'].length == 1) {
							    alert()
								// сохраним токен в хранилище 
								user = otvet['response'][0]
								localStorage['login'] = user ['login']
								localStorage['token'] = user ['token']
								localStorage['expire'] = user ['expiration']
							window.location = "http://217.71.129.139:4222/api/global.html";
						}
						else {
							    alert('Такого пользователя нет')
						}
				}
				else {
					    alert['Непредвиденная ошибка']
						console.log(data)
				}
		});
}