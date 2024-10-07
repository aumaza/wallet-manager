<?php

function mainNavBar($nombre,$avatar){
	

	echo '<nav class="navbar navbar-inverse">
			  <div class="container-fluid">
			    <div class="navbar-header">
			    <form action="#" method="POST">
			      <button class="btn btn-default btn-sm navbar-btn" type="submit" name="home">
                    <img src="../img/icons/status/wallet-open.png"  class="img-reponsive img-rounded" alt="img" /> Wallet Manager</button>
			    </form>
			    </div>

			    <ul class="nav navbar-nav">
			      
			      <button type="button" class="btn btn-default btn-sm navbar-btn" data-toggle="modal" data-target="#myModalAbout">
			      	<img src="../img/icons/status/dialog-information.png"  class="img-reponsive img-rounded" alt="img" /> A cerca de..</button>
			      
			      <button type="button" class="btn btn-default btn-sm navbar-btn" data-toggle="modal" data-target="#myModalDocumentation">
			      	<img src="../img/icons/actions/help-contents.png"  class="img-reponsive img-rounded" alt="img" /> Documentación</button>
			    </ul>
			    
			    <ul class="nav navbar-nav navbar-right">
			      
			      <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle navbar-btn" type="button" data-toggle="dropdown" data-            toggle="tooltip" title="Menú"><img src="../img/icons/places/user-identity.png"  class="img-reponsive img-rounded" alt="img" /> '.$nombre.'</button>

                <ul class="dropdown-menu">
				    <form action="#" method="POST">
				      <li class="dropdown-header">Menú del Usuario</li>
				      <li><button type="submit" name="user_bio" class="btn btn-default btn-sm btn-block">
				      	<img src="../img/icons/actions/view-process-own.png"  class="img-reponsive img-rounded" alt="img" /> Mis Datos</button></li>
				      
				      <li><button type="submit" name="empresas" class="btn btn-default btn-sm btn-block">
				      	<img src="../img/icons/categories/applications-engineering.png"  class="img-reponsive img-rounded" alt="img" /> Empresas</button></li>

				      	<li><button type="submit" name="servicios" class="btn btn-default btn-sm btn-block">
				      	<img src="../img/icons/actions/view-barcode.png"  class="img-reponsive img-rounded" alt="img" /> Servicios</button></li>

				      	<li><button type="submit" name="pagos" class="btn btn-default btn-sm btn-block">
				      	<img src="../img/icons/actions/view-loan.png"  class="img-reponsive img-rounded" alt="img" /> Pagos</button></li>

				      <li class="divider"></li>
				      <li class="dropdown-header">Menú del sistema</li>';

                        if($nombre == 'Administrador'){
                            echo '<li><button type="submit" name="usuarios" class="btn btn-default btn-sm btn-block">
                                                <img src="../img/icons/apps/system-users.png"  class="img-reponsive img-rounded" alt="img" /> Usuarios</button></li>';
                        }
                            echo '<li><button class="btn btn-danger btn-sm btn-block" type="submit" name="exit">
                                                <img src="../img/icons/actions/system-shutdown.png"  class="img-reponsive img-rounded" alt="img" /> Salir</button></li>

				     </form>
				    </ul>
				  </div>

			</div>
			      
			      
			    </ul>
			  </div>
			</nav>';

}


function modalAbout(){

	echo '<div class="modal fade" id="myModalAbout" role="dialog">
		    <div class="modal-dialog">
		    
		      <!-- Modal content-->
		      <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
		          <h4 class="modal-title">A Cerca de...</h4>
		        </div>
		        <div class="modal-body">
		          <p>Some text in the modal.</p>
		        </div>
		        <div class="modal-footer">
		          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
		        </div>
		      </div>
		      
		    </div>
		  </div>';
}


function modalDocumentation(){

	echo '<div class="modal fade" id="myModalDocumentation" role="dialog">
		    <div class="modal-dialog">
		    
		      <!-- Modal content-->
		      <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
		          <h4 class="modal-title">Documentación</h4>
		        </div>
		        <div class="modal-body">
		          <p>Some text in the modal.</p>
		        </div>
		        <div class="modal-footer">
		          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
		        </div>
		      </div>
		      
		    </div>
		  </div>';

}




?>
