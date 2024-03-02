<!--sidebar wrapper -->
<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div>
					<img src="assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
				</div>
				<div>
					<h4 class="logo-text">Rukada</h4>
				</div>
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
				</div>
			</div>
			<!--navigation-->
			<ul class="metismenu" id="menu">
				<li>
					<a href="dashboard.php">
						<div class="menu-title">Dashboard</div>
					</a>
					
				</li>
				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="bx bx-user"></i>
						</div>
						<div class="menu-title">User Management</div>
					</a>
					<ul>
						<li> <a href="user.php?do=add"><i class="bx bx-right-arrow-alt"></i> Add New User </a></li>
						<li> <a href="user.php?do=manage"><i class="bx bx-right-arrow-alt"></i> Manage All User </a></li>
					</ul>
				</li>

				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="lni lni-grid-alt"></i>
						</div>
						<div class="menu-title">All Category</div>
					</a>
					<ul>
						<li> <a href="category.php?do=add"><i class="bx bx-right-arrow-alt"></i> Add New Category </a></li>
						<li> <a href="category.php?do=manage"><i class="bx bx-right-arrow-alt"></i> Manage All Category </a></li>
					</ul>
				</li>

				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="lni lni-gallery"></i>
						</div>
						<div class="menu-title">All Posts</div>
					</a>
					<ul>
						<li> <a href="post.php?do=add"><i class="bx bx-right-arrow-alt"></i> Add New Post </a></li>
						<li> <a href="post.php?do=manage"><i class="bx bx-right-arrow-alt"></i> Manage All Post </a></li>
					</ul>
				</li>

				<li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class="lni lni-comments-alt"></i>
						</div>
						<div class="menu-title">All Comment</div>
					</a>
					<ul>
						<li> <a href="comment.php?do=manage"><i class="bx bx-right-arrow-alt"></i> Manage All Post </a></li>
					</ul>
				</li>
				
				<a href="logout.php" class="btn-logout">Log Out</a>
			</ul>
			<!--end navigation-->
		</div>
		<!--end sidebar wrapper -->