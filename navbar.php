<?php
if(empty($_SESSION['tipo_usuario'])){
		echo "
			<nav class='navbar navbar-expand-lg navbar-dark py-4' style='background-color: #716D6D'>
				  <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarTogglerDemo01' aria-controls='navbarTogglerDemo01' aria-expanded='false' aria-label='Toggle navigation'>
					<span class='navbar-toggler-icon'></span>
				 </button>
				<div class='collapse navbar-collapse nav-style' id='navbarTogglerDemo01'>
					<a class='navbar-brand' href='#' style='font-size: 1.10rem'>
						Futuro Nome do Sistema
					</a>
					<ul class='navbar-nav ml-auto mt-2 mt-lg-0'>
						<li class='nav-item'>
						    <a class='nav-link text-white' href='#'>Notícias</a>
						</li>
						<li class='nav-item rounded vermelho'>
						    <a class='nav-link text-dark' href='usuario_login_front.php'>Ouvidoria</a>
						</li>
					</ul>
				</div>
			</nav>
		";
	} else if($_SESSION["tipo_usuario"] == '1'){
		echo "
			<nav class='navbar navbar-expand-lg navbar-dark py-4' style='background-color: #716D6D'>
				  <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarTogglerDemo01' aria-controls='navbarTogglerDemo01' aria-expanded='false' aria-label='Toggle navigation'>
					<span class='navbar-toggler-icon'></span>
				 </button>
				<div class='collapse navbar-collapse nav-style' id='navbarTogglerDemo01'>
					<a class='navbar-brand' href='#' style='font-size: 1.10rem'>
						Futuro Nome do Sistema
					</a>
					<ul class='navbar-nav ml-auto mt-2 mt-lg-0'>
						<li class='nav-item'>
						    <a class='nav-link text-white' href='#'>
						    	Notícias
								<i class='fas fa-newspaper'></i>
							</a>
						</li>
						<li class='nav-item'>
						    <a class='nav-link text-white' href='tela_ouvidoria.php'>
						    	Ouvidoria
						    	<i class='fas fa-headphones-alt'></i>
						    </a>
						</li>
						<li class='nav-item dropdown'>
					        <a class='nav-link text-white dropdown-texto' href='#'' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
						        Conta
						        <i class='fas fa-user-cog'></i>
					        </a>
					        <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
					          <a class='dropdown-item text-white dropdown-texto' href='usuario_edita_front.php'>
					          	Editar Dados
					          	<i class='fas fa-user-edit'></i>
					          </a>
					          <div class='dropdown-divider'></div>
					          <a class='dropdown-item text-white dropdown-texto' href='usuario_logout_back.php'>
					          	Sair
					          	<i class='fas fa-sign-out-alt'></i>
					          </a>
					        </div>
					      </li>
					</ul>
				</div>
			</nav>
		";
	} else if($_SESSION["tipo_usuario"] == '2'){
		echo "
			<nav class='navbar navbar-expand-lg navbar-dark py-4' style='background-color: #716D6D'>
				  <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarTogglerDemo01' aria-controls='navbarTogglerDemo01' aria-expanded='false' aria-label='Toggle navigation'>
					<span class='navbar-toggler-icon'></span>
				 </button>
				<div class='collapse navbar-collapse nav-style ' id='navbarTogglerDemo01'>
					<a class='navbar-brand text-white' href='ouvidoria_front.php' style='font-size: 1.10rem;'>
						Ouvidoria da cai
					</a>
					<ul class='navbar-nav ml-auto mt-2 mt-lg-0'>
						<li class='nav-item dropdown'>
					        <a class='nav-link dropdown-toggle text-white' href='#'' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
						        Conta
						        <i class='fas fa-user-cog'></i>
					        </a>
					        <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
					          <a class='dropdown-item text-white dropdown-texto ' href='usuario_edita_front.php'>
					          	Editar Dados
					          	<i class='fas fa-user-edit'></i>
					          </a>
					          <a class='dropdown-item text-white dropdown-texto' href='usuario_excluir_front.php'>
					          	Excluir Conta
					          	<i class='fas fa-user-times'></i>
					          </a>
					      </li>
						<li class='nav-item'>
						    <a class='nav-link text-white' href='usuario_logout_back.php'>
						    	Sair
								<i class='fas fa-sign-out-alt ml-1'></i>
							</a>
						</li>
					</ul>
				</div>
			</nav>
		";
	} 

?>


