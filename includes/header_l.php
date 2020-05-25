<?php  

$name = $_SESSION['name'];

$nameArray = explode(' ', $name);
$name = $nameArray[0];

?>
<header>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark">
        
        <a class="navbar-brand" href="index.php"><img src="index/images/Logo3.png"
                                                      style="max-height: 40px; max-width:40px;"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php"><i class="fa fa-fw fa-home"></i> Home</a>
                </li>
                <!-- <li>
                    <a class="nav-link" href="#"><i class="fa fa-book-open" data-toggle="tooltip"
                                                    title="Search Users"></i> How To Use</a>
                </li> -->
                <li>
                    <a class="nav-link" href="contact.html"><i class="fa fa-fw fa-envelope" data-toggle="tooltip"
                                                               title="Want Some Assisstance?"></i> Contact</a>
                </li>
                <li>
                    <a class="nav-link" href="cc_index.php"><i class="far fa-money-bill-alt" data-toggle="tooltip"
                                                               title="Use Currency Converter"></i> Currency
                        Converter</a>
                </li>

                <!-- <li>
                    <button type="button" class="btn btn-warning" style="margin-left: 10px"><i class="fas fa-user"></i>
                        SignUp
                    </button>
                </li>
        
                <li>
                    <button type="button" class="btn btn-success" style="margin-left: 20px"><i class="fas fa-sign-in-alt"></i>
                        LogIn
                    </button>
                </li> -->
            </ul>
            <form class="form-inline mt-2 mt-md-0">
                <input class="form-control mr-sm-2" type="search" autocomplete="off" placeholder="Search User" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
            <span class="badge badge-info" style="margin-left:10px "><h6>Welcome, <?php echo $name;?></h6></span>
        </div>
        
    </nav>
</header>