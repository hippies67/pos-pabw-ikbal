<!--**********************************
            Sidebar start
        ***********************************-->
        <div class="deznav">
            <div class="deznav-scroll mm-active">
				<ul class="metismenu mm-show" id="menu">
                        <li <?php if($_SERVER['SCRIPT_NAME']=="/dashboard.php") { ?>  class="active"   <?php   }  ?>>
                            <a class="ai-icon" href="dashboard.php" aria-expanded="false">
                                <i class="flaticon-381-networking"></i>
                                <span class="nav-text">Dashboard</span>
                            </a>
                        </li>
                        <li <?php if($_SERVER['SCRIPT_NAME']=="/data-barang.php") { ?>  class="active"   <?php   }  ?>>
                            <a class="ai-icon" href="data-barang.php" aria-expanded="false">
                                <i class="flaticon-381-television"></i>
                                <span class="nav-text">Data Barang</span>
                            </a>
                        </li>
                        <li <?php if($_SERVER['SCRIPT_NAME']=="/transaksi.php") { ?>  class="active"   <?php   }  ?>>
                            <a class="ai-icon" href="transaksi.php" aria-expanded="false">
                                <i class="flaticon-381-home-2"></i>
                                <span class="nav-text">Transaksi</span>
                            </a>
                        </li>
                        <li <?php if($_SERVER['SCRIPT_NAME']=="/laporan-transaksi.php") { ?>  class="active"   <?php   }  ?>>
                            <a class="ai-icon" href="laporan-transaksi.php" aria-expanded="false">
                                <i class="flaticon-381-home-2"></i>
                                <span class="nav-text">Laporan Transaksi</span>
                            </a>
                        </li>
                        <li <?php if($_SERVER['SCRIPT_NAME']=="/manajemen-user.php") { ?>  class="active"   <?php   }  ?>>
                            <a href="manajemen-user.php" class="ai-icon" aria-expanded="false">
                                <i class="flaticon-381-settings-2"></i>
                                <span class="nav-text">Manajemen User</span>
                            </a>
                        </li>
                </ul>
			</div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->