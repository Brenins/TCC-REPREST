
<!-- Page Wrapper -->
<div id="wrapper">

<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion" style="background-color: #256D85" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="./paginas/home">
            
        <img src="images/logo.png" alt="Vitrine Logo" style="width: 100%">

    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="./paginas/home">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">


    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTree"
        aria-expanded="true" aria-controls="collapseTree">
        <i class="fas fa-ticket-alt"></i>
        <span>Reservas e Empréstimos</span>
    </a>
    <div id="collapseTree" class="collapse" aria-labelledby="headingTree" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="cadastros/categorias"><i class="fas fa-tags"></i> Não Desenvolvido</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">

   
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseGestao"
        aria-expanded="true" aria-controls="collapseGestao">
        <i class="fas fa-globe"></i>
        <span>Gestão</span>
    </a>
    <div id="collapseGestao" class="collapse" aria-labelledby="headingGestao" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="cadastros/GestaoPessoas"><i class="fas fa-users"></i> Pessoas</a>
                <a class="collapse-item" href="cadastros/GestaoPredial"><i class="fas fa-building"></i> Edificio</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseItens"
            aria-expanded="true" aria-controls="collapseItens">
            <i class="fas fa-tools"></i>
            <span>Inventário de Itens</span>
        </a>
        <div id="collapseItens" class="collapse" aria-labelledby="headingItens" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="cadastros/itens"><i class="fas fa-dolly"></i> Gerenciar Itens</a>
                <a class="collapse-item" href="cadastros/categorias"><i class="fas fa-tags"></i> Gerenciar Categorias</a>
            </div>
        </div>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider">


    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-hand-holding-usd"></i>
            <span>Financeiro</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="relatorios/produtos"><i class="fas fa-shopping-cart"></i> Não Desenvolvido</a>
            </div>
        </div>
    </li>
    
    <hr class="sidebar-divider">

    <!-- Nav Item - Pages Collapse Menu -->
    
    


    <!-- Nav Item - Charts -->
   <!--  <li class="nav-item">
        <a class="nav-link" href="sair.php">
            <i class="fas fa-fw fa-power-off"></i>
            <span>Sair</span></a>
    </li> -->



</ul>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>


            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                <li class="nav-item dropdown no-arrow d-sm-none">
                    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-search fa-fw"></i>
                    </a>
                </li>

                <!-- Nav Item - Alerts -->
                

                

                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                            Olá <?=$_SESSION['usuario']['login']?> <i class="fas fa-ellipsis-v"></i>
                        </span>
                        
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="sair.php">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">