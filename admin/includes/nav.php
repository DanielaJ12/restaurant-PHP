<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="background:sandybrown;">


    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">

        <div class="sidebar-brand-text mx-3">Restaurant</div>
    </a>


    <hr class="sidebar-divider my-0">

    <li class="nav-item <?php echo $page=='dashboard'?'active':''; ?>">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <li class="nav-item <?php echo $page=='users'?'active':''; ?>">
        <a class="nav-link" href="clients.php">
            <i class="fas fa-fw fa-users"></i>
            <span>Clienți</span></a>
    </li>
    <li class="nav-item <?php echo $page=='orders'?'active':''; ?>">
        <a class="nav-link" href="orders.php">
            <i class="fas fa-fw fa-shopping-cart"></i>
            <span>Comenzi</span></a>
    </li>
    <li class="nav-item <?php echo $page=='reservations'?'active':''; ?>">
        <a class="nav-link" href="reservations.php">
            <i class="fas fa-fw fa-calendar"></i>
            <span>Rezervări</span></a>
    </li>


    <hr class="sidebar-divider">


    <div class="sidebar-heading">
        Produse
    </div>


    <li class="nav-item">
        <a class="nav-link <?php echo $tab!='products'?'collapsed':'' ?>" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fas fa-boxes"></i>
            <span>Produse</span>
        </a>
        <div id="collapseTwo" class="collapse <?php echo $tab=='products'?'show':'' ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item <?php echo $page=='add-product'?'active':'' ?>" href="add-product.php">Adaugă Produs</a>
                <a class="collapse-item <?php echo $page=='products'?'active':'' ?>" href="products.php">Vezi Produse</a>
            </div>
        </div>
    </li>

    <li class="nav-item <?php echo $page=='categories'?'active':''; ?>">
        <a class="nav-link" href="categories.php">
            <i class="fas fa-fw fa-tag"></i>
            <span>Categorii</span></a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">
    <li class="nav-item">
        <a class="nav-link" href="../">
            <i class="fas fa-fw fa-globe"></i>
            <span>Înapoi la Website</span></a>
    </li>

</ul>