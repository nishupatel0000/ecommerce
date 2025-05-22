 <style>
   .li-active {
     background-color: #007bff !important;
     color: white !important;
   }
 </style>
 <?php

  $current_page = basename($_SERVER['PHP_SELF']);
  ?>
 <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
   <!--begin::Sidebar Brand-->
   <div class="sidebar-brand">
     <!--begin::Brand Link-->
     <a href="./index.html" class="brand-link">
       <!--begin::Brand Image-->
       <!-- <img
         src="assets/img/loggo.png"
         alt="AdminLTE Logo"
         class="brand-image opacity-75 shadow" /> -->
       <!--end::Brand Image-->
       <!--begin::Brand Text-->
       <!--end::Brand Text-->
     </a>
     <!--end::Brand Link-->
   </div>
   <!--end::Sidebar Brand-->
   <!--begin::Sidebar Wrapper-->
   <div class="sidebar-wrapper">
     <nav class="mt-2">
       <!--begin::Sidebar Menu-->
       <ul
         class="nav sidebar-menu flex-column"
         data-lte-toggle="treeview"
         role="menu"
         data-accordion="false">
         <li class="nav-item menu-open">
           <!--  -->

           <ul class="nav nav-treeview">
             <li class="nav-item">
               <a href="dashboard.php" class="nav-link <?= ($current_page == 'dashboard.php') ? 'li-active' : '' ?>">
                 <i class="nav-icon bi bi-palette"></i>
                 <p>
                   Dashboard
                 </p>
               </a>
             </li>
          
             <li class="nav-item">
               <a href="user_info.php" class="nav-link <?= ($current_page == 'user_info.php') ? 'li-active' : '' ?>">
                 <i class="nav-icon bi bi-person"></i>
                 <p>Users</p>
               </a>
             </li>
             <li class="nav-item">
               <a href="category.php" class="nav-link <?= ($current_page == 'category.php') ? 'li-active' : '' ?>">
                 <i class="nav-icon bi bi-bullseye"></i>
                 <p>Category</p>
               </a>
             </li>
                <li class="nav-item">
               <a href="color.php" class="nav-link <?= ($current_page == 'color.php') ? 'li-active' : '' ?>">
                 <i class="nav-icon bi bi-brush"></i>
                 <p>Color</p>
               </a>
             </li>
             <li class="nav-item">
               <a href="product.php" class="nav-link <?= ($current_page == 'category_info.php') ? 'li-active' : '' ?>">
                 <i class="nav-icon bi bi-menu-button-wide-fill"></i>
                 <p>Product</p>
               </a>
             </li>
            
            
                 
            
             <li class="nav-item has-treeview menu-open">
               <a href="#" class="nav-link  ">
                 <i class="nav-icon bi bi-book"></i>
                 <p>
                   Static Page
                   <i class="nav-arrow bi bi-chevron-right"></i>

                 </p>
               </a>
               <ul class="nav nav-treeview" style="display: block;">
                 
                 
                 

                 
                
                 
               </ul>
             </li>

           </ul>
         </li>
       </ul>
       <!--end::Sidebar Menu-->
     </nav>
   </div>
   <!--end::Sidebar Wrapper-->
 </aside>
 <main class="app-main">
   <div class="app-content-header">
     <div class="container-fluid">
       <div class="row">
         <div class="new" style="margin-bottom: 20px;"></div>