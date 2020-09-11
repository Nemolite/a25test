 //slick
 $('.content_top-slider').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: true,
  fade: false,
  adaptiveHeight: true,
  infinite: false,
  useTransform: true,
  speed: 400,
  cssEase: 'cubic-bezier(0.77, 0, 0.18, 1)',
 });


 // ajax

 function ajax_transport_to_server() { // функция отправки данных (ajax)
	 var formData = new FormData(document.forms.name_form);
	 console.dir(formData); // что там отправляем то?
	 var xhr = new XMLHttpRequest(); //создаем объект
	 xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) { //проверяем ответ на ошибки 
            	// если норм то выводим
                document.getElementById("result").innerHTML = this.responseText;
            }
            else
            {
            	// если нет сообщаем об ошибке
            	document.getElementById("result").innerHTML = "Error";
            }	
        };
     xhr.open("POST", "/controller.php"); // post запрос на конкретный контроллер
     xhr.send(formData); //отпраляем данные

}