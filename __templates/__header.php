<style>
	.sign-up-text {
		text-decoration: none;
		color: black;
		position: absolute;
		display: flex;
		right: 1%;
		font-weight: bold;
		margin-right: 15px;
		padding: 5px 10px;
	}

	.sign-up-text:hover {
		border-radius: 50%;
		transform: scale(1.2)
	}

	.navbar-brand {
		margin-left: 30px
	}
</style>


<div class="container px-0 py-3 ">
	<!-- Navbar -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark rounded">
		<!-- Container wrapper -->
		<div class="container-fluid">
			<!-- Toggle button -->
			<button class="navbar-toggler" type="button" data-mdb-toggle="collapse"
				data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
				aria-label="Toggle navigation">
				<i class="fas fa-bars"></i>
			</button>

			<!-- Collapsible wrapper -->
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<!-- Navbar brand -->
				<a class="navbar-brand mt-2 mt-lg-0" href="index.php">
					<img src="https://git.selfmade.ninja/uploads/-/system/appearance/header_logo/1/logo-text.png"
						height="15" alt="LOGO" />
				</a>
				<!-- Left links -->
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a class="nav-link text-white" href="index.php">Dashboard</a>
					</li>				
					<li class="nav-item">
						<a class="nav-link text-white" href="insert.php">Insert</a>

					</li>

					<li class="nav-item">
						<a class="nav-link text-white" href="table.php?dailyincomelist=income">Income</a>

					</li>
					<li class="nav-item">
						<a class="nav-link text-white" href="table.php?dailyincomelist=expense">Expense</a>
					</li>
				</ul>
				<!-- Left links -->
			</div>
			<!-- Collapsible wrapper -->

			 <!-- Right elements -->
			 <div class="d-flex align-items-center">
      <!-- Icon -->
	  <h6 class="mx-3 mt-1 text-light"><?=$_SESSION['user_name']?></h6>
      <a class="text-reset me-5 text-light" href='libs/load.php?action=d&token=<?=$_COOKIE['sessionToken']?>' id="session-destroy">
        <i class="fas fa-sign-out"></i>
      </a>

	<div id="toggle_filter">


      <!-- Avatar -->
      

    </div>
    <!-- Right elements -->
  </div>
  <!-- Container wrapper -->
</nav>
<!-- Navbar -->
		</div>
		<!-- Container wrapper -->
	</nav>
	<!-- Navbar -->
</div>

<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"
>
