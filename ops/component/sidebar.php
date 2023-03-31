<?php  session_start(); ?>
<div class="bg-sidebar vh-100 vw-50 position-fixed">
    <?php
        if($_SESSION['role'] != "operasional"){
          header("Location: http://localhost/Raf/index");
        }               
    ?>
            <div class="log d-flex justify-content-between">
                <img class="logo" src="../assets/img/raffeda.png" />
                <h1 class="text h6 fw-bold">Raffeda Express</h1>
                <i class="far fa-times h4 me-3 close align-self-end d-md-none"></i>
            </div>
            <div class=" bg-list d-flex flex-column align-items-left fw-bold gap-2 mt-4">
                <ul class="d-flex flex-column list-unstyled">
                    <li class="h7 <?php if($page=='aboutme'){echo 'active';}?>"><a class="nav-link text-dark" href="aboutme"><i
                            class="fal fa-bars me-2"></i> <span>About Me</span></a></li>
                    <li class="h7 <?php if($page=='customer'){echo 'active';}?>"><a class=" nav-link text-dark" href="customerlist"><i
                                class="fal fa-bars me-2"></i> <span>Customer</span></a></li>
                    <li class="h7 <?php if($page=='airwaybill'){echo 'active';}?>"><a class=" nav-link text-dark" href="airwaybillinput"><i
                                class="fal fa-bars me-2"></i> <span>Airwaybill</span></a></li>
                    <li class="h7 <?php if($page=='manifest'){echo 'active';}?>"><a class=" nav-link text-dark" href="manifesttype"><i
                                class="fal fa-bars me-2"></i> <span>Manifest</span></a></li>
                    <li class="h7 <?php if($page=='tracking'){echo 'active';}?>"><a class=" nav-link text-dark" href="trackinginput"><i
                                class="fal fa-bars me-2"></i> <span>Tracking</span></a></li>
                    <li class="h7 <?php if($page=='receiver'){echo 'active';}?>"><a class=" nav-link text-dark" href="receiver"><i
                                class="fal fa-bars me-2"></i> <span>Receiver</span></a></li>
                    <li class="h7 <?php if($page=='simulation'){echo 'active';}?>"><a class=" nav-link text-dark" href="simulation"><i
                                class="fal fa-bars me-2"></i> <span>Simulation</span></a></li>
                    <li class="h7 <?php if($page=='country'){echo 'active';}?>"><a class=" nav-link text-dark" href="country"><i
                                class="fal fa-bars me-2"></i> <span>Country</span></a></li>
                    <li class="h7 ">&nbsp</li>
                    <li class="h7 ">&nbsp</li>
                    <li class="h7 ">&nbsp</li>
                    <li class="h7 ">&nbsp</li>
                    <li class="h7 ">&nbsp</li>
                </ul>
                <ul class="logout d-flex justify-content-start list-unstyled">
                    <li class=" h7"><a class="nav-link text-dark" href="http://localhost/Raf/logout"><span>Logout</span><i
                                class="fal fa-sign-out-alt ms-2"></i></a></li>
                </ul>
            </div>

            
        </div>

        