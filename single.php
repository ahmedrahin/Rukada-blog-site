<?php
include "inc/header.php";
?>

	<div role="main" class="main">

		<section class="page-header page-header-modern bg-color-light-scale-1 page-header-md">
			<div class="container">
				<div class="row">

					<div class="col-md-12 align-self-center p-static order-2 text-center">

						<h1 class="text-dark font-weight-bold text-8">
							<?php
								if(isset($_GET['pId'])){

									$blogId = $_GET['pId'];

								$Post    = "SELECT * FROM post WHERE id = '$blogId'";
								$postDb  = mysqli_query($db, $Post);

								while( $postRow = mysqli_fetch_assoc($postDb) ){
									$title      = $postRow['title'];
									$cat        = $postRow['category_id'];
									echo $title;
								}
							}
							?>
						</h1>
<span class="sub-title text-dark">Check out our Latest News!</span>
					</div>

					<div class="col-md-12 align-self-center order-1">

						<ul class="breadcrumb d-block text-center">
							<li><a href="index.php">Home</a></li>
							<li class="active">
								<?php 
									$catSql = "SELECT * FROM category WHERE id = '$cat' ";
									$catDb  = mysqli_query($db, $catSql);
									while($catRow = mysqli_fetch_assoc($catDb)){
										$catName = $catRow['name'];
										echo $catName;
									}
								?>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</section>

		<div class="container py-4">

			<div class="row">
				<div class="col-lg-3 order-lg-2">
				<?php
					include "inc/sidebar.php";
				?>
				</div>
				<div class="col-lg-9 order-lg-1">
					<div class="blog-posts single-post">
						<?php
							function agoTime($timestamp){
								$time_ago     = strtotime($timestamp);
								$current_time = time();
								
								$time_differnce = $current_time - $time_ago;
								$seconds   = $time_differnce;
								$minutes   = round($seconds / 60);
								$hours     = round($seconds / 3600);
								$days      = round($seconds / 86400);
								$weeks     = round($seconds / 604800);
								$months    = round($seconds / 2629440);
								$years     = round($seconds / 31553280);
					
								if( $seconds <= 60 ){
									return "Just Now";
								}
					
								else if( $minutes <= 60 ){
					
									if( $minutes == 1 ){
										return "1 minute ago";
									} else {
										return $minutes . " minutes ago";
									}
					
								}
					
								else if( $hours <= 24 ){
					
									if( $hours == 1 ){
										return "1 hour ago";
									} else {
										return $hours . " hrs ago";
									}
									
								}
					
								else if( $days <= 7 ){
					
									if( $days == 1 ){
										return "1 day ago";
									} else {
										return $days . " days ago";
									}
									
								}
					
								else if( $days <= 7 ){
					
									if( $days == 1 ){
										return "1 day ago";
									} else {
										return $days . " days ago";
									}
									
								}
					
								else if( $weeks <= 4.3 ){
					
									if( $weeks == 1 ){
										return "1 week ago";
									} else {
										return $weeks . " weeks ago";
									}
									
								}
					
								else if( $months <= 12 ){
					
									if( $months == 1 ){
										return "1 month ago";
									} else {
										return $months . " months ago";
									}
									
								}
					
								else {
									if( $years == 1 ){
										return "1 year ago";
									} else {
										return $years . " years ago";
									}
								}									
							}
						?>

					<!-- blog  -->
					<?php
					
						if(isset($_GET['pId'])){

						$blogId = $_GET['pId'];

						$Post    = "SELECT * FROM post WHERE id = '$blogId'";
						$postDb  = mysqli_query($db, $Post);

						while( $postRow = mysqli_fetch_assoc($postDb) ){
							$id         = $postRow['id'];
							$title      = $postRow['title'];
							$dec        = $postRow['description'];
							$author     = $postRow['author_id'];
							$category   = $postRow['category_id'];
							$post_date  = $postRow['post_date'];
							$image      = $postRow['image'];
							$view       = $postRow['view_count'];
							$day        = $postRow['post_day'];
							$month      = $postRow['post_month'];

							?>

							<!-- blog content -->
							<article class="post post-large blog-single-post border-0 m-0 p-0">
								<div class="post-image ml-0">
									<img src="admin/assets/post-image/<?php echo $image; ?>" class="single-img blog-img" alt="" />
								</div>
					
								<div class="post-date ml-0">
									<span class="day"><?php 
										$len = ( strlen($day) == 1 ) ? 0 : "";
										echo $len . $day; 
									?></span>
									<span class="month"><?php echo $month; ?></span>
								</div>
					
								<div class="post-content ml-0">
						
									<h2 class="font-weight-bold blog-heading"> <?php echo $title; ?> </h2>
						
									<div class="post-meta">
												<span><i class="far fa-user"></i> By  <?php
													$authorSql = "SELECT * FROM users WHERE id = '$author'";
													$authorDb  = mysqli_query($db, $authorSql);
													while($row = mysqli_fetch_assoc($authorDb)){
														$name  =  $row['name'];
														echo $name;
													}
												?>  </span>
												<span><i class="far fa-folder"></i> 
													<?php
														$catSql = "SELECT * FROM category WHERE id = '$category' ";
														$catDb  = mysqli_query($db, $catSql);
														while($catRow = mysqli_fetch_assoc($catDb)){
															$catName = $catRow['name'];
															echo $catName;
														}
													?>
												</span>
												<span><i class="fas fa-eye"></i> 
													<?php echo $view; ?> Views
												</span>
											</div>

									<p><?php echo $dec; ?></p>
						
									<div class="post-block mt-5 post-share">
										<h4 class="mb-3">Share this Post</h4>
						
										<!-- AddThis Button BEGIN -->
										<div class="addthis_toolbox addthis_default_style ">
											<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
											<a class="addthis_button_tweet"></a>
											<a class="addthis_button_pinterest_pinit"></a>
											<a class="addthis_counter addthis_pill_style"></a>
										</div>
										<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-50faf75173aadc53"></script>
										<!-- AddThis Button END -->
						
									</div>
						
									<div class="post-block mt-4 pt-2 post-author">
										<h4 class="mb-3">Category</h4>
										<div class="img-thumbnail img-thumbnail-no-borders d-block pb-3">
											
										</div>
										<p><strong class="name"><a href="#" class="text-4 pb-2 pt-2 d-block">
											<?php
												$categorySql =  "SELECT * FROM category WHERE id = '$category'";
												$cDb         = mysqli_query($db, $categorySql);
				
												while($cRow = mysqli_fetch_assoc($cDb)){
													$cName = $cRow ['name'];
													echo $cName;
												}
											?>
										</a></strong></p>
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae. Sed dui lorem, adipiscing in adipiscing et, interdum nec metus. Mauris ultricies, justo eu convallis placerat, felis enim ornare nisi, vitae mattis nulla ante id dui. </p>
									</div>

							<?php

						}
					}

					?>

					<!-- view count data -->
					<?php 
						$updateView    = $view + 1;
						$updateViewSql = "UPDATE post SET view_count = '$updateView' WHERE id = '$id'";
						$updateDb      = mysqli_query($db, $updateViewSql);
					?>


							<!-- all comment -->
							<?php 
							
								if( isset($_GET['pId']) ){
									$pId      = $_GET['pId'];
									$cmtSql   = "SELECT * FROM comment WHERE post_id = $pId";
									$cmtDb    = mysqli_query($db, $cmtSql);
									$totalCmt = mysqli_num_rows($cmtDb);

									?>
									<div id="comments" class="post-block mt-5 post-comments">
										<h4 class="mb-3">Comments (<?php echo $totalCmt; ?>)</h4>
						
										<ul class="comments">
											<!-- comment info -->
											<?php

												if( $totalCmt != 0 ){

													while( $cmtRow = mysqli_fetch_assoc($cmtDb) ){

														$cmtId       = $cmtRow['id'];
														$userCmt     = $cmtRow['comments'];
														$user_id     = $cmtRow['user_id'];
														$date        = $cmtRow['date'];
														$time        = $cmtRow['date_time'];

														?>
															<li>
																<div class="comment">
																		<div class="img-thumbnail img-thumbnail-no-borders d-none d-sm-block">
																			<!-- user image -->
																		<?php
																			$imgSql  = "SELECT image AS 'userImage' FROM users WHERE id = '$user_id'";
																			$imgDb   = mysqli_query($db, $imgSql);

																			while($user_imgRow = mysqli_fetch_assoc($imgDb)){
																				extract($user_imgRow);
																				
																				if( !empty($userImage) ){
																					?>
																						<img src="admin/assets/user-image/<?php echo $userImage; ?>" alt="" class="userImg cmtImg">
																					<?php
																				}else {
																					?>
																						<img src="admin/assets/user-image/defualt.png" alt="" class="userImg cmtImg">
																					<?php
																				}
																			}

																		?>
																		</div>
																		<div class="comment-block">
																			<div class="comment-arrow"></div>
																			<span class="comment-by">
																				<!-- user name -->
																				<strong>
																					<?php
																						$userSql = "SELECT name AS 'user' FROM users WHERE id = '$user_id'";
																						$userDb  = mysqli_query($db, $userSql);
																						while($userRow = mysqli_fetch_assoc($userDb)){
																							extract($userRow);
																							echo $user;
																						}

																					?>
																				</strong>

																				<!-- delete & reply comment -->
																				<?php
																					if( !empty($_SESSION['userId']) ){
																						if( $_SESSION['userId'] == $user_id ){
																							?>
																								<form action="" method="POST">
																									<input type="hidden" name="delCmt_id" value=<?php echo $cmtId; ?>>
																									<button type="submit" name="delCmt" class="float-right btnDel ">
																										<i class="fas fa-trash"></i>
																									</button>
																								</form>
																							<?php
																						}
																						else {
																							?>
																								<span class="float-right">
																									<span> <a href="#">
																										<i class="fas fa-reply"></i> 
																										Reply
																									</a></span>
																								</span>
																							<?php
																						}
																					}
																					
																				?>
																				
																			</span>
																			<p><?php echo $userCmt; ?></p>
																			<span class="date float-right">
																				<!-- ago time -->
																				<?php
																					date_default_timezone_set('Asia/Dhaka');
																					echo agoTime($time);
																				?>
																			</span>

																		</div>
																</div>
															</li>
														<?php
														
													}

												}
												else {
													echo "<span class='no-comment'>No comment found in this post !</span>";
												}
												
												if( !empty($_SESSION['status-del']) ){
													?> <script src="assets/js/sweetalert.js"></script><?php
													if(!empty( $_SESSION['status-del'])){
														?>
															<script>
															swal({
															title: "<?php echo $_SESSION['status-del']; ?>",
															icon: "<?php echo $_SESSION['status-item']; ?>",
															});
															</script>
														<?php
															unset($_SESSION['status-del']); 
													}
												}
												
												// delete comment
												if(isset($_POST['delCmt'])){
													if(!empty($_SESSION['status-del']) && !empty($_SESSION['status-item'])){
														?>
															<span>
																<?php echo $_SESSION['status-del']; ?>
															</span>
														<?php
													}
													else{
													$delId     = $_POST['delCmt_id'];
													$del_cmt   = "DELETE FROM comment WHERE id = '$delId'";
													$delDb     = mysqli_query($db, $del_cmt);
				
													if($delDb){
														$_SESSION['status-del'] = "Comment Deleted";
                                                        $_SESSION['status-item'] = "success";
														header("Location: single.php?pId=$pId");
													}
												}
											}
												
											?>

																
										</div>
									<?php

								}
							
							?>
					
								<div class="post-block mt-5 post-leave-comment">
								<h4 class="mb-3">Leave a comment</h4>

								<?php
								
									if( !empty( $_SESSION['userId'] ) ){
										?>
											<form class="contact-form p-4 rounded bg-color-grey" action="" method="POST">			
												<div class="p-2">
													<div class="form-row">
														<div class="form-group col">
															<label class="required font-weight-bold text-dark">Comment</label>
															<textarea maxlength="5000" data-msg-required="Please enter your message." rows="8" class="form-control" name="message" placeholder="Write Message..." required></textarea>
														</div>
													</div>
													<div class="form-row">
														<div class="form-group col mb-0">
															<input type="submit" name="btnPost" value="Post Comment" class="btn btn-primary btn-modern" data-loading-text="Loading...">
														</div>
													</div>
												</div>
												<?php
													if( !empty($_SESSION['status-cmt']) ){
														?> <script src="assets/js/sweetalert.js"></script><?php
														if(!empty( $_SESSION['status-cmt'])){
															?>
																<script>
																swal({
																title: "<?php echo $_SESSION['status-cmt']; ?>",
																icon: "<?php echo $_SESSION['status-item']; ?>",
																});
																</script>
															<?php
																unset($_SESSION['status-cmt']); 
														}
													}
												?>

												<!-- comment send to database -->
												<?php  

													if( isset($_POST['btnPost']) ){
														if( isset($_GET['pId']) ){

															if(!empty($_SESSION['status-cmt']) && !empty($_SESSION['status-item'])){
																?>
																	<span>
																		<?php echo $_SESSION['status-cmt']; ?>
																	</span>
																<?php
															}
															else {
															$postId  = $_GET['pId'];
															$userId  = $_SESSION['userId'];
															$comment = mysqli_real_escape_string($db, $_POST['message']);
															$time    = date("d-M-Y h:ia");
															date_default_timezone_set('Asia/Dhaka');

															if( !empty($comment) ){
																$cmtSql = "INSERT INTO comment (comments, post_id, user_id, date, date_time) VALUES ('$comment', '$postId', '$userId', now(), '$time') ";
																$cmtDb  = mysqli_query($db, $cmtSql);

																if($cmtDb){
																	$_SESSION['status-cmt'] = "Comment Added";
                                                                	$_SESSION['status-item'] = "success";
																	header("Location: single.php?pId=$postId");
																}
															}

														}
													}

												}

												?>

											</form>
											</div>
										<?php
									}
									else {
										if( isset($_GET['pId']) ){
											$postId = $_GET['pId'];
										}
										?>
											<div class="alert alert-info">
												Please <strong> <a href="login.php?lp=<?php echo $postId;?>">Log In</a> </strong> to post your comment
											</div>
										<?php
									}
								
								?>
					
							</div>
						</article>
					
					</div>
				</div>
			</div>

		</div>

	</div>

<?php
include "inc/footer.php";
?>
