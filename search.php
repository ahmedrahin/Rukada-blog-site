<?php
    include "inc/header.php";
?>

			<div role="main" class="main">

				<section class="page-header page-header-modern page-header page-header-modern bg-color-primary page-header-md m-0">
					<div class="container">
						<div class="row">

							<div class="col-md-12 align-self-center p-static order-2 text-center">
								<h1 class="text-light text-10"><strong>Search</strong></h1>
							</div>

							<div class="col-md-12 align-self-center order-1">

								<ul class="breadcrumb d-block text-center breadcrumb-light">
									<li><a href="#">Home</a></li>
									<li class="active">Pages</li>
								</ul>
							</div>
						</div>
					</div>
				</section>
				<hr class="m-0">

				<div class="container py-5 mt-3">

					<div class="row">
						<div class="col">

                            <?php

                                // search content
                                if(isset($_GET['search'])){
                                    $searchContent = $_GET['search'];

									$serchSql  = "SELECT * FROM post WHERE title LIKE '%$searchContent%' OR meta_tag LIKE '%$searchContent%' AND status = 1 ";
									$searchDb  = mysqli_query($db, $serchSql);
									$searchRow = mysqli_num_rows($searchDb);

                                    ?>

										<h2 class="font-weight-normal text-7 mb-0">Showing results for 
											<strong class="font-weight-extra-bold">
												<?php echo $searchContent; ?>
											</strong>
										</h2>
										<p class="lead mb-0"><?php echo $searchRow;?> results found.</p>

                                    <?php

                                }
                            
                            ?>

							
						</div>
					</div>
                    <br>
                    <br>
                    <br>
					
                    <div class="row">
						<div class="col-lg-3 order-lg-2">
							<?php include "inc/sidebar.php"; ?>
						</div>
						
						<div class="col-lg-9 order-lg-1">
							<div class="blog-posts">

								<!-- All Post -->
								<?php

								if(isset($_GET['search'])){
									$searchPost    = $_GET['search'];
									$serchpSql     = "SELECT * FROM post WHERE title LIKE '%$searchPost%' OR meta_tag LIKE '%$searchPost%' AND status = 1";    
									$searchpostDb  = mysqli_query($db, $serchpSql);
									$total_row     = mysqli_num_rows($searchpostDb);

									if( $total_row != 0 ){
										while( $postRow = mysqli_fetch_assoc($searchpostDb) ){
											$id         = $postRow['id'];
											$title      = $postRow['title'];
											$dec        = $postRow['description'];
											$author     = $postRow['author_id'];
											$category   = $postRow['category_id'];
											$post_date  = $postRow['post_date'];
											$image      = $postRow['image'];
											$day        = $postRow['post_day'];
							                $month      = $postRow['post_month'];

										?>

											<article class="post post-large">
												<div class="post-image">
													<a href="single.php?pId=<?php echo $id; ?>">
														<img src="admin/assets/post-image/<?php echo $image; ?>" class="blog-img" alt="" />
													</a>
												</div>
											
												<div class="post-date">
													<span class="day"><?php
														$len = ( strlen($day) == 1 ) ? 0 : "";
														echo $len . $day; 
													?></span>
													<span class="month"><?php
														echo  $month; 
													?></span>
												</div>
											
												<div class="post-content">
											
													<h2 class="font-weight-semibold text-6 line-height-3 mb-3"><a href="single.php?pId=<?php echo $id; ?>">
														<?php echo $title; ?>
													</a></h2>
													<p>
														<?php  
															echo substr( $dec, 0, 250 );
														?>
														[...]
													</p>
											
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
														<span><i class="far fa-comments"></i> <a href="#">12 Comments</a></span>
														<span class="d-block d-sm-inline-block float-sm-right mt-3 mt-sm-0"><a href="single.php?pId=<?php echo $id; ?>" class="btn btn-xs btn-light text-1 text-uppercase">Read More</a></span>
													</div>
											
												</div>
											</article>

										<?php
				
									}
								}else {
									echo "<div class='alert alert-info'>Opps!! No Post Found based on your search content <b>" . $searchPost ."</b></div>";
								}
							}
								
								?>

								

								<ul class="pagination float-right">
									<li class="page-item"><a class="page-link" href="#"><i class="fas fa-angle-left"></i></a></li>
									<li class="page-item active"><a class="page-link" href="#">1</a></li>
									<li class="page-item"><a class="page-link" href="#">2</a></li>
									<li class="page-item"><a class="page-link" href="#">3</a></li>
									<a class="page-link" href="#"><i class="fas fa-angle-right"></i></a>
								</ul>

							</div>
						</div>
					</div>

					<div class="row">
						<div class="col">

							

							<ul class="pagination float-right">
								<li class="page-item"><a class="page-link" href="#"><i class="fas fa-angle-left"></i></a></li>
								<li class="page-item active"><a class="page-link" href="#">1</a></li>
								<li class="page-item"><a class="page-link" href="#">2</a></li>
								<li class="page-item"><a class="page-link" href="#">3</a></li>
								<a class="page-link" href="#"><i class="fas fa-angle-right"></i></a>
							</ul>

						</div>
					</div>
				</div>

				

			</div>

<?php
    include "inc/footer.php";
?>			