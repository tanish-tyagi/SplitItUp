<?php  

$name = $_SESSION['name'];

$nameArray = explode(' ', $name);
$name = $nameArray[0];

?>
<header>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark flex-md-nowrap shadow">
        
        <a class="navbar-brand" href="index.php"><img <?php echo "src='uploads/".$_SESSION['pic']."'";?>
                                                      style="max-height: 40px; max-width:40px;" alt="PIC" class="rounded-circle"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php"><i class="fa fa-fw fa-home"></i> Dashboard</a>
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
                    <a class="nav-link" data-toggle="collapse" href="#ccHome" role="button" aria-expanded="false" aria-controls="ccHome" id="ccBtn"><i class="far fa-money-bill-alt" data-toggle="tooltip"
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
            <!-- <span class="badge badge-success text-wrap" style="margin-right:10px; width:10rem;"><p class="text-justify-center lead font-italic">Welcome, <?php //echo $name;?></p></span> -->
            <form class="form-inline mt-2 mt-md-0" style="margin-right: 10px;">
                <input class="form-control mr-sm-2" type="search" autocomplete="off" placeholder="Search User" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
            <a href="backend/logout.php" class="btn btn-warning" role="button"><i class="fas fa-sign-out-alt"></i> LogOut</a>
            
        </div>
        
    </nav>
</header>