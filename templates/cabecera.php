<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>FC Barcelona</title>
	<link rel="shortcut icon" href="img/favicon.ico" type="image/bmp" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/custom.css">
	<link href="fontawesome/css/all.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
	<!--Cabecera-->
	<div class="row mr-1 ml-1 mt-1 bg-azul_oscuro p-2">
		<div class="col d-flex justify-content-start align-items-center">
			<img class="mr-2" src="img/escudo_barca.png" width="80" height="80">
			<h1 class="text-white">Futbol Club Barcelona</h1>
		</div>
	</div>
	<div class="mr-1 bg-degradado_red_blue ml-1">
		<nav class="navbar navbar-expand-sm navbar-dark primary-color">
			<button class="navbar-toggler" data-target="#my-nav" data-toggle="collapse" aria-controls="my-nav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div id="my-nav" class="collapse navbar-collapse">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item active">
						<a class="nav-link" href="index.php"><i class="fas fa-home"></i> Inicio <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="mostrarCarrito.php" tabindex="-1" aria-disabled="true"><i class="fas fa-shopping-cart fa-lg"></i> (0)</a>
					</li>
				</ul>
			</div>
			<div class="d-flex justify-content-end">
		        <div class="nav-item">
		          	<button type="button" class="btn btn-primary text-white" data-toggle="modal" data-target="#myModalLogin">Login</button>
		        </div>
		       	<div class="nav-item ml-2 mr-2">
		       		<button type="button" class="btn btn-primary text-white" data-toggle="modal" data-target="#myModalRegistro">Registro</button>
	           	</div>
	        </div>
			<!-- Modal Login-->
			<div class="modal fade" id="myModalLogin" role="dialog">
      			<div class="modal-dialog">
      				<!-- Modal content-->
        			<div class="modal-content">
          				<div class="modal-header bg-primary">
			            	<div class="col-12 d-flex flex-row">
				              <p class="modal-title text-white">Menu de Inicio de Sesion</p>
				              <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
				            </div>
			          	</div>
			        	<div class="modal-body">
			            	<div class="col-12">
			              		<form action="login.php" method="post">
			                	<div class="form-group">
			                  		<label for="exampleInputEmail1">Email</label>
			                  		<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Introduzca tu email" name="correo" required>
			                	</div>
			                	<div class="form-group">
			                  		<label for="exampleInputPassword1">Contraseña</label>
			                  		<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Introduzca tu contraseña" name="password" required>
			                	</div>
			                	<div class="modal-footer border-0">
			            			<button class="btn btn-primary text-white" type="submit" name="boton" value="Entrar">Entrar</button>
			          			</div>
			              		</form>
			            	</div>
			          	</div>	
			        </div>
		      	</div>
			</div>
			<!-- Modal Registro-->
		    <div class="modal fade" id="myModalRegistro" role="dialog">
		    	<div class="modal-dialog">
		      	<!-- Modal content-->
		        	<div class="modal-content">
		          		<div class="modal-header bg-primary">
		            		<div class="col-12 d-flex flex-row">
		              			<p class="modal-title text-white">Menu de Registro</p>
		              			<button type="button" class="close text-white" data-dismiss="modal">&times;</button>
		            		</div>
		          		</div>
		          		<div class="modal-body">
		            		<div class="row justify-content-center">
		              			<div class="col-12">
		                		<form form action="registro.php" method="post">
		                  			<div class="form-group">
		                    			<label for="exampleInputEmail1">Nombre</label>
		                    			<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Introduzca tu nombre" name="nombre" required>
		                  			</div>
		                  			<div class="form-group">
		                    			<label for="exampleInputPassword1">Apellidos</label>
		                    			<input type="text" class="form-control" id="exampleInputPassword1" placeholder="Introduzca tus apellidos" name="apellidos" required>
		                  			</div>
		                  			<div class="form-group">
		                    			<label for="exampleInputEmail1">Email</label>
		                    			<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Introduzca tu email" name="correo" required>
		                  			</div>
		                  			<div class="form-group">
		                    			<label for="exampleInputPassword1">Contraseña</label>
		                    			<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Introduzca tu contraseña" name="password" required>
		                  			</div>
		                  			<div class="form-inline">
		                    		<label class="mr-3" for="exampleInputPassword1">Sexo</label>
		                    			<div class="btn-group btn-group-toggle" data-toggle="buttons">
		                      				<label class="btn btn-warning text-dark active">
		                        				<input type="radio" name="sexo" value="Hombre" id="option1" autocomplete="off" checked> Hombre
		                      				</label>
		                      				<label class="btn btn-warning text-dark">
		                       					<input type="radio" name="sexo" value="Mujer" id="option2" autocomplete="off"> Mujer
		                      				</label>
		                    			</div>
		                  			</div>
		                  			<div class="modal-footer border-0">
		                    			<button class="btn btn-primary mb-3" type="submit" name="boton" value="Registrar">Registrar</button>
		                  			</div>
		                		</form>
		              			</div>
		            		</div>
		          		</div>
		        	</div>
				</div>
			</div>  
      	</nav>
	</div>
	<div class="container">

