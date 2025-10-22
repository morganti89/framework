window.onload = (event) => {
	const slot = document.querySelector('slot');
	const xlayout = document.querySelector('x-layout');
	const layout = document.querySelector('#layout');
	
	if (xlayout === null) {
		layout.remove();
		layout.style.display = "none";
	}
	layout.style.display = "block";	
	slot.appendChild(xlayout);
	const title = xlayout.attributes.title.value;
	document.title = title;
	const mainHeader = document.querySelector('#main_header');
	mainHeader.innerHTML = title;

}