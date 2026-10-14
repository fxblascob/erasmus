
			window.onload = function() {
				
				function poner() {
					window.setInterval(myFunction, 3000);

					function myFunction() {
						if (document.getElementById("novedades-message").style.color=="blue")
							document.getElementById("novedades-message").style.color="black";
						else
							document.getElementById("novedades-message").style.color="blue";
					}
				}
				
				let domElement = document.getElementById("novedades-message");
				let texto = domElement.innerHTML;
				let falso = ""
				let longitud = String(texto).length;
				
				let caracteres = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZabccdefghijklmnñopqrstuwxyz0123456789-+|}{[]~:;?/.><=+-_)(*&^%$#@!)}";
				
				for(let i = 0; i < longitud; i++){
					falso += caracteres.charAt(Math.floor(Math.random() * 101));
				}
				falso = String(falso);
				domElement.innerHTML = falso
				let i = 0;

				function cambiar(){
					if(i <= texto.length) {
						falso = texto.substr(0,i) + falso.substr(i);
						console.log(falso);
						domElement.innerHTML = falso;
						i++;
						//setInterval(cambiar, 500);
					}
				};
				// Esperar un segundo antes de iniciar
				setInterval(cambiar, 1000);
			}
			
