function toggleForm(){
		var container = document.querySelector('.cont');
		container.classList.toggle('active')
	}
function openform(){
		document.getElementById('section').classList.add('active');
		document.querySelector('main').classList.add('blur');
	}
function toggle(){
		document.getElementById('section').classList.remove('active');
		document.querySelector('main').classList.remove('blur');
	}