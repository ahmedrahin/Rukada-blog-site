						<aside class="sidebar">
								<form action="search.php" method="GET">
									<div class="input-group mb-3 pb-1">
										<input class="form-control text-1" placeholder="Search..." name="search" id="s" type="text" required>
										<span class="input-group-append">
											<button type="submit" name="" class="btn btn-dark text-1 p-2"><i class="fas fa-search m-2"></i></button>
										</span>
									</div>
								</form>

								<h5 class="font-weight-bold pt-4">Categories</h5>
								<ul class="nav nav-list flex-column mb-5">

								<!-- category from database-->
								<?php
													
									$parentSql = "SELECT id AS 'pcatId', name AS 'pcatName' FROM category WHERE is_parent = 0 AND status = 1 ORDER BY name ASC ";
									$parentDb  = mysqli_query($db, $parentSql);
									

									while( $row = mysqli_fetch_assoc($parentDb) ){
										extract($row);

									$childSql  = "SELECT id AS 'CcatId', name AS 'CcatName' FROM category WHERE is_parent = '$pcatId' AND status = 1 ORDER BY name ASC ";
									$childDb       = mysqli_query($db, $childSql);
									$numberOfchild = mysqli_num_rows($childDb);
									
									if( $numberOfchild == 0 ){
										// how many post in those category
										$countPSql       = "SELECT * FROM post WHERE category_id = '$pcatId' AND status = 1 ";
										$countPDb        = mysqli_query($db, $countPSql);
										$total_parentRow = mysqli_num_rows($countPDb);
										?>
											<li class="nav-item">
												<a class="nav-link 
												<?php
													// active category
													if(isset($_GET['id'])){
														$catPage = $_GET['id'];
														$active = ($catPage == $pcatId) ? "active" : null;
														echo $active;
													}
													?>
												" href="category.php?id=<?php echo $pcatId ;?>">
													<?php echo $pcatName ;?> (<?php echo $total_parentRow; ?>)
												</a>
											</li>
										<?php
									} else {

										?>
											<li class="nav-item">
												<a class="nav-link" href="javascript:;">
													<?php echo $pcatName ;?>
												</a>
												<ul>
													<?php
														while( $childRow = mysqli_fetch_assoc($childDb) ){
														extract ($childRow);

														// how many post in those sub category
														$countcSql       = "SELECT * FROM post WHERE category_id = '$CcatId' AND status = 1 ";
														$countCDb        = mysqli_query($db, $countcSql);
														$total_childRow  = mysqli_num_rows($countCDb);
														?>
															<li class="nav-item">
																<a class="nav-link 
																	<?php
																		// active sub category
																		if(isset($_GET['id'])){
																			$scatPage = $_GET['id'];
																			$active = ($scatPage == $CcatId) ? "active" : null;
																			echo $active;
																		}
																		?>
																	?>
																" href="category.php?id=<?php echo $CcatId ;?>">
																	<?php echo $CcatName ;?> (<?php echo $total_childRow; ?>)
																</a>
															</li>
														<?php
													}
													?>																		
												</ul>
											</li>
										<?php
										
									}


								}
									
													
								?>

								</ul>
								<div class="tabs tabs-dark mb-4 pb-2">
									<ul class="nav nav-tabs">
										<li class="nav-item active"><a class="nav-link show active text-1 font-weight-bold text-uppercase" href="#popularPosts" data-toggle="tab">Popular</a></li>
										<li class="nav-item"><a class="nav-link text-1 font-weight-bold text-uppercase" href="#recentPosts" data-toggle="tab">Recent</a></li>
									</ul>
									<div class="tab-content">

										<!-- popular post -->
										<div class="tab-pane active" id="popularPosts">
											<ul class="simple-post-list">
											<?php 
												$recentSql = "SELECT * FROM post WHERE status = 1 AND view_count >= 6  LIMIT 3";
												$recentDb  = mysqli_query($db, $recentSql);

												while( $popularRow = mysqli_fetch_assoc($recentDb) ){
													$postId    = $popularRow['id'];
													$postName  = $popularRow['title'];
													$thumb     = $popularRow['image'];
													$year      = $popularRow['post_year'];
													$month     = $popularRow['post_month'];

													?>
														<li>
															<div class="post-image">
																<div class="img-thumbnail img-thumbnail-no-borders d-block">
																	<a href="single.php?pId=<?php echo $postId; ?>">
																		<img src="admin/assets/post-image/<?php echo $thumb; ?>" width="50" height="50" alt="">
																	</a>
																</div>
															</div>
															<div class="post-info">
																<a href="single.php?pId=<?php echo $postId; ?>">
																	<?php echo $postName; ?>
																</a>
																<div class="post-meta">
																	<?php echo $month . " " . $year ; ?>
																</div>
															</div>
														</li>
													<?php
												}
											?>
											</ul>
										</div>

										<!-- recent post -->
										<div class="tab-pane" id="recentPosts">
											<ul class="simple-post-list">
												<?php 
													$recentSql = "SELECT * FROM post WHERE status = 1 ORDER BY id DESC LIMIT 3";
													$recentDb  = mysqli_query($db, $recentSql);

													while( $recentRow = mysqli_fetch_assoc($recentDb) ){
														$postId    = $recentRow['id'];
														$postName  = $recentRow['title'];
														$thumb     = $recentRow['image'];
														$year      = $recentRow['post_year'];
														$month     = $recentRow['post_month'];

														?>
															<li>
																<div class="post-image">
																	<div class="img-thumbnail img-thumbnail-no-borders d-block">
																		<a href="single.php?pId=<?php echo $postId; ?>">
																			<img src="admin/assets/post-image/<?php echo $thumb; ?>" width="50" height="50" alt="">
																		</a>
																	</div>
																</div>
																<div class="post-info">
																	<a href="single.php?pId=<?php echo $postId; ?>">
																		<?php echo $postName; ?>
																	</a>
																	<div class="post-meta">
																		<?php echo $month . " " . $year; ?>
																	</div>
																</div>
															</li>
														<?php
													}
												?>
											</ul>
										</div>
									</div>
								</div>

								<!-- meta tag -->
								<h5 class="font-weight-bold pt-4">Tags</h5>
								<p>
									<?php
										$allTag   = "SELECT * FROM post WHERE status = 1 ORDER BY id DESC LIMIT 10";
										$tagDb    = mysqli_query($db, $allTag);
		
										while( $postRow = mysqli_fetch_assoc($tagDb) ){
											$id         = $postRow['id'];
											$postTag    = $postRow['meta_tag'];
											$tags       = explode(',',$postTag);

											if(!empty($postTag)){
												foreach($tags as $tag){
													$tagContent = trim($tag, ' ');
													?>
														<span class="badge badge-primary">
																<a href="single.php?pId=<?php echo $id; ?>" class="tag">
																	<?php echo $tagContent; ?>
																</a>
														</span>
													<?php
												}
											}

											
										}
									?>
								</p>
								
							</aside>